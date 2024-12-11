<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id(); // ID único para cada favorito
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relaciona ao usuário
            $table->foreignId('part_id')->constrained()->onDelete('cascade'); // Relaciona à peça favorita
            $table->timestamps(); // Created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
