@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Venta</h1>

    <!-- Mostrar error desde backend si viene -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('ventas.store') }}" id="ventaForm">
        @csrf

        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select id="producto_id" name="producto_id" class="form-select" required>
                <option value="">-- Selecciona un producto --</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->codigo }}" data-stock="{{ $producto->cantidad }}">
                        {{ $producto->nombre }} (Stock: {{ $producto->cantidad }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_vendida" class="form-label">Cantidad Vendida</label>
            <input type="number" class="form-control" id="cantidad_vendida" name="cantidad_vendida" min="1" required>
            <div id="stockAlert" class="text-danger mt-2" style="display:none;">
                ⚠️ La cantidad supera el stock disponible.
            </div>
        </div>

        <button type="submit" class="btn btn-success">💾 Guardar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">⬅️ Atrás</a>
    </form>
</div>

<script>
    const productoSelect = document.getElementById('producto_id');
    const cantidadInput = document.getElementById('cantidad_vendida');
    const stockAlert = document.getElementById('stockAlert');
    const form = document.getElementById('ventaForm');

    function validarStock() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const stock = selectedOption.getAttribute('data-stock');
        const cantidad = parseInt(cantidadInput.value);

        if (stock !== null && cantidad > parseInt(stock)) {
            stockAlert.style.display = 'block';
            return false;
        } else {
            stockAlert.style.display = 'none';
            return true;
        }
    }

    cantidadInput.addEventListener('input', validarStock);
    productoSelect.addEventListener('change', validarStock);

    form.addEventListener('submit', function(event) {
        if (!validarStock()) {
            event.preventDefault(); // Evita enviar el formulario
            alert('⚠️ No puedes vender más de lo disponible en stock.');
        }
    });
</script>
@endsection
