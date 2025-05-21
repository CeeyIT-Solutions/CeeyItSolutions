<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function levels()
    {
        $pageTitle = "Course Levels";
        $emptyMessage = "No Data Found";
        $levels = Level::with('courses')->get();
        return view('admin.level.list', compact('pageTitle', 'emptyMessage', 'levels'));
    }
    public function levelStore(Request $request)
    {
        $request->validate(['name' => 'required|unique:levels']);
        $level = new Level();
        $level->name = $request->name;
        $level->slug = slug($request->name);
        $level->save();

        $notify[] = ['success', 'New Course Level Added'];
        return back()->withNotify($notify);
    }
    public function levelUpdate(Request $request, $id)
    {
        $request->validate(['name' => 'required|unique:levels,name,' . $id]);
        $level = Level::findOrFail($id);
        $level->name = $request->name;
        $level->update();

        $notify[] = ['success', 'Course Level Updated'];
        return back()->withNotify($notify);
    }



    public function courseDetail($id)
    {
        $pageTitle = "Details of this course";
        $course = Course::findOrFail($id);
        return view('admin.courses.course_play', compact('pageTitle', 'course'));
    }


    public function activeCourses()
    {

        $search = request('search');
        if ($search) {
            $pageTitle = "Search results of $search";
            $courses = Course::active()->where('title', 'like', "%$search%")->orWhere('code', $search)->with(['category', 'subcategory', 'author', 'level'])->latest()->paginate(getPaginate());

        } else {
            $pageTitle = "Active Courses";
            $courses = Course::active()->with(['category', 'subcategory', 'author', 'level'])->latest()->paginate(getPaginate());
        }
        $emptyMessage = "No active course found";
        return view('admin.courses.list', compact('pageTitle', 'courses', 'emptyMessage', 'search'));
    }
    public function pendingCourses()
    {
        $search = request('search');
        if ($search) {
            $pageTitle = "Search results of $search";
            $courses = Course::inactive()->where('title', 'like', "%$search%")->orWhere('code', $search)->with(['category', 'subcategory', 'author', 'level'])->latest()->paginate(getPaginate());
        } else {
            $pageTitle = "Pending Courses";
            $courses = Course::inactive()->with(['category', 'subcategory', 'author', 'level'])->latest()->paginate(getPaginate());
        }

        $emptyMessage = "No active course found";
        return view('admin.courses.list', compact('pageTitle', 'courses', 'emptyMessage', 'search'));
    }


    public function bannedCourses()
    {
        $search = request('search');
        if ($search) {
            $pageTitle = "Search results of $search";
            $courses = Course::banned()->where('title', 'like', "%$search%")->orWhere('code', $search)->with(['category', 'subcategory', 'author', 'level'])->latest()->paginate(getPaginate());
        } else {
            $pageTitle = "Banned Courses";
            $courses = Course::banned()->with(['category', 'subcategory', 'author', 'level'])->latest()->paginate(getPaginate());
        }

        $emptyMessage = "No active course found";
        return view('admin.courses.list', compact('pageTitle', 'courses', 'emptyMessage', 'search'));
    }

    public function banCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if ($course->status != 2) {
            $request->validate([
                'reasons' => 'required'
            ]);
            $course->status = 2;
            $course->reasons = $request->reasons;
            $msg = 'Course has been banned';
            $course->save();

            notify($course->author, 'BAN_COURSE', [
                'course_name' => $course->title,
                'reasons' => $request->reasons,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);

        } else {
            $course->status = 1;
            $msg = 'Course has been Un-banned';
            $course->save();

            notify($course->author, 'UN_BAN_COURSE', [
                'course_name' => $course->title,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);
        }

        $notify[] = ['success', $msg];
        return back()->withNotify($notify);
    }

    public function topCourse($id)
    {
        $course = Course::findOrFail($id);

        if ($course->is_top == 1) {
            $course->is_top = 0;
            $msg = 'This course has been removed from top course';
        } else {
            $course->is_top = 1;
            $msg = 'This course has been marked as top course';
        }

        $course->save();
        $notify[] = ['success', $msg];
        return back()->withNotify($notify);
    }

    public function action(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if ($course->status == 1) {
            $request->validate([
                'reasons' => 'required'
            ]);

            $course->status = 0;
            $course->reasons = $request->reasons;
            $msg = 'Course has been rejected';
            $course->save();

            notify($course->author, 'REJECT_COURSE', [
                'course_name' => $course->title,
                'reasons' => $request->reasons,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);

        } elseif ($course->status == 0) {
            $course->status = 1;
            $msg = 'Course has been approved';
            $course->save();

            notify($course->author, 'APPROVE_COURSE', [
                'course_name' => $course->title,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);
        }

        $notify[] = ['success', $msg];
        return back()->withNotify($notify);
    }

    public function fileDownload($id)
    {
        try {
            $lecture = Lecture::findOrFail($id);
            $filepath = imagePath()['lecture']['file_path'] . $lecture->file;
            $extension = pathinfo($filepath, PATHINFO_EXTENSION);
            $fileName = $lecture->slug . '.' . $extension;
            $headers = [
                'Content-Type' => 'application',
                'Cache-Control' => 'no-store, no-cache'
            ];
            return response()->download($filepath, $fileName, $headers);
        } catch (\Throwable $th) {
            $notify[] = ['error', 'File Not found'];
            return back()->withNotify($notify);
        }
    }

    public function pendingUserCourses()
    {
        $search = request('search');
        if ($search) {
            // ->where('status',"pending")
            $pageTitle = "Search results of $search";
            $coursesUser = UserCourse::with(['user', 'course'])
                ->whereHas('course', function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%");
                })
                ->latest()
                ->paginate(getPaginate());
        } else {
            $pageTitle = "User Courses";
            $coursesUser = UserCourse::with(['user', 'course'])->latest()->paginate(getPaginate());
            // dd($coursesUser);where('status',"pending")->
        }

        $emptyMessage = "No active user course found";
        return view('admin.courses.user_course_list', compact('pageTitle', 'coursesUser', 'emptyMessage', 'search'));
    }

    public function actionUser(Request $request, $id)
    {
        $course_user = UserCourse::findOrFail($id);
        $course = Course::findOrFail($course_user->course_id);


        if ($course_user->status == "success") {
            $request->validate([
                'reasons' => 'required'
            ]);

            $course_user->status = "rejected";
            $course_user->reasons = $request->reasons;
            $msg = 'Your request to enroll to this course has been rejected';
            $course_user->save();

            notify($course_user->user, 'REJECT_COURSE', [
                'course_name' => $course->title,
                'reasons' => $request->reasons,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);

        } elseif ($course_user->status == "pending") {
            $course_user->status = "success";
            $msg = 'Your request to enroll to this course has been approved';
            $course_user->save();

            notify($course_user->user, 'APPROVE_COURSE', [
                'course_name' => $course->title,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);
        }

        $notify[] = ['success', $msg];
        return back()->withNotify($notify);
    }

    public function banUserCourse(Request $request, $id)
    {
        $course_user = UserCourse::findOrFail($id);
        $course = Course::findOrFail($course_user->course_id);

        if ($course_user->status != "rejected") {
            $request->validate([
                'reasons' => 'required'
            ]);
            $course_user->status = "rejected";
            $course_user->reasons = $request->reasons;
            $msg = 'Your request to enroll to this course has been rejected';
            $course_user->save();

            notify($course_user->user, 'REJECT_COURSE', [
                'course_name' => $course->title,
                'reasons' => $request->reasons,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);

        } else {
            $course_user->status = "success";
            $msg = 'Your request to enroll to this course has been approved';
            $course_user->save();

            notify($course->author, 'APPROVE_COURSE', [
                'course_name' => $course->title,
                'time' => showDateTime('', 'd M Y @ h:i:a'),
            ]);
        }

        $notify[] = ['success', $msg];
        return back()->withNotify($notify);
    }
}