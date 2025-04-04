<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaptopApplicationsExport;
use App\Exports\ScholarshipApplicationsExport;
use App\Http\Controllers\Controller;
use App\Mail\LaptopApplicationStatus;
use App\Mail\LaptopConfirmation;
use App\Mail\ScholarshipApprovalNotification;
use App\Mail\ScholarshipRejectionNotification;
use App\Mail\SlackWorkspaceInviteMail;
use App\Models\Course;
use App\Models\LaptopApplication;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class LaptopController extends Controller
{
    /* Pending Scholarship Application function */

    public function index(Request $request)
    {
        $keyword = $request->search;

        if ($request->has('export')) {
            return Excel::download(new LaptopApplicationsExport($keyword), 'laptop_applications.xlsx');
        }

        $pageTitle = "Laptop Applications";

        $emptyMessage = "No Data Found";

        $applications = LaptopApplication::with('course')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('full_name', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhere('phone', 'LIKE', "%$keyword%");
            })
            ->latest()
            ->paginate(10);

        $totalCount = LaptopApplication::count();

        $courses = Course::active()
            ->orderBy('title', 'ASC')
            ->get();
        return view('admin.laptops.list', compact('pageTitle', 'emptyMessage', 'applications', 'keyword', 'totalCount', 'courses'));
    }

    public function denyApplication(Request $request)
    {
        $application = LaptopApplication::where('id', $request->application_id)->firstOrFail();
        if ($application) {

            $application->update(['approval_status' => 2]);

            $email = $application->email;

            $status = "rejected";

            $remarks = $status == 'rejected' ? 'Your application lacks information.' : null;

            Mail::to($email)->send(new LaptopApplicationStatus($application->full_name, $status, $remarks));

            return response()->json([
                'status' => 200,
                'message' => 'Application successfully rejected.',
            ], 200);
        }

        // If the application doesn't exist, return a 400 response
        return response()->json([
            'status' => 400,
            'message' => 'Application not found.',
        ], 400);
    }
    public function approveApplication(Request $request)
    {
        $application = LaptopApplication::where('id', $request->application_id)->firstOrFail();
        if ($application) {

            $application->update(['approval_status' => 1]);

            $email = $application->email;

            $status = "approved";

            $remarks = $status == 'rejected' ? 'Your application lacks information.' : null;

            Mail::to($email)->send(new LaptopApplicationStatus($application->full_name, $status, $remarks));

            return response()->json([
                'status' => 200,
                'message' => 'Application successfully approved.',
            ], 200);
        }

        // If the application doesn't exist, return a 400 response
        return response()->json([
            'status' => 400,
            'message' => 'Application not found.',
        ], 400);
    }
}
