<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('books', BookController::class)->names('books');
Route::resource('authors', AuthorController::class)->names('authors');