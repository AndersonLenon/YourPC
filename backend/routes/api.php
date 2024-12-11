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


// // Only é após registro de todas as rotas COM  middleware
// Route::apiResource('/produtos',ProdutoController::class)->middleware('auth:sanctum');
// Route::apiResource('/produtos',ProdutoController::class)->only(['index','show']);


// //Except é após o registro de todas as rotas SEM middleware
// Route::apiResource('/users',UserController::class);
// Route::apiResource('/users',UserController::class)
//     ->middleware('auth:sanctum') //post, put, delete com middleware
//     ->except(['index','show']); // não cria as rotas de index e show

//Agrupando por middleware sanctum todas as rotas de produtos e usuários
Route::apiResource('parts', PartController::class)->only(['index', 'show']);
Route::apiResource('builds', BuildController::class)->only(['index', 'show', 'store', 'update']);

// Rotas protegidas (requer autenticação)
Route::middleware('auth:sanctum')->group(function () {
   Route::apiResource('users', UserController::class);
   Route::apiResource('builds', BuildController::class)->only(['destroy']); // Exclusão de builds salva requer login
   Route::apiResource('favorites', FavoriteController::class);
});



require __DIR__.'/queries.php';
