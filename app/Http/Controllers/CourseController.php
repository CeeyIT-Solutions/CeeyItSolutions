<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Course;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct() {
        $this->activeTemplate  = activeTemplate();
    }

    //course Crud
    public function courses(Request $request)
    {
        $search = $request->search;
        if($search){
            $pageTitle = "Search Results of $search";
            $courses = Course::where('author_id',auth()->id())->where('title','like',"%$search%")->with(['category','subcategory','level'])->latest()->paginate(getPaginate());
        } else{
            $pageTitle = "Your Created Courses";
            $courses = Course::where('author_id',auth()->id())->with(['category','subcategory','level'])->latest()->paginate(getPaginate());
        }
      
        return view($this->activeTemplate.'user.instructor.courses',compact('pageTitle','courses','search'));
    }

    public function create()
    {
        $pageTitle = "Create New Course";
        $categories = Category::where('status',1)->with('subcategories')->latest()->get(['name','id']);
        
        $levels = Level::get();
        return view($this->activeTemplate.'user.instructor.create_course',compact('pageTitle','categories','levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:courses',
            'description'=> 'required',
            'will_learn' => 'required',
            'category_id' => 'required|integer|gt:0',
            'subcategory_id' => 'required|integer|gt:0',
            'level_id' => 'required|integer|gt:0',
            'value' => 'required|integer',
            'price' => 'required_if:value,1|numeric|gt:0',
            'discount' => 'nullable|numeric|gt:0|lte:100',
            'tags' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,PNG,JPG,jpeg',
            'preview' => 'required|in:1,2',
            'preview_video' => 'required_if:preview,1|mimes:mp4,avi,wmv',
            'preview_url' => 'required_if:preview,2',
            
        ]);

        $tags = explode(',',$request->tags);
        if(count($tags) > 10){
            $notify[]=['error','Sorry! tags can not be more than 10'];
            return back()->withNotify($notify);
        }

        $course = new Course();
        $course->code = getTrx(15);
        $course->title = $request->title;
        $course->slug  = slug($request->title);
        $course->author_id = auth()->id();
        $course->description = $request->description;
        $course->will_learn = $request->will_learn;
        $course->category_id = $request->category_id;
        $course->subcategory_id = $request->subcategory_id;
        $course->level_id = $request->level_id;
        $course->value = $request->value;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->tags = $tags;
        $course->preview = $request->preview;

        if($request->thumbnail){
            $path = imagePath()['course']['path'];
            $pSize = imagePath()['course']['preview_size'];
            $thumbSize = imagePath()['course']['thumb_size'];
            $course->thumbnail = uploadImage($request->thumbnail,$path,$pSize,null,$thumbSize);
        }
        if($request->preview == 1  && $request->preview_video){
            $path = imagePath()['course']['preview_video_path'];
            $course->preview_video =  uploadFile($request->preview_video,$path);
        }else {
            $course->preview_url = $request->preview_url;
        }
        $course->status = 3;
        $course->save();
        $notify[]=['success','New course added successfully'];
        return back()->withNotify($notify);
    }

    public function edit($id,$slug)
    {
        $pageTitle = "Edit Course";
        $course = Course::where('author_id',auth()->id())->where('id',$id)->firstOrFail();
        $levels = Level::get();
        $categories = Category::where('status',1)->with('subcategories')->latest()->get(['name','id']);
        return view($this->activeTemplate.'user.instructor.edit_course',compact('pageTitle','categories','course','levels'));

    }

    public function update(Request $request)
    {

        $course = Course::findOrFail($request->id);
        $request->validate([
            'title' => 'required|unique:courses,title,'.$course->id,
            'description'=> 'required',
            'will_learn' => 'required',
            'category_id' => 'required|integer|gt:0',
            'subcategory_id' => 'required|integer|gt:0',
            'level_id' => 'required|integer',
            'value' => 'required|integer',
            'price' => 'required_if:value,1|numeric|gt:0',
            'tags' => 'required',
            'thumbnail' => 'image|mimes:jpg,png,PNG,JPG,jpeg',
            'preview' => 'required|in:1,2',
            'preview_video' => 'sometimes|required_if:preview,1|mimes:mp4,avi,wmv',
            'preview_url' => 'required_if:preview,2',
            'discount' => 'nullable|numeric|gt:0|lte:100',
          
        ]);

        $tags = explode(',',$request->tags);
        if(count($tags) > 10){
            $notify[]=['error','Sorry! tags can not be more than 10'];
            return back()->withNotify($notify);
        }

        $course->title = $request->title;
        $course->author_id = auth()->id();
        $course->slug  = slug($request->title);
        $course->description = $request->description;
        $course->will_learn = $request->will_learn;
        $course->category_id = $request->category_id;
        $course->subcategory_id = $request->subcategory_id;
        $course->level_id = $request->level_id;
        $course->value = $request->value;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->tags = $tags;
        $course->preview = $request->preview;
        if($request->thumbnail){
            $old = $course->thumbnail ?? null;
            $path = imagePath()['course']['path'];
            $pSize = imagePath()['course']['preview_size'];
            $thumbSize = imagePath()['course']['thumb_size'];
            $course->thumbnail = uploadImage($request->thumbnail,$path,$pSize,$old,$thumbSize);
        }
        if($request->preview == 1 && $request->preview_video){
            $path = imagePath()['course']['preview_video_path'];
            $course->preview_video =  uploadFile($request->preview_video,$path); 
        }else {
            $course->preview_url = $request->preview_url;
        }
       
        $course->save();
        $notify[]=['success','Course updated successfully'];
        return back()->withNotify($notify);
    }   

    public function publish($code)
    {
        $course = Course::where('author_id',auth()->id())->where('code',$code)->firstOrFail();
        $general = GeneralSetting::first();
        if($course->status == 3){
            $course->status = $general->approval == 1 ?  1 : 0;
            $course->save();
            $msg = $general->approval == 1 ? 'Course has been published' : 'Course has been published. Wait for the admin approval';

            $notify[]=['success',$msg];
            return back()->withNotify($notify);
        }

        $notify[]=['info','Course is already published'];
        return back()->withNotify($notify);

    }
    
    public function coursePlay($id,$slug)
    {
        $pageTitle = "Course Play";
        $course = Course::where('status',1)->eagerLoads()->find($id);
        if (!$course) {
            $notify[]=['error','Something went wrong try again sometimes later'];
            return back()->withNotify($notify);
        }
        $exist = UserCourse::where([['course_id',$course->id],['user_id',auth()->id()]])->where('status',"success")->first();
        if(!$exist){
            $notify[]=['error','Invalid request'];
            return back()->withNotify($notify);
        }
      
        return view($this->activeTemplate.'user.course_play',compact('pageTitle','course'));
    }
    public function purchasedCourses()
    {
        $pageTitle = "Purchased Courses";
        $user = auth()->user();
       
        return view($this->activeTemplate.'user.purchased_courses',compact('pageTitle','user'));
    }

    public function review(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|gt:0',
            'review' => 'required'
        ]);
      
        $enrolled = UserCourse::where('user_id',auth()->id())->where('course_id',$request->course_id)->where('status',"success")->first();
        if(!$enrolled){
            $notify[]=['error','You haven\'t enrolled this course yet'];
            return back()->withNotify($notify);
        }
       
        if(auth()->user()->reviewed($request->course_id)){
            $notify[]=['error','You have already reviewed once'];
            return back()->withNotify($notify);
        }

        if(auth()->id() == $request->author_id){
            $notify[]=['error','You can not review your own course'];
            return back()->withNotify($notify);
        }

        $review = new Review();
        $review->user_id = auth()->id();
        $review->course_id = $request->course_id;
        $review->author_id = $request->author_id;
        $review->stars = $request->rating;
        $review->review = $request->review;
        $review->save();

        $notify[]=['success','Review has been submitted'];
        return back()->withNotify($notify);
     }

     public function purchaseCourse(Request $request)
     {
        $course = Course::find($request->course_id);

        if(!$course){
            $notify[]=['error','Sorry course not found'];
            return back()->withNotify($notify);
        }

        if($course->author_id == auth()->id()){
            $notify[]=['error','Can\'t purchase your own course'];
            return back()->withNotify($notify);
        }


        if($course->value == 1){
            if(session('newPrice')){
                $price = session('newPrice');
            } else {
                $price = $course->discount ? $course->discountPrice() : $course->price;
            }

            if($price > auth()->user()->balance){
                $notify[]=['error','Insufficient balance'];
                return back()->withNotify($notify);
            }

            auth()->user()->balance -= $price;
            auth()->user()->save(); 
        }

        $trx = new Transaction();
        $trx->user_id = auth()->id();
        $trx->amount = $course->value == 1 ? $price : 0;
        $trx->trx = getTrx();
        $trx->post_balance = auth()->user()->balance;
        $trx->trx_type = '-';
        $trx->charge = 0;
        $trx->details = 'Payment for '.$course->title;
        $trx->save();

        $userCourse = new UserCourse();
        $userCourse->user_id = auth()->id();
        $userCourse->course_id = $course->id;
        $userCourse->author_id = $course->author_id;
        $userCourse->status = $course->value == 1 ? "success" : "pending";
        $userCourse->save();
    
        notify(auth()->user(), 'PURCHASE_COURSE', [
            'course_name' => $course->title,
            'course_code' => $course->code,
            'amount' => $course->value == 1 ? getAmount($price):0.00,
            'trx' => $trx->trx,
            'currency' => GeneralSetting::value('cur_text'),
            'time' => showDateTime($userCourse->created_at,'d M Y @ h:i:a'),
        ]);

        if($course->value == 1){
             $notify[]=['success','Purchased successfully'];
        }else{
             $notify[]=['success','Enrolled request sent successful. Check back to know if successful'];
        }
      
        return back()->withNotify($notify);


     }

}
