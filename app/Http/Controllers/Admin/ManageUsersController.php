<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\WithdrawMethod;
use App\Http\Controllers\Controller;
use App\Models\ScholarshipApplication;
use Illuminate\Support\Facades\Auth;
use App\Mail\UnverifiedUserEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifiedUserAnnouncement;


class ManageUsersController extends Controller
{
    public function allUsers()
    {
        $pageTitle = 'Manage Users';
        $emptyMessage = 'No user found';
        $users = User::where('is_instructor', '!=', 1)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function activeUsers()
    {
        $pageTitle = 'Manage Active Users';
        $emptyMessage = 'No active user found';
        $users = User::active()->where('is_instructor', '!=', 1)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function bannedUsers()
    {
        $pageTitle = 'Banned Users';
        $emptyMessage = 'No banned user found';
        $users = User::banned()->orderBy('id', 'desc')->where('is_instructor', '!=', 1)->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function emailUnverifiedUsers()
    {
        $pageTitle = 'Email Unverified Users';
        $emptyMessage = 'No email unverified user found';
        $users = User::emailUnverified()->where('is_instructor', '!=', 1)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }
    public function emailVerifiedUsers()
    {
        $pageTitle = 'Email Verified Users';
        $emptyMessage = 'No email verified user found';
        $users = User::emailVerified()->where('is_instructor', '!=', 1)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }


    public function smsUnverifiedUsers()
    {
        $pageTitle = 'SMS Unverified Users';
        $emptyMessage = 'No sms unverified user found';
        $users = User::smsUnverified()->where('is_instructor', '!=', 1)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }


    public function smsVerifiedUsers()
    {
        $pageTitle = 'SMS Verified Users';
        $emptyMessage = 'No sms verified user found';
        $users = User::smsVerified()->where('is_instructor', '!=', 1)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }


    public function usersWithBalance()
    {
        $pageTitle = 'Users with balance';
        $emptyMessage = 'No sms verified user found';
        $users = User::where('balance', '!=', 0)->where('is_instructor', '!=', 1)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }


    public function sendEmailBroadcast()
    {
        $users = User::where('ev', 1)->get();

        foreach ($users as $user) {
            // Validate email
            $validator = Validator::make(
                ['email' => $user->email],
                ['email' => 'required|email:rfc,dns']
            );

            if ($validator->fails()) {
                logger()->warning("Invalid email: " . $user->email);
                continue;
            }

            try {
                Mail::to($user->email)->send(new VerifiedUserAnnouncement($user));

                // Delay of 200 milliseconds (0.2 seconds)
                usleep(200000);
            } catch (\Exception $e) {
                logger()->error("Failed to send to {$user->email}: " . $e->getMessage());
            }
        }
        // foreach ($users as $user) {
        //     // Validate email
        //     $validator = Validator::make(
        //         ['email' => $user->email],
        //         ['email' => 'required|email:rfc,dns']
        //     );

        //     if ($validator->fails()) {
        //         logger()->warning("Invalid email: " . $user->email);
        //         continue;
        //     }

        //     try {
        //         Mail::to($user->email)->send(new VerifiedUserAnnouncement($user));
        //     } catch (\Exception $e) {
        //         logger()->error("Failed to send to {$user->email}: " . $e->getMessage());
        //     }
        // }

        return response()->json(['message' => 'Emails sent to verified users.']);
    }

    public function sendEmailToUnverified()
    {

        $users = User::where('ev', 0)->get();

        foreach ($users as $user) {
            // Validate email format and DNS
            $validator = Validator::make(
                ['email' => $user->email],
                ['email' => 'required|email:rfc,dns']
            );

            if ($validator->fails()) {
                // Log or skip invalid email
                logger()->warning("Skipped invalid email: " . $user->email);
                continue;
            }

            try {
                Mail::to($user->email)->send(new UnverifiedUserEmail($user->name, $user->email));
            } catch (\Exception $e) {
                logger()->error("Failed to send to {$user->email}: " . $e->getMessage());
            }
        }

        return response()->json(['message' => 'Emails sent to unverified users.']);

    }



    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $users = User::where(function ($user) use ($search) {
            $user->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })->where('is_instructor', '!=', 1);
        $pageTitle = '';
        if ($scope == 'active') {
            $pageTitle = 'Active ';
            $users = $users->where('status', 1);
        } elseif ($scope == 'banned') {
            $pageTitle = 'Banned';
            $users = $users->where('status', 0);
        } elseif ($scope == 'emailUnverified') {
            $pageTitle = 'Email Unverified ';
            $users = $users->where('ev', 0);
        } elseif ($scope == 'smsUnverified') {
            $pageTitle = 'SMS Unverified ';
            $users = $users->where('sv', 0);
        } elseif ($scope == 'withBalance') {
            $pageTitle = 'With Balance ';
            $users = $users->where('balance', '!=', 0);
        }

        $users = $users->paginate(getPaginate());
        $pageTitle .= 'User Search - ' . $search;
        $emptyMessage = 'No search result found';
        return view('admin.users.list', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'users'));
    }


    public function detail($id)
    {
        $pageTitle = 'User Detail';
        $user = User::findOrFail($id);
        $totalDeposit = Deposit::where('user_id', $user->id)->where('status', 1)->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id', $user->id)->where('status', 1)->sum('amount');
        $totalTransaction = Transaction::where('user_id', $user->id)->count();
        $totalCourses = Course::where('author_id', $user->id)->count();
        $purchasedCourses = $user->userCourses()->count();
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('admin.users.detail', compact('pageTitle', 'user', 'totalDeposit', 'totalWithdraw', 'totalTransaction', 'countries', 'totalCourses', 'purchasedCourses'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $countryData = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email|max:90|unique:users,email,' . $user->id,
            'mobile' => 'required|unique:users,mobile,' . $user->id,
            'country' => 'required',
        ]);
        $countryCode = $request->country;
        $user->mobile = $request->mobile;
        $user->country_code = $countryCode;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->address = [
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$countryData->$countryCode->country,
        ];
        $user->status = $request->status ? 1 : 0;
        $user->ev = $request->ev ? 1 : 0;
        $user->sv = $request->sv ? 1 : 0;
        $user->ts = $request->ts ? 1 : 0;
        $user->tv = $request->tv ? 1 : 0;
        $user->save();

        $notify[] = ['success', 'User detail has been updated'];
        return redirect()->back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $user = User::findOrFail($id);
        $amount = $request->amount;
        $general = GeneralSetting::first(['cur_text', 'cur_sym']);
        $trx = getTrx();

        if ($request->act) {
            $user->balance += $amount;
            $user->save();
            $notify[] = ['success', $general->cur_sym . $amount . ' has been added to ' . $user->username . '\'s balance'];

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->details = 'Added Balance Via Admin';
            $transaction->trx = $trx;
            $transaction->save();

            notify($user, 'BAL_ADD', [
                'trx' => $trx,
                'amount' => getAmount($amount),
                'currency' => $general->cur_text,
                'post_balance' => getAmount($user->balance),
            ]);
        } else {
            if ($amount > $user->balance) {
                $notify[] = ['error', $user->username . '\'s has insufficient balance.'];
                return back()->withNotify($notify);
            }
            $user->balance -= $amount;
            $user->save();



            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Subtract Balance Via Admin';
            $transaction->trx = $trx;
            $transaction->save();


            notify($user, 'BAL_SUB', [
                'trx' => $trx,
                'amount' => $amount,
                'currency' => $general->cur_text,
                'post_balance' => getAmount($user->balance)
            ]);
            $notify[] = ['success', $general->cur_sym . $amount . ' has been subtracted from ' . $user->username . '\'s balance'];
        }
        return back()->withNotify($notify);
    }


    public function userLoginHistory($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'User Login History - ' . $user->username;
        $emptyMessage = 'No users login found.';
        $login_logs = $user->login_logs()->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.users.logins', compact('pageTitle', 'emptyMessage', 'login_logs'));
    }



    public function showEmailSingleForm($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'Send Email To: ' . $user->username;
        return view('admin.users.email_single', compact('pageTitle', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = User::findOrFail($id);
        sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function transactions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search User Transactions : ' . $user->username;
            $transactions = $user->transactions()->where('trx', $search)->with('user')->orderBy('id', 'desc')->paginate(getPaginate());
            $emptyMessage = 'No transactions';
            return view('admin.reports.transactions', compact('pageTitle', 'search', 'user', 'transactions', 'emptyMessage'));
        }
        $pageTitle = 'User Transactions : ' . $user->username;
        $transactions = $user->transactions()->with('user')->orderBy('id', 'desc')->paginate(getPaginate());
        $emptyMessage = 'No transactions';
        return view('admin.reports.transactions', compact('pageTitle', 'user', 'transactions', 'emptyMessage'));
    }

    public function deposits(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $userId = $user->id;
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search User Deposits : ' . $user->username;
            $deposits = $user->deposits()->where('trx', $search)->orderBy('id', 'desc')->paginate(getPaginate());
            $emptyMessage = 'No deposits';
            return view('admin.deposit.log', compact('pageTitle', 'search', 'user', 'deposits', 'emptyMessage', 'userId'));
        }

        $pageTitle = 'User Deposit : ' . $user->username;
        $deposits = $user->deposits()->orderBy('id', 'desc')->paginate(getPaginate());
        $successful = $user->deposits()->orderBy('id', 'desc')->sum('amount');
        $pending = $user->deposits()->orderBy('id', 'desc')->sum('amount');
        $rejected = $user->deposits()->orderBy('id', 'desc')->sum('amount');
        $emptyMessage = 'No deposits';
        $scope = 'all';
        return view('admin.deposit.log', compact('pageTitle', 'user', 'deposits', 'emptyMessage', 'userId', 'scope', 'successful', 'pending', 'rejected'));
    }


    public function depViaMethod($method, $type = null, $userId)
    {
        $method = Gateway::where('alias', $method)->firstOrFail();
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Payment Via ' . $method->name;
            $deposits = Deposit::where('method_code', '>=', 1000)->where('user_id', $user->id)->where('method_code', $method->code)->where('status', 1)->orderBy('id', 'desc')->with(['user', 'gateway'])->paginate(getPaginate());
        } elseif ($type == 'rejected') {
            $pageTitle = 'Rejected Payment Via ' . $method->name;
            $deposits = Deposit::where('method_code', '>=', 1000)->where('user_id', $user->id)->where('method_code', $method->code)->where('status', 3)->orderBy('id', 'desc')->with(['user', 'gateway'])->paginate(getPaginate());
        } elseif ($type == 'successful') {
            $pageTitle = 'Successful Payment Via ' . $method->name;
            $deposits = Deposit::where('status', 1)->where('user_id', $user->id)->where('method_code', $method->code)->orderBy('id', 'desc')->with(['user', 'gateway'])->paginate(getPaginate());
        } elseif ($type == 'pending') {
            $pageTitle = 'Pending Payment Via ' . $method->name;
            $deposits = Deposit::where('method_code', '>=', 1000)->where('user_id', $user->id)->where('method_code', $method->code)->where('status', 2)->orderBy('id', 'desc')->with(['user', 'gateway'])->paginate(getPaginate());
        } else {
            $pageTitle = 'Payment Via ' . $method->name;
            $deposits = Deposit::where('status', '!=', 0)->where('user_id', $user->id)->where('method_code', $method->code)->orderBy('id', 'desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }
        $pageTitle = 'Deposit History: ' . $user->username . ' Via ' . $method->name;
        $methodAlias = $method->alias;
        $emptyMessage = 'Deposit Log';
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits', 'methodAlias', 'userId'));
    }



    public function withdrawals(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search User Withdrawals : ' . $user->username;
            $withdrawals = $user->withdrawals()->where('trx', 'like', "%$search%")->orderBy('id', 'desc')->paginate(getPaginate());
            $emptyMessage = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('pageTitle', 'user', 'search', 'withdrawals', 'emptyMessage'));
        }
        $pageTitle = 'User Withdrawals : ' . $user->username;
        $withdrawals = $user->withdrawals()->orderBy('id', 'desc')->paginate(getPaginate());
        $emptyMessage = 'No withdrawals';
        $userId = $user->id;
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'user', 'withdrawals', 'emptyMessage', 'userId'));
    }

    public function withdrawalsViaMethod($method, $type, $userId)
    {
        $method = WithdrawMethod::findOrFail($method);
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Withdrawal of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', 1)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate(getPaginate());
        } elseif ($type == 'rejected') {
            $pageTitle = 'Rejected Withdrawals of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', 3)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate(getPaginate());
        } elseif ($type == 'pending') {
            $pageTitle = 'Pending Withdrawals of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', 2)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate(getPaginate());
        } else {
            $pageTitle = 'Withdrawals of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', '!=', 0)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate(getPaginate());
        }
        $emptyMessage = 'Withdraw Log Not Found';
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'withdrawals', 'emptyMessage', 'method'));
    }

    public function showEmailAllForm()
    {
        $pageTitle = 'Send Email To All Users';
        return view('admin.users.email_all', compact('pageTitle'));
    }


    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (User::where('status', 1)->cursor() as $user) {
            sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All users will receive an email shortly.'];
        return back()->withNotify($notify);
    }
    public function sendScholarshipEmail(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
            'course_id' => 'required|integer',
        ]);
        $scholarshipUsers = ScholarshipApplication::where('course_id', $request->course_id)
            ->where('approval_status', 1)
            ->where('channel_invite_email', 0)
            ->get();
        if (empty($scholarshipUsers)) {
            $notify[] = ['error', 'No approved users found for email.'];

            return redirect()->route('admin.scholarships.list')->withNotify($notify);
        }

        foreach ($scholarshipUsers as $user) {
            sendGeneralEmail($user->email, $request->subject, $request->message, $user->full_name);
            // $scholarshipUsers->update(['channel_invite_email' => 1]);
        }

        $notify[] = ['success', 'All users will receive an email shortly.'];
        return redirect()->route('admin.scholarships.list')->withNotify($notify);
    }

    public function login($id)
    {
        $user = User::findOrFail($id);
        Auth::login($user);
        return redirect()->route('user.home');
    }
}