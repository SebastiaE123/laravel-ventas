<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')->orderBy('fecha', 'desc')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,codigo',
            'cantidad_vendida' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->cantidad < $request->cantidad_vendida) {
            return redirect()->back()->with('error', 'Stock insuficiente para realizar la venta');
        }

        $venta = Venta::create([
            'producto_id' => $producto->codigo,
            'cantidad_vendida' => $request->cantidad_vendida,
            'precio_unitario' => $producto->precio,
            'total' => $producto->precio * $request->cantidad_vendida,
            'fecha' => now(),
        ]);

        // Descontar stock
        $producto->update([
            'cantidad' => $producto->cantidad - $request->cantidad_vendida
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito');
    }
}
