<?php
    include('conexion.php');
    include('Clientes/tabla_clientes.php');
    include('Clientes/contar_por_pais.php');
    include('Clientes/pais_producto.php');
    include('Empleados/tabla_empleados.php');
    include('Ventas/tabla_ventas.php');
    include('Ventas/venta_covid.php');
    include('Productos/tabla_productos.php');
    include('Productos/samsung_menor.php');
    $pais = "";
    $marca = "";
    $precio = 0;
    $conexion = conectar();
    $clientes = tablaClientes($conexion);
    $empleados = tablaEmpleados($conexion);
    $ventas = tablaVentas($conexion);
    $productos = tablaProductos($conexion);
    if(isset($_GET['enviar'])){
        $pais = $_GET['pais'];
        $result = contarPorPais($conexion, $pais);
    }
    $productos_por_pais = contarProductosPorPais($conexion);
    $result2 = array();
    if(isset($_GET['enviar2'])){
        $marca = $_GET['marca'];
        $precio = $_GET['precio'];
        $result2 = samsungMenor($conexion, $marca, $precio);
    }
    $ventas_covid = ventasDespuesDeCovid($conexion);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>

    <body>
        <!-- Relacionado con Usuarios -->
        <form action="index.php" metod="GET">
            <h1>Cantidad de Clientes</h1>
            <input type="text" name="pais" id="pais"/>
            <button type="submit" name="enviar" id="enviar">Buscar</button>
        </form>
        <h2> <?php echo "Cantidad de clientes que viven en $pais: " . $result; ?> </h2>

        <br>

        <h1>Cantidad de Productos Vendidos por País</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>País</th>
                    <th>Cantidad de Productos Vendidos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos_por_pais as $pais_producto) : ?>
                    <tr>
                        <td><?php echo $pais_producto['Pais']; ?></td>
                        <td><?php echo $pais_producto['total_productos']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Fin Relacionado con Usuarios -->

        <br>

        <!-- Relacionado con Productos -->
        <form action="index.php" method="GET">
        <h1>Filtrar por Nombre y Precio</h1>
        <input type="text" name="marca" id="marca" placeholder="Marca (ej. Samsung)" required>
        <input type="text" name="precio" id="precio" placeholder="Precio máximo (ej. 300000.00)" required>
        <button type="submit" name="enviar2" id="enviar2">Buscar</button>
        </form>
        <?php if (!empty($result2)) : ?>
            <h2>Productos de la marca <?php echo $marca; ?> con precio menor a $<?php echo $precio; ?>:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result2 as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['ID_Producto']; ?></td>
                            <td><?php echo $producto['Nombre']; ?></td>
                            <td><?php echo $producto['Marca']; ?></td>
                            <td><?php echo $producto['Modelo']; ?></td>
                            <td><?php echo $producto['Precio_compra']; ?></td>
                            <td><?php echo $producto['Precio_venta']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <!-- Fin Relacionado con Productos -->

        <!-- Relacionado con Ventas -->
        <h1>Ventas Realizadas a partir del Covid</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>ID Cliente</th>
                    <th>ID Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas_covid as $venta) : ?>
                    <tr>
                        <td><?php echo $venta['ID_ventas']; ?></td>
                        <td><?php echo $venta['Fecha']; ?></td>
                        <td><?php echo $venta['ID_Cliente']; ?></td>
                        <td><?php echo $venta['ID_Producto']; ?></td>
                        <td><?php echo $venta['Cantidad']; ?></td>
                        <td><?php echo $venta['Precio_Unitario']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Fin Relacionado con Ventas -->

        <br>

        <!-- Tabla General Clientes -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>País</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($cliente = mysqli_fetch_array($clientes)) {
                ?>
                <tr>
                    <td><?php echo $cliente['ID_Cliente']; ?></td>
                    <td><?php echo $cliente['Nombre']; ?></td>
                    <td><?php echo $cliente['Apellido']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $cliente['Direccion']; ?></td>
                    <td><?php echo $cliente['Ciudad']; ?></td>
                    <td><?php echo $cliente['Pais']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <!-- Fin Tabla General Clientes -->

        <!-- Tabla General Empleados -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha Contratación</th>
                    <th>Departamento</th>
                    <th>Sueldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($empleado = mysqli_fetch_array($empleados)) {
                ?>
                <tr>
                    <td><?php echo $empleado['ID_Empleado']; ?></td>
                    <td><?php echo $empleado['Nombre']; ?></td>
                    <td><?php echo $empleado['Apellido']; ?></td>
                    <td><?php echo $empleado['Fecha_Contratacion']; ?></td>
                    <td><?php echo $empleado['Departamento']; ?></td>
                    <td><?php echo $empleado['Sueldo']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <!-- Fin Tabla General Empleados -->

        <!-- Tabla General Ventas -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>ID Cliente</th>
                    <th>ID Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($venta = mysqli_fetch_array($ventas)) {
                ?>
                <tr>
                    <td><?php echo $venta['ID_ventas']; ?></td>
                    <td><?php echo $venta['Fecha']; ?></td>
                    <td><?php echo $venta['ID_Cliente']; ?></td>
                    <td><?php echo $venta['ID_Producto']; ?></td>
                    <td><?php echo $venta['Cantidad']; ?></td>
                    <td><?php echo $venta['Precio_Unitario']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <!-- Fin Tabla General Ventas -->

        <!-- Tabla General Productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($producto = mysqli_fetch_array($productos)) {
                ?>
                <tr>
                    <td><?php echo $producto['ID_Producto']; ?></td>
                    <td><?php echo $producto['Nombre']; ?></td>
                    <td><?php echo $producto['Marca']; ?></td>
                    <td><?php echo $producto['Modelo']; ?></td>
                    <td><?php echo $producto['Precio_compra']; ?></td>
                    <td><?php echo $producto['Precio_venta']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <!-- Fin Tabla General Productos -->
    </body>
</html>