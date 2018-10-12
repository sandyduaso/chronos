<?php

namespace Timesheet\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Timesheet\Repositories\TimesheetRepository;

class TimesheetController extends AdminController
{
    use Resources\TimesheetResourceAdminTrait,
        Resources\TimesheetResourceExportTrait,
        Resources\TimesheetResourceSoftDeleteTrait,
        Resources\TimesheetResourceUploadTrait;

    /**
     * Inject the resource model to the repository instance.
     *
     */
    public function __construct()
    {
        $this->repository = new TimesheetRepository();

        parent::__construct();
    }
}
