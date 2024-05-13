<?php
    function ventasDespuesDeCovid($conexion){
        $fecha_limite = '2020-01-01';
        $query = "SELECT * FROM ventas WHERE Fecha > '$fecha_limite'";
        $result = mysqli_query($conexion, $query);
        $ventas_despues_covid = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $ventas_despues_covid[] = $row;
        }
        return $ventas_despues_covid;
    }
?>