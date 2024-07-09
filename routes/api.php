<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthorController::class, 'login']);
    Route::post('logout', [AuthorController::class, 'logout']);
    Route::post('refresh', [AuthorController::class, 'refresh']);
});

Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);
