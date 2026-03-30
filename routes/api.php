<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MangaController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/mangas', [MangaController::class, 'index']);
Route::get('/mangas/{manga}', [MangaController::class, 'show']);