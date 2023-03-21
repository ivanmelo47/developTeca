<?php

/* Base datos en localhost */
$servidor = "localhost";
$baseDeDatos = "app";
$usuario = "root";
$contrasenia = "";

/* Base datos en sitio web */
/* $servidor = 'db5012381931.hosting-data.io';
$baseDeDatos = 'dbs10412547';
$usuario = 'dbu5393113';
$contrasenia = '140735@Abcd'; */

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
} catch (Exception $ex) { /* Captura errores en la conexion de la Bade de datos */
    echo $ex->getMessage(); /* Imprime en pantalla el error capturado */
}


?>