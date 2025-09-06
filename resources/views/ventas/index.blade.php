@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Registro de Ventas</h1>

    <a href="{{ route('ventas.create') }}" class="btn btn-success mb-3">➕ Registrar Venta</a>
    <a href="{{ url('/menus') }}" class="btn btn-secondary mb-3">⬅️ Menú</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->cantidad_vendida }}</td>
                    <td>${{ number_format($venta->precio_unitario, 2) }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->fecha }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No hay ventas registradas</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
