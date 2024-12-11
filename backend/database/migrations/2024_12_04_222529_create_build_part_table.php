<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('build_part', function (Blueprint $table) {
            $table->id(); // ID único da relação
            $table->foreignId('build_id')->constrained()->onDelete('cascade'); // Relaciona à montagem
            $table->foreignId('part_id')->constrained()->onDelete('cascade'); // Relaciona à peça
            $table->integer('quantity')->default(1); // Quantidade de peças
            $table->timestamps(); // Created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('build_part');
    }
};
