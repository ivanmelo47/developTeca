<?php
/* Llamdo al archivo bd.php que me conecta a mi base de datos */
include("../../bd.php");
/* -------------------------------------- */
/* Sentencia para eliminar un registro */
/* -------------------------------------- */
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    /* Preparar la eliminacion de los datos */
    $sentencia = $conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
    /* Asignando los valores que viene del metodo POST (Los que viene del formulario) */
    $sentencia->bindParam(":id", $txtID);
    /* Ejecucion de la sentencia (Es aqui donde finalmente se eliminan los datos en la tabla) */
    $sentencia->execute();
    
    /* Mensaje de notificacion */
    $mensaje="Registro eliminado!";
    /* Esto nos concateta el mensaje al url y despues vuelve a cargar el index, con lo 
    cual se imprime nuestro mensaje de confirmacion en pantalla */
    header("Location:index.php?mensaje=".$mensaje);
}

/* -------------------------------------------------------- */
/* Sentencia para listar los datos en la tabla del index */
/* -------------------------------------------------------- */
/* Creo una sentencia donde listo todos los registros de mi tabla tbl_puestos */
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");

/* Ejecute la sentencia anteriormente creada */
$sentencia->execute();

/* Creacion de una lista de la tbl_puestos en la cual se guardaran todos los registros de la tabla*/
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>


<br />
<h4>Puestos</h4>
<!-- /--------------------------------------/ -->
<!-- /Tabla para listar puestos/ -->
<!-- /--------------------------------------/ -->
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            <i class="bi bi-person-plus-fill"></i> Agregar puesto
        </a>
    </div>
    <div class="card-body">
        <!-- Tabla -->
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <!-- Columnas nombres -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <!-- Impresion de las filas -->
                <tbody>
                    <!-- Uso de un ciclo 'foreach' para imprimir cada uno de los registros guardados en la lista "$lista_tbl_puestos" dinamicamente -->
                    <?php foreach ($lista_tbl_puestos as $registro) { ?>
                        <tr class="">
                            <!-- ID del puesto -->
                            <td scope="row">
                                <?php echo $registro['id']; ?>
                            </td>
                            <!-- Nombre del puesto -->
                            <td>
                                <?php echo $registro['nombredelpuesto']; ?>
                            </td>
                            <!-- Botones |Editar||Eliminar| -->
                            <td>
                                | <a class="btn btn-success" href="editar.php?txtID=<?php echo $registro['id'] ?>"
                                    role="button"><i class="bi bi-pencil-fill"></i></a><!-- Boton editar -->
                                | <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'] ?>);"
                                    role="button"><i class="bi bi-trash3-fill"></i></a><!-- Boton eliminar -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>