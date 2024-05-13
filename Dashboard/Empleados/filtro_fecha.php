<?php
    function filtroFecha($conexion, $fecha){
        //habra que hacer conversion de fecha?
        $empleados = array();
        $query = "SELECT * FROM empleados WHERE Fecha_Contratacion > '$fecha'";
        $result = mysqli_query($conexion, $query);
        while ($row = mysqli_fetch_array($result)) {
            $empleados[] = $row;
        }
        return $empleados;
    }
?>