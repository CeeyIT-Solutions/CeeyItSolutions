<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lecture;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;

class LectureController extends Controller
{
    public function __construct() {
        $this->activeTemplate = activeTemplate();
    }
    public function lectures(Request $request,$course_slug,$chapter_slug)
    {
        $search = $request->search;
        $course = Course::where('slug',$course_slug)->where('author_id',auth()->id())->first();
        if(!$course){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        $chapter = Chapter::where('slug',$chapter_slug)->where('course_id',$course->id)->first();
        if(!$chapter){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        if($search){
            $pageTitle = "Search Results of $search";
            $lectures = Lecture::where('course_id',$course->id)->where('chapter_id', $chapter->id)->where('title','like',"%$search%")->latest()->paginate(getPaginate());
        } else {
            $pageTitle = "Lecture List";
            $lectures = Lecture::where('course_id',$course->id)->where('chapter_id', $chapter->id)->latest()->paginate(getPaginate());
        }
        return view($this->activeTemplate.'user.instructor.lectures',compact('pageTitle','lectures','course','chapter'));
    }

    public function create($course_slug,$chapter_slug)
    {
        $course = Course::where('slug',$course_slug)->where('author_id',auth()->id())->first();
        if(!$course){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        $chapter = Chapter::where('slug',$chapter_slug)->where('course_id',$course->id)->first();
        if(!$chapter){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        $pageTitle = "Add New Lecture";
        return view($this->activeTemplate.'user.instructor.add_lecture',compact('pageTitle','course','chapter','pageTitle'));
    }
   

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:lectures',
            'description' => 'required',
            'duration' => 'required|numeric|gt:0',
            'type' => 'required|in:1,2,3',
            'video_file' => ['required_if:type,1',new FileTypeValidate(['mp4','avi'])],
            'file' => [new FileTypeValidate(['pdf','docx'])],
            'url' => 'required_if:type,2',
        ]);

        $course = Course::where('id',$request->course_id)->where('author_id',auth()->id())->first();
        if(!$course){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }

        $chapter = Chapter::where('id',$request->chapter_id)->where('course_id',$course->id)->first();
        if(!$chapter){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }

        $lecture = new Lecture();
        $lecture->course_id = $request->course_id;
        $lecture->chapter_id = $request->chapter_id;
        $lecture->title = $request->title;
        $lecture->duration = $request->duration;
        $lecture->slug = slug($request->title);
        $lecture->description = $request->description;
        $lecture->type = $request->type;
       
        if($request->video_file){
            try {
                $path = imagePath()['lecture']['path'];
                $lecture->video_file = uploadFile($request->video_file,$path);
            }catch (\Exception $e) {
                $notify[]=['error','Lecture file can not be uploaded'];
                return back()->withNotify($notify);
            }
        }  else {
            $lecture->url = $request->url;
        }
      
        if($request->file){
           try {
            $path = imagePath()['lecture']['file_path'];
             $lecture->file = uploadFile($request->file,$path);
           }catch (\Exception $e) {
             $notify[]=['error','Lecture file can not be uploaded'];
             return back()->withNotify($notify);
           }
        }

        $lecture->visibility = $request->visibility ? 1: 0;
        $lecture->status = $request->status ? 1: 0;
        
        $lecture->save();
        $notify[]=['success','Lecture Added Successfully'];
        return back()->withNotify($notify);
        
    }

    public function edit($course_slug,$chapter_slug,$lecture_slug)
    {
        $course = Course::where('slug',$course_slug)->where('author_id',auth()->id())->first();
        if(!$course){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        $chapter = Chapter::where('slug',$chapter_slug)->where('course_id',$course->id)->first();
        if(!$chapter){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        $lecture = Lecture::where('slug',$lecture_slug)->first();
        $pageTitle = "Edit Lecture";
        return view($this->activeTemplate.'user.instructor.edit_lecture',compact('pageTitle','course','chapter','pageTitle','lecture'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:lectures,title,'.$request->lecture_id,
            'description' => 'required',
            'duration' => 'required|numeric|gt:0',
            'type' => 'required|in:1,2,3',
            'video_file' => [new FileTypeValidate(['mp4','avi'])],
            'file' => [new FileTypeValidate(['pdf','docx'])],
        ]);

        $course = Course::where('id',$request->course_id)->where('author_id',auth()->id())->first();
        if(!$course){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        $chapter = Chapter::where('id',$request->chapter_id)->where('course_id',$course->id)->first();
        if(!$chapter){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }

        $lecture = Lecture::findOrFail($request->lecture_id);
        $lecture->course_id = $request->course_id;
        $lecture->chapter_id = $request->chapter_id;
        $lecture->title = $request->title;
        $lecture->duration = $request->duration;
        $lecture->slug = slug($request->title);
        $lecture->description = $request->description;
        $lecture->type = $request->type;
       
        if($request->video_file){
           try{
               $old = $lecture->video_file ?? null; 
               $lecture->video_file = uploadFile($request->video_file,imagePath()['lecture']['path'],null,$old);
           } catch(\Exception $e){
                $notify[]=['error','Lecture file can not be uploaded'];
                return back()->withNotify($notify);
           }
        }else {
            $lecture->url = $request->url;
        }
      
        if($request->file){
            try{
                $old = $lecture->file ?? null; 
                $lecture->file = uploadFile($request->file,imagePath()['lecture']['file_path'],null, $old);
            } catch(\Exception $e){
                $notify[]=['error','Lecture file can not be uploaded'];
                return back()->withNotify($notify);
            }
           
        }

        $lecture->visibility = $request->visibility ? 1: 0;
        $lecture->status = $request->status ? 1: 0;
        
        $lecture->update();
        $notify[]=['success','Lecture Updated Successfully'];
        return redirect(route('user.course.lectures',[$course->slug,$chapter->slug]))->withNotify($notify);
        
    }

    public function fileDownload($id)
    {
        try {
                $lecture = Lecture::findOrFail($id);
            $user = auth()->user();

            $exist = UserCourse::where('user_id',$user->id)->where('course_id',$lecture->course_id)->where('status',"success")->first();
            if($user->is_instructor != 1 && !$exist){
                $notify[]=['error','Sorry! invalid request'];
                return back()->withNotify($notify);
            }

            $filepath = imagePath()['lecture']['file_path'].$lecture->file;
            $extension = pathinfo($filepath,PATHINFO_EXTENSION);
            $fileName =  $lecture->slug.'.'.$extension;
            $headers = [
                'Content-Type' => 'application', 
                'Cache-Control' => 'no-store, no-cache'
            ];
            return response()->download( $filepath, $fileName, $headers);
        } catch (\Throwable $th) {
            $notify[]=['error','File Not found'];
            return back()->withNotify($notify);
        }
    }
    

    
}
