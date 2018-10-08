<?php

namespace Activity\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Pluma\Support\Repository\Repository;
use Activity\Models\Activity;

class ActivityRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Activity::class;

    /**
     * An instance of a log.
     *
     * @var array
     */
    protected $log;

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [];
    }

    /**
     * Log the activity.
     *
     * @param string $subject
     * @param  array $causer
     * @return void
     */
    public function log($subject, $causer)
    {
        $this->log['subject'] = $subject;
        $this->log['url'] = request()->fullUrl();
        $this->log['method'] = request()->method();
        $this->log['ip_address'] = request()->ip();
        $this->log['agent'] = request()->header('user-agent');
        $this->log['causer_id'] = $causer[0] ?? null;
        $this->log['causer_type'] = $causer[1] ?? null;
        $this->model->create($this->log);
    }
}
