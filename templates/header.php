<?php
session_start();
$url1="localhost";
$url2="josueivanmelo.com";
$url_base="http://$url1/developTeca/";

/* Esta seccion de codigo nos permite bloquear cualquier URL del sitio si antes no se ah iniciado sesion. */
if (!isset($_SESSION['usuario'])) {
  header("Location:".$url_base."/login.php");
}

?>

<!doctype html>
<html lang="es">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  <!-- Uso de DataTables - Esta seccion de codigo se utiliza para paginar nuestras tablas(busquedas de datos dinamicas) -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <!-- /--------------------------------------------------------------------------------------------/ -->

  <!-- Uso de Sweet alert para los mensajes emergentes -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- /---------------------------------------------/ -->

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>

  <nav class="navbar navbar-expand navbar-light bg-light">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="#" aria-current="page">Sistema Web<span
            class="visually-hidden">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $url_base;?>secciones/empleados/">Empleados</a> <!-- Se agrega la url base para evitar conflictos de url  -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $url_base;?>secciones/puestos/">Puestos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $url_base;?>secciones/usuarios/">Usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar sesion</a>
      </li>
    </ul>
  </nav>

  <main class="container">

  <!-- Utilizamos este script para verificar si hay un mensaje -->
  <!-- Se activa cuando se realiza la eliminacion de un registro! -->
  <?php if(isset($_GET['mensaje'])) { ?>
  <script>
      Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
  </script>
  <?php } ?>
  <!-- /-----------------------------------------------------/ -->