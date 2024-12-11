<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da peça
            $table->string('image_path')->nullable(); // Caminho da imagem
            $table->text('description'); // Descrição da peça
            $table->decimal('price', 10, 2); // Preço (ex.: 9999.99)
            $table->string('purchase_link'); // Link para compra
            $table->string('category'); // Categoria (ex.: Processador, GPU)
            $table->string('brand'); // Marca (ex.: Intel, AMD)
            $table->integer('stock')->nullable(); // Estoque disponível
            $table->decimal('rating', 2, 1)->nullable(); // Avaliação média (ex.: 4.5)
            $table->date('release_date')->nullable(); // Data de lançamento
            $table->json('specs')->nullable(); // Especificações técnicas
            $table->timestamps(); // Created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
