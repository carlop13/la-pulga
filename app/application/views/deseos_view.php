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
    <title>Lista de deseos</title>
</head>
    <body>

    <script>
            var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
            idusuario : "<?= $this->session->id_cli ?>",
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
                <h2>LISTA DE DESEOS</h2>

            </div>
            <script>
                mostrar_deseos();
            </script>


            <section class="principal">
                <div id="datos-deseos" >
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

        <script src="<?=base_url()?>static/js/productos.js" ></script>
         <br><br><br><br><br><br>
    </body>
</html>

