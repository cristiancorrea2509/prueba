<?php

namespace App\Http\Controllers;

use App\Models\DetalleSale;
use App\Models\Sale;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
    
        $topCompradores = Sale::selectRaw('documento_comprador, COUNT(*) as total_compras')
        ->groupBy('documento_comprador')
        ->orderByDesc('total_compras') // Ordena de mayor a menor
        ->limit(5) // Obtener solo los 5 primeros
        ->get();
        $articuloMasVendido = DetalleSale::selectRaw('codigo_producto, SUM(cantidad) as total_vendido')
        ->groupBy('codigo_producto')
        ->orderByDesc('total_vendido') // Ordenar de mayor a menor
        ->limit(5) // Obtener solo los 5 primeros
        ->get();
        return inertia('top/index', ['topCompradores' => $topCompradores,'articuloMasVendido'=>$articuloMasVendido]);

    }
}
