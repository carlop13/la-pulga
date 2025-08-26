  <script type='text/javascript'>
      $(document).ready(function(){ 
          $(window).scroll(function(){ 
              if ($(this).scrollTop() > 100) { 
                  $('#scroll').fadeIn(); 
              } else { 
                  $('#scroll').fadeOut(); 
              } 
          }); 
          $('#scroll').click(function(){ 
              $("html, body").animate({ scrollTop: 0 }, 600); 
              return false; 
          }); 
      });
      </script>

<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>

<div class="p-2  bg-secondary text-white">

        
        <ul class="menu">
            <li class="col col-md-3">
                <i class="fas fa-phone-alt"></i>
                Llamanos al: 742-100-48-43
            </li>
            <li class="col col-md-8">
                <i class="fas fa-truck"></i>
                Envío a domicilio
            </li>
          </ul>
         
          
        
    </div>

 <nav class="navbar navbar-expand-md navbar-dark flex-fill roundeds" style="background-color: brown; filter: brightness(1.1);">
        <a class="navbar-brand" href="#"> &nbsp;&nbsp; Almacén La Pulga&nbsp;&nbsp;</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto menu">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="#">Inicio
              <span class="border border-top"></span>
              <span class="border border-right"></span>
              <span class="border border-bottom"></span>
              <span class="border border-left"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?=base_url()?>frontend/catalogousux">Productos
              <span class="border border-top"></span>
              <span class="border border-right"></span>
              <span class="border border-bottom"></span>
              <span class="border border-left"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?=base_url()?>acceso/login">Iniciar sesión
              <span class="border border-top"></span>
              <span class="border border-right"></span>
              <span class="border border-bottom"></span>
              <span class="border border-left"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#contactos">Contactos
                       <span class="border border-top"></span>
                        <span class="border border-right"></span>
                        <span class="border border-bottom"></span>
                        <span class="border border-left"></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

<section style="background-color: #f4f4f4;" >
  &nbsp;
</section>

<section style="background-color: brown; filter: brightness(1.1);" class="text-center">
 <br>
        <a href="#">
          <img src="<?=base_url()?>static/images/logo.jpeg" style="height: 100px;" />
        </a>

        <br><br>
</section>

<style>
 
</style>

<?php 

$fot=$this->db->select("foto")->from("carrusel")->where("id",1)->get()->result_array();
$foto1=$fot["0"]["foto"];

$fot=$this->db->select("foto")->from("carrusel")->where("id",2)->get()->result_array();
$foto2=$fot["0"]["foto"];

$fot=$this->db->select("foto")->from("carrusel")->where("id",3)->get()->result_array();
$foto3=$fot["0"]["foto"];

?>

 <!--Carrusel-->
 <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="bd-placeholder-img" width="100%" height="600px" src="<?=base_url()?>static/images/<?=$foto1?>" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="5%" fill="#777"/></svg>

        <div class="container">
         
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="600px" src="<?=base_url()?>static/images/<?=$foto2?>" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="5%" fill="#777"/></svg>

        <div class="container">
          
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="600px" src="<?=base_url()?>static/images/<?=$foto3?>" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="5%" fill="#777"/></svg>

        <div class="container">
          
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  
<br />
 <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

<style>
    .collection-image {
      position: relative;
      overflow: hidden;
      height: 0;
      padding-bottom: 75%; /* Proporción 4:3 para hacer las imágenes más pequeñas */
    }
    
    .collection-item__title {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 10px;
      color: #fff;
      font-family: Arial, sans-serif;
      font-size: 60px;
      text-align: center;
      transition: all 5s ease; /* Animación más lenta */
    }
    
    .collection-image img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ajustar imagen al contenedor sin deformarla */
      transition: transform 0.9s ease-in-out, filter 0.9s ease-in-out; /* Agrega transiciones a transform y filter */
    }

    .collection-image:hover img {
      transform: scale(1.1);
      filter: brightness(40%); /* Imagen más oscura */
    }

    .collection-image:not(:hover) img {
      transform: scale(1);
      filter: brightness(80%); /* Imagen con brillo completo */
    }
  </style>


  <section>
    <div class="container">
    <div class="row">
      <div class="col-md-6 mt-2">
        <div class="collection-image d-flex">
          <a href="<?=base_url()?>frontend/muebles">
            <img src="<?=base_url()?>static/images/producto/es.jpg" alt="Muebles" class="img-fluid">
            <span class="collection-item__title">Muebles</span>
          </a>
        </div>
      </div>

      <div class="col-md-6 mt-2">
        <div class="collection-image d-flex">
          <a href="<?=base_url()?>frontend/decoracion">
            <img src="<?=base_url()?>static/images/producto/dec.jpg" alt="Decoración" class="img-fluid">
            <span class="collection-item__title">Decoración</span>
          </a>
        </div>
      </div>

      <div class="col-md-6 mt-2 mb-2">
        <div class="collection-image d-flex">
          <a href="<?=base_url()?>frontend/ropa">
            <img src="<?=base_url()?>static/images/producto/short.jpg" alt="Ropa" class="img-fluid">
            <span class="collection-item__title">Ropa</span>
          </a>
        </div>
      </div>

      <div class="col-md-6 mt-2 mb-2">
        <div class="collection-image d-flex">
          <a href="<?=base_url()?>frontend/calzado">
            <img src="<?=base_url()?>static/images/producto/calzado.jpg" alt="Calzado" class="img-fluid">
            <span class="collection-item__title">Calzado</span>
          </a>
        </div>
      </div>

      <div class="col-md-6 mt-2 mb-2">
        <div class="collection-image d-flex">
          <a href="<?=base_url()?>frontend/juguetes">
            <img src="<?=base_url()?>static/images/producto/jug.jpg" alt="Juguetes" class="img-fluid">
            <span class="collection-item__title">Juguetes</span>
          </a>
        </div>
      </div>

      <div class="col-md-6 mt-2 mb-2">
        <div class="collection-image d-flex">
          <a href="<?=base_url()?>frontend/otro">
            <img src="<?=base_url()?>static/images/producto/cun.jpg" alt="Otras Cosas" class="img-fluid">
            <span class="collection-item__title">Otras Cosas</span>
          </a>
        </div>
      </div>
      
    </div>
  </div>
  </section>

  <div class="container marketing mt-5">

    <!-- Three columns of text below the carousel -->
  <div class="row">
        <center><h2>Aquí estamos ubicados</h2></center> 

        <center><div id="mapa" style="height: 400px;border-style: solid;border-width: 5px;"></div></center>
     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ7TvV1KlSm2HKZbZ0GvkovPDFkV1O-0Y&callback=cargaMapa" 
    type="text/javascript"></script>
      
    </div><!-- /.row -->
    </div>




 </div>
 <hr  /><!--Linea horizontal-->

