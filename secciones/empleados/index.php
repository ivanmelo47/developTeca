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
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">Oscar Uh</td>
                        <td>imagen.jpg</td>
                        <td>cv.pdf</td>
                        <td>Programador Sr.</td>
                        <td>03/16/2023</td>
                        <td>
                             <a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>
                            |<a name="" id="" class="btn btn-info" href="#" role="button">Editar</a>
                            |<a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>