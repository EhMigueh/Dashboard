<?php
    function contarPorPais($conexion, $pais){
        $clientes;
        $query = "SELECT count(ID_Cliente) as total FROM clientes WHERE Pais = '$pais'";
        $clientes = mysqli_query($conexion, $query);
        $clientes = mysqli_fetch_array($clientes);
        return $clientes['total'];
    }
?>