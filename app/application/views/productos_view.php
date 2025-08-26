  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta author="Carlos Guadalupe López Trejo">
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


    
    <title>Gestión de Productos</title>
</head>
<body class="bg-light">

    <script type="text/javascript">
  $(document).ready(function() {
    $(window).scroll(function() {
      var scrollPosition = $(window).scrollTop();
      var windowHeight = $(window).height();
      var documentHeight = $(document).height();

      // Mostrar botón de scroll hacia abajo al principio de la página
      if (scrollPosition < windowHeight) {
        $('#scrollDown').fadeIn();
      } else {
        $('#scrollDown').fadeOut();
      }

      // Mostrar botón de scroll hacia arriba al final de la página
      if (scrollPosition + windowHeight >= documentHeight) {
        $('#scrollUp').fadeIn();
      } else {
        $('#scrollUp').fadeOut();
      }
    });

    $('#scrollDown').click(function() {
      $('html, body').animate({
        scrollTop: $(document).height()
      }, 600);
      return false;
    });

    $('#scrollUp').click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 600);
      return false;
    });
  });
</script>

<style>
  .scroll-button {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 999;
    width: 40px;
    height: 40px;
    text-align: center;
    background: black;
    color: #fff;
    border-radius: 50%;
    font-size: 30px;
    line-height: 40px;
  }

      .mb-8 {
  margin-bottom: 190px;
}
</style>

<a href="javascript:void(0);" id="scrollDown" class="scroll-button" title="Scroll to Bottom">
  <i class="fas fa-arrow-down"></i>
</a>

<a href="javascript:void(0);" id="scrollUp" class="scroll-button" title="Scroll to Top">
  <i class="fas fa-arrow-up"></i>
</a>

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
    
    <script>
        var appData = {
        uri_app : "<?= base_url() ?>",
        uri_ws  : "<?= base_url() ?>../webservice/",
        idusuario : "<?= $this->session->id_cli ?>",
        correo : "<?=$this->session->correo ?>",
        nombre: "<?= $this->session->nombre ?>",
        token : "<?=$this->session->token ?>",
        id_usu : "<?=$this->session->id_usu ?>",
        id_proo : 0,
        }
    </script>

    <style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>

    <?php 
$pro=$this->db->select("count(id) as id")->from("producto")->where("estado",1)->get()->result_array();

if (!empty($pro)) {
$productos = $pro["0"]["id"];
}
else {
$productos = 0;
  }

if($mensaje == "Producto_Insertado"):
  ?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("success","<?=$mensaje?>");
   });
</script>

<?php 
elseif($mensaje == "Imposible_insertar"):
?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("danger","<?=$mensaje?>");
   });
</script>

<?php 
endif;
?>

<div class="container" >

   <style>
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

 <nav class="navbar navbar-dark bg-brown mb-4 p-4 fixed-top">
    <div class="d-flex justify-content-between">
<div>
      <h1 class="text-center">Gestión de productos</h1>

     <div class="text-center">tienes: <span id="total">0</span> productos en Stock</div>
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

        <div class="d-flex mt-5">
        </div>


<br><br><br><br><br>

 <div class="container mt-2">

  <div class="row" id="lista-productos">
  </div>

</div>

                <div class="container mt-2 mb-8">
        <div class="d-flex">
            <button id="btn-agregar" type="button" class="btn bg-success text-white btn-lg" title="Agregar">
                <i class="fa-solid fa-plus text-white"></i>
                Agregar
            </button>
        </div>
    </div>

      <!-- Modal Borrar-->
<div class="modal fade" id="modal-borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-danger bg-opacity-75">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
    ¿Realmente quieres eliminar este producto?

      </div>
      <div class="modal-footer d-flex justify-content-center">

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn-eliminar-fin">
          <i class="fas fa-trash"></i>
        Eliminar
      </button>


        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-ban"></i>
        Cancelar
      </button>
      
        
      </div>
    </div>
  </div>
</div>


                <br /><br />
  
 </div> 
    <script src="<?=base_url()?>static/js/GestionProductos.js" ></script>

    <div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px;right:10px;"></div>

</body>
</html>