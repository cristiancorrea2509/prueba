<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Habilita la asignación masiva para estos campos
    protected $fillable = ['nombre', 'codigo', 'valor'];
}
