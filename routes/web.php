<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//User management all routes
Route::prefix('users')->group(function () {

    Route::get('/view', [UserController::class, 'viewUsers'])->name('users.view');

    Route::get('/add', [UserController::class, 'getAddUser'])->name('user.add');
    Route::post('/store', [UserController::class, 'storeUser'])->name('user.store');

    Route::get('/edit/{user}', [UserController::class, 'getEdit'])->name('user.edit');
    Route::post('/update/{user}', [UserController::class, 'updateUser'])->name('user.update');
    Route::get('/delete/{user}', [UserController::class, 'deleteUser'])->name('user.delete');
});

//User profile & change password

Route::prefix('profile')->group(function () {

    Route::get('/view/profile', [ProfileController::class,  'viewProfile'])->name('profile.view');
    Route::get('/edit/profile/{user}', [ProfileController::class,  'editProfile'])->name('profile.edit');
    Route::post('/update/profile/{user}', [ProfileController::class,  'updateProfile'])->name('profile.update');

    Route::get('/password/view', [ProfileController::class,  'viewPassword'])->name('password.view');
    Route::post('/password/update', [ProfileController::class,  'updatePassword'])->name('password.update');
});
