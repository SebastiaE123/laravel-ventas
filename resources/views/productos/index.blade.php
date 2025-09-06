@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestión de Productos</h1>

    <a href="{{ route('productos.create') }}" class="btn btn-success mb-3">➕ Registrar Producto</a>
    <a href="{{ url('/menus') }}" class="btn btn-secondary mb-3">⬅️ Menú</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->codigo) }}" class="btn btn-primary btn-sm">✏️ Editar</a>
                        <form action="{{ route('productos.destroy', $producto->codigo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No hay productos registrados</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
