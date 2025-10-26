<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::get('/', [ProductsController::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/products/trashed', [ProductsController::class, 'trashed'])->name('products.trashed');
    Route::resource('products', ProductsController::class);
    Route::get('/categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::resource('categories', CategoryController::class);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/products/{id}/restore', [ProductsController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{id}/force-delete', [ProductsController::class, 'forceDelete'])->name('products.forceDelete');
    Route::post('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
});



require __DIR__.'/auth.php';
