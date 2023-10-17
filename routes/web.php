<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectSearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('/admin/login', function () {
    return view('login');
});


// プロジェクト一覧〜登録
Route::get('/admin', [ProjectController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/admin/create', [ProjectController::class, 'create'])->middleware('auth');
Route::post('/admin', [ProjectController::class, 'store'])->name('admin.index.store')->middleware('auth');
Route::get('/admin/edit/{project}', [ProjectController::class, 'edit'])->name('admin.edit')->middleware('auth');
Route::get('/admin/detail/{project}', [ProjectController::class, 'show'])->name('admin.detail')->middleware('auth');
Route::put('/admin/{project}', [ProjectController::class, 'update'])->name('admin.update')->middleware('auth');
Route::delete('/admin/{project}', [ProjectController::class, 'destroy'])->name('admin.destroy')->middleware('auth');

// プロジェクト検索
Route::get('/admin/search', [ProjectSearchController::class, 'index'])->name('admin.search');

// ユーザー管理
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.index.store');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::get('/user/{user}', [UserController::class, 'update'])->name('user.update');

// 認証
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// パスワードを忘れた場合
Route::get('/user/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.changePasswordForm');
Route::post('/user/change-password', 'UserController@changePassword')->name('user.changePassword');

