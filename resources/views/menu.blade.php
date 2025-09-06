<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="container text-center">
        <h1 class="mb-4 text-primary">Gestión de Inventario</h1>

        <div class="d-flex flex-column gap-3">
            <a href="{{ route('productos.index') }}" class="btn btn-lg btn-outline-primary">
                Gestionar Productos
            </a>
            <a href="{{ route('ventas.index') }}" class="btn btn-lg btn-outline-success">
                Gestionar Ventas
            </a>
        </div>
    </div>

</body>
</html>