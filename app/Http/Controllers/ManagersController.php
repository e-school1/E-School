<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Students;
use Illuminate\Support\Facades\File;

class ManagersController extends Controller
{
    public function updateNews($id, Request $request)
    {
        $messages = [
            'images.*' => 'All images Must Be As Type Of Jpg Png Jpeg Bmp Svg ',
        ];

        if ($request->file('images')) {
            $validated = $request->validate([
                'images.*' => ['image','mimes:jpg,png,jpeg,bmp,svg'],
            ],$messages);
        }

        $validated = $request->validate([
            'header' => ['required','string'],
            'title' => ['required','string'],
            'content' => ['required', 'string'],
        ]);

        $userId = News::where('id',$id)->update([
            'header' => $request['header'],
            'title' => $request['title'],
            'content' => $request['content'],
        ]);

        if ($request->file('images')) {
            File::deleteDirectory(public_path(News::find($id)->images));
            foreach($request->file('images') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/'.$id.'/', $name);  
                $data[] = $name;  
            }
            News::where('id',$id)->update([
                'images' => 'images/'. $id.'/',
            ]);
        }

        return view('home');
    }

    public function updateNewsForm($id)
    {
        return view('addNewsForm',[
            'news'=>News::where('id',$id)->first(),
        ]);
    }
    public function showNews($id)
    {
        return view('showNews',[
            'new'=>News::where('id',$id)->first(),
        ]);
    }

	    public function giveFirstSemesterForm($id)
    {
        return view('resaultForm',[
            'semester'=>'First',
            'student'=>User::where('id',$id)->with('student')->first(),
        ]);
    }

    public function giveFirstSemester($id, Request $request)
    {
        $resault = json_encode(
            [
                "name1"=>['name'=>$request['name1'],'degree'=>$request['degree1'].'/'.$request['of1']],
                "name2"=>['name'=>$request['name2'],'degree'=>$request['degree2'].'/'.$request['of2']],
                "name3"=>['name'=>$request['name3'],'degree'=>$request['degree3'].'/'.$request['of3']],
                "name4"=>['name'=>$request['name4'],'degree'=>$request['degree4'].'/'.$request['of4']],
                "name5"=>['name'=>$request['name5'],'degree'=>$request['degree5'].'/'.$request['of5']],
                "name6"=>['name'=>$request['name6'],'degree'=>$request['degree6'].'/'.$request['of6']],
                "name7"=>['name'=>$request['name7'],'degree'=>$request['degree7'].'/'.$request['of7']],
                "name8"=>['name'=>$request['name8'],'degree'=>$request['degree8'].'/'.$request['of8']],
                "name9"=>['name'=>$request['name9'],'degree'=>$request['degree9'].'/'.$request['of9']],
                "name10"=>['name'=>$request['name10'],'degree'=>$request['degree10'].'/'.$request['of10']],
            ]
        );


        Students::updateOrCreate (['user_id'=>$id],[
            'firstsemester'=>$resault,
            'firstsemesterresault' => $request['finalresault'],
            'firstsemesternote'=> $request['note'],
        ]);
        return redirect('/showStudent/'.$id);
    }

    public function deleteFirstSemester($id, Request $request)
    {
        Students::where('user_id', $id)
          ->update([
            'firstsemester'=>'',
            'firstsemesterresault' => '',
            'firstsemesternote'=> '',
        ]);
        return redirect('/showStudent/'.$id);
    }

    public function giveSecondSemesterForm($id)
    {
        return view('resaultForm',[
            'semester'=>'Second',
            'student'=>User::where('id',$id)->with('student')->first(),
        ]);
    }

    public function giveSecondSemester($id, Request $request)
    {
        $resault = json_encode(
            [
                "name1"=>['name'=>$request['name1'],'degree'=>$request['degree1'].'/'.$request['of1']],
                "name2"=>['name'=>$request['name2'],'degree'=>$request['degree2'].'/'.$request['of2']],
                "name3"=>['name'=>$request['name3'],'degree'=>$request['degree3'].'/'.$request['of3']],
                "name4"=>['name'=>$request['name4'],'degree'=>$request['degree4'].'/'.$request['of4']],
                "name5"=>['name'=>$request['name5'],'degree'=>$request['degree5'].'/'.$request['of5']],
                "name6"=>['name'=>$request['name6'],'degree'=>$request['degree6'].'/'.$request['of6']],
                "name7"=>['name'=>$request['name7'],'degree'=>$request['degree7'].'/'.$request['of7']],
                "name8"=>['name'=>$request['name8'],'degree'=>$request['degree8'].'/'.$request['of8']],
                "name9"=>['name'=>$request['name9'],'degree'=>$request['degree9'].'/'.$request['of9']],
                "name10"=>['name'=>$request['name10'],'degree'=>$request['degree10'].'/'.$request['of10']],
            ]
        );


        Students::updateOrCreate (['user_id'=>$id],[
            'secondsemester'=>$resault,
            'secondsemesterresault' => $request['finalresault'],
            'secondsemesternote'=> $request['note'],
        ]);
        return redirect('/showStudent/'.$id);
    }

    public function deleteSecondSemester($id, Request $request)
    {
        Students::where('user_id', $id)
          ->update([
            'secondsemester'=>'',
            'secondsemesterresault' => '',
            'secondsemesternote'=> '',
        ]);
        return redirect('/showStudent/'.$id);
    }

	public function addNewNewsForm()
	{
		return view('addNewsForm');
	}
	
    public function addNewNews(Request $request)
    {
        $messages = [
            'images.*' => 'All images Must Be As Type Of Jpg Png Jpeg Bmp Svg ',
        ];

    	$validated = $request->validate([
	        'header' => ['required','string'],
	        'title' => ['required','string'],
	        'content' => ['required', 'string'],
            'images.*' => ['image','mimes:jpg,png,jpeg,bmp,svg'],
	    ],$messages);

        $userId = News::create([
            'header' => $request['header'],
            'title' => $request['title'],
            'content' => $request['content'],
        ]);

        if ($request->file('images')) {
            foreach($request->file('images') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/'.$userId->id.'/', $name);  
                $data[] = $name;  
            }
        }
        News::where('id',$userId->id)->update([
            'images' => 'images/'. $userId->id.'/',
        ]);

	    return redirect('home');
    }

    public function deleteNews($id)
    {
        File::deleteDirectory(public_path(News::find($id)->images));
    	News::find($id)->delete();
    	return redirect('home');
    }
}
