<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profileForm($id)
    {
    	return view('profile',[
    		'user'=>User::where('id',$id)->first(),
    	]);
    }

    public function profile(Request $request,$id)
    {
        if ($request['password']) {
            $validated = $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            User::where('id', $id)
                ->update(['password' => Hash::make($request['password'])]);
        }
        if (User::where('id',$id)->first()->mobile != $request['mobile']) {
            $validated = $request->validate([
                'mobile' => ['required', 'unique:users'],
            ]);
            User::where('id', $id)
                ->update(['mobile' =>$request['mobile']]);   
        }
        if (User::where('id',$id)->first()->email != $request['email']) {
            $validated = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            User::where('id', $id)
                ->update(['email' =>$request['email']]);   
        }
        if ($request['avatar']) {
           $validated = $request->validate([
                'avatar' => ['file'],
            ]);
           Storage::delete(User::find($id)->avatar);
           User::where('id', $id)
            ->update(['avatar' => request('avatar')->store('avatars')]);
        }
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'facebook' => ['max:255', 'unique:users'],
                'section' => ['string', 'max:100'],
                'gender' => ['required',Rule::in(['male', 'female'])],
                'birthday' => ['required'],
                'description' => ['string', 'max:300'],
            ]);
            User::where('id', $id)
                ->update([
                            'name' => $request['name'],
                            'facebook' => $request['facebook'],
                            'birthday' => $request['birthday'],
                            'gender' => $request['gender'],
                            'section' => $request['section'],
                            'description'=> $request['description'],
                        ]);
        return back();
    }
}
