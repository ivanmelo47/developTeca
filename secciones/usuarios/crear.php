<?php 
/* Llamdo al archivo bd.php que me conecta a mi base de datos */
include("../../bd.php");

/* Sentencia para insertar datos en la tabla 'tbl_puesto' */
if ($_POST) {
    /* Recolectamos los datos del metodo POST */
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    /* Preparar la inserccion de los datos */
    $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo) VALUES (null, :usuario, :password, :correo)");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);
    /* Ejecucion de la sentencia (Es aqui donde finalmente se insertan los datos en la tabla) */
    $sentencia->execute();
    
    /* Mensaje de notificacion */
    $mensaje="Registro creado!";
    /* Esto nos concateta el mensaje al url y despues vuelve a cargar el index, con lo 
    cual se imprime nuestro mensaje de confirmacion en pantalla */
    header("Location:index.php?mensaje=".$mensaje);
}
?> 

<?php include("../../templates/header.php"); ?>
<br />

<h4>Agregar usuarios</h4>
<!-- /--------------------------------------/ -->
<!-- /Formulario para agregar usuarios/ -->
<!-- /--------------------------------------/ -->
<div class="card">
    <div class="card-header">
       Datos del Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Entrada nombre del usuario -->
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario:</label>
              <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <!-- Entrada contraseña del usuario -->
            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
            </div>
            <!-- Entrada correo del usuario -->
            <div class="mb-3">
              <label for="correo" class="form-label">Correo:</label>
              <input type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
            </div>
            <!-- Boton agregar puesto -->
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Agregar</button>
            <!-- Boton cancelar accion -->
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="bi bi-x-circle-fill"></i> Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>