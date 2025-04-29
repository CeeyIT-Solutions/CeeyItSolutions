<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ScholarshipApplicationsExport;
use App\Http\Controllers\Controller;
use App\Mail\ScholarshipApprovalNotification;
use App\Mail\ScholarshipRejectionNotification;
use App\Mail\SlackWorkspaceInviteMail;
use App\Models\Course;
use App\Models\ScholarshipApplication;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ScholarshipController extends Controller
{
    /* Pending Scholarship Application function */

    public function index(Request $request)
    {
        $keyword = $request->search;
        $dateSort = $request->get('date_sort', 'desc');
        $year = 2025;
        $operator = '<';

        if ($request->has('export')) {
            return Excel::download(
                new ScholarshipApplicationsExport($keyword, $dateSort, $year, $operator),
                'scholarship_applications.csv'
            );
        }

        $pageTitle = "Scholarship Applications Older";
        $emptyMessage = "No Data Found";

        $applications = ScholarshipApplication::with('course')
            ->where('apply_year', '<', 2025)
            ->when($keyword, function ($q) use ($keyword) {
                $q->where(function ($sub) use ($keyword) {
                    $sub->where('full_name', 'LIKE', "%{$keyword}%")
                        ->orWhere('email', 'LIKE', "%{$keyword}%")
                        ->orWhere('application_id', 'LIKE', "%{$keyword}%")
                        ->orWhere('phone', 'LIKE', "%{$keyword}%");
                });
            })
            ->orderBy('created_at', $dateSort)  // ← use the select value here
            ->paginate(10)
            ->appends([
                'search' => $keyword,
                'date_sort' => $dateSort,
            ]);

        $totalCount = ScholarshipApplication::where('apply_year', '<', 2025)
            ->count();

        $courses = Course::active()
            ->orderBy('title', 'ASC')
            ->get();

        return view('admin.scholarships.list', compact(
            'pageTitle',
            'emptyMessage',
            'applications',
            'keyword',
            'totalCount',
            'courses',
            'dateSort'        // pass into the view for selected= logic
        ));
    }


    public function indexNew(Request $request)
    {

        $keyword = $request->search;
        $dateSort = $request->get('date_sort', 'desc');
        $year = 2025;
        $operator = '>=';

        if ($request->has('export')) {
            return Excel::download(
                new ScholarshipApplicationsExport($keyword, $dateSort, $year, $operator),
                'scholarship_applications.csv'
            );
        }
        $pageTitle = "Scholarship Applications 2025";

        $emptyMessage = "No Data Found";

        $applications = ScholarshipApplication::with('course')
            ->where('apply_year', '>=', 2025)
            ->when($keyword, function ($q) use ($keyword) {
                $q->where(function ($sub) use ($keyword) {
                    $sub->where('full_name', 'LIKE', "%{$keyword}%")
                        ->orWhere('email', 'LIKE', "%{$keyword}%")
                        ->orWhere('application_id', 'LIKE', "%{$keyword}%")
                        ->orWhere('phone', 'LIKE', "%{$keyword}%");
                });
            })
            ->orderBy('created_at', $dateSort)  // ← use the select value here
            ->paginate(10)
            ->appends([
                'search' => $keyword,
                'date_sort' => $dateSort,
            ]);

        $totalCount = ScholarshipApplication::where('apply_year', '>=', 2025)->count();

        $courses = Course::active()
            ->orderBy('title', 'ASC')
            ->get();
        return view('admin.scholarships.list_new', compact('pageTitle', 'emptyMessage', 'applications', 'keyword', 'totalCount', 'courses', 'dateSort'));
    }

    public function denyApplication(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:scholarship_applications,id',
        ]);

        if (!$validated) {
            // Return a 400 response if validation fails
            return response()->json([
                'status' => 400,
                'message' => 'Invalid application ID or application does not exist.',
            ], 400);
        }

        // Attempt to update the application's status
        $application = ScholarshipApplication::with('course')->find($request->application_id);

        if ($application) {

            $application->update(['approval_status' => 2]);

            if (!empty($application->email)) {
                try {
                    $mailStatus = 1;
                    $application->update(['is_email_sent' => $mailStatus]);
                    Mail::to($application->email)->send(new ScholarshipRejectionNotification($application));
                } catch (\Throwable $th) {
                    $mailStatus = 2;
                    $application->update(['is_email_sent' => $mailStatus]);
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Application successfully denied.',
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
        $validated = $request->validate([
            'application_id' => 'required|exists:scholarship_applications,id',
        ]);

        if (!$validated) {
            // Return a 400 response if validation fails
            return response()->json([
                'status' => 400,
                'message' => 'Invalid application ID or application does not exist.',
            ], 400);
        }

        // Attempt to update the application's status
        $application = ScholarshipApplication::with('course')->find($request->application_id);

        if ($application) {

            $application->update(['approval_status' => 1]);

            $email = $application->email;

            $checkUser = User::where('email', $email)->first();

            if ($checkUser) {

                $courseInfo = Course::find($application->course_id);

                if (!empty($courseInfo)) {
                    UserCourse::create([
                        'user_id' => $checkUser->id,
                        'course_id' => $courseInfo->id,
                        'author_id' => $courseInfo->author_id,
                        'status' => 'success'
                    ]);
                }

                if (!empty($email)) {
                    try {
                        $mailStatus = 1;
                        $application->update(['is_email_sent' => $mailStatus]);
                        Mail::to($email)->send(new ScholarshipApprovalNotification("Your old password", $application));
                    } catch (\Throwable $th) {
                        $mailStatus = 2;
                        $application->update(['is_email_sent' => $mailStatus]);
                    }
                }
            } else {

                // throw an error user not found
                return response()->json([
                    'status' => 400,
                    'message' => 'User not found.',
                ], 400);
            }

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

    public function sendChannelInvite(Request $request)
    {
        $course_id = $request->course_id;
        $course = Course::find($course_id);

        $pageTitle = 'Send Email To Scholarship Applicants';
        return view('admin.users.email_scholarship', compact('pageTitle', 'course'));
    }


    public function sendSlackInvite()
    {
        $currentYear = Carbon::now()->year;

        $approvedUsers = ScholarshipApplication::where('approval_status', 1)
            ->where('is_slack_invite_sent', 0)
            ->where('apply_year', $currentYear)
            ->latest()
            ->select(['id', 'full_name', 'email'])
            ->get();

        if ($approvedUsers->isEmpty()) {
            Log::info("No approved users found for Slack invite in {$currentYear}.");
            return response()->json([
                'status' => 404,
                'message' => "No approved users found for Slack invite in {$currentYear}.",
            ], 404);
        }

        $workspaceInviteLink = env('SLACK_WORKSPACE_INVITE_LINK');

        foreach ($approvedUsers as $user) {
            $email = strtolower($user->email);
            $name = $user->full_name;

            if (empty($email)) {
                $user->update(['is_slack_invite_sent' => 2]);
                continue;
            }

            try {
                Mail::to($email)->send(new SlackWorkspaceInviteMail($name, $workspaceInviteLink));
                Log::info("Slack Workspace invite sent successfully to: " . $email);
                $user->update(['is_slack_invite_sent' => 1]);
            } catch (\Throwable $th) {
                Log::error("Failed to send Slack invite to {$email}: " . $th->getMessage());
                $user->update(['is_slack_invite_sent' => 2]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Slack invites processed successfully for ' . $currentYear,
        ], 200);
    }


    public function sendSlackInviteById($id)
    {
        $user = ScholarshipApplication::where('id', $id)
            ->where('approval_status', 1)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found or not approved.',
            ], 404);
        }

        if ($user->is_slack_invite_sent == 1) {
            return response()->json([
                'status' => 400,
                'message' => 'Slack invite already sent.',
            ], 400);
        }

        $email = strtolower($user->email);
        $name = $user->full_name;
        $workspaceInviteLink = env('SLACK_WORKSPACE_INVITE_LINK');

        if (empty($email)) {
            $user->update(['is_slack_invite_sent' => 2]);
            return response()->json([
                'status' => 422,
                'message' => 'User email is missing.',
            ], 422);
        }

        try {
            Mail::to($email)->send(new SlackWorkspaceInviteMail($name, $workspaceInviteLink));
            $user->update(['is_slack_invite_sent' => 1]);

            Log::info("Slack invite sent to: " . $email);

            return response()->json([
                'status' => 200,
                'message' => 'Slack invite sent successfully.',
            ]);
        } catch (\Throwable $th) {
            $user->update(['is_slack_invite_sent' => 2]);

            Log::error("Slack invite failed: " . $th->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'Failed to send Slack invite.',
            ]);
        }
    }


    public function approveAllPending(Request $request)
    {
        $applyYear = $request->input('apply_year');

        if (!$applyYear || !is_numeric($applyYear)) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid or missing apply year.',
            ], 422);
        }

        $applications = ScholarshipApplication::with('course')
            ->where('approval_status', 0)
            ->where('apply_year', $applyYear)
            ->get();

        if ($applications->isEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => "No pending applications found for {$applyYear}.",
            ]);
        }

        $approvedCount = 0;
        $emailFailures = 0;

        foreach ($applications as $application) {
            $application->update(['approval_status' => 1]);

            $email = $application->email;
            if (empty($email))
                continue;

            $user = User::where('email', $email)->first();

            // Only proceed if user exists
            if (!$user)
                continue;

            // Assign course if course exists
            if (!empty($application->course)) {
                UserCourse::create([
                    'user_id' => $user->id,
                    'course_id' => $application->course->id,
                    'author_id' => $application->course->author_id,
                    'status' => 'success'
                ]);
            }

            // Send email
            try {
                Mail::to($email)->send(new ScholarshipApprovalNotification("Your old password", $application));
                $application->update(['is_email_sent' => 1]);
            } catch (\Throwable $th) {
                $application->update(['is_email_sent' => 2]);
                $emailFailures++;
                info("Email send failed: " . $email . " - " . $th->getMessage());
            }

            $approvedCount++;
        }

        return response()->json([
            'status' => 200,
            'message' => "{$approvedCount} applications approved for {$applyYear}. " .
                ($emailFailures > 0 ? "{$emailFailures} email(s) failed to send." : "All emails sent successfully."),
        ]);
    }
}