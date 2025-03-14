<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
//Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
//Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('book.index', function () {
    return view('book.index');
});


Route::get('/', [BookController::class,'index']); // Display all books
Route::get('/create', [BookController::class, 'create']); // Show form to create a book
Route::post('/store', [BookController::class, 'store']); // Store the new book
Route::get('/edit/{id}', [BookController::class, 'edit']); // Show form to edit a book
Route::put('/update/{id}', [BookController::class, 'update']); // Update a book
Route::delete('/destroy/{id}', [BookController::class, 'destroy']); // Delete a book
  