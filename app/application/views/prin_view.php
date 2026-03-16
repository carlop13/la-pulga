<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacén La Pulga</title>
    <style>
        /* ==========================================================================
           VARIABLES Y TIPOGRAFÍA
           ========================================================================== */
        :root {
            --primary-color: #bf2c3b; /* Rojo base */
            --topbar-color: #9e1c28; /* Un rojo más oscuro/fuerte para arriba */
            --primary-hover: #9f2430; 
            --secondary-bg: #f8f9fa;
            --text-dark: #333;
            --text-light: #fff;
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #ffffff;
            color: var(--text-dark);
            padding-top: 0; 
            overflow-x: hidden;
        }

        /* ==========================================================================
           BARRA SUPERIOR (TOP BAR) - AHORA ROJA
           ========================================================================== */
        .top-bar {
            background-color: var(--topbar-color);
            color: #ffffff; /* Texto blanco */
            font-size: 0.85rem;
            padding: 8px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 35px;
            z-index: 1040;
        }
        
        .top-bar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Iconos blancos en la top-bar */
        .top-bar i { color: #ffffff; margin-right: 5px; } 

        /* ==========================================================================
           NAVEGACIÓN (NAVBAR FINA Y FIJA)
           ========================================================================== */
        .navbar-custom {
            background-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: fixed;
            top: 35px; /* Debajo del top-bar de escritorio */
            left: 0;
            right: 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            padding: 10px 15px !important;
            position: relative;
            transition: color 0.3s ease;
        }

        /* Efecto de línea debajo del link (Solo PC) */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after, .nav-item.active .nav-link::after {
            width: 80%;
        }

        /* ==========================================================================
           CARRUSEL
           ========================================================================== */
        .carousel-item img {
            height: 60vh; 
            min-height: 400px;
            object-fit: cover;
            filter: brightness(0.85); 
        }

        /* ==========================================================================
           GALERÍA DE CATEGORÍAS (CARDS MODERNAS)
           ========================================================================== */
        .category-section {
            padding: 60px 0;
            background-color: var(--secondary-bg);
        }

        .category-card {
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            display: block;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            aspect-ratio: 4/3; 
            background-color: #fff;
            text-decoration: none;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .category-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .category-card:hover .category-img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
            padding: 30px 20px 20px 20px;
            text-align: center;
        }

        .category-title {
            color: #fff;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        /* ==========================================================================
           CARACTERÍSTICAS / BENEFICIOS (FEATURES)
           ========================================================================== */
        .features-section {
            padding: 60px 0;
            background-color: #fff;
        }

        .feature-box {
            text-align: center;
            padding: 30px 20px;
            border-radius: 15px;
            background-color: var(--secondary-bg);
            transition: transform 0.3s ease;
            height: 100%;
            border: 1px solid #eee;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            font-size: 2rem;
            color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(191, 44, 59, 0.15); 
        }

        .feature-box h4 {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .feature-box p {
            color: #666;
            font-size: 0.95rem;
            margin: 0;
        }

        /* ==========================================================================
           MAPA
           ========================================================================== */
        .map-section {
            padding: 60px 0;
            background-color: var(--secondary-bg);
        }

        .section-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 40px;
            color: var(--text-dark);
            text-transform: uppercase;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 400px;
        }

        /* ==========================================================================
           FOOTER 
           ========================================================================== */
        .footer-custom {
            background-color: #4d1218; 
            color: #fff;
            padding-top: 60px;
        }

        .footer-custom h6 {
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .footer-custom p, .footer-custom a {
            color: #ccc;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-custom a:hover {
            color: #fff;
        }

        .footer-social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.1);
            color: #fff;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .footer-social-btn:hover {
            background-color: var(--primary-color);
            color: #fff;
            transform: translateY(-3px);
        }

        .footer-bottom {
            background-color: rgba(0,0,0,0.3);
            padding: 20px 0;
            margin-top: 40px;
            font-size: 0.85rem;
            color: #aaa;
        }

        /* ==========================================================================
           BOTÓN SCROLL TO TOP 
           ========================================================================== */
        #scroll {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: #fff !important; /* Fuerza el color blanco */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            z-index: 1050;
            transition: all 0.3s ease;
            font-size: 1.5rem; /* Tamaño más grande para la flecha */
        }

        #scroll:hover {
            background-color: var(--primary-hover);
            transform: translateY(-5px);
            color: #fff;
        }
        
        /* ==========================================================================
           MEDIA QUERIES - AJUSTES DE RESPONSIVIDAD
           ========================================================================== */
        /* Escritorio (Navbar + Top Bar) */
        @media (min-width: 769px) {
            body { padding-top: 110px; } 
        }

        /* Móvil (Navbar solo + Top Bar d-none) */
        @media (max-width: 768px) {
            body { padding-top: 60px; } 
            
            .navbar-custom { top: 0; } 
            
            .category-title { font-size: 1.2rem; }

            /* QUITA LA LÍNEA DE LOS LINKS EN CELULAR */
            .nav-link::after {
                display: none !important;
                content: none !important;
            }
        }
    </style>
