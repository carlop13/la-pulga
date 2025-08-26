<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Carlos Guadalupe López Trejo">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Reportes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/reportes.css">
   <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
</head>
<body>

  <script>
            var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
            idusuario : "<?= $this->session->id_cli ?>",
            idusuario : "<?= $this->session->correo ?>",
            }
        </script>

     <header>
    <h1>Reportes</h1>
    <p class="text-white mx-4" >Bienvenido: <?= $this->session->nombre ?></p>
    <div class="d-flex justify-content-between">
                <a href="<?=base_url()?>frontend/principalAdmin/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-info text-white" title="Inicio">
                    <i class="fa-solid fa-home text-white"></i>
                    Inicio
                </a>
                <div class="bienvenida d-flex align-items-center" id="mensaje-bienvenida" >
                </div>
            <div >
                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sessión">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    Cerrar sesión
                </a>
                </div>
            </div>

  </header>
          <section class="mt-4">
            <div id="report-buttons">
        <button type="button" id="btn-sales-week">Ventas de la Semana</button>
        <button type="button" id="btn-sales-month">Ventas del Mes</button>
        <button type="button" id="btn-sales-year">Ventas del Año</button>
         <button type="button" id="btn-sales">Ventas Totales</button>
        <button type="button" id="btn-customer-phone">Teléfonos de Clientes</button>
        <button type="button" id="btn-active-users">Clientes Activos</button>
         <form action="<?= base_url('../webservice/BackupController/backupDatabase') ?>" method="POST">
        <button type="submit" id="btn-database-backup">Respaldo de Base de Datos</button>
        </form>
    </section>
    </div>

  
    <div id="report-results">
        <h1 class="text-center" id="titulo">titulo</h1>
    <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabla-venta-mes">
                <thead>

                </thead>
                <tbody>
                    <!-- Aquí van los datos de la tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="report-results-2">
        <h1 class="text-center" id="titulo">titulo</h1>
    <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabla-venta-mes">
                <thead>

                    <tr class="table-info">
                <th class="text-center">Nombre</th>
                <th class="text-center">Teléfono</th>
                    </tr>

                </thead>
                <tbody>
                    <!-- Aquí van los datos de la tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>


    <script src="<?=base_url()?>static/js/reportes.js"></script>
</body>
</html>
