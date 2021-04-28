<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{

    public function addStudentForm()
    {
        return view('addStudent');
    }

    public function deleteStudent($id)
    {
        Storage::delete(User::find($id)->avatar);
        User::find($id)->delete();
        return redirect('students');
    }

    public function addStudent(Request $request)
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
            'type' => 'student',
            'mobile' => $request['mobile'],
            'section' => $request['section'],
            'description'=> $request['description'],
        ]);
        return redirect('home');
    }

    public function showStudent($id)
    {
        if (Auth::user()->type == 'manager' || (Auth::user()->id == $id && Auth::user()->type == 'student')) {
            return view('showStudent',[
                'student'=>User::where('id',$id)->with('student')->first(),
            ]);
        }
        else{
            abort('404');
        }
    }


    public function students()
    {
    	return view('students',[
    		'students'=>User::where('type','=','student')->paginate(10),
    	]);
    }

    public function studentsByClass($class)
    {
        return view('students',[
            'students'=>User::where('type','=','student')->where('section','=',str_ireplace("%20"," ",$class))->get(),
        ]);
    }
}
