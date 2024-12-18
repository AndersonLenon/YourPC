<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'name', 'image_path', 'description', 'price', 'purchase_link', 'category',
        'brand', 'stock', 'rating', 'release_date', 'specs'
    ];

    // Adicione o tipo de dados 'specs' como JSON
    protected $casts = [
        'specs' => 'array',
        'release_date' => 'date',
    ];
}
