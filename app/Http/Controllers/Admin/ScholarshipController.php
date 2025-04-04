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

class ScholarshipController extends Controller
{
    /* Pending Scholarship Application function */

    public function index(Request $request)
    {
        $keyword = $request->search;

        if ($request->has('export')) {
            return Excel::download(new ScholarshipApplicationsExport($keyword), 'scholarship_applications.xlsx');
        }

        $pageTitle = "Scholarship Applications";

        $emptyMessage = "No Data Found";

        $applications = ScholarshipApplication::with('course')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('full_name', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhere('application_id', 'LIKE', "%$keyword%")
                    ->orWhere('phone', 'LIKE', "%$keyword%");
            })
            ->latest()
            ->paginate(10);

        $totalCount = ScholarshipApplication::count();

        $courses = Course::active()
            ->orderBy('title', 'ASC')
            ->get();
        return view('admin.scholarships.list', compact('pageTitle', 'emptyMessage', 'applications', 'keyword', 'totalCount', 'courses'));
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
            $length = 12;
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $password = substr(str_shuffle($characters), 0, $length);

            if (empty($checkUser)) {
                $nameParts = explode(' ', $application->full_name, 2);
                $firstname = $nameParts[0]; // First part is the firstname
                $lastname = isset($nameParts[1]) ? $nameParts[1] : ''; // Second part is the lastname

                $user =   User::create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'username' => strtolower($firstname . '.' . $lastname),
                    'email' => $email,
                    'mobile' => $application->phone,
                    'balance' => "0.00",
                    'password' => Hash::make($password),
                    'status' => 1,
                    'sv' => 1,
                    'ev' => 1
                ]);

                $courseInfo = Course::find($application->course_id);

                if (!empty($courseInfo)) {
                    UserCourse::create([
                        'user_id' => $user->id,
                        'course_id' => $courseInfo->id,
                        'author_id' => $courseInfo->author_id,
                        'status' => 'success'
                    ]);
                }

                if (!empty($email)) {
                    try {
                        $mailStatus = 1;
                        $application->update(['is_email_sent' => $mailStatus]);
                        Mail::to($email)->send(new ScholarshipApprovalNotification($password, $application));
                        info("Email Sent Successfully to " . json_encode($email));
                    } catch (\Throwable $th) {
                        $mailStatus = 2;
                        $application->update(['is_email_sent' => $mailStatus]);
                        info("Email Not Sent , having issue  " . json_encode($th->getMessage()));
                    }
                }
            } else {

                $courseInfo = Course::find($application->course_id);
                $password = substr(str_shuffle($characters), 0, $length);

                if (!empty($courseInfo)) {
                    UserCourse::create([
                        'user_id' => $checkUser->id,
                        'course_id' => $courseInfo->id,
                        'author_id' => $courseInfo->author_id,
                        'status' => 'success'
                    ]);
                }
                User::where('id', $checkUser->id)->update([
                    'password' => Hash::make($password),
                ]);

                if (!empty($email)) {
                    try {
                        $mailStatus = 1;
                        $application->update(['is_email_sent' => $mailStatus]);
                        Mail::to($email)->send(new ScholarshipApprovalNotification($password, $application));
                    } catch (\Throwable $th) {
                        $mailStatus = 2;
                        $application->update(['is_email_sent' => $mailStatus]);
                    }
                }
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
        $approvedUsers = ScholarshipApplication::where('approval_status', 1)
            ->where('is_slack_invite_sent', 0) // Process only unsent invites
            ->latest()
            ->select(['id', 'full_name', 'email'])
            ->get();


        if (empty($approvedUsers)) {
            info("No approved users found for Slack invite.");
            return;
        }

        $workspaceInviteLink = getenv('SLACK_WORKSPACE_INVITE_LINK');

        foreach ($approvedUsers as $user) {
            $email = strtolower($user->email);
            $name = $user->full_name;

            if (empty($email)) {
                ScholarshipApplication::where('id', $user->id)->update(['is_slack_invite_sent' => 2]);
                continue; // Skip to the next user if email is missing
            }

            try {
                $email = strtolower($email);
                // Send the email
                Mail::to($email)->send(new SlackWorkspaceInviteMail($name, $workspaceInviteLink));

                Log::info("Slack Workspace mail sent successfully" . json_encode($email));
                // Mark as invite sent successfully
                $user->update(['is_slack_invite_sent' => 1]);
            } catch (\Throwable $th) {
                // Log the error and mark as failed
                Log::info("Mailgun email sending failed." . json_encode($th->getMessage()));

                $user->update(['is_slack_invite_sent' => 2]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Slack invites processed successfully.',
        ], 200);
    }
}