</head>
<body>

    <a href="#" id="scroll" title="Subir al inicio" style="display: none;">
        <i class="fas fa-arrow-up"></i>
    </a>

    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="top-bar-content">
                <div>
                    <span class="me-4"><i class="fas fa-phone-alt"></i> 742-100-48-43</span>
                    <span><i class="fas fa-envelope"></i> almacen.la.pulga@gmail.com</span>
                </div>
                <div>
                    <span><i class="fas fa-truck"></i> Envío seguro a domicilio</span>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?=base_url()?>static/images/logo.jpeg" alt="Logo La Pulga" width="40" height="40" class="rounded-circle" style="object-fit: cover;">
                Almacén La Pulga
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>frontend/catalogousux">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>acceso/login">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactos">Contactos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php 
    $fot=$this->db->select("foto")->from("carrusel")->where("id",1)->get()->result_array();
    $foto1=$fot["0"]["foto"];

    $fot=$this->db->select("foto")->from("carrusel")->where("id",2)->get()->result_array();
    $foto2=$fot["0"]["foto"];

    $fot=$this->db->select("foto")->from("carrusel")->where("id",3)->get()->result_array();
    $foto3=$fot["0"]["foto"];
    ?>

    <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="4000">
                <img class="d-block w-100" src="<?=base_url()?>static/images/<?=$foto1?>" alt="Promoción 1">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img class="d-block w-100" src="<?=base_url()?>static/images/<?=$foto2?>" alt="Promoción 2">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img class="d-block w-100" src="<?=base_url()?>static/images/<?=$foto3?>" alt="Promoción 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <section class="category-section">
        <div class="container">
            <h2 class="section-title">Explora Nuestras Categorías</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <a href="<?=base_url()?>frontend/muebles" class="category-card">
                        <img src="<?=base_url()?>static/images/producto/es.jpg" alt="Muebles" class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Muebles</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="<?=base_url()?>frontend/decoracion" class="category-card">
                        <img src="<?=base_url()?>static/images/producto/dec.jpg" alt="Decoración" class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Decoración</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="<?=base_url()?>frontend/ropa" class="category-card">
                        <img src="<?=base_url()?>static/images/producto/short.jpg" alt="Ropa" class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Ropa</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="<?=base_url()?>frontend/calzado" class="category-card">
                        <img src="<?=base_url()?>static/images/producto/calzado.jpg" alt="Calzado" class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Calzado</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="<?=base_url()?>frontend/juguetes" class="category-card">
                        <img src="<?=base_url()?>static/images/producto/jug.jpg" alt="Juguetes" class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Juguetes</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="<?=base_url()?>frontend/otro" class="category-card">
                        <img src="<?=base_url()?>static/images/producto/cun.jpg" alt="Otras Cosas" class="category-img">
                        <div class="category-overlay">
                            <h3 class="category-title">Otras Cosas</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h4>Envío a domicilio</h4>
                        <p>Nuestro servicio de envío a domicilio garantiza que tus productos lleguen a tu casa seguros y a tiempo.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <h4>Pagos Seguros</h4>
                        <p>Cada compra es segura gracias a nuestros excelentes estándares de seguridad en línea PayPal/MercadoPago.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4>Buena Calidad</h4>
                        <p>Nuestra selección de productos americanos garantiza calidad y satisfacción para tus necesidades.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <h2 class="section-title">Aquí estamos ubicados</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div id="mapa" class="map-container"></div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-custom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase"><i class="fas fa-gem me-2"></i> Almacén La Pulga</h6>
                    <p class="mt-3" style="text-align: justify;">
                        Explora nuestra tienda online y descubre una amplia variedad de artículos americanos exclusivos. Desde elegantes muebles hasta accesorios de decoración, disfruta de la comodidad de comprar desde casa.
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0 mx-auto">
                    <h6 class="text-uppercase">Categorías</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#!"><i class="fas fa-angle-right me-2" style="font-size: 0.8em;"></i> Muebles</a></li>
                        <li class="mb-2"><a href="#!"><i class="fas fa-angle-right me-2" style="font-size: 0.8em;"></i> Ropa</a></li>
                        <li class="mb-2"><a href="#!"><i class="fas fa-angle-right me-2" style="font-size: 0.8em;"></i> Decoración</a></li>
                        <li class="mb-2"><a href="#!"><i class="fas fa-angle-right me-2" style="font-size: 0.8em;"></i> Calzado</a></li>
                        <li class="mb-2"><a href="#!"><i class="fas fa-angle-right me-2" style="font-size: 0.8em;"></i> Juguetes</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 mb-4 mb-md-0" id="contactos">
                    <h6 class="text-uppercase">Contacto</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex">
                            <i class="fas fa-home mt-1 me-3"></i> 
                            <span>Col. Aguas Blancas. Mpio. de Tecpan de Galeana, Gro., México</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-envelope me-3"></i>
                            <a href='mailto:almacen.la.pulga@gmail.com'>almacen.la.pulga@gmail.com</a>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-phone me-3"></i> 
                            <a href="tel:7421004843">742 100 48 43</a>
                        </li>
                        <li class="mb-3 text-muted" style="font-size: 0.85rem;">
                            <i>Anahí Pérez Rivera - Directora General</i>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col text-center">
                    <h6 class="mb-3">Síguenos en nuestras redes</h6>
                    <div>
                        <a href="https://www.facebook.com/profile.php?id=100073360505667&mibextid=ZbWKwL" class="footer-social-btn" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://wa.me/527421004843" class="footer-social-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://instagram.com/la_pulga_almacen?igshid=ZDdkNTZiNTM=" class="footer-social-btn" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <div class="container marketing">
                © 2023, Almacén La Pulga. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9NVdgMz2GdZa-UEpa4fyHkjcO0b60xiQ&callback=cargaMapa" type="text/javascript"></script>
    
    <script type='text/javascript'>
        $(document).ready(function(){ 
            // Control del Scroll To Top
            $(window).scroll(function(){ 
                if ($(this).scrollTop() > 300) { 
                    $('#scroll').fadeIn(); 
                } else { 
                    $('#scroll').fadeOut(); 
                } 
            }); 
            $('#scroll').click(function(e){ 
                e.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, 600); 
                return false; 
            }); 
        });
    </script>

</body>
</html>