<?php

namespace App\Services\Application;

use App\Exceptions\ConsumerException;
use App\Models\SkillApplication;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ApplicationService
{
    protected $activeTemplate;

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    
    public function getAllCourses()
    {
        return Course::select('id', 'title', 'status')->where('status', 2)->get();
    }

    public function viewApplicationFormPage()
    {
        $courses = $this->getAllCourses();
        $pageTitle = "Course Application";
        return view($this->activeTemplate . 'application.form', compact('courses', 'pageTitle'));
    }

    public function createApplicationRecord($data)
    {
        return SkillApplication::create($data);
    }

    public function formatApplicationData($data)
    {
        $data['user_id'] = auth()->user()->id;
        $data['status'] = "pending";
        return $data;
    }

    public function submitApplicationForm($data)
    {
        DB::beginTransaction();
        try {
            $data = $this->formatApplicationData($data);
            $this->createApplicationRecord($data);
            DB::commit();

            $notify[] = ['success', 'Application submitted successfully!'];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            DB::rollback();

            Log::error("Error creating Application", [
                "message" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]);
            $notify[] = ['error', 'Somethig went wrong, application could not submitted successfully!'];
            return back()->withNotify($notify);
        }
    }
}
