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

<script>
    function imprimir() {
        // En lugar de esconderlo solo con JS, usé CSS avanzado abajo, pero dejamos tu función intacta.
        window.print();
    }
</script>

<style>
    /* ==========================================================================
       ESTILOS DE LA FACTURA
       ========================================================================== */
    :root {
        --primary-color: #bf2c3b;
    }

    body {
        background-color: #f4f6f9; /* Fondo gris claro para resaltar la hoja blanca */
    }

    .invoice-container {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 50px;
        margin-top: 30px;
        margin-bottom: 50px;
        border-top: 10px solid var(--primary-color);
    }

    .invoice-title {
        color: var(--primary-color);
        font-weight: 800;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .section-title {
        font-size: 1.1rem;
        color: #555;
        border-bottom: 2px solid #eee;
        padding-bottom: 8px;
        margin-bottom: 15px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .table-invoice th {
        background-color: var(--primary-color) !important;
        color: white !important;
        border: none;
    }

    .table-invoice td {
        vertical-align: middle;
    }

    /* Botón de Imprimir */
    .btn-print {
        background-color: var(--primary-color);
        color: white;
        border-radius: 25px;
        padding: 12px 35px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }
    
    .btn-print:hover {
        background-color: #9f2430;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(191, 44, 59, 0.4);
        color: white;
    }

    /* ==========================================================================
       ESTILOS PARA CUANDO SE MANDA A IMPRIMIR (MÁGICO)
       ========================================================================== */
    @media print {
        body { background-color: white !important; padding: 0; margin: 0; }
        .container { max-width: 100% !important; width: 100% !important; margin: 0 !important; padding: 0 !important;}
        .invoice-container { box-shadow: none !important; border: none !important; padding: 0 !important; margin-top: 0 !important; }
        
        /* Ocultar el botón para que no salga en la hoja impresa */
        .no-print { display: none !important; }

        /* Forzar a la impresora a usar el color rojo en la tabla */
        .table-invoice th {
            background-color: #bf2c3b !important;
            color: white !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    }
</style>

<?php 
$fec=$this->db->select("fech")->from("venta")->where("id",$idvent)->get()->result_array();

if (!empty($fec)) {
    $fecha=$fec["0"]["fech"];
} else {
    $fecha = " ";
    $idvent=0;
    $nombre="";
    $ap="";
    $am="";
    $ciudad = "";
    $col  ="";
    $calle  = "";
    $noint = "";
    $noext = "";
    $cp = "";
}

$consulta = $this->db->select("nombre,ap,am,ciudad,col,calle,noint,noext,cp")->from("venta")->join("cliente","venta.id_cli = cliente.id")->where("venta.id",$idvent)->get()->result_array();
if (!empty($fec)) {
    $nombre = $consulta["0"]["nombre"];
    $ap = $consulta["0"]["ap"];
    $am = $consulta["0"]["am"];
    $ciudad = $consulta["0"]["ciudad"];
    $col  = $consulta["0"]["col"];
    $calle  = $consulta["0"]["calle"];
    $noint = $consulta["0"]["noint"];
    $noext = $consulta["0"]["noext"];
    $cp = $consulta["0"]["cp"];
}
?>

<div class="invoice-container">
    
    <div class="row mb-5 align-items-center">
        <div class="col-sm-6 text-center text-sm-start mb-4 mb-sm-0">
            <img src="<?=base_url()?>static/images/logo.jpeg" style="height: 110px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        </div>
        <div class="col-sm-6 text-center text-sm-end">
            <h1 class="invoice-title fs-2">FACTURA</h1>
            <p class="text-muted mb-1 fs-5"><strong>No° Folio:</strong> #<?=$idvent?></p>
            <p class="text-muted mb-0"><strong>Fecha:</strong> <?=$fecha?></p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <h2 class="section-title"><i class="fas fa-file-invoice me-2"></i> Facturar a</h2>
            <div class="p-3 bg-light rounded border border-light">
                <p class="mb-0 fs-5"><strong><?=$nombre?> <?=$ap?> <?=$am?></strong></p>
            </div>
        </div>

        <div class="col-md-6">
            <h2 class="section-title"><i class="fas fa-shipping-fast me-2"></i> Enviar a</h2>
            <div class="p-3 bg-light rounded border border-light">
                <p class="mb-1"><i class="fas fa-map-marker-alt text-danger me-2"></i> <?=$calle?> <?=$noext?> <?=$noint?></p>
                <p class="mb-1 ms-4"><?=$col?>, <?=$ciudad?></p>
                <p class="mb-0 ms-4"><strong>C.P:</strong> <?=$cp?></p>
            </div>
        </div>
    </div>

    <div class="table-responsive mb-5">
        <table class="table table-hover table-invoice border" id="tabla-productos">
            <thead>
                <tr class="text-center">
                    <th class="py-3">Producto</th>
                    <th class="py-3">Cantidad</th>
                    <th class="py-3">Precio unitario</th>
                    <th class="py-3">Importe</th>
                </tr>
            </thead>
            <tbody>
                </tbody>
        </table>
    </div>

    <div class="text-center mt-5 no-print">
        <button type="button" class="btn-print" id="miboton" onclick="imprimir()">
            <i class="fas fa-file-pdf me-2"></i> Descargar Factura / Imprimir
        </button>
        <div class="mt-3">
            <a href="<?=base_url()?>frontend/historial/<?=$this->session->id_usu?>/<?=$this->session->token?>" class="text-muted text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Volver a mis compras
            </a>
        </div>
    </div>

</div>