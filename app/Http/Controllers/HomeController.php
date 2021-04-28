<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\CourseOfstudy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'news' => News::get(),
            'teachers'=>User::where('type','=','teacher')->get(),
        ]);
    }
    public function courseOfStudy($class)
    {
        return view('courseOfStudy',[
            'courses' => CourseOfstudy::with('user')->where('class','=',str_ireplace("%20"," ",$class))->get(),
        ]);
    }

    public function downloadCourse(Request $request)
    {
        return Storage::download($request['path']);
        redirect(Request::url());
    }
}
