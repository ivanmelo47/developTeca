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
            <button type="submit" class="btn btn-success">Agregar</button>
            <!-- Boton cancelar accion -->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>