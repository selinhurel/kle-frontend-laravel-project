<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

// Route::get('/', [ProductController::class, 'index'])->name('home');


// User routes
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('login.post');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerPost'])->name('registration.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

   

    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    
    Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
 
        Route::get('/products/update/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');

    
    Route::delete('/products/{id}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');

