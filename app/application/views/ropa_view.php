<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Catálogo de Ropa - Almacén La Pulga</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
    
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.bundle.min.js " rel="stylesheet"></script>
    <script src="<?=base_url()?>static/js/carritos.js" ></script>

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
            padding-top: 130px; /* Compensa la barra fija */
        }

        /* ==========================================================================
           BARRA DE AVISO (TOP BAR)
           ========================================================================== */
        .promo-bar {
            background-color: #9e1c28; /* Rojo oscuro */
            color: white;
            text-align: center;
            padding: 8px 10px;
            font-size: 0.9rem;
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
            top: 35px; /* Debajo de la barra de promo */
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

        /* Botones de acción (Inicio / Login) */
        .action-buttons .btn-nav {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-left: 10px;
        }

        .btn-home {
            background-color: rgba(255,255,255,0.2);
            color: white;
        }
        .btn-home:hover { background-color: rgba(255,255,255,0.3); color: white; transform: translateY(-2px); }

        .btn-login {
            background-color: white;
            color: var(--primary-color);
        }
        .btn-login:hover { background-color: #f1f1f1; color: var(--primary-color); transform: translateY(-2px); }

        /* Título del Catálogo */
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

        /* ==========================================================================
           BOTONES FLOTANTES DE SCROLL
           ========================================================================== */
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

        .scroll-button:hover {
            background: var(--primary-hover);
            transform: translateY(-3px);
        }

        #scrollDown { bottom: 80px; }
        #scrollUp { bottom: 20px; }

        /* ==========================================================================
           MODAL (DETALLES DEL PRODUCTO)
           ========================================================================== */
        .modal-content {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .modal-header {
            background-color: var(--primary-color) !important; /* Forzamos tu color rojo */
            border-bottom: none;
            padding: 15px 25px;
        }

        .modal-title { font-weight: 700; letter-spacing: 0.5px; }
        .btn-close { filter: invert(1); } /* Hace blanca la X de cerrar */

        .modal-body { padding: 25px; text-align: center; }
        
        .carousel-item img {
            border-radius: 10px;
            object-fit: contain; /* Para que la imagen del producto no se deforme */
            background-color: #fff;
        }

        #descripcion {
            margin-top: 20px;
            color: #555;
            font-size: 1rem;
            line-height: 1.5;
        }

        /* ==========================================================================
           RESPONSIVE MÓVIL (CORRECCIÓN DEFINITIVA DE ESPACIOS)
           ========================================================================== */
        @media (max-width: 768px) {
            body { padding-top: 260px !important; } 
            
            .catalog-navbar {
                top: 55px !important; 
            }

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

            .nav-logo-img {
                margin-bottom: 15px !important; 
                display: block !important;
            }

            .search-box {
                margin: 0 0 15px 0 !important; 
                width: 100% !important;
                max-width: 100% !important;
            }

            .action-buttons {
                display: flex !important;
                width: 100% !important;
                justify-content: space-between !important;
                gap: 10px !important;
            }
            
            .action-buttons .btn-nav {
                flex: 1 !important;
                justify-content: center !important;
                margin: 0 !important;
            }
        }
    </style>

    <script>
        var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
        }

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
</head>

<body>

    <a href="javascript:void(0);" id="scrollDown" class="scroll-button" title="Bajar">
        <i class="fas fa-arrow-down"></i>
    </a>
    <a href="javascript:void(0);" id="scrollUp" class="scroll-button" title="Subir">
        <i class="fas fa-arrow-up"></i>
    </a>

    <div class="promo-bar">
        <i class="fas fa-shopping-cart me-2"></i> ¡Hola amiguito! Para agregar productos al carrito ingresa a tu cuenta.
    </div>

    <nav class="catalog-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="<?= base_url() ?>frontend/catalogousux/">
                <img src="<?=base_url()?>static/images/logo.jpeg" class="nav-logo-img" alt="Almacén La Pulga">
            </a>
            
            <div class="search-box">
                <input type="text" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar ropa, tallas y más..."/>
            </div>

            <div class="action-buttons">
                <a href="<?=base_url()?>" class="btn-nav btn-home" title="Ir al Inicio">
                    <i class="fa-solid fa-home"></i> Inicio
                </a>
                <a href="<?=base_url()?>acceso/login" class="btn-nav btn-login" title="Iniciar Sesión">
                    <i class="fa-solid fa-sign-in-alt"></i> Login
                </a>
            </div>

        </div>
    </nav>

    <div class="container mt-4 mb-5">
        
        <h2 class="page-title">Catálogo de Ropa</h2>

        <section class="principal">
            <div id="datos"></div>
        </section>

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
                        <div class="carousel-inner" id="fotos">
                            </div>
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

            </div>
        </div>
    </div>

    <script src="<?=base_url()?>static/js/ropa.js" ></script>
    
</body>
</html>