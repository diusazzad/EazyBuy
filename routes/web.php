<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/'], function () {
    Route::get('/', [PageController::class, 'welcome'])->name('home.index');
    Route::get('/demo', [PageController::class, 'demo'])->name('home.demo');
    Route::get('/feature', [PageController::class, 'feature'])->name('home.feature');
    Route::get('/element', [PageController::class, 'element'])->name('home.element');
    Route::get('/support', [PageController::class, 'support'])->name('home.support');
});

Route::resource('/product', ProductController::class);
Route::resource('/category', CategoryController::class);

Route::resource('/shop', ShopController::class);
Route::resource('/other', OtherController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
