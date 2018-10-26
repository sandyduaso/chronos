<?php

namespace Timesheet\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Reader\Csv as CsvReader;
use Pluma\Support\Repository\Repository;
use Role\Models\Role;
use Timesheet\Models\Timedump;
use Timesheet\Models\Timesheet;
use Timesheet\Support\Punchcard\Punchcard;
use User\Models\Detail;
use User\Models\User;

class TimesheetRepository extends Repository
{
    use Traits\ExportToSpreadsheet;

    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Timesheet::class;

    /**
     * The timedump model instance.
     *
     * @var \Timesheet\Models\Timedump
     */
    protected $timedumps;

    /**
     * The Punchcard instance.
     *
     * @var \Timesheet\Support\Punchcard\Punchcard
     */
    protected $punchcard;

    /**
     * Constructor of the class.
     *
     * @param \Pluma\Models\Model $model
     */
    public function __construct(Timesheet $model = null)
    {
        parent::__construct($model);

        $this->timedumps = new Timedump();

        $this->punchcard = $this->punchcard();
    }

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required',
            'data' => 'sometimes|required',
            'file' => 'sometimes|mimes:csv,txt|file|required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'data.required' => 'The csv file is required.'
        ];
    }

    /**
     * Process a given file model resource.
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function process(UploadedFile $file)
    {
        $csv = new CsvReader();
        $sheet = $csv->load($file->getPathname());
        $worksheet = $sheet->getActiveSheet();

        return $worksheet;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $param
     */
    public function store($data)
    {
        // Timesheet
        $timesheet = $this->model->create([
            'name' => $data['name'],
            'start_date' => date('Y-m-d', strtotime($data['start_date'])),
            'end_date' => date('Y-m-d', strtotime($data['end_date'])),
            'user_id' => user()->id,
        ]);

        // Timedumps
        $this->saveTimedumps(json_decode($data['data']), $timesheet);

        return $timesheet;
    }

    /**
     * Update model resource.
     *
     * @param array  $data
     * @param int $id
     */
    public function update(array $data, $id)
    {
        $timesheet = $this->model->findOrFail($id);
        $timesheet->fill([
            'name' => $data['name'],
            'start_date' => date('Y-m-d', strtotime($data['start_date'])),
            'end_date' => date('Y-m-d', strtotime($data['end_date'])),
            'user_id' => user()->id,
        ]);

        if (isset($data['file']) && $data['file'] instanceof UploadedFile) {
            $timesheet->timedumps()->delete();
            $data['data'] = json_encode($this->process($data['file'])->toArray());
            $this->saveTimedumps(json_decode($data['data']), $timesheet);
        }

        $timesheet->save();

        return $timesheet;
    }

    /**
     * Export from given format
     *
     * @param int $id
     * @param array $data
     * @return void
     */
    public function export($id, $data)
    {
        $resource = $this->find($id);

        switch ($data['format']) {
            case 'xlsx':
                $this->toSpreadsheet($resource, $data);
                return;
                break;

            default:
            case 'pdf':
                $this->toPDF($resource, $data);
                break;
        }
    }

    /**
     * Retrieve user from given parameters.
     *
     * @param string $value
     * @return mixed
     */
    public function user($value)
    {
        $user = User::whereHas('details', function ($query) use ($value) {
            $query->where('key', 'card_id');
            $query->where('value', $value);
        })->first();

        return $user;
    }

    /**
     * Retrieve a new Punchar instance.
     *
     * @return \Timesheet\Support\Punchcard\Punchcard
     */
    public function punchcard()
    {
        return new Punchcard([
            'default_time_in' => settings('timesheet_default_time_in', '09:00 AM'),
            'default_time_out' => settings('timesheet_default_time_out', '06:15 PM'),
            'default_lunch_start' => settings('timesheet_default_lunch_start', '01:00 PM'),
            'default_lunch_end' => settings('timesheet_default_lunch_end', '02:00 PM'),
        ]);
    }

    public function charts($departments)
    {
        $charts['totallates'] = ['Total No. of Lates'];
        $x = [];
        foreach ($departments as $name => $employees) {
            foreach ($employees as $j => $employee) {
                $charts['totallates'][$name][] = $this->punchcard()->totalLateCount($employee['calendar'], 'time_in');
            }
            $charts['totallates'][$name] = $y = array_sum($charts['totallates'][$name]);
            $x[$name] = $y;
        }
        $orderedValues = $x;
        sort($orderedValues);

        $newX = [];
        foreach ($x as $key => $value) {
            foreach ($orderedValues as $orderedKey => $orderedValue) {
                if ($value === $orderedValue) {
                    $key = $orderedKey;
                    break;
                }
            }
            $newX[] = $key + 1;
        }

        $charts['ranking'] = array_merge(['Ranking'], array_values($newX));

        return [array_values($charts['totallates']), $charts['ranking']];
    }

    /**
     * Retrieve the top late employees.
     *
     * @return array
     */
    public function lates($lates, $take = 10)
    {
        $charts[0] = ['Total Late Points'];
        $employees = [];
        foreach ($lates as $employee) {
            $employee['hours-late'] = $this->punchcard()->toSeconds($this->punchcard()->totalFromKey($employee['calendar']->toArray(), 'tardy_time'));
            $employees[] = $employee;
        }

        $employees = collect($employees)->sortByDesc('hours-late')->map(function ($item) {
            // $this->punchcard()->toTime
            $item['hours-late'] = (string) ($item['hours-late']);
            return [
                'hours-late' => $item['hours-late'],
                'metadata' => $item['metadata'],
                'user' => $item['user'],
            ];
        })->take($take);

        foreach ($employees as $emp) {
            $charts[0][] = $emp['hours-late'];
            $charts[1][] = (string) (! is_null($emp['user']) ? $emp['user']->displayname : ($emp['metadata']->firstname ?? $emp['metadata']->card_id ?? 'Unnamed Employee'));
        }
        $charts[0] = [$charts[0]];

        return $charts;
    }

    /**
     * Save the timedumps.
     *
     * @param array $data
     * @param \Timesheet\Models\Timesheet $timesheet
     * @return void
     */
    protected function saveTimedumps($data, $timesheet)
    {
        $dataset = $data;
        $keys = array_shift($dataset);

        $dataset = collect($dataset)->map(function ($set) use ($keys) {
            $set = array_combine($keys, $set);
            return $set;
        });

        $punchcard = $this->punchcard();

        $dataset = $dataset->map(function ($item) use ($punchcard) {
            $item['time_in'] = $item['time_in'] ?? '00:00:00';
            $item['time_out'] = $item['time_out'] ?? '00:00:00';

            $item['date'] = date('Y/m/d', strtotime($item['time_in']));
            $item['total_am'] = $punchcard->totalAM($item['time_in']);
            $item['total_pm'] = $punchcard->totalPM($item['time_out']);
            $item['total_time'] = $punchcard->duration($item['time_in'], $item['time_out']);
            $item['tardy_time'] = $punchcard->tardy($item['time_in']);
            $item['under_time'] = $punchcard->undertime($item['time_out']);
            $item['over_time'] = $punchcard->overtime($item['time_out']);
            $item['offset_hours'] = $punchcard->offset($item['time_in'], $item['time_out']);
            $item['user'] = $this->user($item['user_id'] ?? $item['card_id'] ?? null);

            return $item;
        });

        $dataset->sortBy('date')->each(function ($set) use ($timesheet) {
            $this->timedumps->create([
                'date' => date('Y-m-d', strtotime($set['date'])),
                'time_in' => date('H:i:s', strtotime($set['time_in'])),
                'time_out' => date('H:i:s', strtotime($set['time_out'])),
                'total_am' => date('H:i:s', strtotime($set['total_am'])),
                'total_pm' => date('H:i:s', strtotime($set['total_pm'])),
                'total_time' => date('H:i:s', strtotime($set['total_time'])),
                'tardy_time' => date('H:i:s', strtotime($set['tardy_time'])),
                'under_time' => date('H:i:s', strtotime($set['under_time'])),
                'over_time' => date('H:i:s', strtotime($set['over_time'])),
                'offset_hours' => date('H:i:s', strtotime($set['offset_hours'])),
                'key' => $set['key'] ?? $set['user']->id ?? $set['card_id'] ?? null,
                'department' => $set['department'] ?? null,
                'user_id' => $set['user'] ? $set['user']->id : null,
                'timesheet_id' => $timesheet->id,
                'metadata' => json_encode(collect($set)->except(['date','time_in','time_out','total_am','total_pm','total_time','tardy_time','under_time','over_time','offset_hours','user'])),
            ]);
        });
    }
}
