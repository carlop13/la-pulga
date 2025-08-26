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
    <script src="<?=base_url()?>static/js/carritos.js" ></script>
     <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.bundle.min.js " rel="stylesheet"></script>
    <title>Catálogo</title>
</head>
<body class="bg-light">

  <script>
        var appData = {
        uri_app : "<?= base_url() ?>",
        uri_ws  : "<?= base_url() ?>../webservice/",
        }
    </script>

<script>
    // Función para mostrar los detalles del producto
    function mostrarDetalles(id) {
 
 $.ajax({
    url: appData.uri_ws + "../webservice/backend/getdes",
    type: "POST",
    dataType: "json",
    data: {
        idproducto: id
    },
})
.done(function(obj) {
   
    var fotos = obj.fotos;
    var descripcion = obj.descripcion;
    var fotosHTML = "";


    for (var i = 0; i < fotos.length; i++) {
        var foto = fotos[i];

        var fotoKey = Object.keys(foto)[0];
        var fotoValue = foto[fotoKey];

        // Verifica si el objeto foto no está vacío
        if (Object.keys(foto).length !== 0) {
            if (fotoValue !== "") {
            

            // Agrega el HTML del carrusel para cada imagen
            fotosHTML += '<div class="carousel-item' + (i === 0 ? ' active' : '') + '">';
            fotosHTML += '<img src="' + appData.uri_app + 'static/images/producto/' + fotoValue + '" height="420px;" class="d-block w-100" alt="Imagen ' + (i + 1) + '">';
            fotosHTML += '</div>';
            }
        }
    }

    // Verifica si la descripción está vacía
    if (descripcion.length === 0 || Object.keys(descripcion[0]).length === 0 || descripcion[0].descripcion === "") {
        descripcion = "No hay descripción";
    } else {
        descripcion = descripcion[0].descripcion;
    }

    // Asigna el HTML del carrusel y la descripción a los elementos correspondientes
    document.getElementById('fotos').innerHTML = fotosHTML;
    document.getElementById('descripcion').textContent = descripcion;


});



    }

</script>
    

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
</style>

<a href="javascript:void(0);" id="scrollDown" class="scroll-button" title="Scroll to Bottom">
  <i class="fas fa-arrow-down"></i>
</a>

<a href="javascript:void(0);" id="scrollUp" class="scroll-button" title="Scroll to Top">
  <i class="fas fa-arrow-up"></i>
</a>





    <div class="container" >
        <nav class="navbar navbar-dark bg-brown mb-4 p-4 fixed-top">

            <div class="d-flex justify-content-between">
                <a href="<?= base_url() ?>frontend/catalogousux/"><img src="<?=base_url()?>static/images/logo.jpeg" style="height: 90px;" class="w-20 mr-auto" alt=""></a>
                <div class="bienvenida d-flex align-items-center" id="mensaje-bienvenida" >
                    <p class="text-white mx-4" >¡Hola amiguito! para agregar productos al carrito ingresa a tu cuenta</p> 
                </div>
              
            </div>
            <div class="form-inline">
                <input type="text" name="caja_busqueda" id="caja_busqueda" class="form-control mr-sm-2" placeholder="Buscar..."/>
            </div>
            <div class="botones" >
               
                <a href="<?=base_url()?>" class="btn bg-primary text-white" title="Inicio">
                    <i class="fa-solid fa-home text-white"></i>
                    Inicio
                </a>

                <a href="<?=base_url()?>acceso/login" class="btn bg-success text-white" title="Login">
                    <i class="fa-solid fa-sign-in-alt text-white"></i>
                    Login
                </a>

            </div>
        </nav>
        <br><br><br><br><br><br><br><br>


        <div class="d-flex mt-5">
            <h2>CATÁLOGO DE MUEBLES</h2>

        </div>


        <section class="principal">
            <div id="datos" >
            </div>
        </section>
    </div>


<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="detallesModalLabel">Detalles del producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carouselFotos" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" id="fotos"></div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselFotos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselFotos" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <br>
        <strong><p id="descripcion"></p></strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

   

    <script src="<?=base_url()?>static/js/muebles.js" ></script>
    <br><br><br><br><br><br>
</body>
</html>