<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckSession;
use App\Http\Controllers\CourseController;


Route::get('/', function () {
    return view('home');
})->name('home')->middleware(CheckSession::class);;

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::middleware('auth')->group(function () {
    Route::get('/index', [CourseController::class, 'index'], function () {
        return view('index');})->name('index');
    Route::resource('courses', CourseController::class);
});


Route::post('/signup', [UserController::class, 'signup'])->name('signup.post');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');