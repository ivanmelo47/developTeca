<?php include("../../templates/header.php"); ?>
<br />
<h4>Puestos</h4>
<!-- /--------------------------------------/ -->
<!-- /Tabla para listar puestos/ -->
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
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">1</td>
                        <td>Developer Jr.</td>
                        <td>
                            <input name="btneditar" id="btneditar" class="btn btn-primary" type="button" value="Editar">
                            <input name="btnborrar" id="btnborrar" class="btn btn-danger" type="button" value="Eliminar">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("../../templates/footer.php"); ?>