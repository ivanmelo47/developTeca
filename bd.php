<?php

$servidor = "localhost";
$baseDeDatos = "app";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
} catch (Exception $ex) { /* Captura errores en la conexion de la Bade de datos */
    echo $ex->getMessage(); /* Imprime en pantalla el error capturado */
}

?>