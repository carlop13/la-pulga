</div> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    var appData = {
        uri_app : "<?= base_url() ?>",
        uri_ws  : "<?= base_url() ?>../webservice/",
        id_venta : <?=$idvent?>,
        correo : "<?=$this->session->correo ?>",
        nombre: "<?= $this->session->nombre ?>",
        token : "<?=$this->session->token ?>",
        id_usu : "<?=$this->session->id_usu ?>",
        id_cli : "<?=$this->session->id_cli ?>"
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
        left: 0;
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
        left: 0;
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
        visibility: hidden; 
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
       DISEÑO DEL DETALLE DE COMPRA
       ========================================================================== */
    .page-title {
        color: var(--primary-color);
        font-weight: 800;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
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

    .invoice-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        padding: 25px;
        margin-bottom: 30px;
        border-left: 5px solid var(--primary-color);
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

    .btn-back {
        background-color: #ffc107;
        color: #212529;
        font-weight: 600;
        border-radius: 25px;
        padding: 10px 20px;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-back:hover {
        background-color: #e0a800;
        color: #212529;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
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

        .page-title::after { left: 50%; transform: translateX(-50%); }
        .mobile-center { text-align: center; }
    }
</style>

<script src="<?=base_url()?>static/js/carritos.js"></script>

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

<?php 
$usua=$this->db->select("nombre")->from("usuario")->where("id",$this->session->id_usu)->get()->result_array();
$usuario = isset($usua["0"]["nombre"]) ? $usua["0"]["nombre"] : "";

$fec=$this->db->select("fech")->from("venta")->where("id",$idvent)->get()->result_array();

if (!empty($fec)) {
    $fecha=$fec["0"]["fech"];
} else {
    $fecha = " ";
    $idvent=0;
    $nombre="";
    $ap="";
    $am="";
    $usuario = "";
}

$consulta = $this->db->select("nombre,ap,am")->from("venta")->join("cliente","venta.id_cli = cliente.id")->where("venta.id",$idvent)->get()->result_array();

if (!empty($fec) && !empty($consulta)) {
    $nombre = $consulta["0"]["nombre"];
    $ap = $consulta["0"]["ap"];
    $am = $consulta["0"]["am"];
}
?>

<div class="container mt-4 mb-5">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-3 mb-md-0 mobile-center">Detalle de Compra</h2>
        <a href="<?=base_url()?>frontend/historial/<?=$this->session->id_usu?>/<?=$this->session->token?>" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i> Regresar a mis compras
        </a>
    </div>

    <div class="invoice-card">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="text-danger mb-3" style="color: var(--primary-color) !important;">
                    <i class="fas fa-receipt me-2"></i> Folio de Venta: <strong>#<?=$idvent?></strong>
                </h5>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <span class="text-muted"><i class="far fa-calendar-alt me-2"></i> Fecha:</span><br>
                        <strong><?=$fecha?></strong>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <span class="text-muted"><i class="fas fa-user-tag me-2"></i> Usuario:</span><br>
                        <strong><?=$usuario?></strong>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <span class="text-muted"><i class="fas fa-truck-loading me-2"></i> Cliente / Envío:</span><br>
                        <strong><?=$nombre?> <?=$am?> <?=$ap?></strong>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end text-center mt-4 mt-md-0 border-start ps-md-4">
                <?php if (!empty($fec)) : ?>
                    <div class="p-3 bg-light rounded shadow-sm">
                        <small class="text-muted d-block">Comprador</small>
                        <h6 class="mb-0 fw-bold">Hola, <?=$this->session->nombre?></h6>
                    </div>
                <?php else : ?>
                    <div class="p-3 bg-light rounded shadow-sm">
                        <small class="text-muted d-block">Comprador</small>
                        <h6 class="mb-0 fw-bold">Hola</h6>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-custom mb-0" id="tabla-productos">
                    <thead>
                        <tr class="text-center">
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

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

<div>