<?php

namespace App\Services\Admin\Application;

use App\Exceptions\ConsumerException;
use App\Models\SkillApplication;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ApplicationService
{
    
    public function getAllApplications()
    {
        return SkillApplication::with('user')->paginate(10);
    }

    public function viewApplicationListPage()
    {
        $applications = $this->getAllApplications();
        $pageTitle = "Course Applications";
        return view('admin.application.index', compact('applications', 'pageTitle'));
    }

    public function updateApplicationStatus(int $id, string $status)
    {
        DB::beginTransaction();
        try {
        
            $this->updateStatus($id, $status);
            // Assign the course to the user if the status is approved
            if ($status === "approved") {
                $this->assignCourseToUser($id);
            }
            DB::commit();

            $notify[] = ['success', "Application status updated to '{$status}' successfully!"];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            DB::rollback();

            Log::error("Error creating Application", [
                "message" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]);
            $notify[] = ['error', 'Somethig went wrong, application status could not be update successfully!'];
            return back()->withNotify($notify);
        } 
    }

    public function updateStatus(int $id, string $status)
    {
        return SkillApplication::where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function assignCourseToUser(int $id)
    {
        $application =  SkillApplication::where('id', $id)->with(['user', 'course'])->first();
    
        $user = $application->user;
        $course_id = $application->program_course_id;

        return UserCourse::create([
            'user_id' => $user->id,
            'course_id' => $course_id,
            'status' => 'success'
        ]);
    }
}
