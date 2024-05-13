<?php
    function tablaClientes($conexion){
        $clientes = array();
        $query = "SELECT * FROM clientes";
        $clientes = mysqli_query($conexion, $query);
        return $clientes;
    }
?>