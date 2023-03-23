<?php
include("../../bd.php");

/* --INTRUCCIONES PARA LISTAR LOS DATOS DE LA TABLA `tbl_empleados`-- */
if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];
    
    $foto=$registro["foto"];
    $cv=$registro["cv"];
    
    $idpuesto=$registro["idpuesto"];
    $fechadeingreso=$registro["fechadeingreso"];

    /* Creo una sentencia donde listo todos los registros de mi tabla tbl_puestos */
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`"); 
    /* Ejecute la sentencia anteriormente creada */
    $sentencia->execute();
    /* Creacion de una lista de la tbl_puestos en la cual se guardaran todos los registros de la tabla*/
    $lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
}

/* --INSTRUCCIONES PARA ACTUALIZAR LOS DATOS DE LOS REGISTROS-- */
if ($_POST) {
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";

  /* Recolectamos los datos del metodo POST */
  $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
  $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
  $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
  $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");

  $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
  $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

  /* Preparar la inserccion de los datos */
  $sentencia=$conexion->prepare(
    "UPDATE tbl_empleados 
    SET 
      primernombre = :primernombre, 
      segundonombre = :segundonombre, 
      primerapellido = :primerapellido, 
      segundoapellido = :segundoapellido, 
      idpuesto = :idpuesto, 
      fechadeingreso = :fechadeingreso 
    WHERE id=:id"
  );
  /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
  $sentencia->bindParam(":primernombre", $primernombre);
  $sentencia->bindParam(":segundonombre", $segundonombre);
  $sentencia->bindParam(":primerapellido", $primerapellido);
  $sentencia->bindParam(":segundoapellido", $segundoapellido);
  $sentencia->bindParam(":idpuesto", $idpuesto);
  $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
  $sentencia->bindParam(":id", $txtID);
  $sentencia->execute();

  /* INTRUCCIONES ESPECIALES PARA INCLUIR ARCHIVOS EN EL FORMULARIO -> */
  $fecha_=new DateTime();
  /* -- INTRUCCIONES PARA CAMBIAR DE FOTO Y ELIMINAR LA ANTERIOR-- */
    $foto=(isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"");
    $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    $tmp_foto=$_FILES["foto"]["tmp_name"];

    if ($tmp_foto!='') {
      move_uploaded_file($tmp_foto,"./fotosEmpleados/".$nombreArchivo_foto);

      /* Buscar el archivo relacionado con el empleado */
      $sentencia=$conexion->prepare("SELECT foto FROM `tbl_empleados` WHERE id=:id");
      $sentencia->bindParam(":id",$txtID); 
      $sentencia->execute();
      $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

      /* Eliminando Foto */
      if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="") {
          if (file_exists("./fotosEmpleados/".$registro_recuperado["foto"])) {
              unlink("./fotosEmpleados/".$registro_recuperado["foto"]);
          }
      }

      $sentencia=$conexion->prepare("UPDATE tbl_empleados SET foto=:foto WHERE id=:id");
      $sentencia->bindParam(":foto", $nombreArchivo_foto);
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
    }
    
  /* --INTRUCCIONES PARA CAMBIAR EL CV.PDF Y ELIMINAR EL ANTERIOR-- */
  $cv=(isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"");
  $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";
  $tmp_cv=$_FILES["cv"]["tmp_name"];

    if ($tmp_cv!='') {
      move_uploaded_file($tmp_cv,"./cvEmpleados/".$nombreArchivo_cv);

      /* Buscar el archivo relacionado con el empleado */
      $sentencia=$conexion->prepare("SELECT cv FROM `tbl_empleados` WHERE id=:id");
      $sentencia->bindParam(":id",$txtID); 
      $sentencia->execute();
      $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

      /* Eliminando CV.pdf */
      if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="") {
          if (file_exists("./cvEmpleados/".$registro_recuperado["cv"])) {
              unlink("./cvEmpleados/".$registro_recuperado["cv"]);
          }
      }

      $sentencia=$conexion->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id=:id");
      $sentencia->bindParam(":cv", $nombreArchivo_cv);
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
    }
      

  /* ----------------------------------------------------------------< */

  header("Location:index.php");
}
?>

<?php include("../../templates/header.php"); ?>
<br />

<div class="card">
    <div class="card-header">
        Datos del empleado
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
            <!-- Entrada primer nombre del empleado -->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Primer nombre</label>
              <input type="text"
                value="<?php echo $primernombre; ?>"
                class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
            </div>
            <!-- Entrada segundo nombre del empleado -->
            <div class="mb-3">
              <label for="segundonombre" class="form-label">Segundo nombre</label>
              <input type="text"
                value="<?php echo $segundonombre; ?>"
                class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
            </div>
            <!-- Entrada primer apellido del empleado -->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Primer apellido</label>
              <input type="text"
                value="<?php echo $primerapellido; ?>"
                class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
            </div>
            <!-- Entrada segundo apellido del empleado -->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Segundo apellido</label>
              <input type="text"
                value="<?php echo $segundoapellido; ?>"
                class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
            </div>
            <!-- Entrada foto del empleado -->
            <div class="mb-3">
              <label for="foto" class="form-label">Foto:</label>
              <br>
              <img width="100px" src="./fotosEmpleados/<?php echo $foto ?>" class="img-fluid rounded" alt=""/><br><br>
              <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>
            <!-- Entrada CV del empleado -->
            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF):</label>
              <br>
              <a href=<?php echo "./cvEmpleados/".$cv; ?> target="_blank"><?php echo $cv; ?></a>
              <input type="file"
                class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
            </div>
            <!-- Entrada seleccion del puesto del empleado -->
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                <?php foreach ($lista_tbl_puestos as $registro) { ?>

                    <option <?php echo ($idpuesto==$registro['id'])?"selected":"";?> value="<?php echo $registro['id'] ?>">
                      <?php echo $registro['nombredelpuesto'] ?>
                    </option>

                <?php } ?>
                </select>

            </div>
            <!-- Entrada Fecha de ingreso -->
            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
              <input
              value="<?php echo $fechadeingreso; ?>"
              type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
            </div>
            <!-- Boton aplicar cambios al empleado -->
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Aplicar cambios</button>
            <!-- Boton cancelar accion -->
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="bi bi-x-circle-fill"></i> Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>