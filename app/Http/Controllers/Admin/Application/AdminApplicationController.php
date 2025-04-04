<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Services\Admin\Application\ApplicationService;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    //
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function listApplications()
    {
        return $this->applicationService->viewApplicationListPage();
    }

    public function updateStatus($id, Request $request)
    {
        return $this->applicationService->updateApplicationStatus( (int) $id, $request->status);
    }
}
