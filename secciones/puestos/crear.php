<?php 
/* Llamdo al archivo bd.php que me conecta a mi base de datos */
include("../../bd.php");

/* Sentencia para insertar datos en la tabla 'tbl_puesto' */
if ($_POST) {
    /* Recolectamos los datos del metodo POST */
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    /* Preparar la inserccion de los datos */
    $sentencia=$conexion->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto) VALUES (null, :nombredelpuesto)");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
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
<h4>Crear Puestos</h4>
<!-- /--------------------------------------/ -->
<!-- /Formulario para crear puestos/ -->
<!-- /--------------------------------------/ -->
<div class="card">
    <div class="card-header">
        Puesto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Entrada nombre del puesto -->
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
              <input type="text"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
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