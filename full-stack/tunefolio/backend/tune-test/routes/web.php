<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;


// ✅ Auth Routes
Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/login', [AuthController::class, 'login']);

Route::get('/debug', function () {
    return response()->json(['error' => file_get_contents(storage_path('logs/laravel.log'))]);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/user', [AuthController::class, 'user']);
    Route::post('/api/logout', [AuthController::class, 'logout']);
    Route::delete('/api/auth/delete', [AuthController::class, 'deleteAccount']);


    // ✅ Album Routes
    Route::post('/api/albums', [AlbumController::class, 'store']);
    Route::get('/api/albums', [AlbumController::class, 'index']);
    Route::get('/api/albums/{id}', [AlbumController::class, 'show']);
    Route::put('/api/albums/{id}', [AlbumController::class, 'update']);
    Route::delete('/api/albums/{id}', [AlbumController::class, 'destroy']);

    // ✅ Song Routes
    Route::post('/api/songs', [SongController::class, 'store']);
    Route::get('/api/songs', [SongController::class, 'index']);
    Route::get('/api/songs/{id}', [SongController::class, 'show']);
    Route::put('/api/songs/{id}', [SongController::class, 'update']);
    Route::delete('/api/songs/{id}', [SongController::class, 'destroy']);
    // ✅ Get songs by album ID
    Route::get('/api/albums/{id}/songs', [SongController::class, 'getSongsByAlbum']);
});




Route::get('/', function () {
    return view('welcome');
});
