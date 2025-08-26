<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Carlos Guadalupe López Trejo">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Carrusel</title>

    <link href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>static/fontawesome/css/all.min.css" rel="stylesheet" />

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.bundle.min.js " rel="stylesheet"></script>


    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/reportes.css" >

    <script src="<?= base_url() ?>static/js/jquery-3.6.1.min.js" rel="stylesheet"></script>
    <script src="<?=base_url()?>static/js/jquery-3.6.1.js"></script>

    <script src="<?=base_url()?>static/js/mensajes.js"></script>

</head>
<body>

    <style type="text/css">
        img {
    /* Establece el tamaño inicial de la imagen */
    transform: scale(1);
    /* Agrega una transición suave al tamaño de la imagen */
    transition: transform 0.3s ease-in-out;
  }
  
  /* Cuando el mouse se pase sobre la imagen, cambia su tamaño a 1.5 veces su tamaño original */
  .img-producto:hover {
    transform: scale(1.1);
  }

  .alert-dismissible{
      position: fixed;
      bottom: 20px;
      right: 10px;
    }

    </style>

  <script>
            var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
            idusuario : "<?= $this->session->id_cli ?>",
            idusuario : "<?= $this->session->correo ?>",
            id_foto : 0,
            }
        </script>

     <header>
    <h1>Carrusel</h1>
    <p class="text-white mx-4" >Bienvenido: <?= $this->session->nombre ?></p>
    <div class="d-flex justify-content-between">
                <a href="<?=base_url()?>frontend/principalAdmin/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-info text-white" title="Inicio">
                    <i class="fa-solid fa-home text-white"></i>
                    Inicio
                </a>
                <div class="bienvenida d-flex align-items-center" id="mensaje-bienvenida" >
                </div>
            <div >
                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sessión">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    Cerrar sesión
                </a>
                </div>
            </div>

  </header>
          <section class="mt-4">

            <?php 

$fot=$this->db->select("foto")->from("carrusel")->where("id",1)->get()->result_array();
$foto1=$fot["0"]["foto"];

$fot=$this->db->select("foto")->from("carrusel")->where("id",2)->get()->result_array();
$foto2=$fot["0"]["foto"];

$fot=$this->db->select("foto")->from("carrusel")->where("id",3)->get()->result_array();
$foto3=$fot["0"]["foto"];

?>

<script type="text/javascript">

    $(document).ready(function(){
$("#tabla-carrusel").find("thead").hide();

//Carga foto
    $.ajax({
        "url" : appData.uri_ws+"backend/foto/",
        "dataType" : "json"
    })
    .done(function(obj){
        if (obj) {
            $("#tabla-carrusel").find("thead").show();

            $.each(obj, function(i,p){
                $("#tabla-carrusel").find("tbody").append(
                    '<tr id="tr-'+p.id+'">'+
                    '<td>'+p.id+'</td>'+
                    '<td><img class="img-producto" src="'+appData.uri_app+'static/images/'+p.foto+'" width="150" height="150" alt="texto alternativo" >'+'</td>'+
                    '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-foto'+p.id+'" title="Cambiar Foto" onclick="click_btn_edit('+p.id+')"><i class="fas fa-edit"></i> Editar</button>'+'</td>'+
                    '</tr>'
                    );
            });

        }
        else{
            $("#tabla-carrusel").find("thead").hide();
            alert("No hay fotos");
        }
    });

}); //Fin del ready


    function click_btn_edit(id){
    
    appData.id_foto = id; 
  
}


</script>

            <div id="report-buttons">
  <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabla-carrusel">
                <thead>
                    <tr class="table-info">
                <th class="text-center">No.</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Editar</th>
                </tr>
                </thead>
                <tbody>

                   

                </tbody>
            </table>
        </div>
    </div>

    </div>

    </section>


