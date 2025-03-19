<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Customer;
use App\Models\DetalleSale;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $Productos = Producto::get();
        return inertia('sale/index', ['Productos' => $Productos]);
    }

    public function store(Request $request)
    {
        //Sale= ['dcomuento_comprador', 'valor'];
        //DetalleSale = ['codigo_producto', 'valor', 'cantidad', 'id_sale'];
        //Customer = ['documento', 'nombre'];
        //  Validar los datos recibidos
        $validated = $request->validate([
            'comprador.documento' => 'required|string|max:20',
            'comprador.nombre' => 'required|string|max:255',
            'productos' => 'required|array|min:1',
            'productos.*.codigo' => 'required|string',
            'productos.*.valor' => 'required|numeric|min:1',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);


        //  Buscar o Crear el comprador
        $comprador = Customer::firstOrCreate(
            ['documento' => $validated['comprador']['documento']],
            ['nombre' => $validated['comprador']['nombre']]
        );

        //  Crear la compra
        $compra = new Sale();

        $compra->documento_comprador = $comprador->documento;
        $compra->valor = 0;

        $compra->save();

        $totalCompra = 0;

        //  Guardar cada producto en la tabla `sales`
        foreach ($validated['productos'] as $producto) {
            $subtotal = $producto['cantidad'] * $producto['valor']; // Cantidad * Precio
            $totalCompra += $subtotal;
            DetalleSale::create([
                'codigo_producto' => $producto['codigo'],
                'valor' => $producto['valor'],
                'cantidad' => $producto['cantidad'],
                'id_sale' => $compra->id
            ]);
        }

        //  Actualizar el total de la compra
        $compra->update(['valor' => $totalCompra]);

        return response()->json([
            'message' => 'Compra registrada correctamente',
            'redirect' => route('sale.show',[$compra ->id])
        ]);
    }
    public function show($id)
    {
        dd(123);
    }
}
