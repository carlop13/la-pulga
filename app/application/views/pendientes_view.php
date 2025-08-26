<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Carlos Guadalupe López Trejo">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Pedidos Pendientes</title>

     <link href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>static/fontawesome/css/all.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.bundle.min.js " rel="stylesheet"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
   <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
</head>
<body>

  <script>
            var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
            idusuario : "<?= $this->session->id_cli ?>",
            idusuario : "<?= $this->session->correo ?>",
            id_v : 0,
            id_cl : 0,
            lat : 0,
            lng : 0,
            }
        </script>

        <style>


      nav {
            background-color: brown;
            color: #fff;
            padding: 20px;
            text-align: center;
            animation: slideDown 0.5s ease-in-out;
        }


    @keyframes slideDown {
      0% { transform: translateY(-100%); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }
    </style>


        <nav class="navbar navbar-dark bg-brown mb-4 p-4 fixed-top">
    <div class="d-flex justify-content-between">
<div>
      <h1>Pedidos Pendientes</h1>
    <p class="text-white mx-4" >Bienvenido: <?= $this->session->nombre ?></p>

      </div>

            </div>

             <div class="d-flex justify-content-between">
      <a href="<?=base_url()?>frontend/principalAdmin/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-info text-white" title="Inicio">
                    <i class="fa-solid fa-home text-white"></i>
                    Inicio
                </a>
                </div>

            <div class="botones" >
           
            <div >
                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sessión">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    Cerrar sesión
                </a>
                </div>
            </div>
  </nav>

        <br><br><br><br><br><br>

        <script type="text/javascript">
 $(document).ready(function() {

  $("#guardar-pedido").click(function(){

    $.ajax({
      "url": appData.uri_ws + "backend/updateenvio/",
      "dataType": "json",
      "type": "post",
      "data": {
        "id": appData.id_v
      }
    })
    .done(function(obj) {
      if (obj != "Imposible Actualizar") {
     alert(obj);
     $("#modal-pedido").modal("hide");
      } else {
        alert(obj);
      }
    });

  });

    }); //Fin del ready
        </script>


            <div id="report-buttons">
  <div class="container mt-5">
        <div >
            <table class="table table-bordered table-hover" id="tabla-pedidos">
                <thead>
                    <tr class="table-info">
                <th class="text-center">No.</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Folio</th>
                <th class="text-center">Total</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Ver detalle</th>
                <th class="text-center">Ver dirección</th>
                <th class="text-center">Ver ubicación</th>
                </tr>
                </thead>
                <tbody>
                    <!-- Aquí van los datos de la tabla -->
                </tbody>
            </table>
        </div>
    </div>

    </div>

<!-- Modal detalle -->
<div class="modal fade" id="modal-pedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="modal-formato-titulo">Detalles de la Venta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="tabla-detalle">
            <thead>
              <tr class="table-info">
                <th class="text-center">Producto</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí van los datos de la tabla -->
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button id="guardar-pedido" type="button" class="btn btn-primary">
          <i class="fas fa-check"></i>
          Marcar como entregada
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i>
          Cancelar
        </button>
      </div>

    </div>
  </div>
</div>



<!-- Modal direccion -->
<div class="modal fade" id="modal-direccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="modal-formato-titulo">Dirección del Cliente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="tabla-direccion">
            <thead>
              <tr class="table-info">
                <th class="text-center">Ciudad</th>
                <th class="text-center">Colonia</th>
                <th class="text-center">Calle</th>
                <th class="text-center">CP</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí van los datos de la tabla -->
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
    
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i>
          Cancelar
        </button>
      </div>

    </div>
  </div>
</div>


<!-- Modal mapa -->
<div class="modal fade" id="modal-mapa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="modal-formato-titulo">Ubicación de Envío</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
       <div class="d-flex justify-content-center flex-column">
      Posición
     <div id="mapa" class="border border-dark rounded col-md-10" style="height: 400px;"></div>
</div>
      </div>

      <div class="modal-footer">
    
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i>
          Cancelar
        </button>
      </div>

    </div>
  </div>
</div>




    <script src="<?=base_url()?>static/js/pedidos.js"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ7TvV1KlSm2HKZbZ0GvkovPDFkV1O-0Y&callback=cargaMapa" 
    type="text/javascript"></script>
</body>
</html>
