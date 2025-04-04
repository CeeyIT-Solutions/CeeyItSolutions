<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function __construct() {
        $this->activeTemplate = activeTemplate();
    }

    public function chapters (Request $request,$id,$slug)
    {
        $search = $request->search;
        $course = Course::where('id',$id)->where('author_id',auth()->id())->first();
        if(!$course){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        if($search){
            $pageTitle = "Search Results of $search";
            $chapters = Chapter::where('course_id',$course->id)->where('title','like',"%$search%")->latest()->paginate(getPaginate());
        } else {
            $pageTitle = "Chapter List";
            $chapters = Chapter::where('course_id',$course->id)->latest()->paginate(getPaginate());
        }
        return view($this->activeTemplate.'user.instructor.chapters',compact('pageTitle','chapters','course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:chapters',          
        ]);
        $course = Course::where('id',$request->course_id)->where('author_id',auth()->id())->first();
        if(!$course){
            $notify[]=['error','Sorry invalid request'];
            return back()->withNotify($notify);
        }
        $chapter = new Chapter();
        $chapter->course_id = $request->course_id;
        $chapter->title = $request->title;
        $chapter->slug = slug($request->title);
        $chapter->status = $request->status ? 1:0;
        $chapter->save();
        $notify[]=['success','Chapter added successfully'];
        return back()->withNotify($notify);
    }
    public function update(Request $request)
    {
        $chapter = Chapter::findOrFail($request->chapter_id);
        $request->validate([
            'title' => 'required|unique:chapters,title,'.$chapter->id,          
        ]);
        
        $chapter->title = $request->title;
        $chapter->slug = slug($request->title);
        $chapter->status = $request->status ? 1:0;
        $chapter->update();
        $notify[]=['success','Chapter Updated successfully'];
        return back()->withNotify($notify);
    }
    
}
