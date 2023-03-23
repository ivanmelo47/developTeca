<?php

/* Base datos en localhost */
$servidor = "localhost";
$baseDeDatos = "app";
$usuario = "root";
$contrasenia = "";

/* Base datos en sitio web */
/* $servidor = 'localhost';
$baseDeDatos = 'u248102699_empleados';
$usuario = 'u248102699_josueivan';
$contrasenia = 'Q4LKwgvLFQej6mg'; */

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
} catch (Exception $ex) { /* Captura errores en la conexion de la Bade de datos */
    echo $ex->getMessage(); /* Imprime en pantalla el error capturado */
}


?>