<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Carlos Guadalupe López Trejo">

    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Clientes</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.bundle.min.js " rel="stylesheet"></script>


    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/estilos.css">
   <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <script type="text/javascript">
    $(document).ready(function() {
        $(window).scroll(function() {
            $('#scroll').toggleClass('show', $(this).scrollTop() < $(document).height() - $(window).height());
        });

        $('#scroll').click(function() {
            var scrollHeight = $(document).height() - $(window).height();
            $('html, body').animate({scrollTop: scrollHeight}, 600);
            return false;
        });
    });
</script>

<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>

  <script>
            var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
            idusuario : "<?= $this->session->id_cli ?>",
            idusuario : "<?= $this->session->correo ?>",
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

     #scroll {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background-color: #333;
        color: #fff;
        text-align: center;
        line-height: 50px;
        font-size: 14px;
        border-radius: 50%;
        z-index: 9999;
        cursor: pointer;
    }

    #scroll:hover {
        background-color: #555;
    }
    </style>

<nav class="navbar navbar-dark bg-brown mb-4 p-4 fixed-top">
    <div class="d-flex justify-content-between">
<div>
      <h1 class="text-center">Clientes</h1>

     <div class="text-center">Bienvenido: <?= $this->session->nombre ?></div>
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

<br /><br /><br /><br /><br />


            <div id="report-buttons">
  <div class="container mt-5">
        <div >
            <table class="table table-bordered table-hover" id="tabla-clientes">
                <thead>
                    <tr class="table-info">
                <th class="text-center">No.</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Nombre de usuario</th>
                <th class="text-center">Fecha de Registro</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Correo</th>
                </tr>
                </thead>
                <tbody>
                    <!-- Aquí van los datos de la tabla -->
                </tbody>
            </table>
        </div>
    </div>

    </div>


    <script src="<?=base_url()?>static/js/clientes.js"></script>

    <br /><br />
</body>
</html>
