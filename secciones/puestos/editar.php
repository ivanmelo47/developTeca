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
    /*  */
    $nombredelpuesto = $registro["nombredelpuesto"];
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
            <!-- Boton agregar puesto -->
            <button type="submit" class="btn btn-success">Aplicar cambios</button>
            <!-- Boton cancelar accion -->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>