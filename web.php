<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrmController;

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
    return view('login');
});

// Route::get('/admin', function () {
//     return view('admin.index');
// });

// Route::get('/admin/create', function () {
//     return view('admin.create');
// });

Route::get('/admin/edit', function () {
    return view('admin.edit');
});


Route::get('/account', function () {
    return view('account.index');
});


Route::get('/account/create', function () {
    return view('account.create');
});

Route::get('/admin', [CrmController::class, 'index'])->name('admin.index');
Route::get('/admin/create', [CrmController::class, 'create']);
Route::post('/admin', [CrmController::class, 'store'])->name('admin.index.store');
// Route::get('/admin/edit', [CrmController::class, 'edit']);


