<?php

namespace Employee\Repositories;

use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Pluma\Support\Repository\Repository;
use User\Models\User;
use User\Repositories\UserRepository;

class EmployeeRepository extends UserRepository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = User::class;

    /**
     * The User model type.
     * Used for module specific users.
     *
     * @var string
     */
    protected $usertype = 'employee';

    /**
     * Import from file to storage.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function import(UploadedFile $file)
    {
        $dataset = $this->process($file)->toArray();
        $keys = array_shift($dataset);
        $dataset = collect($dataset)->map(function ($set) use ($keys) {
            $set = array_combine($keys, $set);
            return $set;
        });

        foreach ($dataset as $i => $user) {
            $user = array_merge($user, ['type' => $this->usertype]);
            $user = $this->model->updateOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }

    /**
     * Export from given format
     *
     * @param array $id
     * @param array $data
     * @return void
     */
    public function export($id, $data)
    {
        $resources = $this->repository->model()->whereIn('id', $id)->get();

        switch ($data['format']) {
            case 'xlsx':
                $this->toSpreadsheet($resources, $data);
                return;
                break;

            default:
            case 'pdf':
                $this->toPDF($resources, $data);
                break;
        }
    }

    /**
     * Process a given file model resource.
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function process(UploadedFile $file)
    {
        $csv = new Csv();
        $sheet = $csv->load($file->getPathname());
        $dataset = $sheet->getActiveSheet();

        return $dataset;
    }
}
