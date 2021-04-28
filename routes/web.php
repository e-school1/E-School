<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home',[App\Http\Controllers\HomeController::class, 'index']);

Route::get('/courseOfStudy/{class}',[App\Http\Controllers\HomeController::class, 'courseOfStudy']);
Route::post('/download',[App\Http\Controllers\HomeController::class, 'downloadCourse']);

Route::get('/showNews/{id}',[App\Http\Controllers\ManagersController::class, 'showNews']);

Route::group(['middleware' => 'auth'], function () {

	Route::get('/showStudent/{id}',[App\Http\Controllers\StudentsController::class, 'showStudent']);


	Route::group(['middleware' => ['Manager']], function () {

		Route::get('/profile/{id}',[App\Http\Controllers\UserController::class, 'profileForm']);
		Route::post('/profile/{id}',[App\Http\Controllers\UserController::class, 'profile']);

		Route::get('/students',[App\Http\Controllers\StudentsController::class, 'students']);
		Route::get('/studentsByClass/{class}',[App\Http\Controllers\StudentsController::class, 'studentsByClass']);

		Route::get('/addNewNews',[App\Http\Controllers\ManagersController::class, 'addNewNewsForm']);
		Route::post('/addNewNews',[App\Http\Controllers\ManagersController::class, 'addNewNews']);
		Route::post('/deleteNews/{id}',[App\Http\Controllers\ManagersController::class, 'deleteNews']);

		Route::get('/updateNews/{id}',[App\Http\Controllers\ManagersController::class, 'updateNewsForm']);
		Route::post('/addNewNews/{id}',[App\Http\Controllers\ManagersController::class, 'updateNews']);

		Route::get('/addNewTeacher',[App\Http\Controllers\TeachersController::class, 'addNewTeacherForm']);
		Route::post('/addNewTeacher',[App\Http\Controllers\TeachersController::class, 'addNewTeacher']);
		Route::post('/deleteTeacher/{id}',[App\Http\Controllers\TeachersController::class, 'deleteTeacher']);

		Route::get('/addStudent',[App\Http\Controllers\StudentsController::class, 'addStudentForm']);
		Route::post('/addStudent',[App\Http\Controllers\StudentsController::class, 'addStudent']);
		Route::post('/deleteStudent/{id}',[App\Http\Controllers\StudentsController::class, 'deleteStudent']);

		Route::get('/giveFirstSemester/{id}',[App\Http\Controllers\ManagersController::class, 'giveFirstSemesterForm']);
		Route::get('/giveSecondSemester/{id}',[App\Http\Controllers\ManagersController::class, 'giveSecondSemesterForm']);

		Route::post('/giveFirstSemester/{id}',[App\Http\Controllers\ManagersController::class, 'giveFirstSemester']);
		Route::post('/giveSecondSemester/{id}',[App\Http\Controllers\ManagersController::class, 'giveSecondSemester']);

		Route::post('/deleteFirstSemester/{id}',[App\Http\Controllers\ManagersController::class, 'deleteFirstSemester']);
		Route::post('/deleteSecondSemester/{id}',[App\Http\Controllers\ManagersController::class, 'deleteSecondSemester']);
	});




	Route::group(['middleware' => ['Teacher']], function () {
		Route::get('/addCourseOfStudy',[App\Http\Controllers\TeachersController::class, 'addCourseOfStudyForm']);

		Route::post('/addCourseOfStudy',[App\Http\Controllers\TeachersController::class, 'addCourseOfStudy']);

		Route::post('/deleteCourseOfStudy/{id}',[App\Http\Controllers\TeachersController::class, 'deleteCourseOfStudy']);
	});
});

Auth::routes();
// ['register' => false,]