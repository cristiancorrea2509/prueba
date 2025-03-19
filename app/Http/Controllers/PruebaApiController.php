<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PruebaApiController extends Controller
{
    public function index()
    {
        return view('api.index');
    }
    public function listado(Request $request)
    {
        //$productos=Producto::where('nombre', 'LIKE', "%".$request->busqueda."%")->first();
        $nombre=$request->busqueda;
        $url = "http://localhost/prueba_practica/public/api/productos"; // API de ejemplo

        // Hacer la petición GET
        $response = Http::get($url);

        // Convertir la respuesta a JSON
        $data = $response->json();
        //dd($data);
        return view('api.listado',compact('data','nombre'));
    }
}
