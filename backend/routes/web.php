<?php

use App\Http\Controllers\Api\PartController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function () {
    echo "Olá Mundo !!!";
});

Route::get('/hello',function(){
    return view('hello_page',
        ["message"=>"Hello World!!"]
    );
});

Route::get('parts', [PartController::class, 'showPage']);


Route::controller(ProdutoController::class)->group(function(){
    Route::prefix('/produtos')->group(function () {
        Route::get('/','index')->name("produto.index");
        Route::get('/{produto}','show')->name("produto.show");
    });

    Route::prefix('/produto')->group(function () {
        Route::get('/','create')->name("produto.create");
        Route::post('/','store')->name("produto.store");
        Route::get('/{id}/edit','edit')->name("produto.edit");
        Route::put('/{id}/update','update')->name("produto.update");
    });
});

Route::resource('/fornecedores',FornecedorController::class)->parameters([
    "fornecedores"=>"fornecedor"
]);

Route::resource('/fabricante',FabricanteController::class);

Route::apiResource('/vendors',VendorController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
