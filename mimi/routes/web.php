<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class,'index']); // Display all books
Route::get('/create', [BookController::class, 'create']); // Show form to create a book
Route::post('/store', [BookController::class, 'store']); // Store the new book
