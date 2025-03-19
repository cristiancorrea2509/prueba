<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSale extends Model
{
    use HasFactory;

   
    protected $fillable = ['codigo_producto', 'valor', 'cantidad', 'id_sale'];
}
