<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CourseOfStudy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Auth;

class TeachersController extends Controller
{

    public function deleteCourseOfStudy($id)
    {
        Storage::delete(CourseOfStudy::find($id)->path);
        CourseOfStudy::find($id)->delete();
        return back();
    }


    public function addCourseOfStudyForm()
    {
        return view('addCourseOfStudy');
    }

    public function addCourseOfStudy(Request $request)
    {
        $validated = $request->validate([
            'header' => ['required','string'],
            'title' => ['required','string'],
            'class' => ['required',Rule::in(['First Grade','Second Grade','Third Grade','Fourth Grade','Fifth Grade','Sixth Grade'])],
            'description' => ['string', 'max:300'],
        ]);

        CourseOfStudy::create([
            'header' => $request['header'],
            'user_id' =>Auth::user()->id,
            'title' => $request['title'],
            'class' => $request['class'],
            'description'=> $request['description'],
            'path' => request('file')->store('courseofstudy'),
        ]);
        return redirect('home');
    }


    public function deleteTeacher($id)
    {
        Storage::delete(User::find($id)->avatar);
        User::find($id)->delete();
        return redirect('home');
    }

    public function addNewTeacherForm()
    {
        return view('addTeacherForm');
    }
    
    public function addNewTeacher(Request $request)
    {
    	$validated = $request->validate([
	        'name' => ['required', 'string', 'max:255'],
            'facebook' => ['max:255', 'unique:users'],
            'avatar' => ['required','file'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	        'section' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required',Rule::in(['male', 'female'])],
            'birthday' => ['required'],
            'mobile' => ['required', 'unique:users'],
            'description' => ['string', 'max:300'],
	    ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'facebook' => $request['facebook'],
            'password' => Hash::make($request['password']),
            'avatar' => request('avatar')->store('avatars'),
            'birthday' => $request['birthday'],
            'gender' => $request['gender'],
            'type' => 'teacher',
            'mobile' => $request['mobile'],
            'section' => $request['section'],
            'description'=> $request['description'],
        ]);
	    return redirect('home');
    }
}
