<?php include("../../templates/header.php"); ?>
<br />

<h4>Agregar usuarios</h4>
<!-- /--------------------------------------/ -->
<!-- /Formulario para agregar usuarios/ -->
<!-- /--------------------------------------/ -->
<div class="card">
    <div class="card-header">
       Datos del Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Entrada nombre del usuario -->
            <div class="mb-3">
              <label for="usario" class="form-label">Nombre del usuario:</label>
              <input type="text"
                class="form-control" name="usario" id="usario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <!-- Entrada contraseña del usuario -->
            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
            </div>
            <!-- Entrada correo del usuario -->
            <div class="mb-3">
              <label for="correo" class="form-label">Correo:</label>
              <input type="email"
                class="form-control" name="nombredelusario" id="correo" aria-describedby="helpId" placeholder="Correo">
            </div>
            <!-- Boton agregar puesto -->
            <button type="submit" class="btn btn-success">Agregar</button>
            <!-- Boton cancelar accion -->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>