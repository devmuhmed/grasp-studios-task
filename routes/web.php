<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('layout');
});

Auth::routes();

Route::post('logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/task', App\Http\Controllers\TaskController::class);
    Route::post('/comment/{task}', [App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
});
