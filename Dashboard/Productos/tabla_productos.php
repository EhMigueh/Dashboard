<?php
    function tablaProductos($conexion){
        $productos = array();
        $query = "SELECT * FROM productos";
        $productos = mysqli_query($conexion, $query);
        return $productos;
    }
?>