<?php
    function tablaEmpleados($conexion){
        $empleados = array();
        $query = "SELECT * FROM empleados";
        $empleados = mysqli_query($conexion, $query);
        return $empleados;
    }
?>