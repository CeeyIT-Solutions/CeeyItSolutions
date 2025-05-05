<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Application\AdminApplicationController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ScholarshipController as AdminScholarshipController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\MailController;


Route::get('/send-email', [MailController::class, 'sendTestEmail']);
Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::
        namespace('Gateway')->prefix('ipn')->name('ipn.')->group(function () {
            Route::post('paypal', 'Paypal\ProcessController@ipn')->name('Paypal');
            Route::get('paypal-sdk', 'paypal_sdk_2\ProcessController@ipn')->name('PaypalSdk');
            Route::post('perfect-money', 'PerfectMoney\ProcessController@ipn')->name('PerfectMoney');
            Route::post('stripe', 'Stripe\ProcessController@ipn')->name('Stripe');
            Route::post('stripe-js', 'StripeJs\ProcessController@ipn')->name('StripeJs');
            Route::post('stripe-v3', 'StripeV3\ProcessController@ipn')->name('StripeV3');
            Route::post('skrill', 'Skrill\ProcessController@ipn')->name('Skrill');
            Route::post('paytm', 'Paytm\ProcessController@ipn')->name('Paytm');
            Route::post('payeer', 'Payeer\ProcessController@ipn')->name('Payeer');
            Route::post('paystack', 'Paystack\ProcessController@ipn')->name('Paystack');
            Route::post('voguepay', 'Voguepay\ProcessController@ipn')->name('Voguepay');
            Route::get('flutterwave/{trx}/{type}', 'Flutterwave\ProcessController@ipn')->name('Flutterwave');
            Route::post('razorpay', 'Razorpay\ProcessController@ipn')->name('Razorpay');
            Route::post('instamojo', 'Instamojo\ProcessController@ipn')->name('Instamojo');
            Route::get('blockchain', 'Blockchain\ProcessController@ipn')->name('Blockchain');
            Route::get('blockio', 'Blockio\ProcessController@ipn')->name('Blockio');
            Route::post('coinpayments', 'Coinpayments\ProcessController@ipn')->name('Coinpayments');
            Route::post('coinpayments-fiat', 'CoinpaymentsFiat\ProcessController@ipn')->name('CoinpaymentsFiat');
            Route::post('coingate', 'Coingate\ProcessController@ipn')->name('Coingate');
            Route::post('coinbase-commerce', 'CoinbaseCommerce\ProcessController@ipn')->name('CoinbaseCommerce');
            Route::get('mollie', 'Mollie\ProcessController@ipn')->name('Mollie');
            Route::post('cashmaal', 'Cashmaal\ProcessController@ipn')->name('Cashmaal');
        });

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@supportTicket')->name('ticket');
    Route::get('/new', 'TicketController@openSupportTicket')->name('ticket.open');
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});


/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/

