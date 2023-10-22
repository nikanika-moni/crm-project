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

Route::get('/crm/login', function () {
    return view('login');
});

// プロジェクト一覧〜登録
Route::get('/crm', [ProjectController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/crm/create', [ProjectController::class, 'create'])->middleware('auth');
Route::post('/crm', [ProjectController::class, 'store'])->name('admin.index.store')->middleware('auth');
Route::get('/crm/edit/{project}', [ProjectController::class, 'edit'])->name('admin.edit')->middleware('auth');
Route::get('/crm/detail/{project}', [ProjectController::class, 'show'])->name('admin.detail')->middleware('auth');
Route::put('/crm/{project}', [ProjectController::class, 'update'])->name('admin.update')->middleware('auth');
Route::delete('/crm/{project}', [ProjectController::class, 'destroy'])->name('admin.destroy')->middleware('auth');

// プロジェクト検索
Route::get('/crm/search', [ProjectSearchController::class, 'index'])->name('admin.search');

// ユーザー管理
Route::get('/crm/user', [UserController::class, 'index'])->name('user.index');
Route::get('/crm/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/crm/user', [UserController::class, 'store'])->name('user.index.store');
Route::get('/crm/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::get('/crm/user/{user}', [UserController::class, 'update'])->name('user.update');

// 認証
Route::get('/crm/login', [AuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
Route::post('/crm/login', [AuthController::class, 'login']);
Route::post('/crm/logout', [AuthController::class, 'logout'])->name('admin.logout');

// パスワードを忘れた場合
// Route::get('/crm/user/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.changePasswordForm');
// Route::post('/crm/user/change-password', 'UserController@changePassword')->name('user.changePassword');


