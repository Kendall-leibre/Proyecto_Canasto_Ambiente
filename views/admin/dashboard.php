
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<div class="topbar">
    <h2>Dashboard</h2>
    <p>Bienvenido al sistema de administración</p>
</div>

<div class="cards">

    <div class="card">
        <h3>Pedidos del día</h3>
        <p><?= $totalPedidos ?? 0 ?></p>
    </div>

    <div class="card">
        <h3>Ventas del día</h3>
        <p>₡<?= $totalVentas ?? 0 ?></p>
    </div>

    <div class="card">
        <h3>Usuarios activos</h3>
        <p><?= $totalUsuarios ?? 0 ?></p>
    </div>

    <div class="card">
        <h3>Productos disponibles</h3>
        <p><?= $totalProductos ?? 0 ?></p>
    </div>

</div>

<div class="contenido">

    <div class="titulo-seccion">
        Resumen del sistema
    </div>

    <p>
        Diay queeeeee
    </p>

</div>


</head>
<body>
    
</body>
</html>