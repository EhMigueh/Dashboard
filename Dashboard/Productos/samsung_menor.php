<?php
    function samsungMenor($conexion, $marca, $precio){
        $productos = array();
        $query = "SELECT * FROM productos WHERE marca = '$marca' AND precio_compra < $precio";
        $result = mysqli_query($conexion, $query);
        while ($row = mysqli_fetch_array($result)) {
            $productos[] = $row;
        }
        return $productos;
    }
?>