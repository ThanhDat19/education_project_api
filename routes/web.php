<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QuestionTypeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\YouTubeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
#Upload
Route::post('upload/services', [UploadController::class, 'store']);
#Home
#Course
Route::get('/admin/course/add', [CourseController::class, 'create']);
Route::post('/admin/course/add', [CourseController::class, 'store']);
Route::get('/admin/course/list', [CourseController::class, 'index']);
Route::get('/admin/course/edit/{course}', [CourseController::class, 'show']);
Route::post('/admin/course/edit/{course}', [CourseController::class, 'update']);
Route::delete('/admin/course/destroy', [CourseController::class, 'delete']);


#Course Category
Route::get('/admin/course-category/add', [CourseCategoryController::class, 'create']);
Route::post('/admin/course-category/add', [CourseCategoryController::class, 'store']);
Route::get('/admin/course-category/list', [CourseCategoryController::class, 'index']);
Route::get('/admin/course-category/edit/{category}', [CourseCategoryController::class, 'show']);
Route::post('/admin/course-category/edit/{category}', [CourseCategoryController::class, 'update']);
Route::delete('/admin/course-category/destroy', [CourseCategoryController::class, 'delete']);
#Lesson
Route::get('/admin/lesson/add/{course}', [LessonController::class, 'create']);
Route::post('/admin/lesson/add/{course}', [LessonController::class, 'store']);
Route::get('/admin/lesson/list/{course}', [LessonController::class, 'index'])->name('course.lesson');
Route::get('/admin/lesson/edit/{lesson}/{course}', [LessonController::class, 'show']);
Route::post('/admin/lesson/edit/{lesson}/{course}', [LessonController::class, 'update']);
Route::delete('/admin/lesson/destroy', [LessonController::class, 'delete']);
#Test
Route::get('/admin/tests/list', [TestController::class, 'index']);
Route::get('/admin/tests/edit/{test}', [TestController::class, 'show']);
Route::put('/admin/tests/edit/{test}', [TestController::class, 'update']);
Route::delete('/admin/tests/destroy', [TestController::class, 'delete']);
Route::post('/admin/tests/get-lesson-of-course', [TestController::class, 'getLessonOfCourse'])->name('get.lessons');
Route::get('/admin/tests/add', [TestController::class, 'create']);
Route::post('/admin/tests/add', [TestController::class, 'store']);

Route::get('/admin/tests/add-test-for-course/{course}', [TestController::class, 'createTestForCourse']);
Route::post('/admin/tests/add-test-for-course/{course}', [TestController::class, 'storeTestForCourse']);

Route::post('/admin/questions/filter-by-type', [QuestionController::class, 'filterByType'])->name('questions.filterByType');

#Question
Route::get('/admin/questions/add', [QuestionController::class, 'create']);
Route::post('/admin/questions/add', [QuestionController::class, 'store']);
Route::get('/admin/questions/list', [QuestionController::class, 'index']);
Route::get('/admin/questions/edit/{question}', [QuestionController::class, 'show']);
Route::put('/admin/questions/edit/{question}', [QuestionController::class, 'update']);
Route::delete('/admin/questions/destroy', [QuestionController::class, 'delete']);
#Option
Route::get('/admin/options/add/{question}', [OptionController::class, 'create']);
Route::post('/admin/options/add/{question}', [OptionController::class, 'store']);
Route::get('/admin/options/list/{question}', [OptionController::class, 'index'])->name('question.options');
Route::get('/admin/options/edit/{option}/{question}', [OptionController::class, 'show']);
Route::put('/admin/options/edit/{option}/{question}', [OptionController::class, 'update']);
Route::delete('/admin/options/destroy', [OptionController::class, 'delete']);
#Youtube
Route::get('/youtube-duration', [YouTubeController::class, 'getVideoDuration']);
#Question Types
Route::get('/admin/question-types/add', [QuestionTypeController::class, 'create']);
Route::post('/admin/question-types/add', [QuestionTypeController::class, 'store']);
Route::get('/admin/question-types/list', [QuestionTypeController::class, 'index']);
Route::get('/admin/question-types/edit/{type}', [QuestionTypeController::class, 'show']);
Route::put('/admin/question-types/edit/{type}', [QuestionTypeController::class, 'update']);
Route::delete('/admin/question-types/destroy', [QuestionTypeController::class, 'delete']);
#Pages
Route::get('/admin/pages/list', [PageController::class, 'homeList'])->name('pages.list');
Route::get('/admin/pages/home/edit/{home}', [PageController::class, 'homeShow']);
Route::put('/admin/pages/home/edit/{home}', [PageController::class, 'homeEdit']);
Route::get('/admin/pages/footer/edit/{footer}', [PageController::class, 'footerShow']);
Route::put('/admin/pages/footer/edit/{footer}', [PageController::class, 'footerEdit']);
Route::get('/admin/pages/information/edit/{information}', [PageController::class, 'informationShow']);
Route::put('/admin/pages/information/edit/{information}', [PageController::class, 'informationEdit']);
