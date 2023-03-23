<!-- Esta seccion de codigo muestra la notificacion 
de confirmacion de liminacion del registro -->
<script>
    function borrar(id) {
        Swal.fire({
            title: 'Desea borrar el registro?',
            showDenyButton: true,
            confirmButtonText: 'Si',
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "index.php?txtID=" + id;
            }
        })
    }
</script>
<!-- /--------------------------------------/ -->

</main>

  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- Esta seccion de codigo se utiliza para paginar nuestras tablas(busquedas de datos dinamicas) -->
  <script>
  $(document).ready( function(){
    $("#tabla_id").DataTable({
      "pageLenght":3,
      lengthMenu:[
        [3,10,25,50],
        [3,10,25,50]
      ],
      "lenguage":{
        "url":"https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
      }
    });
  });
  </script>
  <!-- /--------------------------------------------------------------------------------------------/ -->

</body>

</html>