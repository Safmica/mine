<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckSession;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return view('home');
})->name('home')->middleware(CheckSession::class);;

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/signup', [UserController::class, 'signup'])->name('signup.post');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/index', [CourseController::class, 'index'], function () {
        return view('index');})->name('index');
    Route::get('/meeting', [MeetingController::class, 'index'], function () {
        return view('meeting');})->name('meeting');
    Route::get('/courses/{course}/meetings', [MeetingController::class, 'indexByCourse'])->name('meetings.indexByCourse');
    Route::post('/courses/{course}/meetings', [MeetingController::class, 'store'])->name('courses.meetings.store');
    Route::get('/courses/{course}/meetings/{meeting}/files', [FileController::class, 'indexByMeeting'])->name('files.indexByMeeting');
    Route::post('/files', [FileController::class, 'store'])->name('courses.meetings.files.store');
    Route::resource('courses', CourseController::class);
});