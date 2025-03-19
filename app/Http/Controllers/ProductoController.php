<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    
    const NUMEROS_FILAS_PAGINA = 5;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Productos = Producto::paginate(self::NUMEROS_FILAS_PAGINA);
        return inertia('sale/index', ['Productos' => $Productos]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd(123);
        return inertia('productos/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|unique:productos,codigo',
            'valor' => 'required|numeric',
            'cantidad' => 'required|numeric',
        ]);
        
        $producto = new Producto();
        $producto->nombre = $request->nombre; // Corrección del campo
        $producto->codigo = $request->codigo; // Se asigna correctamente
        $producto->valor = $request->valor; // Se asigna correctamente
        $producto->cantidad = $request->cantidad; // Se asigna correctamente
        
        $producto->save();

        return response()->json([
            'message' => 'Producto Modificado exitosamente',
            'redirect' => route('productos.index')
        ]);

        //return redirect()->route('bus.index');
        //dd(123456);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Producto_id=Producto::where('id',$id)->first();
        return inertia('productos/edit',['Producto_id' => $Producto_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);

        // Validación (permite que el código no cambie sin error)
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|unique:productos,codigo,' . $producto->id,
            'valor' => 'required|numeric',
            'cantidad' => 'required|numeric',
        ]);

        // Actualizar los datos
        $producto->nombre = $request->nombre; // Corrección del campo
        $producto->codigo = $request->codigo; // Se asigna correctamente
        $producto->valor = $request->valor; // Se asigna correctamente
        $producto->cantidad = $request->cantidad; // Se asigna correctamente
        
        $producto->save();

        // Respuesta exitosa con redirección
        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'redirect' => route('productos.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Producto = Producto::find($id);

        $Producto->delete();

        return redirect()->route('productos.index');
    }
}


