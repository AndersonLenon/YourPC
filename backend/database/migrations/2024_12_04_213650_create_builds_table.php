<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('builds', function (Blueprint $table) {
            $table->id(); // ID único da montagem
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relaciona ao usuário
            $table->string('name'); // Nome da montagem
            $table->text('description')->nullable(); // Descrição opcional
            $table->timestamps(); // Created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('builds');
    }
};
