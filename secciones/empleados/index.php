<?php 
/* Llamdo al archivo bd.php que me conecta a mi base de datos */
include("../../bd.php");
/* -------------------------------------- */
/* Sentencia para eliminar un registro */
/* -------------------------------------- */
if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    
    /* Buscar el archivo relacionado con el empleado */
    $sentencia=$conexion->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID); 
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    /* Eliminando Foto */
    if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="") {
        if (file_exists("./fotosEmpleados/".$registro_recuperado["foto"])) {
            unlink("./fotosEmpleados/".$registro_recuperado["foto"]);
        }
    }
    /* Eliminando CV.pdf */
    if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="") {
        if (file_exists("./cvEmpleados/".$registro_recuperado["cv"])) {
            unlink("./cvEmpleados/".$registro_recuperado["cv"]);
        }
    }

    /* Sentencia para eliminar los datos del registro */
    $sentencia=$conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
    
}

/* -------------------------------------------------------- */
/* Sentencia para listar los datos en la tabla del index */
/* -------------------------------------------------------- */
/* Creo una sentencia donde listo todos los registros de mi tabla tbl_puestos */
$sentencia=$conexion->prepare("SELECT *,
(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto 
FROM `tbl_empleados`"); 
/* Ejecute la sentencia anteriormente creada */
$sentencia->execute();
/* Creacion de una lista de la tbl_usuarios en la cual se guardaran todos los registros de la tabla*/
$lista_tbl_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?> 

<?php include("../../templates/header.php"); ?>
<br />
<h4>Empleados</h4>
<!-- /--------------------------------------/ -->
<!-- /Tabla para listar a los empleados/ -->
<!-- /--------------------------------------/ -->
<div class="card">
    <div class="card-header">

        <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar registro
        </a>

    </div>
    <div class="card-body">
        <!-- Tabla -->
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Uso de un ciclo 'foreach' para imprimir cada uno de los registros guardados en la lista "$lista_tbl_usuarios" dinamicamente -->
                <?php foreach ($lista_tbl_empleados as $registro) { ?>
                    <tr class="">
                        <td><?php echo $registro['id'] ?></td>
                        <td scope="row">
                            <?php echo $registro['primernombre'] ?>
                            <?php echo $registro['segundonombre'] ?>
                        </td>
                        <td>
                            <img width="50px" src="./fotosEmpleados/<?php echo $registro['foto'] ?>" class="img-fluid rounded" alt=""/>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="<?php echo "./cvEmpleados/".$registro['cv'] ?>" role="button" target="_blank"><i class="bi bi-file-pdf-fill"></i></a><!-- Boton editar -->
                        </td>
                        <td><?php echo $registro['puesto'] ?></td>
                        <td><?php echo $registro['fechadeingreso'] ?></td>
                        <td>
                            | <a name="" id="" class="btn btn-primary" href="#" role="button"><i class="bi bi-file-text-fill"></i></a><!-- Generar carta -->
                            | <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button"><i class="bi bi-pencil-fill"></i></a><!-- Boton editar -->
                            | <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id'] ?>" role="button"><i class="bi bi-trash3-fill"></i></a><!-- Boton eliminar -->
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>