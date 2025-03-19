<?php

namespace App\Http\Controllers;

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
        $url = 'http://127.0.0.1:8000/api/productos'; // API de ejemplo

        // Hacer la petición GET
        $response = Http::get($url);

        // Convertir la respuesta a JSON
        $data = $response->json();
        dd(data);
        return view('api.listado');
    }
}