Route::
        namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
            Route::namespace('Auth')->group(function () {
                Route::get('/', 'LoginController@showLoginForm')->name('login');
                Route::post('/', 'LoginController@login')->name('login');
                Route::get('logout', 'LoginController@logout')->name('logout');
                // Admin Password Reset
                Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
                Route::post('password/reset', 'ForgotPasswordController@sendResetCodeEmail');
                Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify.code');
                Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.form');
                Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
            });

            Route::middleware('admin')->group(function () {
                Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
                Route::get('profile', 'AdminController@profile')->name('profile');
                Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
                Route::get('password', 'AdminController@password')->name('password');
                Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

                //Notification
                Route::get('notifications', 'AdminController@notifications')->name('notifications');
                Route::get('notification/read/{id}', 'AdminController@notificationRead')->name('notification.read');
                Route::get('notifications/read-all', 'AdminController@readAll')->name('notifications.readAll');

                //Report Bugs
                Route::get('request-report', 'AdminController@requestReport')->name('request.report');
                Route::post('request-report', 'AdminController@reportSubmit');

                Route::get('system-info', 'AdminController@systemInfo')->name('system.info');



                // Users Manager
                Route::get('users', 'ManageUsersController@allUsers')->name('users.all');
                Route::get('users/active', 'ManageUsersController@activeUsers')->name('users.active');
                Route::get('users/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
                Route::get('users/email-verified', 'ManageUsersController@emailVerifiedUsers')->name('users.email.verified');
                Route::get('users/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.email.unverified');
                Route::get('users/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.sms.unverified');
                Route::get('users/sms-verified', 'ManageUsersController@smsVerifiedUsers')->name('users.sms.verified');
                Route::get('users/with-balance', 'ManageUsersController@usersWithBalance')->name('users.with.balance');

                // send verification email to unverified users
                Route::post('users/unverified/send-email', 'ManageUsersController@sendEmailToUnverified');


                Route::get('users/{scope}/search', 'ManageUsersController@search')->name('users.search');
                Route::get('user/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
                Route::post('user/update/{id}', 'ManageUsersController@update')->name('users.update');
                Route::post('user/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.add.sub.balance');
                Route::get('user/send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('users.email.single');
                Route::post('user/send-email/{id}', 'ManageUsersController@sendEmailSingle')->name('users.email.single');
                Route::get('user/login/{id}', 'ManageUsersController@login')->name('users.login');
                Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');
                Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
                Route::get('user/deposits/via/{method}/{type?}/{userId}', 'ManageUsersController@depositViaMethod')->name('users.deposits.method');

                //manage instructor
                Route::get('instructors', 'ManageInstructorController@allInstructor')->name('instructor.all');
                Route::get('instructor/active', 'ManageInstructorController@activeInstructor')->name('instructor.active');
                Route::get('instructor/pending', 'ManageInstructorController@pendingInstructor')->name('instructor.pending');
                Route::get('instructor/banned', 'ManageInstructorController@bannedInstructor')->name('instructor.banned');
                Route::get('instructor/email-verified', 'ManageInstructorController@emailVerifiedInstructor')->name('instructor.email.verified');
                Route::get('instructor/email-unverified', 'ManageInstructorController@emailUnverifiedInstructor')->name('instructor.email.unverified');
                Route::get('instructor/sms-unverified', 'ManageInstructorController@smsUnverifiedInstructor')->name('instructor.sms.unverified');
                Route::get('instructor/sms-verified', 'ManageInstructorController@smsVerifiedInstructor')->name('instructor.sms.verified');
                Route::get('instructor/with-balance', 'ManageInstructorController@instructorWithBalance')->name('instructor.with.balance');
                Route::post('instructor/approve', 'ManageInstructorController@instructorApprove')->name('approve.instructor');
                Route::post('instructor/reject', 'ManageInstructorController@instructorReject')->name('reject.instructor');
                Route::get('instructor/download/resume/{id}', 'ManageInstructorController@downloadResume')->name('instructor.download.resume');

                Route::get('instructor/{scope}/search', 'ManageInstructorController@search')->name('instructor.search');
                Route::get('instructor/detail/{id}', 'ManageInstructorController@detail')->name('instructor.detail');
                Route::get('instructor/total-courses/{id}', 'ManageInstructorController@totalCourses')->name('instructor.totalCourses');

                Route::get('instructor/send-email', 'ManageInstructorController@showEmailAllForm')->name('instructor.email.all');
                Route::post('instructor/send-email', 'ManageInstructorController@sendEmailAll');


                Route::get('user/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
                Route::get('user/withdrawals/via/{method}/{type?}/{userId}', 'ManageUsersController@withdrawalsViaMethod')->name('users.withdrawals.method');
                // Login History
                Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');

                Route::get('users/send-email', 'ManageUsersController@showEmailAllForm')->name('users.email.all');
                Route::post('users/send-email', 'ManageUsersController@sendEmailAll')->name('users.email.send');

                //Category manage
                Route::get('categories', 'CategoryController@categories')->name('categories');
                Route::post('category/store', 'CategoryController@categoryStore')->name('category.store');
                Route::post('category/update', 'CategoryController@categoryUpdate')->name('category.update');

                //Sub-Category manage
                Route::get('sub-categories', 'CategoryController@subCategories')->name('subcategories');
                Route::post('sub-category/store', 'CategoryController@subCategoryStore')->name('subcategory.store');
                Route::post('sub-category/update', 'CategoryController@subCategoryUpdate')->name('subcategory.update');


                // Subscriber
                Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
                Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
                Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove');
                Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->name('subscriber.sendEmail');

                //manage courses
                Route::get('/course/details/{id}', 'CourseController@courseDetail')->name('course.details');
                Route::get('active/courses', 'CourseController@activeCourses')->name('course.active');
                Route::get('pending/courses', 'CourseController@pendingCourses')->name('course.pending');
                Route::post('ban-course/{id}', 'CourseController@banCourse')->name('course.ban');
                Route::post('top-course/{id}', 'CourseController@topCourse')->name('course.top');
                Route::get('banned/courses', 'CourseController@bannedCourses')->name('course.banned');
                Route::post('/action/course/{id}', 'CourseController@action')->name('course.action');
                Route::post('/update/course', 'CourseController@update')->name('update.course');
                Route::get('/course/lecture/file/download/{id}', 'CourseController@fileDownload')->name('course.lecture.file.download');
                Route::get('courses/users', 'CourseController@pendingUserCourses')->name('course.user');
                Route::post('action/course/user/{id}', 'CourseController@actionUser')->name('course.user');
                Route::post('ban-course/user/{id}', 'CourseController@banUserCourse')->name('course.ban_user');


                // Manage Scholarships Routes
                Route::get('scholarship/list', [AdminScholarshipController::class, 'index'])->name('scholarships.list');
                Route::get('scholarship/list/2025', [AdminScholarshipController::class, 'indexNew'])->name('scholarships.list.new');

                Route::get('laptops/list', [LaptopController::class, 'index'])->name('laptops.list');
                Route::get('laptops/list/2025', [LaptopController::class, 'indexNew'])->name('laptops.list.new');

                Route::post('approve-laptop-application', [LaptopController::class, 'approveApplication'])->name("approve.laptop.request");

                Route::post('deny-laptop-application', [LaptopController::class, 'denyApplication'])->name("deny.laptop.request");

                Route::post('send-channel-invite', [AdminScholarshipController::class, 'sendChannelInvite'])->name('invite.send');
                Route::post('send-scholarship-email', [ManageUsersController::class, 'sendScholarshipEmail'])->name('users.email.scholarship');

                Route::get("send-slack-invite", [AdminScholarshipController::class, "sendSlackInvite"])->name("send.slack.invite");
                Route::get("send/slack/invite/{id}", [AdminScholarshipController::class, "sendSlackInviteById"]);
                Route::post('approve-all', [AdminScholarshipController::class, 'approveAllPending'])
                    ->name('approve.all.applications');
                Route::post('/deny-application', [AdminScholarshipController::class, 'denyApplication']);
                Route::post('/approve-application', [AdminScholarshipController::class, 'approveApplication']);

                // course level
                Route::get('course-levels', 'CourseController@levels')->name('levels');
                Route::post('course-levels', 'CourseController@levelStore');
                Route::post('course-levels/update/{id}', 'CourseController@levelUpdate')->name('course.level.update');

                //Manage Coupon
                Route::get('coupon/all', 'CouponController@allCoupons')->name('coupon.all');
                Route::get('coupon/add', 'CouponController@addCoupons')->name('coupon.add');
                Route::post('coupon/store', 'CouponController@store')->name('coupon.store');
                Route::get('coupon/edit/{id}', 'CouponController@edit')->name('coupon.edit');
                Route::post('coupon/update/{id}', 'CouponController@update')->name('coupon.update');


                //Donations
                Route::get('donations/all', [DonationController::class, 'allDonations'])->name('donations.all');
                //advertisements
                Route::get('advertisements/all', 'AdManageController@advertisements')->name('advertisements');
                Route::post('advertisements/store', 'AdManageController@advertisementStore')->name('advertisements.store');
                Route::post('advertisements/update/{id}', 'AdManageController@advertisementUpdate')->name('advertisements.update');
                Route::post('advertisements/remove/{id}', 'AdManageController@advertisementRemove')->name('advertisements.remove');

                // Deposit Gateway
                Route::name('gateway.')->prefix('gateway')->group(function () {
                    // Automatic Gateway
                    Route::get('automatic', 'GatewayController@index')->name('automatic.index');
                    Route::get('automatic/edit/{alias}', 'GatewayController@edit')->name('automatic.edit');
                    Route::post('automatic/update/{code}', 'GatewayController@update')->name('automatic.update');
                    Route::post('automatic/remove/{code}', 'GatewayController@remove')->name('automatic.remove');
                    Route::post('automatic/activate', 'GatewayController@activate')->name('automatic.activate');
                    Route::post('automatic/deactivate', 'GatewayController@deactivate')->name('automatic.deactivate');


                    // Manual Methods
                    Route::get('manual', 'ManualGatewayController@index')->name('manual.index');
                    Route::get('manual/new', 'ManualGatewayController@create')->name('manual.create');
                    Route::post('manual/new', 'ManualGatewayController@store')->name('manual.store');
                    Route::get('manual/edit/{alias}', 'ManualGatewayController@edit')->name('manual.edit');
                    Route::post('manual/update/{id}', 'ManualGatewayController@update')->name('manual.update');
                    Route::post('manual/activate', 'ManualGatewayController@activate')->name('manual.activate');
                    Route::post('manual/deactivate', 'ManualGatewayController@deactivate')->name('manual.deactivate');
                });


                // DEPOSIT SYSTEM
                Route::name('deposit.')->prefix('deposit')->group(function () {
                    Route::get('/', 'DepositController@deposit')->name('list');
                    Route::get('pending', 'DepositController@pending')->name('pending');
                    Route::get('rejected', 'DepositController@rejected')->name('rejected');
                    Route::get('approved', 'DepositController@approved')->name('approved');
                    Route::get('successful', 'DepositController@successful')->name('successful');
                    Route::get('details/{id}', 'DepositController@details')->name('details');

                    Route::post('reject', 'DepositController@reject')->name('reject');
                    Route::post('approve', 'DepositController@approve')->name('approve');
                    Route::get('via/{method}/{type?}', 'DepositController@depositViaMethod')->name('method');
                    Route::get('/{scope}/search', 'DepositController@search')->name('search');
                    Route::get('date-search/{scope}', 'DepositController@dateSearch')->name('dateSearch');
                });


                // WITHDRAW SYSTEM
                Route::name('withdraw.')->prefix('withdraw')->group(function () {
                    Route::get('pending', 'WithdrawalController@pending')->name('pending');
                    Route::get('approved', 'WithdrawalController@approved')->name('approved');
                    Route::get('rejected', 'WithdrawalController@rejected')->name('rejected');
                    Route::get('log', 'WithdrawalController@log')->name('log');
                    Route::get('via/{method_id}/{type?}', 'WithdrawalController@logViaMethod')->name('method');
                    Route::get('{scope}/search', 'WithdrawalController@search')->name('search');
                    Route::get('date-search/{scope}', 'WithdrawalController@dateSearch')->name('dateSearch');
                    Route::get('details/{id}', 'WithdrawalController@details')->name('details');
                    Route::post('approve', 'WithdrawalController@approve')->name('approve');
                    Route::post('reject', 'WithdrawalController@reject')->name('reject');


                    // Withdraw Method
                    Route::get('method/', 'WithdrawMethodController@methods')->name('method.index');
                    Route::get('method/create', 'WithdrawMethodController@create')->name('method.create');
                    Route::post('method/create', 'WithdrawMethodController@store')->name('method.store');
                    Route::get('method/edit/{id}', 'WithdrawMethodController@edit')->name('method.edit');
                    Route::post('method/edit/{id}', 'WithdrawMethodController@update')->name('method.update');
                    Route::post('method/activate', 'WithdrawMethodController@activate')->name('method.activate');
                    Route::post('method/deactivate', 'WithdrawMethodController@deactivate')->name('method.deactivate');
                });

                // Report
                Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
                Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');
                Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
                Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');

                //ftp
                Route::get('/storage/settings', 'GeneralSettingController@ftpSettings')->name('ftp.setting');
                Route::post('/storage/settings', 'GeneralSettingController@ftpSettingsUpdate')->name('ftp.setting.update');

                // Admin Support
                Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
                Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
                Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
                Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
                Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
                Route::post('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply');
                Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
                Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete');


                // Language Manager
                Route::get('/language', 'LanguageController@langManage')->name('language.manage');
                Route::post('/language', 'LanguageController@langStore')->name('language.manage.store');
                Route::post('/language/delete/{id}', 'LanguageController@langDel')->name('language.manage.del');
                Route::post('/language/update/{id}', 'LanguageController@langUpdate')->name('language.manage.update');
                Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language.key');
                Route::post('/language/import', 'LanguageController@langImport')->name('language.importLang');



                Route::post('language/store/key/{id}', 'LanguageController@storeLanguageJson')->name('language.store.key');
                Route::post('language/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('language.delete.key');
                Route::post('language/update/key/{id}', 'LanguageController@updateLanguageJson')->name('language.update.key');



                // General Setting
                Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
                Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update');
                Route::get('optimize', 'GeneralSettingController@optimize')->name('setting.optimize');

                // Logo-Icon
                Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo.icon');
                Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo.icon');

                //Custom CSS
                Route::get('custom-css', 'GeneralSettingController@customCss')->name('setting.custom.css');
                Route::post('custom-css', 'GeneralSettingController@customCssSubmit');


                // Plugin
                Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
                Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update');
                Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate');
                Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate');



                // Email Setting
                Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
                Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global');
                Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
                Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting');
                Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
                Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
                Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
                Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.test.mail');


                // SMS Setting
                Route::get('sms-template/global', 'SmsTemplateController@smsTemplate')->name('sms.template.global');
                Route::post('sms-template/global', 'SmsTemplateController@smsTemplategUpdate')->name('sms.template.global');
                Route::get('sms-template/setting', 'SmsTemplateController@smsSetting')->name('sms.templates.setting');
                Route::post('sms-template/setting', 'SmsTemplateController@smsSettingUpdate')->name('sms.template.setting');
                Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms.template.index');
                Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms.template.edit');
                Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms.template.update');
                Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('sms.template.test.sms');

                // SEO
                Route::get('seo', 'FrontendController@seoEdit')->name('seo');


                // Frontend
                Route::name('frontend.')->prefix('frontend')->group(function () {


                    Route::get('templates', 'FrontendController@templates')->name('templates');
                    Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');


                    Route::get('frontend-sections/{key}', 'FrontendController@frontendSections')->name('sections');
                    Route::post('frontend-content/{key}', 'FrontendController@frontendContent')->name('sections.content');
                    Route::get('frontend-element/{key}/{id?}', 'FrontendController@frontendElement')->name('sections.element');
                    Route::post('remove', 'FrontendController@remove')->name('remove');

                    // Page Builder
                    Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
                    Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
                    Route::post('manage-pages/update', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
                    Route::post('manage-pages/delete', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
                    Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
                    Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
                });

                Route::prefix("applications")->as("applications.")->group(function () {
                    Route::get('/list', [AdminApplicationController::class, 'listApplications'])->name('list');
                    Route::get("/status-update/{id}", [AdminApplicationController::class, 'updateStatus'])->name("update-status");
                });
            });
        });




/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/


Route::name('user.')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->middleware('regStatus');
    Route::post('check-mail', 'Auth\RegisterController@checkUser')->name('checkUser');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetCodeEmail')->name('password.email');
    Route::get('password/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('password.code.verify');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify.code');

    Route::get('password/reset/screen', 'Auth\ResetPasswordController@showPasswordResetScreen')->name('password.reset.screen');
});

Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify.email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify.sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');


        Route::middleware(['checkStatus'])->group(function () {
            Route::get('dashboard', 'UserController@home')->name('home');

            Route::post('apply-coupon', 'UserController@applyCoupon')->name('apply.coupon');

            Route::get('profile-setting', 'UserController@profile')->name('profile.setting');
            Route::post('profile-setting', 'UserController@submitProfile');
            Route::get('change-password', 'UserController@changePassword')->name('change.password');
            Route::post('change-password', 'UserController@submitPassword');

            //2FA
            Route::get('twofactor', 'UserController@show2faForm')->name('twofactor');
            Route::post('twofactor/enable', 'UserController@create2fa')->name('twofactor.enable');
            Route::post('twofactor/disable', 'UserController@disable2fa')->name('twofactor.disable');

            //payment from balance
            Route::post('/payment-balance/{code}', 'UserController@purchaseCourse')->name('payment.balance');

            // Deposit
            Route::get('/payment/{code}', 'Gateway\PaymentController@payment')->name('payment');
            Route::any('/deposit', 'Gateway\PaymentController@deposit')->name('deposit');
            Route::post('deposit/insert', 'Gateway\PaymentController@depositInsert')->name('deposit.insert');
            Route::get('deposit/preview', 'Gateway\PaymentController@depositPreview')->name('deposit.preview');
            Route::get('deposit/confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');
            Route::get('deposit/manual', 'Gateway\PaymentController@manualDepositConfirm')->name('deposit.manual.confirm');
            Route::post('deposit/manual', 'Gateway\PaymentController@manualDepositUpdate')->name('deposit.manual.update');
            Route::get('deposit/history', 'UserController@depositHistory')->name('deposit.history');



            Route::post('post/comment', 'UserController@postComment')->name('post.comment');
            Route::get('become/instructor', 'UserController@becomeInstructor')->name('become.instructor');
            Route::post('/instructor/submit', 'UserController@applyAsInstructor')->name('apply.instructor');

            Route::middleware('instructor')->group(function () {
                //course manage
                Route::get('/courses', 'CourseController@courses')->name('courses');
                Route::get('/create/course', 'CourseController@create')->name('create.course');
                Route::post('/create/course', 'CourseController@store');
                Route::get('/edit/course/{id}-{slug}', 'CourseController@edit')->name('edit.course');
                Route::post('/update/course', 'CourseController@update')->name('update.course');
                Route::get('/publish/course/{code}', 'CourseController@publish')->name('course.publish');

                //chapter , lectures
                Route::get('/course/chapter/{id}-{slug}', 'ChapterController@chapters')->name('course.chapters');
                Route::post('/course/chapter/store', 'ChapterController@store')->name('course.chapter.store');
                Route::post('/course/chapter/update', 'ChapterController@update')->name('course.chapter.update');
                Route::get('/course/lectures/{course}/{chapter}', 'LectureController@lectures')->name('course.lectures');
                Route::get('/course/create/lectures/{course}/{chapter}', 'LectureController@create')->name('course.lecture.create');
                Route::post('/course/lecture/store', 'LectureController@store')->name('course.lecture.store');
                Route::get('/course/edit/lectures/{course}/{chapter}/{lecture}', 'LectureController@edit')->name('course.lecture.edit');
                Route::post('/course/lecture/update', 'LectureController@update')->name('course.lecture.update');


                // Withdraw
                Route::get('/withdraw', 'UserController@withdrawMoney')->name('withdraw');
                Route::post('/withdraw', 'UserController@withdrawStore')->name('withdraw.money');
                Route::get('/withdraw/preview', 'UserController@withdrawPreview')->name('withdraw.preview');
                Route::post('/withdraw/preview', 'UserController@withdrawSubmit')->name('withdraw.submit');
                Route::get('/withdraw/history', 'UserController@withdrawLog')->name('withdraw.history');
            });

            Route::get('/course/lecture/file/download/{id}', 'LectureController@fileDownload')->name('course.lecture.file.download');


            Route::get('transaction/history/', 'UserController@trxHistory')->name('transactions');
            Route::get('purchased/courses/', 'CourseController@purchasedCourses')->name('course.purchased');
            Route::get('/course/play/{id}-{slug}', 'CourseController@coursePlay')->name('course.play');
            Route::post('/review', 'CourseController@review')->name('review');
            Route::post('/purchase/course', 'CourseController@purchaseCourse')->name('purchase');

            Route::prefix("application")->as("application.")->group(function () {
                Route::get("/form", 'SkillApplicationController@createFormPage')->name("form");
                Route::post("/submit-form", 'SkillApplicationController@submitForm')->name("submit-form");
            });
        });
    });
});