<script type="text/javascript">
  $(document).ready(function () {
    borra_mensajes();

    const form1 = document.getElementById('form-foto1');
    const form2 = document.getElementById('form-foto2');
    const form3 = document.getElementById('form-foto3');
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];


    form1.addEventListener('submit', function (event) {
      event.preventDefault(); // Evita el envío del formulario
      $(".form-group").keydown(borra_mensajes);
      borra_mensajes();
      const fotoInput = document.getElementById('foto1');
      const foto1 = fotoInput.files[0];

      if ($("#foto1").val() == "") {
        error_formulario("foto1", "La foto es requerida");
        return false;
      }
      else if (!allowedTypes.includes(foto1.type)) {
        error_formulario("foto1","El archivo seleccionado no es una imagen");
       return false;
      }
       else {
        // Realizar aquí cualquier acción adicional que desees antes de enviar el formulario
        $(this).unbind("submit").submit(); // Envía el formulario manualmente
      }
    });


    form2.addEventListener('submit', function (event) {
      event.preventDefault(); // Evita el envío del formulario
      $(".form-group").keydown(borra_mensajes);
      borra_mensajes();
      const fotoInput = document.getElementById('foto2');
      const foto2 = fotoInput.files[0];

      if ($("#foto2").val() == "") {
        error_formulario("foto2", "La foto es requerida");
        return false;
      } 
      else if (!allowedTypes.includes(foto2.type)) {
        error_formulario("foto2","El archivo seleccionado no es una imagen");
       return false;
      }
      else {
        // Realizar aquí cualquier acción adicional que desees antes de enviar el formulario
        $(this).unbind("submit").submit(); // Envía el formulario manualmente
      }
    });


    form3.addEventListener('submit', function (event) {
      event.preventDefault(); // Evita el envío del formulario
      $(".form-group").keydown(borra_mensajes);
      borra_mensajes();
      const fotoInput = document.getElementById('foto3');
      const foto3 = fotoInput.files[0];

      if ($("#foto3").val() == "") {
        error_formulario("foto3", "La foto es requerida");
        return false;
      }
      else if (!allowedTypes.includes(foto3.type)) {
        error_formulario("foto3","El archivo seleccionado no es una imagen");
       return false;
      }
      else {
        // Realizar aquí cualquier acción adicional que desees antes de enviar el formulario
        $(this).unbind("submit").submit(); // Envía el formulario manualmente
      }
    });
  });
</script>




<?php 
if($mensaje == "Sin_Foto"):
  ?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("warning","<?=$mensaje?>");
   });
</script>

<?php 
elseif($mensaje == "Actualizada"):
?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("success","<?=$mensaje?>");
   });
</script>

<?php 
elseif($mensaje == "No_se_pudo_actualizar"):
?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("danger","<?=$mensaje?>");
   });
</script>

<?php 
endif;
?>


<!-- Modal Editar 1 -->
<div class="modal fade" id="modal-foto1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="modal-formato-titulo">Editar Foto 1:</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url()?>../webservice/backend/carrusel/" id="form-foto1" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="accion" name="accion" value="1" />
        <div class="modal-body">
          <div class="row">
            <div class="form-group" id="group-foto1">
              <label for="foto1"><strong>Foto: </strong></label>
              <input type="file" class="form-control" id="foto1" name="foto1">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Confirmar
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i>
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Editar 2 -->
<div class="modal fade" id="modal-foto2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="modal-formato-titulo">Editar Foto 2:</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url()?>../webservice/backend/carrusel/" id="form-foto2" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="accion" name="accion" value="2" />
        <div class="modal-body">
          <div class="row">
            <div class="form-group" id="group-foto2">
              <label for="foto2"><strong>Foto: </strong></label>
              <input type="file" class="form-control" id="foto2" name="foto2">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Guardar
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i>
            Cerrar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Editar 3 -->
<div class="modal fade" id="modal-foto3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="modal-editar-titulo"><span id="modal-editar-accion"></span>Editar Foto 3:</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url()?>../webservice/backend/carrusel/" id="form-foto3" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="accion" name="accion" value="3" />
        <div class="modal-body">
          <div class="row">
            <div class="form-group" id="group-foto3">
              <label for="foto3"><strong>Foto: </strong></label>
              <input type="file" class="form-control" id="foto3" name="foto3">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Guardar
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i>
            Cerrar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
 
 <div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px;right:10px;"></div>

</body>
</html>
