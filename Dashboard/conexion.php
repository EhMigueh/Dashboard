<?php
    function conectar(){
        $hostname='localhost';
        $username="admin";
        $password="";
        $database="bd_empresa";
        $conexion = mysqli_connect($hostname, $username, $password, $database);
        if (!$conexion) {
            die('Error de conexión: '.mysqli_connect_error());
        }
        return $conexion;
    }
?>