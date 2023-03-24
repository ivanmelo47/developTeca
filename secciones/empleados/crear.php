<?php 
/* Llamdo al archivo bd.php que me conecta a mi base de datos */
include("../../bd.php");

/* Sentencia para insertar datos en la tabla 'tbl_empleados' */
if ($_POST) {

    /* Recolectamos los datos del metodo POST */
    $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
    $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
    $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
    $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");

    /* INTRUCCIONES ESPECIALES PARA INCLUIR ARCHIVOS EN EL FORMULARIO -> */
    $foto=(isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"");
    $cv=(isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"");
    /* ----------------------------------------------------------------< */

    $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
    $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

    /* Preparar la inserccion de los datos */
    $sentencia=$conexion->prepare("INSERT INTO 
    `tbl_empleados` (`id`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idpuesto`, `fechadeingreso`) 
    VALUES (NULL, :primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto, :fechadeingreso)");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundonombre", $segundonombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);

    /* ----------------------------- */
    /* Codigo para adjuntar la foto */
    $fecha_=new DateTime();

    $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    $tmp_foto=$_FILES["foto"]["tmp_name"];
    if ($tmp_foto!='') {
      move_uploaded_file($tmp_foto,"./fotosEmpleados/".$nombreArchivo_foto);
    }
    $sentencia->bindParam(":foto", $nombreArchivo_foto);
    /* Codigo para adjuntar el CV en pdf */
    $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";
    $tmp_cv=$_FILES["cv"]["tmp_name"];
    if ($tmp_cv!='') {
      move_uploaded_file($tmp_cv,"./cvEmpleados/".$nombreArchivo_cv);
    }
    $sentencia->bindParam(":cv", $nombreArchivo_cv);
    /* ----------------------------- */
    

    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
    /* Ejecucion de la sentencia (Es aqui donde finalmente se insertan los datos en la tabla) */
    $sentencia->execute();
    
    /* Mensaje de notificacion */
    $mensaje="Registro creado!";
    /* Esto nos concateta el mensaje al url y despues vuelve a cargar el index, con lo 
    cual se imprime nuestro mensaje de confirmacion en pantalla */
    header("Location:index.php?mensaje=".$mensaje);
}

/* Creo una sentencia donde listo todos los registros de mi tabla tbl_puestos */
$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`"); 
/* Ejecute la sentencia anteriormente creada */
$sentencia->execute();
/* Creacion de una lista de la tbl_puestos en la cual se guardaran todos los registros de la tabla*/
$lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?> 

<?php include("../../templates/header.php"); ?>
<br />

<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <!-- Entrada primer nombre del empleado -->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Primer nombre</label>
              <input type="text"
                class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
            </div>
            <!-- Entrada segundo nombre del empleado -->
            <div class="mb-3">
              <label for="segundonombre" class="form-label">Segundo nombre</label>
              <input type="text"
                class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
            </div>
            <!-- Entrada primer apellido del empleado -->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Primer apellido</label>
              <input type="text"
                class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
            </div>
            <!-- Entrada segundo apellido del empleado -->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Segundo apellido</label>
              <input type="text"
                class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
            </div>
            <!-- Entrada foto del empleado -->
            <div class="mb-3">
              <label for="foto" class="form-label">Foto:</label>
              <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>
            <!-- Entrada CV del empleado -->
            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF):</label>
              <input type="file"
                class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
            </div>
            <!-- Entrada seleccion del puesto del empleado -->
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                
                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                <?php foreach ($lista_tbl_puestos as $registro) { ?>
                    <option value="<?php echo $registro['id'] ?>">
                      <?php echo $registro['nombredelpuesto'] ?>
                    </option>
                <?php } ?>
                </select>

            </div>
            <!-- Entrada Fecha de ingreso -->
            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
              <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
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