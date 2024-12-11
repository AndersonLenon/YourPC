<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $table = 'parts'; // Nome da tabela no banco de dados
    protected $fillable = ['name', 'description', 'price']; // Campos permitidos para preenchimento
}

