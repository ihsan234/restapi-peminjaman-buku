<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/peminjaman', [BukuController::class, 'index']);
Route::post('/peminjaman', [BukuController::class, 'store']);
Route::get('/peminjaman/{id}', [BukuController::class, 'show']);
Route::put('/peminjaman/update/{id}', [BukuController::class, 'update']);
Route::delete('/peminjaman/delete/{id}', [BukuController::class, 'destroy']);
