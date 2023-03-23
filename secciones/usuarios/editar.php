<?php 
/* Llamdo al archivo bd.php que me conecta a mi base de datos */
include("../../bd.php");

/* Sentencia para rellenar los campos del formulario y editarlos */
if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    /* Preparar la edicion de los datos */
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":id", $txtID);
    /* Ejecucion de la sentencia (Es aqui donde finalmente se consultan los datos en la tabla) */
    $sentencia->execute();
    /* 'FETCH_LAZY' sirve para solo cargar un registro */
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    /* Aquie se llenan nuestra variables con los datos necesarios para llenar el formulario de edicion */
    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
}
/* Sentencia para llevar a cabo la edicion de los datos */
if ($_POST) {
    /* Recolectamos los datos del metodo POST */
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    /* Preparar la actualizacion de los datos */
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET 
        usuario=:usuario,
        password=:password,
        correo=:correo 
        WHERE id=:id 
        ");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":id", $txtID);
    /* Ejecucion de la sentencia (Es aqui donde finalmente se actualizan los datos en la tabla) */
    $sentencia->execute();
    /* Esto nos regresa al listado de puestos */
    header("Location:index.php");
}
?> 

<?php include("../../templates/header.php"); ?>
<br/>

<h4>Editar Usuarios</h4>
<!-- /--------------------------------------/ -->
<!-- /Formulario para editar puestos/ -->
<!-- /--------------------------------------/ -->
<div class="card">
    <div class="card-header">
        Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Solo lectura del ID de el puesto -->
            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text"
                value="<?php echo $txtID; ?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>
            <!-- Entrada nombre del usuario -->
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario</label>
              <input type="text"
                value="<?php echo $usuario; ?>"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <!-- Entrada contraseña del usuario -->
            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password"
                value="<?php echo $password; ?>"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
            </div>
            <!-- Entrada correo del usuario -->
            <div class="mb-3">
              <label for="correo" class="form-label">Correo:</label>
              <input type="email"
                value="<?php echo $correo; ?>"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
            </div>
            <!-- Boton aplicar cambios al usuario -->
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Aplicar cambios</button>
            <!-- Boton cancelar accion -->
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="bi bi-x-circle-fill"></i> Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>