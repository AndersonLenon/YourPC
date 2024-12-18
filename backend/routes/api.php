<?php

use App\Http\Controllers\Api\BuildController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PartController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Agrupando por middleware sanctum todas as rotas de produtos e usuários
Route::apiResource('/parts', PartController::class)->only(['index', 'show', 'store']);
Route::apiResource('builds', BuildController::class)->only(['index', 'show']);
Route::apiResource('users', UserController::class);

// Rotas protegidas (requer autenticação)
Route::middleware('auth:sanctum')->group(function () {
   //Route::apiResource('users', UserController::class);
   Route::apiResource('builds', BuildController::class)->only(['destroy', 'store', 'update']); // Exclusão de builds salva requer login
   Route::apiResource('favorites', FavoriteController::class);
});



require __DIR__.'/queries.php';
