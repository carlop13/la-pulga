  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
    <link href="<?=base_url()?>static/css/alert.css" rel="stylesheet">
    <script src="<?=base_url()?>static/js/mensajes.js" ></script>
    <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>static/js/mensajes.js"></script>
    <script src="<?=base_url()?>static/js/carritos.js" ></script>
    
    <title>Ajustes</title>
</head>
<body class="bg-light">

    <style>

    .alert-dismissible{
      position: fixed;
      bottom: 20px;
      right: 10px;
    }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
    
    <script>
        var appData = {
        uri_app : "<?= base_url() ?>",
        uri_ws  : "<?= base_url() ?>../webservice/",
        idusuario : "<?= $this->session->id_cli ?>",
        correo : "<?=$this->session->correo ?>",
        nombre: "<?= $this->session->nombre ?>",
        token : "<?=$this->session->token ?>",
        id_usu : "<?=$this->session->id_usu ?>",
        }
    </script>

    <div class="container" >

        <nav class="navbar navbar-dark bg-brown mb-4 p-4 fixed-top">
            <div class="d-flex justify-content-between">
                <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>"><img src="<?=base_url()?>static/images/logo.jpeg" style="height: 90px;" class="w-20 mr-auto" alt=""></a>
                <div class="bienvenida d-flex align-items-center" id="mensaje-bienvenida" >
                    <p class="text-white mx-4" >Bienvenido: <?= $this->session->nombre ?>
                     <br />
                     <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info text-black" title="Catálogo">
                    <i class="fas fa-home"></i>
                    Catálogo
                </a>

                    </p> 
                </div>

            </div>
            
            <div class="botones" >
                <a href="<?= base_url() ?>frontend/deseos/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Lista de deseos">
                    <i class="fa-solid fas fa-heart"></i>
                    <script>
                        actualizarCantidadD( <?= $this->session->id_cli ?> );
                    </script>
                    <span id="cantidadDeseos" ></span>
                </a>
                <a href="<?= base_url() ?>frontend/historial/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Historial de compras" >
                    <i class="fa-solid fa-list-alt"></i>
                </a>
                <a href="<?= base_url() ?>frontend/ajuste/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Perfil" >
                    <i class="fa-solid fa-user"></i>
                </a>
                <a href="<?= base_url() ?>frontend/carrito/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Carrito de compras">
                    <i class="fa-solid fas fa-cart-shopping"></i>
                    <script>
                        actualizarCantidad( <?= $this->session->id_cli ?> );
                    </script>
                    <span id="cantidadCarrito" ></span>
                </a>
                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sessión">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    Cerrar sesión
                </a>
            </div>
        </nav>

        <br><br><br><br><br><br><br>

        <div class="d-flex mt-5">
            <h2>Ajustes</h2>

        </div>

        <?php 
$datos = $this->db->select("*")->from("datos_cliente")->where("id",$this->session->id_cli)->get()->result_array();
$nombre = $datos["0"]["nombre"];
$ap = $datos["0"]["ap"];
$am = $datos["0"]["am"];

$usuario = $datos["0"]["usuario"];

$correo = $datos["0"]["correo"];

$ciudad = $datos["0"]["ciudad"];

$fec_registro = $datos["0"]["fec_registro"];

?>



<table class="table table-bordered table-hover mt-2">
      <tr class="text-center table-info">
        <th>Nombre</th>
        <th>Correo</th>
        <th>Fecha de registro</th>
        <th>Nombre de usuario</th>
        <th>Acción</th>
      </tr>
      
      <tr >
      <td> <?=$nombre?> <?=$ap?> <?=$am?></td>
      <td class="text-center"><?=$correo?></td>
      <td class="text-center"><?=$fec_registro?></td>
      <td class="text-center"><?=$usuario?></td>
        <td class="text-center">
          <div class="d-flex justify-content-around">
            <a href="<?=base_url()?>frontend/modatos/<?=$this->session->id_usu?>/<?=$this->session->token?>"
                 
                 class="btn btn-primary btn-sm" title="modificar datos">
                  <i class="fas fa-edit"></i>
                 </a>


<button class="btn btn-sm btn-danger btn-borrar"data-bs-toggle="modal" data-bs-target="#modal-borrar" title="Eliminar cuenta"><i class="fas fa-trash" ></i></button>


             </div>
          </td>
        </tr> 
      
    </table>


    <!-- Modal Borrar-->
<div class="modal fade" id="modal-borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header btn-danger bg-opacity-75">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar cuenta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
    ¿Realmente quieres eliminar tu cuenta?

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-ban"></i>
        Cancelar
      </button>
      
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn-eliminar">
          <i class="fas fa-trash"></i>
        Eliminar
      </button>

      </div>
    </div>
  </div>
</div>

    </div>
  
    <script src="<?=base_url()?>static/js/ajustes.js" ></script>

    <div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px;right:20px;"></div>
<br><br>
</body>
</html>
