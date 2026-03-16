<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Carlos Guadalupe López Trejo">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Historial de Compras - Almacén La Pulga</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
    <link href="<?=base_url()?>static/css/alert.css" rel="stylesheet">
    
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js"></script>
    <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>static/js/mensajes.js"></script>
    <script src="<?=base_url()?>static/js/carritos.js"></script>
    
    <script src="<?=base_url()?>static/js/historial.js"></script>

    <script>
        var appData = {
            uri_app: "<?= base_url() ?>",
            uri_ws: "<?= base_url() ?>../webservice/",
            correo: "<?=$this->session->correo ?>",
            nombre: "<?= $this->session->nombre ?>",
            token: "<?=$this->session->token ?>",
            id_usu: "<?=$this->session->id_usu ?>",
            id_cli: "<?=$this->session->id_cli ?>"
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
           NAVBAR MODERNO
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

        .search-box {
            position: relative;
            flex-grow: 1;
            max-width: 500px;
            margin: 0 20px;
            visibility: hidden; /* Se mantiene oculto pero deja el espacio */
        }

        /* Botones de acción circulares */
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
        
        .btn-logout:hover { background-color: #000; color: white; transform: translateY(-2px); }

        /* ==========================================================================
           TÍTULO Y TABLA DE HISTORIAL
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
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            height: 3px;
            background-color: var(--primary-color);
        }

        /* Tarjeta Blanca para la Tabla */
        .settings-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 50px;
        }

        /* Estilos de Tabla Mejorados */
        .table-custom th {
            background-color: var(--primary-color); /* Encabezado Rojo La Pulga */
            color: white;
            font-weight: 600;
            border: none;
            text-align: center;
        }

        .table-custom td {
            vertical-align: middle;
            text-align: center;
        }

        /* Ajustes botones dentro de la tabla */
        .table-custom .btn {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.85rem;
        }

        /* ==========================================================================
           RESPONSIVE MÓVIL
           ========================================================================== */
        @media (max-width: 768px) {
            body { padding-top: 220px !important; } 
            
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

            .search-box { display: none; }

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

    <div class="promo-bar">
        <i class="fas fa-user-circle me-2"></i> Bienvenido(a): <strong><?= $this->session->nombre ?></strong>
    </div>

    <nav class="catalog-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>">
                <img src="<?=base_url()?>static/images/logo.jpeg" class="nav-logo-img" alt="Almacén La Pulga">
            </a>
            
            <div class="search-box"></div>

            <div class="action-buttons">
                <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Catálogo">
                    <i class="fa-solid fa-store"></i>
                </a>

                <a href="<?= base_url() ?>frontend/deseos/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Lista de deseos">
                    <i class="fa-solid fa-heart"></i>
                    <script>actualizarCantidadD( <?= $this->session->id_cli ?> );</script>
                    <span id="cantidadDeseos" class="badge-counter"></span>
                </a>

                <a href="<?= base_url() ?>frontend/historial/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" style="background: white; color: var(--primary-color);" title="Historial de compras">
                    <i class="fa-solid fa-list-alt"></i>
                </a>

                <a href="<?= base_url() ?>frontend/ajuste/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Perfil">
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
        
        <div class="text-center">
            <h2 class="page-title">Historial de Compras</h2>
            <p class="text-muted mb-4">Revisa el detalle y estado de tus compras anteriores.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                
                <div class="settings-card">
                    <div class="table-responsive">
                        
                        <table class="table table-hover align-middle table-custom mb-0" id="tabla-productos">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Productos</th>
                                    <th>Total</th>
                                    <th>Ver detalle</th>
                                    <th>Factura PDF</th>
                                    <th>Factura XML</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>
        </div>

    </div>

   <div id="mensajee" class="position-fixed d-flex flex-column-reverse" style="bottom: 20px; right: 20px; z-index: 1060; width: 400px; max-width: calc(100vw - 40px);"></div>

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

</body>
</html>