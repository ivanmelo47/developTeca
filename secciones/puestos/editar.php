<?php 
/* Llamdo al archivo bd.php que me conecta a mi base de datos */
include("../../bd.php");

/* Sentencia para rellenar los campos del formulario y editarlos */
if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    /* Preparar la edicion de los datos */
    $sentencia=$conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":id", $txtID);
    /* Ejecucion de la sentencia (Es aqui donde finalmente se consultan los datos en la tabla) */
    $sentencia->execute();
    /* 'FETCH_LAZY' sirve para solo cargar un registro */
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    /* Aquie se llenan nuestra variables con los datos necesarios para llenar el formulario de edicion */
    $nombredelpuesto = $registro["nombredelpuesto"];
}
/* Sentencia para llevar a cabo la edicion de los datos */
if ($_POST) {
    /* Recolectamos los datos del metodo POST */
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    /* Preparar la actualizacion de los datos */
    $sentencia=$conexion->prepare("UPDATE tbl_puestos SET nombredelpuesto=:nombredelpuesto WHERE id=:id ");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia->bindParam(":id", $txtID);
    /* Ejecucion de la sentencia (Es aqui donde finalmente se actualizan los datos en la tabla) */
    $sentencia->execute();

    /* Mensaje de notificacion */
    $mensaje="Registro actualizado!";
    /* Esto nos concateta el mensaje al url y despues vuelve a cargar el index, con lo 
    cual se imprime nuestro mensaje de confirmacion en pantalla */
    header("Location:index.php?mensaje=".$mensaje);
}
?> 

<?php include("../../templates/header.php"); ?>
<br />

<h4>Editar Puestos</h4>
<!-- /--------------------------------------/ -->
<!-- /Formulario para editar puestos/ -->
<!-- /--------------------------------------/ -->
<div class="card">
    <div class="card-header">
        Puesto
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
            <!-- Entrada nombre del puesto -->
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
              <input type="text"
                value="<?php echo $nombredelpuesto; ?>"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>
            <!-- Boton aplicar cambios al puesto -->
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Aplicar cambios</button>
            <!-- Boton cancelar accion -->
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="bi bi-x-circle-fill"></i> Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>