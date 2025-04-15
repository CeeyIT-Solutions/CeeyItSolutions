<?php

namespace App\Providers;

use App\Models\AdminNotification;
use App\Models\Category;
use App\Models\Course;
use App\Models\Deposit;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Page;
use App\Models\SupportTicket;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use ReCaptcha\ReCaptcha;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['request']->server->set('HTTP', true);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        $activeTemplate = activeTemplate();
        $general = GeneralSetting::first();
        $viewShare['general'] = $general;
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['language'] = Language::all();
        $viewShare['pages'] = Page::where('tempname', $activeTemplate)->where('slug', '!=', 'home')->get();
        view()->share($viewShare);


        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'banned_users_count' => User::banned()->count(),
                'email_unverified_users_count' => User::emailUnverified()->count(),
                'sms_unverified_users_count' => User::smsUnverified()->count(),
                'pending_ticket_count' => SupportTicket::whereIN('status', [0, 2])->count(),
                'pending_deposits_count' => Deposit::pending()->count(),
                'pending_withdraw_count' => Withdrawal::pending()->count(),
                'banned_instructor_count' => User::where('is_instructor', 1)->where('status', 0)->count(),
                'email_unverified_instructor_count' => User::where('is_instructor', 1)->where('ev', 0)->count(),
                'sms_unverified_instructor_count' => User::where('is_instructor', 1)->where('sv', 0)->count(),
                'pending_course' => Course::inactive()->count(),

            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications' => AdminNotification::where('read_status', 0)->with('user')->orderBy('id', 'desc')->get(),
            ]);
        });
        view()->composer([$activeTemplate . 'partials.header'], function ($view) {
            $view->with([
                'categories' => Category::where('status', 1)->latest()->get(['name', 'id']),
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        if ($general->force_ssl) {
            \URL::forceScheme('https');
        }


        Paginator::useBootstrap();

        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            if (!config('services.recaptcha.enabled')) {
                return true; // Skip validation if reCAPTCHA is disabled
            }

            $recaptcha = new ReCaptcha(config('services.recaptcha.secret_key'));
            $response = $recaptcha->verify($value, request()->ip());

            return $response->isSuccess();
        }, 'Please ensure you are not a robot.');

    }
}