<div class="p-1  bg-secondary text-white mt-5">

    
    <div class="container marketing mt-5">

        <!-- Three columns of text below the carousel -->
        <div class="row">
    
          <div class="col col-lg-4 mt-1">
            <center><i class="fas fa-truck fa-4x"></i><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em"></text></svg>
    
            <h4 class="fw-normal">Envío a domicilio</h4>
            <p> Nuestro servicio de envío a domicilio garantiza que tus productos lleguen a tu casa.</p>
          </div></center><!-- /.col-lg-4 -->
          <div class="col col-lg-4 mt-1">
            <center><i class="fas fa-money-check-alt fa-4x"></i><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em"></text></svg>
    
            <h4 class="fw-normal">Pagos seguros</h4>
            <p> Cada compra es segura gracias a nuestros excelentes estándares de seguridad en línea. </p>
          </div></center><!-- /.col-lg-4 -->
          <div class="col col-lg-4 mt-1">
            <center><i class="fas fa-check-circle fa-4x"></i><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em"></text></svg>
    
            <h4 class="fw-normal">Buena calidad</h4>
            <p>Nuestra selección de productos garantiza calidad y satisfacción para tus necesidades. </p>
          </div></center><!-- /.col-lg-4 -->
          
        </div><!-- /.row -->
        </div>
     
      
    
</div>

<!--Pie de pagina-->
<footer class="text-center text-white mt-5" style="background-color: brown; filter: brightness(1.1);">
<!-- Grid container -->
<div class="container p-4 pb-0">
<!-- Section: Social media -->
<section class="mb-4">
  <!-- Facebook -->
  <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/profile.php?id=100073360505667&mibextid=ZbWKwL" role="button" target="_blank"
    ><i class="fab fa-facebook-f"></i
  ></a>

  <!-- WhatsApp -->
  <a class="btn btn-outline-light btn-floating m-1" href="https://wa.me/527421004843" role="button" target="_blank"
    ><i class="fab fa-whatsapp"></i></a>

  <!-- Instagram -->
  <a class="btn btn-outline-light btn-floating m-1" href="https://instagram.com/la_pulga_almacen?igshid=ZDdkNTZiNTM=" role="button" target="_blank"
    ><i class="fab fa-instagram"></i
  ></a>



</section>

<!-- Section: Links  -->
<section class="">
<div class="container text-center text-md-start mt-5">
<!-- Grid row -->
<div class="row mt-3">
<!-- Grid column -->
<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
  <!-- Content -->
  <h6 class="text-uppercase fw-bold mb-4">
    <i class="fas fa-gem me-3"></i>Almacén La Pulga
  </h6>
  <p>
   Explora nuestra tienda online y descubre una amplia variedad de artículos para el hogar. Desde elegantes muebles hasta accesorios de decoración, disfruta de la comodidad de comprar desde casa y encuentra los mejores artículos americanos para tu hogar en nuestra tienda online.
  </p>
</div>
<!-- Grid column -->

<!-- Grid column -->
<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
  <!-- Links -->
  <h6 class="text-uppercase fw-bold mb-4">
    Productos
  </h6>
  <p>
    <a href="#!" class="text-reset">Muebles</a>
  </p>
  <p>
    <a href="#!" class="text-reset">Ropa</a>
  </p>
  <p>
    <a href="#!" class="text-reset">Decoración</a>
  </p>
  <p>
    <a href="#!" class="text-reset">Calzado</a>
  </p>
  <p>
    <a href="#!" class="text-reset">Juguetes</a>
  </p>
</div>
<!-- Grid column -->



<!-- Grid column -->
<div class="col-md-45 col-lg-6 col-xl-4 mx-auto mb-md-0 mb-2">
  <!-- Links -->
  <h6 id="contactos" class="text-uppercase fw-bold mb-4">
    Contactos
  </h6>
  <p><i class="fas fa-home me-3"></i> Col. Aguas Blancas. mpio. de tecpan de Galeana Gro., México</p>
  <p>
    <i class="fas fa-envelope me-3"></i>
 <a href='mailto:almacen.la.pulga@gmail.com'>almacen.la.pulga@gmail.com</a>
  </p>
  <p><i class="fas fa-phone me-3"></i> <a href="tel:742 100 48 43">742 100 48 43</a> - Anahí Pérez Rivera Directora General</p>

</div>
<!-- Grid column -->
</div>
<!-- Grid row -->
</div>
</section>
<!-- Section: Links  -->

<br><br><br>

<!-- Section: CTA -->
</div>

    
                      

<!-- Copyright -->
<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
© 2023, Almacén La Pulga, Inc. o afiliados. Todos los derechos reservados.
</div>
<!-- Copyright -->
</footer>