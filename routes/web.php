<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\LogViewerController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return to_route('panel');
//    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', [PanelController::class, 'index'])->name('panel');

    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);

    Route::get('create_user_role/{id}', [UserController::class, 'createUserRole'])->name('create_user_roles');
    Route::post('create_user_role/{id}', [UserController::class, 'storeUserRole'])->name('store_user_roles');

    Route::get('logs', [LogViewerController::class, 'index'])->name('logs');

    Route::resource('category', CategoryController::class);

    Route::resource('sliders', SliderController::class);

    Route::resource('brands', BrandController::class);

    Route::resource('colors', ColorController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
