<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/books/{id}', [BooksController::class, 'show']);
Route::get('/books', [BooksController::class, 'index']);
Route::post('/books', [BooksController::class, 'store']);
Route::patch('/books/{id}', [BooksController::class, 'update']);
Route::delete('books/{id}', [BooksController::class, 'delete']);
    
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/rents/{id}', [RentController::class, 'show']);
Route::get('/rents', [RentController::class, 'index']);
Route::post('/rents', [RentController::class, 'store']);
Route::patch('/rents/{id}', [RentController::class, 'update']);
Route::delete('/rents/{id}', [RentController::class, 'delete']);