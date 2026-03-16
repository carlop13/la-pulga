<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Ajustes de Cuenta - Almacén La Pulga</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
    <link href="<?=base_url()?>static/css/alert.css" rel="stylesheet">
    
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>static/js/mensajes.js" ></script>
    <script src="<?=base_url()?>static/js/carritos.js" ></script>

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
            display: none;
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
           TÍTULO Y MODALES
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

        /* Estilo de la Tarjeta de Tabla */
        .settings-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 30px;
        }

        .table-custom th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
        }

        .table-custom td {
            vertical-align: middle;
        }

        /* Modal Borrar Modernizado */
        #modal-borrar .modal-content {
            border-radius: 15px;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        #modal-borrar .modal-header {
            background-color: #dc3545;
            color: white;
            border-bottom: none;
        }
        #modal-borrar .btn-close { filter: invert(1); }

        .alert-dismissible {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
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
            
            .btn-action-icon { width: 38px; height: 38px; font-size: 1rem; }
            .logout-text { display: none; }
            .btn-logout { padding: 8px 12px; border-radius: 50%; }
            
            .settings-card { padding: 10px; }
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
                <input type="text" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar productos..."/>
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

                <a href="<?= base_url() ?>frontend/ajuste/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" style="background: white; color: var(--primary-color);" title="Perfil">
                    <i class="fa-solid fa-user"></i>
                </a>

                <a href="<?= base_url() ?>frontend/carrito/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Carrito de compras">
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
        
        <h2 class="page-title">Ajustes de Cuenta</h2>

        <div class="settings-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-custom mb-0 text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha de registro</th>
                            <th>Nombre de usuario</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$nombre?> <?=$ap?> <?=$am?></td>
                            <td><?=$correo?></td>
                            <td><?=$fec_registro?></td>
                            <td><?=$usuario?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?=base_url()?>frontend/modatos/<?=$this->session->id_usu?>/<?=$this->session->token?>" class="btn btn-primary btn-sm" style="border-radius: 20px; padding: 5px 15px;" title="Modificar datos">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btn-borrar" data-bs-toggle="modal" data-bs-target="#modal-borrar" style="border-radius: 20px; padding: 5px 15px;" title="Eliminar cuenta">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal-borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Eliminar cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <p class="mb-0 fw-bold text-secondary">¿Realmente quieres eliminar tu cuenta? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0 pb-4">
                    <button type="button" class="btn btn-secondary" style="border-radius: 20px;" data-bs-dismiss="modal">
                        <i class="fas fa-ban me-1"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-danger" style="border-radius: 20px;" data-bs-dismiss="modal" id="btn-eliminar">
                        <i class="fas fa-trash me-1"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px; right:20px; z-index: 1060;"></div>

    <script>
        setInterval(function() {
            $('.badge-counter').each(function() {
                var valor = $(this).text().trim();
                if (valor === "" || valor === "0") {
                    $(this).hide();
                } else {
                    $(this).css('display', 'flex');
                }
            });
        }, 500); 
    </script>

    <script src="<?=base_url()?>static/js/ajustes.js" ></script>

</body>
</html>