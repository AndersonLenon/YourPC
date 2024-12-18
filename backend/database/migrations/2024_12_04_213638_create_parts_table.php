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
            $table->string('name');
            $table->string('image_path')->nullable(); 
            $table->text('description'); 
            $table->decimal('price', 10, 2); 
            $table->string('purchase_link'); 
            $table->string('category'); 
            $table->string('brand'); 
            $table->integer('stock')->nullable(); 
            $table->decimal('rating', 2, 1)->nullable(); 
            $table->date('release_date')->nullable();
            $table->json('specs')->nullable();
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
