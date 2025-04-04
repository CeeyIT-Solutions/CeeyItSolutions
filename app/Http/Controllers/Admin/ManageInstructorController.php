<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WithdrawMethod;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageInstructorController extends Controller
{
    public function allInstructor ()
    {
        $pageTitle = 'Manage Instructor';
        $emptyMessage = 'No instructor found';
        $users = User::where('is_instructor',1)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function activeInstructor()
    {
        $pageTitle = 'Manage Active Instructors';
        $emptyMessage = 'No active instructor found';
        $users = User::where('is_instructor',1)->where('status',1)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function pendingInstructor()
    {
        $pageTitle = 'Manage Pending Instructors';
        $emptyMessage = 'No pending instructor found';
        $users = User::where('is_instructor',2)->where('status',1)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.pending_instructor', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function bannedInstructor()
    {
        $pageTitle = 'Banned Instructors';
        $emptyMessage = 'No banned instructor found';
        $users = User::where('is_instructor',1)->where('status', 0)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    
    public function emailUnverifiedInstructor()
    {
        $pageTitle = 'Email Unverified Instructors';
        $emptyMessage = 'No email unverified instructor found';
        $users = User::where('is_instructor',1)->where('ev', 0)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }
    public function emailVerifiedInstructor()
    {
        $pageTitle = 'Email Verified Instructor';
        $emptyMessage = 'No email verified instructor found';
        $users = User::where('is_instructor',1)->where('ev', 1)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }


    public function smsUnverifiedInstructor()
    {
        $pageTitle = 'SMS Unverified Instructors';
        $emptyMessage = 'No sms unverified instructor found';
        $users = User::where('is_instructor',1)->where('sv', 0)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }


    public function smsVerifiedInstructor()
    {
        $pageTitle = 'SMS Verified Instructors';
        $emptyMessage = 'No sms verified instructor found';
        $users = User::where('is_instructor',1)->where('sv', 1)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    
    public function instructorWithBalance()
    {
        $pageTitle = 'Instructor with balance';
        $emptyMessage = 'No instructor with balance found';
        $users = User::where('is_instructor',1)->where('balance','!=',0)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.ins_list', compact('pageTitle', 'emptyMessage', 'users'));
    }



    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $users = User::where(function ($user) use ($search) {
            $user->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })->where('is_instructor',1);
        $pageTitle = '';
        if ($scope == 'active') {
            $pageTitle = 'Active ';
            $users = $users->where('status', 1);
        }elseif($scope == 'banned'){
            $pageTitle = 'Banned';
            $users = $users->where('status', 0);
        }elseif($scope == 'emailUnverified'){
            $pageTitle = 'Email Unverified ';
            $users = $users->where('ev', 0);
        }elseif($scope == 'smsUnverified'){
            $pageTitle = 'SMS Unverified ';
            $users = $users->where('sv', 0);
        }elseif($scope == 'withBalance'){
            $pageTitle = 'With Balance ';
            $users = $users->where('balance','!=',0);
        }

        $users = $users->paginate(getPaginate());
        $pageTitle .= 'User Search - ' . $search;
        $emptyMessage = 'No search result found';
        return view('admin.users.ins_list', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'users'));
    }


    public function detail($id)
    {
        $pageTitle = 'Instructor Detail';
        $user = User::findOrFail($id);
        $totalDeposit = Deposit::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalTransaction = Transaction::where('user_id',$user->id)->count();
        $totalCourses = Course::where('author_id',$user->id)->where('status',1)->count();
        $purchasedCourses = $user->userCourses()->count();
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('admin.users.detail', compact('pageTitle', 'user','totalDeposit','totalWithdraw','totalTransaction','countries','totalCourses','purchasedCourses','totalCourses'));
    }

    public function totalCourses($id)
    {
        $author = User::where('id',$id)->where('is_instructor',1)->firstOrFail();
        $courses = Course::where('author_id',$author->id)->where('status',1)->paginate(getPaginate());
        $pageTitle = "All published courses of $author->username";
        return view('admin.courses.list',compact('courses','pageTitle'));
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

        $notify[] = ['success', 'Instructor detail has been updated'];
        return redirect()->back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $user = User::findOrFail($id);
        $amount = $request->amount;
        $general = GeneralSetting::first(['cur_text','cur_sym']);
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
            $transaction->trx =  $trx;
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
            $transaction->trx =  $trx;
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
        $pageTitle = 'Instructor Login History - ' . $user->username;
        $emptyMessage = 'No instructors login found.';
        $login_logs = $user->login_logs()->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.users.logins', compact('pageTitle', 'emptyMessage', 'login_logs'));
    }

    public function showEmailSingleForm($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'Send Email To: ' . $user->username;
        return view('admin.users.email_instructor_single', compact('pageTitle', 'user'));
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
            $transactions = $user->transactions()->where('trx', $search)->with('user')->orderBy('id','desc')->paginate(getPaginate());
            $emptyMessage = 'No transactions';
            return view('admin.reports.transactions', compact('pageTitle', 'search', 'user', 'transactions', 'emptyMessage'));
        }
        $pageTitle = 'User Transactions : ' . $user->username;
        $transactions = $user->transactions()->with('user')->orderBy('id','desc')->paginate(getPaginate());
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
            $deposits = $user->deposits()->where('trx', $search)->orderBy('id','desc')->paginate(getPaginate());
            $emptyMessage = 'No deposits';
            return view('admin.deposit.log', compact('pageTitle', 'search', 'user', 'deposits', 'emptyMessage','userId'));
        }

        $pageTitle = 'User Deposit : ' . $user->username;
        $deposits = $user->deposits()->orderBy('id','desc')->paginate(getPaginate());
        $successful = $user->deposits()->orderBy('id','desc')->sum('amount');
        $pending = $user->deposits()->orderBy('id','desc')->sum('amount');
        $rejected = $user->deposits()->orderBy('id','desc')->sum('amount');
        $emptyMessage = 'No deposits';
        $scope = 'all';
        return view('admin.deposit.log', compact('pageTitle', 'user', 'deposits', 'emptyMessage','userId','scope','successful','pending','rejected'));
    }


    public function depViaMethod($method,$type = null,$userId){
        $method = Gateway::where('alias',$method)->firstOrFail();        
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 1)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $pageTitle = 'Rejected Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 3)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'successful'){
            $pageTitle = 'Successful Payment Via '.$method->name;
            $deposits = Deposit::where('status', 1)->where('user_id',$user->id)->where('method_code',$method->code)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'pending'){
            $pageTitle = 'Pending Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 2)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }else{
            $pageTitle = 'Payment Via '.$method->name;
            $deposits = Deposit::where('status','!=',0)->where('user_id',$user->id)->where('method_code',$method->code)->orderBy('id','desc')->with(['user', 'gateway'])->paginate(getPaginate());
        }
        $pageTitle = 'Deposit History: '.$user->username.' Via '.$method->name;
        $methodAlias = $method->alias;
        $emptyMessage = 'Deposit Log';
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits','methodAlias','userId'));
    }



    public function withdrawals(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search User Withdrawals : ' . $user->username;
            $withdrawals = $user->withdrawals()->where('trx', 'like',"%$search%")->orderBy('id','desc')->paginate(getPaginate());
            $emptyMessage = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('pageTitle', 'user', 'search', 'withdrawals', 'emptyMessage'));
        }
        $pageTitle = 'User Withdrawals : ' . $user->username;
        $withdrawals = $user->withdrawals()->orderBy('id','desc')->paginate(getPaginate());
        $emptyMessage = 'No withdrawals';
        $userId = $user->id;
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'user', 'withdrawals', 'emptyMessage','userId'));
    }

    public  function withdrawalsViaMethod($method,$type,$userId){
        $method = WithdrawMethod::findOrFail($method);
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Withdrawal of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 1)->where('user_id',$user->id)->with(['user','method'])->orderBy('id','desc')->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $pageTitle = 'Rejected Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 3)->where('user_id',$user->id)->with(['user','method'])->orderBy('id','desc')->paginate(getPaginate());

        }elseif($type == 'pending'){
            $pageTitle = 'Pending Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 2)->where('user_id',$user->id)->with(['user','method'])->orderBy('id','desc')->paginate(getPaginate());
        }else{
            $pageTitle = 'Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', '!=', 0)->where('user_id',$user->id)->with(['user','method'])->orderBy('id','desc')->paginate(getPaginate());
        }
        $emptyMessage = 'Withdraw Log Not Found';
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'withdrawals', 'emptyMessage','method'));
    }

    public function showEmailAllForm()
    {
        $pageTitle = 'Send Email To All Instructors';
        return view('admin.users.email_instructor_all', compact('pageTitle'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (User::where('is_instructor',1)->where('status', 1)->cursor() as $user) {
            sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All instructors will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function instructorApprove(Request $request)
    {
        $instructor = User::findOrFail($request->instructor_id);
        $instructor->is_instructor = 1;
        $instructor->update();
        $notify[]=['success','Request has been approved'];
        return back()->withNotify($notify);

    }
    public function instructorReject(Request $request)
    {
        $instructor = User::findOrFail($request->instructor_id);
        $instructor->is_instructor = 0;
        $instructor->update();
        $notify[]=['success','Request has been rejected'];
        return back()->withNotify($notify);

    }

    public function downloadResume($id)
    {
        $instructor = User::findOrFail($id);
      
        $filepath ='assets/admin/instructor/'.$instructor->instructor_info->resume;
        $extension = pathinfo($filepath,PATHINFO_EXTENSION);
        $fullname = @$instructor->instructor_info->firstname.'_'.$instructor->instructor_info->lastname;
        $fileName =   $fullname.'.'.$extension;
        $headers = [
            'Content-Type' => 'application/octet-stream', 
            'Cache-Control' => 'no-store, no-cache'
        ];
       
        return response()->download( $filepath, $fileName, $headers);
    }
    

    public function login($id){
        $user = User::findOrFail($id);
        Auth::login($user);
        return redirect()->route('user.home');
    }
}
