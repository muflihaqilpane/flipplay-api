<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('media', MediaController::class);

Route::get('/users/{id}/collection', [UserController::class, 'showCollection']);
Route::post('/users/{id}/collection', [UserController::class, 'addToCollection']);
Route::delete('/users/{id}/collection/{mediaId}', [UserController::class, 'removeFromCollection']);