Route::get('/', 'SiteController@index')->name('home');

Route::get('courses', 'SiteController@courses')->name('courses');
Route::get('courses/{slug}', 'SiteController@categoryCourses')->name('courses.category');
Route::get('course/details/{id}-{slug}', 'SiteController@courseDetails')->name('course.details');
Route::get('/contact', 'SiteController@contact')->name('contact');

Route::get('/faq', 'SiteController@faq')->name('faq');
Route::get('links/{slug}/{id}', 'SiteController@policyAndTerms')->name('links');
Route::post('/contact', 'SiteController@contactSubmit');
Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');
Route::get('blog', 'SiteController@blog')->name('blog');
Route::get('blog/{id}/{slug}', 'SiteController@blogDetails')->name('blog.details');

Route::post('/ad-click', 'SiteController@adClick')->name('ad.click');
Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholder.image');
Route::get('/apply-for-laptop', [SiteController::class, 'Laptops'])->name('laptops');
Route::get('/consultation', 'SiteController@consultation')->name('consultation');
Route::get('/foundation', 'SiteController@foundation')->name('foundation');
Route::get('/donation', 'SiteController@donation')->name('donation');
Route::get('/thank_you/{id}', 'SiteController@thankYou')->name('thank_you');
Route::post('/process-donation', [DonationController::class, 'processDonation'])->name('donate.process');
Route::get('/success-donation', [DonationController::class, 'success'])->name('donate.success');
Route::get('/cancel-donation', [DonationController::class, 'cancel'])->name('donate.cancel');
Route::get('/{slug}', 'SiteController@pages')->name('pages');
Route::get('/scholarships', [SiteController::class, 'Scholarships'])->name('scholarships');
Route::post('/apply/scholarship', [SiteController::class, 'ApplyForScholarship'])->name('scholarship.apply');
Route::post('/apply/laptop', [SiteController::class, 'ApplyForLaptop'])->name('laptop.apply');
Route::post('thanks-for-applying', [SiteController::class, 'thankYouScreen'])->name('laptop.thankyou.page');