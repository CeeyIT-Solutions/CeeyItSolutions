<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Application\ApplicationService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserApplicationRequest;

class SkillApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function createFormPage()
    {
        return $this->applicationService->viewApplicationFormPage();
    }

    public function submitForm(StoreUserApplicationRequest $request)
    {
        return $this->applicationService->submitApplicationForm($request->validated());
    }
}
