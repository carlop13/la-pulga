<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Carlos Guadalupe López Trejo">
    <title>Historial de compras</title>
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
</head>
<body>

<script src="<?=base_url()?>static/js/jquery-3.6.1.min.js"></script>
<script src="<?=base_url()?>static/js/carritos.js"></script>
<script src="<?=base_url()?>static/js/mensajes.js"></script>
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
        <div class="botones">
            <a href="<?= base_url() ?>frontend/deseos/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Lista de deseos">
                <i class="fa-solid fas fa-heart"></i>
                <script>
                    actualizarCantidadD( <?= $this->session->id_cli ?> );
                </script>
                <span id="cantidadDeseos"></span>
            </a>
            <a href="<?= base_url() ?>frontend/historial/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Historial de compras">
                <i class="fa-solid fa-list-alt"></i>
            </a>
            <a href="<?= base_url() ?>frontend/ajuste/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Perfil">
                <i class="fa-solid fa-user"></i>
            </a>
            <a href="<?= base_url() ?>frontend/carrito/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Carrito de compras">
                <i class="fa-solid fas fa-cart-shopping"></i>
                <script>
                    actualizarCantidad( <?= $this->session->id_cli ?> );
                </script>
                <span id="cantidadCarrito"></span>
            </a>
            <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sesión">
                <i class="fa-solid fa-right-from-bracket text-white"></i>
                Cerrar sesión
            </a>
        </div>
    </div>
</nav>

<br><br><br><br><br><br><br>

<div class="container mt-5">
    <h2>HISTORIAL DE USUARIO</h2>
</div>

<div class="container mt-4">
    <table class="table table-hover" id="tabla-productos">
        <thead class="table-warning">
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
            <!-- Aquí puedes agregar los datos dinámicamente -->
        </tbody>
    </table>
</div>
<div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px;right:20px;"></div>
</body>
</html>
