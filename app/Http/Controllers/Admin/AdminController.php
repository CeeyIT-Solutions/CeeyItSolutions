<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Deposit;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Withdrawal;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function dashboard()
    {

        $pageTitle = 'Dashboard';

        // User Info
        $widget['total_users'] = User::count();
        $widget['instructor'] = User::where('is_instructor', 1)->count();
        $widget['active_course'] = Course::active()->count();
        $widget['pending_courses'] = Course::inactive()->count();
    
        $widget['banned_course'] = Course::banned()->count();
        $widget['active_coupon'] = Coupon::active()->count();
        $widget['total_category'] = Category::count();
        $widget['total_subcategory'] = SubCategory::count();

        // Monthly Deposit & Withdraw Report Graph
        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $report['withdraw_month_amount'] = collect([]);


        $depositsMonth = Deposit::where('created_at', '>=', Carbon::now()->subYear())
            ->where('status', 1)
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')->get();

        $depositsMonth->map(function ($depositData) use ($report) {
            $report['months']->push($depositData->months);
            $report['deposit_month_amount']->push(getAmount($depositData->depositAmount));
        });
        $withdrawalMonth = Withdrawal::where('created_at', '>=', Carbon::now()->subYear())->where('status', 1)
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as withdrawAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')->get();
        $withdrawalMonth->map(function ($withdrawData) use ($report){
            if (!in_array($withdrawData->months,$report['months']->toArray())) {
                $report['months']->push($withdrawData->months);
            }
            $report['withdraw_month_amount']->push(getAmount($withdrawData->withdrawAmount));
        });

        $months = $report['months'];

        for($i = 0; $i < $months->count(); ++$i) {
            $d_val      = Carbon::parse($months[$i]);
            if(isset($months[$i+1])){
                $d_val_next = Carbon::parse($months[$i+1]);
                if($d_val_next < $d_val){
                    $temp = $months[$i];
                    $months[$i]   = Carbon::parse($months[$i+1])->format('F-Y');
                    $months[$i+1] = Carbon::parse($temp)->format('F-Y');
                }else{
                    $months[$i]   = Carbon::parse($months[$i])->format('F-Y');
                }
            }
        }

        // Withdraw Graph
        $withdrawal = Withdrawal::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', 1)
            ->selectRaw('sum(amount) as totalAmount')
            ->selectRaw('DATE(created_at) day')
            ->groupBy('day')->get();

        $withdrawals['per_day'] = collect([]);
        $withdrawals['per_day_amount'] = collect([]);
        $withdrawal->map(function ($withdrawItem) use ($withdrawals) {
            $withdrawals['per_day']->push(date('d M', strtotime($withdrawItem->day)));
            $withdrawals['per_day_amount']->push($withdrawItem->totalAmount + 0);
        });


        // Deposit Graph
        $deposit = Deposit::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', 1)
            ->selectRaw('sum(amount) as totalAmount')
            ->selectRaw('DATE(created_at) day')
            ->groupBy('day')->get();
        $deposits['per_day'] = collect([]);
        $deposits['per_day_amount'] = collect([]);
        $deposit->map(function ($depositItem) use ($deposits) {
            $deposits['per_day']->push(date('d M', strtotime($depositItem->day)));
            $deposits['per_day_amount']->push($depositItem->totalAmount + 0);
        });


        // user Browsing, Country, Operating Log
        $user_login_data = UserLogin::where('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $chart['user_browser_counter'] = $user_login_data->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter'] = $user_login_data->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter'] = $user_login_data->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);


        $payment['total_deposit_amount'] = Deposit::where('status',1)->sum('amount');
        $payment['total_deposit_charge'] = Deposit::where('status',1)->sum('charge');
        $payment['total_deposit_pending'] = Deposit::where('status',2)->count();

        $paymentWithdraw['total_withdraw_amount'] = Withdrawal::where('status',1)->sum('amount');
        $paymentWithdraw['total_withdraw_charge'] = Withdrawal::where('status',1)->sum('charge');
        $paymentWithdraw['total_withdraw_pending'] = Withdrawal::where('status',2)->count();
        return view('admin.dashboard', compact('pageTitle', 'widget', 'report', 'withdrawals', 'chart','payment','paymentWithdraw','depositsMonth','withdrawalMonth','months','deposits'));
    }


    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])]
        ]);
        $user = Auth::guard('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = uploadImage($request->image, imagePath()['profile']['admin']['path'], imagePath()['profile']['admin']['size'], $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('admin.profile')->withNotify($notify);
    }


    public function password()
    {
        $pageTitle = 'Password Setting';
        $admin = Auth::guard('admin')->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password do not match !!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return redirect()->route('admin.password')->withNotify($notify);
    }

    public function notifications(){
        $notifications = AdminNotification::orderBy('id','desc')->with('user')->paginate(getPaginate());
        $pageTitle = 'Notifications';
        return view('admin.notifications',compact('pageTitle','notifications'));
    }


    public function notificationRead($id){
        $notification = AdminNotification::findOrFail($id);
        $notification->read_status = 1;
        $notification->save();
        return redirect($notification->click_url);
    }

    public function requestReport()
    {
        $pageTitle = 'Your Listed Report & Request';
        $arr['app_name'] = env('APP_NAME');;
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $url = "https://license.viserlab.com/issue/get?".http_build_query($arr);
        // $response = json_decode(curlContent($url));
        // if ($response->status == 'error') {
        //     return redirect()->route('admin.dashboard')->withErrors($response->message);
        // }
        $reports = [];
        return view('admin.reports',compact('reports','pageTitle'));
    }

    public function reportSubmit(Request $request)
    {
        $request->validate([
            'type'=>'required|in:bug,feature',
            'message'=>'required',
        ]);
        $url = 'https://license.viserlab.com/issue/add';

        $arr['app_name'] = env('APP_NAME');
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $arr['req_type'] = $request->type;
        $arr['message'] = $request->message;
        // $response = json_decode(curlPostContent($url,$arr));
        // if ($response->status == 'error') {
        //     return back()->withErrors($response->message);
        // }
        $notify[] = [];
        // ['success',$response->message];
        return back()->withNotify($notify);
    }

    public function systemInfo(){
        $laravelVersion = app()->version();
        $serverDetails = $_SERVER;
        $currentPHP = phpversion();
        $timeZone = config('app.timezone');
        $pageTitle = 'System Information';
        return view('admin.info',compact('pageTitle', 'currentPHP', 'laravelVersion', 'serverDetails','timeZone'));
    }

    public function readAll(){
        AdminNotification::where('read_status',0)->update([
            'read_status'=>1
        ]);
        $notify[] = ['success','Notifications read successfully'];
        return back()->withNotify($notify);
    }


}
