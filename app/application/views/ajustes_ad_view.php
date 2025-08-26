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
    
    <title>Información</title>
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

      header {
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


 <header>
    <h1>Mi información</h1>
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

<div class="container" >
        <div class="d-flex mt-5">
        </div>

        <?php 
$datos = $this->db->select("administrador.*,usuario.nombre as usuario")->from("administrador")->join('usuario', 'administrador.id_usu = usuario.id', 'inner')->where("administrador.id",$this->session->id_cli)->get()->result_array();

$id= $datos["0"]["id"];
$nombre = $datos["0"]["nombre"];
$ap = $datos["0"]["ap"];
$am = $datos["0"]["am"];

$usuario = $datos["0"]["usuario"];

$correo = $datos["0"]["correo"];

$fec_registro = $datos["0"]["fec_registro"];

?>



<div class="container mt-2">
  <div class="table-responsive">
    <table class="table align-middle mb-0 bg-whit" id="tabla-admin">
      <thead class="bg-success">
        <tr>
          <th class="text-center">No.</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Correo</th>
          <th class="text-center">Fecha de registro</th>
          <th class="text-center">Nombre de usuario</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <tr>
          <td class="text-center"><?=$id?></td>
          <td class="text-center"><?=$nombre?> <?=$ap?> <?=$am?></td>
          <td class="text-center"><?=$correo?></td>
          <td class="text-center"><?=$fec_registro?></td>
          <td class="text-center"><?=$usuario?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
  
 </div> 
    <script src="<?=base_url()?>static/js/ajustes.js" ></script>

    <div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px;right:20px;"></div>

</body>
</html>
