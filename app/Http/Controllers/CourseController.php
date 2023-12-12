<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseController extends Controller
{
    public function Index()
    {
        return view('admin.course.index', ['courses' => Course::orderBy('created_at', 'DESC')->get()]);
    }

    public function Add()
    {
        return view('admin.course.add');
    }

    public function Store()
    {
        request()->validate([
            'course' => 'required|min:3|max:50'
        ]);

        $categories = Course::create([
            'course_name' => request()->get('course')
        ]);

        $categories->save();
        return back()->with('success', 'Course created successfully!');
    }

    public function Edit(Course $id)
    {
        return view('admin.course.update', ['course' => $id]);
    }

    public function Destroy(Course $id)
    {
        try {
            $id->delete();
            return back()->with('success', 'Delete successfully!');
        } catch (ModelNotFoundException  $e) {
            return back()->with('error', 'Record not found.');
        }
    }

    public function Update(Course $course)
    {
        request()->validate([
            'course' => 'required|min:3|max:50'
        ]);

        $course->course_name = request()->get('course', '');
        $course->save();
        return back()->with('success', 'Course updated successfully!');
    }
}
