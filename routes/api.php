<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseStudentController;
use App\Http\Controllers\API\FooterController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\API\CoursesController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('user-login', 'getUser');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
})->middleware('auth:api');


Route::controller(TodoController::class)->group(function () {
    Route::get('todos', 'index');
    Route::post('todo', 'store');
    Route::get('todo/{id}', 'show');
    Route::put('todo/{id}', 'update');
    Route::delete('todo/{id}', 'destroy');
});

//Chart Route
Route::get('/chart-data', [ChartController::class, 'onAllSelect']);
//Client Route
Route::get('/client-review', [ClientReviewController::class, 'onAllSelect']);
//Contact Form Route
Route::post('/contact-send', [ContactController::class, 'onContactSend']);
//Course Route
Route::get('/course-home', [CoursesController::class, 'onSelectFour']);
Route::get('/course-all', [CoursesController::class, 'onSelectAll']);
Route::post('/course-details/{id}', [CoursesController::class, 'onSelectDetails']);
//Footer Route
Route::get('/footer-data', [FooterController::class, 'onSelectAll']);
//Information Route
Route::get('/information', [InformationController::class, 'onSelectAll']);
//Services Route
Route::get('/services', [ServiceController::class, 'ServiceView']);
//Project Route
Route::get('/project-home', [ProjectController::class, 'onSelectThree']);
Route::get('/project-all', [ProjectController::class, 'onSelectAll']);
Route::post('/project-details', [ProjectController::class, 'onSelectDetails']);
//Home Route
Route::get('/home/title', [HomePageController::class, 'onSelectTitle']);
Route::get('/home/video', [HomePageController::class, 'onSelectVideo']);
Route::get('/home/total', [HomePageController::class, 'onSelectTotal']);
Route::get('/home/technical', [HomePageController::class, 'onSelectTech']);
//Lesson Route
Route::get('/course-details/{id}/learn', [LessonController::class, 'getListLessonOfCourse']);

//Test Route
Route::get('/tests/{lesson}', [TestController::class, 'getTest']);
Route::post('/tests/{lesson}/{user}', [TestController::class, 'takeTest']);
//Payment Route
Route::post('/create-payment', [PaymentController::class, 'createPayment']);

//Course Student Route
// Route::post('/get-relation-course-user', [CourseStudentController::class, 'getRelation']);

//Course Teacher Route
Route::get('/get-course-teacher', [CoursesController::class, 'teacherGetCourse']);
Route::post('/post-course-teacher', [CoursesController::class, 'teacherPostCourse']);
Route::delete('/delete-course-teacher/{course}', [CoursesController::class, 'teacherDeleteCourse']);
