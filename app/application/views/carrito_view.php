<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta author="Carlos Guadalupe López Trejo">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Carrito de Compras - Almacén La Pulga</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
    
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.bundle.min.js " rel="stylesheet"></script>
    <script src="<?=base_url()?>static/js/carritos.js" ></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AU9e4AZ7J-dzswQKAfVQH9yQl87vDSg9hqlnO-WXgA7af5gG0YBYCdUOCU5CB3JuIW2MP-psq9s-di6F&currency=MXN"></script>

    <script>
        var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
            idusuario : "<?= $this->session->id_cli ?>",
        }
    </script>

    <script>
        function mostrarDetalles(id) {
            $.ajax({
                url: appData.uri_ws + "../webservice/backend/getdes",
                type: "POST",
                dataType: "json",
                data: { idproducto: id },
            }).done(function(obj) {
                var fotos = obj.fotos;
                var descripcion = obj.descripcion;
                var fotosHTML = "";

                for (var i = 0; i < fotos.length; i++) {
                    var foto = fotos[i];
                    var fotoKey = Object.keys(foto)[0];
                    var fotoValue = foto[fotoKey];

                    if (Object.keys(foto).length !== 0 && fotoValue !== "") {
                        fotosHTML += '<div class="carousel-item' + (i === 0 ? ' active' : '') + '">';
                        fotosHTML += '<img src="' + appData.uri_app + 'static/images/producto/' + fotoValue + '" height="350px" class="d-block w-100" alt="Imagen ' + (i + 1) + '">';
                        fotosHTML += '</div>';
                    }
                }

                if (descripcion.length === 0 || Object.keys(descripcion[0]).length === 0 || descripcion[0].descripcion === "") {
                    descripcion = "No hay descripción del producto.";
                } else {
                    descripcion = descripcion[0].descripcion;
                }

                document.getElementById('fotos').innerHTML = fotosHTML;
                document.getElementById('descripcion').textContent = descripcion;
            });
        }
    </script>

    <style>
        /* ==========================================================================
           VARIABLES Y BASE
           ========================================================================== */
        :root {
            --primary-color: #bf2c3b; 
            --primary-hover: #9f2430; 
            --secondary-bg: #f8f9fa;
        }

        body {
            background-color: var(--secondary-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 130px; 
        }

        /* ==========================================================================
           BARRA DE AVISO (TOP BAR)
           ========================================================================== */
        .promo-bar {
            background-color: #9e1c28; 
            color: white;
            text-align: center;
            padding: 8px 10px;
            font-size: 0.95rem;
            font-weight: 500;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1040;
            letter-spacing: 0.5px;
        }

        /* ==========================================================================
           NAVBAR DEL CATÁLOGO
           ========================================================================== */
        .catalog-navbar {
            background-color: var(--primary-color);
            position: fixed;
            top: 35px; 
            width: 100%;
            z-index: 1030;
            padding: 10px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .nav-logo-img {
            height: 55px;
            width: 55px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Buscador Modernizado */
        .search-box {
            position: relative;
            flex-grow: 1;
            max-width: 500px;
            margin: 0 20px;
        }

        .search-box input {
            width: 100%;
            border-radius: 25px;
            padding: 10px 20px;
            border: none;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
            outline: none;
        }

        .search-box input:focus {
            box-shadow: 0 0 0 3px rgba(255,255,255,0.4);
        }

        /* ==========================================================================
           BOTONES DE USUARIO (Diseño circular moderno)
           ========================================================================== */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-action-icon {
            position: relative;
            color: white;
            font-size: 1.2rem;
            background: rgba(255, 255, 255, 0.2);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-action-icon:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Globo de notificaciones (Carrito y Deseos) */
        .badge-counter {
            position: absolute;
            top: -4px;
            right: -4px;
            background-color: #ffc107; 
            color: #333;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 18px;
            min-height: 18px;
            display: none; /* Oculto por defecto, el JS lo mostrará si > 0 */
        }

        /* Botón Cerrar Sesión Estilo Píldora */
        .btn-logout {
            background-color: #212529; 
            color: white;
            border-radius: 25px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-logout:hover {
            background-color: #000;
            color: white;
            transform: translateY(-2px);
        }

        /* ==========================================================================
           TÍTULO, MODAL Y PAYPAL
           ========================================================================== */
        .page-title {
            color: var(--primary-color);
            font-weight: 800;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }
        .page-title::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50%;
            height: 3px;
            background-color: var(--primary-color);
        }

        /* Botones de Scroll Flotantes */
        .scroll-button {
            display: none;
            position: fixed;
            right: 20px;
            z-index: 999;
            width: 45px;
            height: 45px;
            text-align: center;
            background: var(--primary-color);
            color: #fff !important;
            border-radius: 50%;
            font-size: 20px;
            line-height: 45px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .scroll-button:hover { background: var(--primary-hover); transform: translateY(-3px); }
        #scrollDown { bottom: 80px; }
        #scrollUp { bottom: 20px; }

        /* Estilos del Modal */
        .modal-content { border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.2); }
        .modal-header { background-color: var(--primary-color) !important; border-bottom: none; padding: 15px 25px; }
        .modal-title { font-weight: 700; letter-spacing: 0.5px; color: white;}
        .btn-close { filter: invert(1); }
        .modal-body { padding: 25px; text-align: center; }
        .carousel-item img { border-radius: 10px; object-fit: contain; background-color: #fff; }
        #descripcion { margin-top: 20px; color: #555; font-size: 1rem; line-height: 1.5; }

        #modal-mapa .modal-header { background-color: var(--primary-color) !important; }

        /* CAJA BLANCA DE PAYPAL */
        .paypal-wrapper {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        /* ==========================================================================
           RESPONSIVE MÓVIL
           ========================================================================== */
        @media (max-width: 768px) {
            body { padding-top: 260px !important; } 
            
            .catalog-navbar { top: 55px !important; }

            .promo-bar {
                height: 56px !important; 
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .catalog-navbar .container {
                flex-direction: column !important;
                align-items: center !important;
            }

            .nav-logo-img { margin-bottom: 15px !important; display: block !important; }

            .search-box {
                margin: 0 0 15px 0 !important; 
                width: 100% !important;
                max-width: 100% !important;
            }

            .action-buttons {
                display: flex !important;
                width: 100% !important;
                justify-content: center !important;
                flex-wrap: wrap !important;
                gap: 10px !important;
            }
            
            .btn-action-icon {
                width: 38px;
                height: 38px;
                font-size: 1rem;
            }

            .logout-text { display: none; }
            .btn-logout { padding: 8px 12px; border-radius: 50%; }
        }
    </style>
</head>

<body>

    <a href="javascript:void(0);" id="scrollDown" class="scroll-button" title="Bajar">
        <i class="fas fa-arrow-down"></i>
    </a>
    <a href="javascript:void(0);" id="scrollUp" class="scroll-button" title="Subir">
        <i class="fas fa-arrow-up"></i>
    </a>

    <div class="promo-bar">
        <i class="fas fa-user-circle me-2"></i> Bienvenido(a): <strong><?= $this->session->nombre ?></strong>
    </div>

    <nav class="catalog-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>">
                <img src="<?=base_url()?>static/images/logo.jpeg" class="nav-logo-img" alt="Almacén La Pulga">
            </a>
            
            <div class="search-box">
                <input type="text" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar productos en tu carrito..."/>
            </div>

            <div class="action-buttons">
                <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Catálogo">
                    <i class="fa-solid fa-store"></i>
                </a>

                <a href="<?= base_url() ?>frontend/deseos/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Lista de deseos">
                    <i class="fa-solid fa-heart"></i>
                    <script>actualizarCantidadD( <?= $this->session->id_cli ?> );</script>
                    <span id="cantidadDeseos" class="badge-counter"></span>
                </a>

                <a href="<?= base_url() ?>frontend/historial/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Historial de compras">
                    <i class="fa-solid fa-list-alt"></i>
                </a>

                <a href="<?= base_url() ?>frontend/ajuste/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Perfil">
                    <i class="fa-solid fa-user"></i>
                </a>

                <a href="<?= base_url() ?>frontend/carrito/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" style="background: white; color: var(--primary-color);" title="Carrito de compras">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <script>actualizarCantidad( <?= $this->session->id_cli ?> );</script>
                    <span id="cantidadCarrito" class="badge-counter"></span>
                </a>

                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn-logout" title="Cerrar sesión">
                    <i class="fa-solid fa-right-from-bracket"></i> <span class="logout-text">Salir</span>
                </a>
            </div>

        </div>
    </nav>

    <div class="container mt-4 mb-5">
        
        <h2 class="page-title">Carrito de Compras</h2>

        <script>
            mostrar_carrito();
        </script>

        <section class="principal">
            <div id="datos-carrito"></div>
        </section>

        <div class="paypal-wrapper mt-5" id="caja-paypal" style="display: none;">
            <h4 class="mb-4" style="color: var(--primary-color); font-weight: 700;">Finalizar Compra Segura</h4>
            <div id="paypal-button-container" class="paypal-button"></div>
        </div>
        
    </div>

    <script>
        $(document).ready(function(){
            $.ajax({
                "url" : appData.uri_ws+"../webservice/Backend/getcar/"+appData.idusuario,
                "dataType" : "json",
                "type" : "GET"
            })
            .done(function(obj){
                if (obj.resultado) {
                    
                    // ! MAGIA AQUÍ: Muestra la caja blanca solo si hay productos
                    $("#caja-paypal").fadeIn(); 

                    paypal.Buttons({
                        style:{
                            color: 'blue',
                            shape: 'pill',
                            label: 'pay'
                        },
                        createOrder: function( data , actions ){
                            return actions.order.create({
                                purchase_units : [{
                                    amount:{
                                        value:$("#totalcar").val(), 
                                        currency_code: "MXN"
                                    }
                                }]
                            });
                        },
                        onApprove: function( data, actions ){
                            actions.order.capture().then(function (detalles){
                                comprarealizada($("#totalcar").val());
                            });
                        },
                        onCancel: function(data){
                            alert( "Pago cancelado" );
                            console.log(data);
                        }
                    }).render( '#paypal-button-container' );
                }
            })
            .fail(function(err){
                console.log("Ocurrió un error consultando el carrito", err);
            });
        }); 
    </script>

    <?php 
    $consulta = $this->db->select("nombre,ap,am")->from("cliente")->where("id",$this->session->id_cli)->get()->result_array();
    $nombre = $consulta["0"]["nombre"];
    $ap = $consulta["0"]["ap"];
    $am = $consulta["0"]["am"];
    ?>

    <div class="modal fade" id="modal-mapa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="modal-mapa-titulo"><i class="fas fa-map-marker-alt me-2"></i> <?=$nombre?> <?=$ap?> <?=$am?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-formato-body">
                    <div class="d-flex justify-content-center flex-column text-center">
                        <p class="mb-3 text-muted fw-bold">Haz clic en el mapa para crear o actualizar tu posición de entrega.</p>
                        <div class="row justify-content-center">
                            <div id="mapa" class="border border-2 rounded col-md-10 shadow-sm" style="height: 500px; border-color: var(--primary-color) !important;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: center; border-top: none;">
                    <button type="button" class="btn btn-secondary" style="border-radius: 20px; padding: 8px 25px;" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cerrar
                    </button>
                    <button type="button" class="btn btn-success" id="btn-guardar" style="border-radius: 20px; padding: 8px 25px; background-color: #28a745; border: none;">
                        <i class="fas fa-save me-2"></i>Guardar Ubicación
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="detallesModalLabel"><i class="fas fa-info-circle me-2"></i> Detalles del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div id="carouselFotos" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="fotos"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFotos" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselFotos" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                    <div id="descripcion"></div>
                </div>

                <div class="modal-footer" style="border-top: none; justify-content: center;">
                    <button type="button" class="btn btn-secondary" style="border-radius: 20px; padding: 8px 30px;" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<script>
        setInterval(function() {
            // 1. Ocultar/Mostrar globitos amarillos
            $('.badge-counter').each(function() {
                var valor = $(this).text().trim();
                if (valor === "" || valor === "0") {
                    $(this).hide();
                } else {
                    $(this).css('display', 'flex');
                }
            });

            // 2. Ocultar la caja de PayPal automáticamente si el carrito se vacía
            var cantidad = $('#cantidadCarrito').text().trim();
            if (cantidad === "" || cantidad === "0") {
                if ($('#caja-paypal').is(':visible')) {
                    $('#caja-paypal').fadeOut();
                }
            }
        }, 500); 
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(window).scroll(function() {
                var scrollPosition = $(window).scrollTop();
                var windowHeight = $(window).height();
                var documentHeight = $(document).height();

                if (scrollPosition < windowHeight) {
                    $('#scrollDown').fadeIn();
                } else {
                    $('#scrollDown').fadeOut();
                }

                if (scrollPosition + windowHeight >= documentHeight - 50) {
                    $('#scrollUp').fadeIn();
                } else {
                    $('#scrollUp').fadeOut();
                }
            });

            $('#scrollDown').click(function() {
                $('html, body').animate({ scrollTop: $(document).height() }, 600);
                return false;
            });

            $('#scrollUp').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 600);
                return false;
            });
        });
    </script>

    <script src="<?=base_url()?>static/js/productos.js" ></script>
    <script src="<?=base_url()?>static/js/ubi.js?v=3" ></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9NVdgMz2GdZa-UEpa4fyHkjcO0b60xiQ&callback=iniciomapa" type="text/javascript"></script>
    
</body>
</html>