<?php

namespace App\Http\Controllers;

use App\Mail\NewScholarshipApplicationNotification;
use App\Mail\ScholarshipApplicationConfirmation;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Level;
use App\Models\Course;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Advertise;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\ScholarshipApplication;
use App\Models\LaptopApplication;
use App\Models\SupportAttachment;
use App\Models\Donation;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SiteController extends Controller
{
    private $activeTemplate;
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $count = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->count();

        if ($count == 0) {
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections'));
    }

    public function consultation()
    {
        $count = Page::where('tempname', $this->activeTemplate)->where('slug', 'consultation')->count();

        if ($count == 0) {
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'CONSULTATION';
            $page->slug = 'consultation';
            $page->save();
        }


        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Consultation';

        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();
        return view($this->activeTemplate . 'consultation', compact('pageTitle', 'sections'));
    }

    public function foundation()
    {
        $pageTitle = 'Foundation';
        return view($this->activeTemplate . 'foundation', compact('pageTitle'));
    }
    public function donation()
    {
        $pageTitle = 'Donation';
        return view($this->activeTemplate . 'donation', compact('pageTitle'));
    }
    public function thankYou($id)
    {
        $Donation = Donation::findOrFail($id);
        $pageTitle = 'Thank You';
        return view($this->activeTemplate . 'thank_you', compact('pageTitle', 'Donation'));
    }


    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }
    public function Scholarships(Request $request)
    {
        $pageTitle = 'Scholarships';
        $view = $this->activeTemplate . "scholarships";

        dd($view);
        return view($this->activeTemplate . 'scholarships', compact('pageTitle'));
    }
    public function Laptops(Request $request)
    {
        $pageTitle = 'Laptops';
        $sections = '["laptops"]';
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact', compact('pageTitle'));
    }



    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;

        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->id() ?? 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language)
            $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blog()
    {
        $pageTitle = "Blogs";
        $blogs = Frontend::where('data_keys', 'blog.element')->latest()->paginate(9);
        return view($this->activeTemplate . 'blog', compact('pageTitle', 'blogs'));
    }
    public function blogDetails($id, $slug)
    {
        $blog = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $pageTitle = $blog->data_values->title;
        $recentblog = Frontend::latest()->where('data_keys', 'blog.element')->take(10)->get();
        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle', 'recentblog'));
    }

    public function faq()
    {
        $pageTitle = "Frequently Asked Questions";
        $elements = Frontend::where('data_keys', 'faq.element')->latest()->get();
        $heading = Frontend::where('data_keys', 'faq.content')->first();
        return view($this->activeTemplate . 'faq', compact('pageTitle', 'elements', 'heading'));
    }

    public function policyAndTerms($slug, $id)
    {
        $policy = Frontend::findOrFail($id);
        $pageTitle = $policy->data_values->title;
        return view($this->activeTemplate . 'policy_terms', compact('policy', 'pageTitle'));
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX = ($imgWidth - $textWidth) / 2;
        $textY = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function categoryCourses($slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->firstOrFail();
        $pageTitle = "Courses of $subcategory->name";
        $courses = Course::active()->where('subcategory_id', $subcategory->id)->paginate(getPaginate());
        return view($this->activeTemplate . 'category_courses', compact('pageTitle', 'courses'));
    }
    public function courses()
    {
        $pageTitle = "All Course";
        $courses = Course::filters()->paginate(getPaginate());
        $levels = Level::get();
        $categories = Category::where('status', 1)->get();

        return view($this->activeTemplate . 'courses', compact('pageTitle', 'courses', 'levels', 'categories'));
    }

    public function courseDetails($id, $slug)
    {
        $pageTitle = "Course Details";
        $course = Course::eagerLoads()->findOrFail($id);
        return view($this->activeTemplate . 'course_details', compact('pageTitle', 'course'));
    }

    public function adClick(Request $request)
    {
        $advert = Advertise::findOrFail($request->ad_id);
        $advert->total_click += 1;
        $advert->save();
    }


    // Submit Scholarship Application

    public function ApplyForScholarship(Request $request)
    {
        try {

            // check if email exists in users table
            $email = strtolower(trim($request->email));
            $user = User::where('email', $email)->first();
            if (!$user) {
                return back()->withErrors('Invalid email address. You need to register on our website first, in order to apply for a scholarship.')->withInput();
            }

            // check if user has already applied for a scholarship
            $application = ScholarshipApplication::where('email', $email)->first();
            if ($application) {
                return back()->withErrors('You have already applied for a scholarship.')->withInput();
            }


            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:scholarship_applications,email',
                'phone' => 'required|string|max:20',
                'occupation' => 'nullable|string|max:255',
                'interest' => 'nullable|string',
                'challenges' => 'nullable|string',
                'course_id' => 'required|integer|exists:courses,id',
                'tech_experience' => 'required|string|max:3',
                'tech_experience_details' => 'nullable|string',
                'goals' => 'nullable|string',
                'terms' => 'accepted',
            ], [
                'email.unique' => 'The email address has already been used to apply for a scholarship.',
            ]);

            $applicationId = "CEEYIT" . rand(11111111, 999999999);
            $application = new ScholarshipApplication();
            $application->full_name = $validatedData['full_name'];
            $application->email = $validatedData['email'];
            $application->phone = $validatedData['phone'];
            $application->occupation = $validatedData['occupation'];
            $application->interest = $validatedData['interest'];
            $application->challenges = $validatedData['challenges'];
            $application->course_id = $validatedData['course_id'];
            $application->tech_experience = $validatedData['tech_experience'];
            $application->tech_experience_details = $validatedData['tech_experience_details'];
            $application->goals = $validatedData['goals'];
            $application->application_id = $applicationId;
            $application->apply_year = intval(date('Y'));
            $application->terms = true;
            $application->approval_status = 0;
            $application->save();

            $applicationData = [
                'application_id' => $applicationId,
                'full_name' => $request->full_name,
                'email' => $request->email,
            ];

            $scholarshipNotificationEmail = getenv("SCHOLARSHIP_NOTIFICATION_EMAIL");

            // Send email to admin
            if (!empty($scholarshipNotificationEmail)) {
                Mail::to($scholarshipNotificationEmail)->send(new NewScholarshipApplicationNotification($applicationData));
            }

            // Send email to user
            Mail::to($request->email)->send(new ScholarshipApplicationConfirmation($applicationData));

            session()->flash('success', 'Your scholarship application has been submitted successfully. We will get back to you soon.');
            // return back();
            $pageTitle = 'Thank You for Your Scholarship Application.';
            $sections = '["thankyouscholarship"]';
            return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function ApplyForLaptop(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:laptop_applications,email',
                'phone' => 'required|string|max:20',
                'reason' => 'required',
                'course_id' => 'required|integer|exists:courses,id',
            ], [
                'email.unique' => 'The email address has already been used to apply for a laptop.',
            ]);


            $email = strtolower(trim($validatedData['email']));

            $scholarshipApplication = ScholarshipApplication::where('email', $email)->where('approval_status', 1)->where('course_id', $validatedData['course_id'])->first();

            if (!$scholarshipApplication) {
                return back()->withErrors('You are not eligible to apply for a laptop. Please apply for a scholarship first.')->withInput();
            }



            $application = new LaptopApplication();
            $application->full_name = $validatedData['full_name'];
            $application->email = $email;
            $application->phone = $validatedData['phone'];
            $application->course_id = $validatedData['course_id'];
            $application->approval_status = 0;
            $application->apply_year = intval(date('Y'));
            $application->reason = $validatedData['reason'];
            $application->save();
            $pageTitle = 'Thank You for Your Laptop Application.';
            $sections = '["thankyou"]';
            return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function thankYouScreen(Request $request)
    {
    }
}