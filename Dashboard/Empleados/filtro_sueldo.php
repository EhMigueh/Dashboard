<?php
    function filtroSueldo($conexion, $sueldo){
        //habra que hacer conversion de fecha?
        $empleados = array();
        $query = "SELECT * FROM empleados WHERE Sueldo > '$sueldo'";
        $result = mysqli_query($conexion, $query);
        while ($row = mysqli_fetch_array($result)) {
            $empleados[] = $row;
        }
        return $empleados;
    }
?>