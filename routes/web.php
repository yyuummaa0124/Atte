<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampController;
use App\Http\Controllers\AttendanceManagementController;

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
Route::group(['middleware' => 'auth'],function() {
    Route::get('/', [StampController::class,"index"])->name('posts.index');
    Route::post('/startwork/{id}', [StampController::class,"startwork"])->name('posts.startwork');
    Route::post('/endwork', [StampController::class,"endwork"])->name('posts.endwork');
    Route::post('/startrest', [StampController::class,"startrest"])->name('posts.startrest');
    Route::post('/endrest', [StampController::class,"endrest"])->name('posts.endrest');
    Route::get('/getAttendanceInfo', [AttendanceManagementController::class,"getAttendanceInfo"])->name('posts.getAttendanceInfo');
    Route::get('/getNextDate/{dates}', [AttendanceManagementController::class,"getNextDate"])->name('posts.getNextDate');
    Route::get('/getBeforeDate/{dates}', [AttendanceManagementController::class,"getBeforeDate"])->name('posts.getBeforeDate');
    Route::get("/getUserList" ,[StampController::Class, "getUserList"])->name('posts.getUserList');
    Route::get('/getUserDate/{id}', [StampController::class, 'getUserDate'])->name('posts.getUserDate');
    Route::get('/getNextMonth/{dates}/{id}', [StampController::class, 'getNextMonth'])->name('posts.getNextMonth');
    Route::get('/getBeforeMonth/{dates}/{id}', [StampController::class, 'getBeforeMonth'])->name('posts.getBeforeMonth');
});



require __DIR__.'/auth.php';
