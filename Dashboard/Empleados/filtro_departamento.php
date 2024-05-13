<?php
    function filtroDepartamento($conexion, $departamento){
        $departamentos = array();
        $query = "SELECT * FROM empleados WHERE Departamento = '$departamento'";
        $result = mysqli_query($conexion, $query);
        while ($row = mysqli_fetch_array($result)) {
            $departamentos[] = $row;
        }
        return $departamentos;
    }
?>