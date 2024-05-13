<?php
    function contarProductosPorPais($conexion){
        $query = "SELECT Pais, COUNT(*) as total_productos FROM ventas INNER JOIN clientes ON ventas.ID_Cliente = clientes.ID_Cliente GROUP BY Pais ORDER BY total_productos DESC";
        $result = mysqli_query($conexion, $query);
        $productos_por_pais = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $productos_por_pais[] = $row;
        }
        return $productos_por_pais;
    }
?>