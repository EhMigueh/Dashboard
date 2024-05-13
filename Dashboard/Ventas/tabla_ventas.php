<?php
    function tablaVentas($conexion){
        $ventas = array();
        $query = "SELECT * FROM ventas";
        $ventas = mysqli_query($conexion, $query);
        return $ventas;
    }
?>