<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // 🔹 Habilitar asignación masiva
    protected $fillable = ['documento', 'nombre'];
}
