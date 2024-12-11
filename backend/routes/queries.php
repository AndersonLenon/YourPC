<?php

use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\ProdutoCollection;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;

Route::prefix('filters')->group(function () {
    Route::prefix('produtos')->group(function () {
        Route::get('regiao/{nome}', function ($nome) {
            return new ProdutoCollection(
                Produto::whereHas(
                    'fornecedor',
                    fn($q) => $q->whereHas(
                        'estado',
                        fn($q) => $q->whereHas(
                            'regiao',
                            fn($q) => $q->where('nome', 'like', $nome)
                        )
                    )
                )
                ->get()
                ->load('fornecedor.estado.regiao')
            );
        });

        Route::get('importados', function () {
            return new ProdutoCollection(
                Produto::where('importado', true)
                ->get()
                ->load('fornecedor')
            );
        });

    });

    Route::prefix('fornecedores')->group(function () {
        Route::get('regiao/{nome}', [FornecedorController::class, 'porRegiao']);
    });
});
