<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta author="Carlos Guadalupe López Trejo">
  <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
  <title>Panel de Administrador</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/css/highcharts.css" rel="stylesheet" />

  <!-- SCRIPTS HIGHCHARTS -->
  <script src="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/highcharts/highcharts.js"></script>
  <script src="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/highcharts/modules/exporting.js"></script>
  <script src="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/highcharts/modules/export-data.js"></script>
  <script src="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/highcharts/modules/accessibility.js"></script>

  <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>static/js/mensajes.js"></script>

  <script>
            var appData = {
            uri_app : "<?= base_url() ?>",
            uri_ws  : "<?= base_url() ?>../webservice/",
            idusuario : "<?= $this->session->id_cli ?>",
            }
        </script>

  <style type="text/css">

    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: brown;
      color: #fff;
      padding: 20px;
      text-align: center;
      animation: slideDown 0.5s ease-in-out;
    }

    @keyframes slideDown {
      0% { transform: translateY(-100%); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      background-color: #eee;
      display: flex;
      justify-content: center;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }

    nav ul li {
      padding: 10px;
    }

    nav ul li a {
      text-decoration: none;
      color: #333;
      transition: color 0.3s ease;
    }

    nav ul li a:hover {
      color: brown;
    }

    section {
      padding: 20px;
      margin-bottom: 20px;
      background-color: #fff;
      box-shadow: 0px 0px 10px #ccc;
      border-radius: 5px;
      animation: slideUp 0.5s ease-in-out;
    }

    @keyframes slideUp {
      0% { transform: translateY(100%); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    .stat {
      text-align: center;
    }

    @keyframes fadeInUp {
      0% { transform: translateY(20px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    #quick-actions {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
    }

    .button-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      max-width: 800px;
      margin: 0 auto;
    }

    button {
      margin: 10px;
      padding: 15px 30px;
      border: none;
      border-radius: 5px;
      background-color: brown;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      animation: scaleIn 0.3s ease-in-out;
    }

    @keyframes scaleIn {
      0% { transform: scale(0.8); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    button:hover {
      background-color: #8B4513;
    }


button[type="button"]:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}

a[type="button"]:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}

button[type="submit"]:active {
  transform: scale(0.95);
  transition: transform 0.2s ease;
}

    h2 {
      margin-top: 0;
    }


.stat h3 {
  margin: 10px 0;
  color: #333;
}

.stat p {
  font-size: 24px;
  font-weight: bold;
  color: #666;
}

.pedidos-badge {
  position: relative;
  display: inline-block;
}

.pedidos-badge .badge {
  position: absolute;
  top: -10px;
  right: 0;
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 4px;
  font-size: 12px;
}

.alert-dismissible{
      position: fixed;
      bottom: 20px;
      right: 10px;
    }

  </style>


  <script src="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/js/jquery-3.6.3.min.js"></script>

</head>

<?php 
$pro=$this->db->select("count(id) as id")->from("producto")->where("estado",1)->get()->result_array();

if (!empty($pro)) {
$productos = $pro["0"]["id"];
}
else {
$productos = 0;
  }

$vent=$this->db->select("count(id) as id")->from("venta")->get()->result_array();

if (!empty($vent)) {
$venta = $vent["0"]["id"];
}
else {
$venta = 0;
  }

$cli=$this->db->select("count(cliente.id) as id")->from("cliente")->join('usuario', 'cliente.id_usu = usuario.id', 'inner')->where( "activo", 1 )->get()->result_array();

if (!empty($cli)) {
$cliente = $cli["0"]["id"];
}
else {
$cliente = 0;
  }

$fecc = $this->db->select("left(now(),10)as fecha")->get()->result_array();
    $fec=$fecc["0"]["fecha"];

?>

<script type="text/javascript">
  $(document).ready(function(){
    borra_mensajes();

    var fecha = document.getElementById("fecha").innerText;
    var fechaFancy = fecha_fancy(fecha);
    document.getElementById("fecha").innerText = fechaFancy;

    //Carga envios
    function envio(){
  $.ajax({
    "url" : appData.uri_ws+"backend/getenvio/",
    "dataType" : "json"
  })
  .done(function(obj){
    document.getElementById("pedidos").innerText = obj;
  });
}

$("#btn-guardar").click(function(){

$(".form-group").keydown(borra_mensajes);
borra_mensajes();

let formato = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

if ($("#nombre").val()=="") {
    error_formulario("nombre","El nombre es requerído");

    return false;
  }

else if ($("#ap").val()=="") {
    error_formulario("ap","El apellido paterno es requerído");

    return false;
  }

else if ($("#am").val()=="") {
    error_formulario("am","El apellido materno es requerído");

    return false;
  }

else if ($("#correo").val()=="") {
    error_formulario("correo","El correo es requerído");

    return false;
  }

else if (!formato.test($("#correo").val())) {
    error_formulario("correo","El formato de correo es incorrecto");

    return false;
  }

else if ($("#password").val()=="") {
    error_formulario("password","La contraseña es requerída");

    return false;
  }

else if ($("#password").val().length < 8) {
    error_formulario("password","La contraseña debe contener por lo menos 8 caracteres");

    return false;
  }

else{

 $.ajax({
        "url"   :   appData.uri_ws + "backend/registradmin/",
        "dataType"  :   "json",
        "type"  :   "post",
        "data"  :   {
    "nombre" : $("#nombre").val(),
    "ap" : $("#ap").val(),
    "am" : $("#am").val(),
    "correo" : $("#correo").val(),
    "password" : $("#password").val()
  }

    })
    .done(function(obj) {
  if (obj.resultado) {
    $("#modal-admin").modal("hide"); //Quita manualmente la modal
    $("#nombre").val("");
    $("#ap").val("");
    $("#am").val("");
    $("#correo").val("");
    $("#password").val("");
    alert("success", obj.mensaje);
  } else {
    alert("danger", obj.mensaje);
  }
})
  .fail( error_ajax );

}

});


$("#btn-productos").click(function(){
  $(location).attr('href', '<?=base_url()?>frontend/gestionP/<?=$this->session->id_usu ?>/<?=$this->session->token ?>');
  });

$("#btn-reportes").click(function(){
  $(location).attr('href', '<?=base_url()?>frontend/reportes/<?=$this->session->id_usu ?>/<?=$this->session->token ?>');
  });

setInterval(envio, 1000);

  });
</script>

<body>
  <header>
    <h1>Panel de Administrador</h1>
    <div class="d-flex justify-content-between">
                <a href="#"><img src="<?=base_url()?>static/images/logo.jpeg" style="height: 90px;" class="w-20 mr-auto" alt=""></a>
                <div class="bienvenida d-flex align-items-center" id="mensaje-bienvenida" >
                    <p class="text-white mx-4" >Bienvenido: <?= $this->session->nombre ?>
                    <br />
                    Hoy es <span id="fecha"><?= $fec ?></span>                    
                  </p> 
                </div>
            <div >
                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sessión">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    Cerrar sesión
                </a>
                </div>
            </div>

  </header>
  <nav>
    <ul>
      <li><a href="<?=base_url()?>frontend/carrusel/<?=$this->session->id_usu ?>/<?=$this->session->token ?>">Carrusel</a></li>

     <li class="pedidos-badge"><a href="<?=base_url()?>frontend/pedidos/<?=$this->session->id_usu ?>/<?=$this->session->token ?>">Pendientes</a><span id="pedidos" class="badge">0</span></li>
     
      <li><a href="<?=base_url()?>frontend/clientes/<?=$this->session->id_usu ?>/<?=$this->session->token ?>">Clientes</a></li>
    </ul>
  </nav>
  <section id="summary">
    <div class="stat">
      <h3>Total de Productos en Stock</h3>
      <p><?=$productos?></p>
    </div>
    <div class="stat">
      <h3>Total de Ventas Realizadas</h3>
      <p><?=$venta?></p>
    </div>
    <div class="stat">
      <h3>Total de Clientes Activos</h3>
      <p><?=$cliente?></p>
    </div>
  </section>
<section id="quick-actions">
  <div class="button-container">
    <button id="btn-productos" type="button" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Gestión de Productos</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-admin" title="Agregar Administrador"><i class="fas fa-user-plus"></i> Nuevo administrador</button>
<button id="btn-reportes" type="button" class="btn btn-primary"><i class="fas fa-chart-bar"></i> Reportes</button>
  </div>
</section>
  <section id="charts">
    <h2>Gráficos</h2>
    <!-- Aquí puedes agregar tus gráficos o informes -->


  <figure class="highcharts-figure">
    <div id="div-grafica"></div>
    
</figure>

<script src="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/js/highcharts-lang-es.js"></script>

<script src="<?=base_url()?>static/js/grafica.js"></script>

  </section>

<section id="charts">
    <!-- Aquí puedes agregar tus gráficos o informes -->


  <figure class="highcharts-figure">
    <div id="div-grafica2"></div>
    
</figure>

<script src="http://dtai.uteq.edu.mx/~carlop202/AWI4/PROYECTO/app/static/js/highcharts-lang-es.js"></script>

<script src="<?=base_url()?>static/js/grafica2.js"></script>
  </section>

  <section id="listings">
    <h2>Administradores Activos</h2>
    <!-- Aquí puedes mostrar listados o tablas de información -->

     <!--Tabla de infromación de plantas-->
<div class="container mt-2">
  <div class="table-responsive">
    <table class="table align-middle mb-0 bg-whit" id="tabla-admin">
      <thead class="bg-primary">
        <tr>
          <th class="text-center">No.</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Correo</th>
          <th class="text-center">Fecha de registro</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <!-- Aquí van los datos de la tabla -->
      </tbody>
    </table>
  </div>
</div>


  </section>
  <section id="settings">
    <h2>Mi información</h2>
    <!-- Aquí puedes agregar opciones de configuración -->

    <div class="button-container mb-2">
    <a href="<?=base_url()?>frontend/ajustead/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" type="button" class="btn btn-primary"><i class="fas fa-user"></i> Información</a>
  </div>

  </section>

<script type="text/javascript">
  function fecha_fancy(sFecha){
  //Convierte un String en arreglo
  aFecha = sFecha.split("-");

  aMes= ["enero","febrero","marzo","abril","mayo","junio",
      "julio","agosto","septiembre","octubre","noviembre","diciembre"]

  return new Intl.NumberFormat().format(aFecha[2]) + " de " + aMes[aFecha[1]-1]+" de "+aFecha[0];
}
</script>

 <!-- Modal agregar-->
<div class="modal fade" id="modal-admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header btn-success bg-opacity-75">
        <h5 class="modal-title" id="exampleModalLabel">Agregar administrador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
    <form>
      <div class="form-group mt-2" id="group-nombre" style="margin-bottom: 20px;">
  <label for="nombre" style="margin-bottom: 10px;">NOMBRE:</label> 
          <input type="text" class="form-control" id="nombre" name="nombre" style="color: black;"/>
</div>

        <div class="form-group mt-2" id="group-ap">
          <label for="ap" style="margin-bottom: 10px;">APELLIDO PATERNO:</label>
          <input type="text" class="form-control" name="ap" id="ap" style="color: black;"/>
        </div>

        <div class="form-group mt-2" id="group-am" style="margin-bottom: 20px;">
  <label for="am" style="margin-bottom: 10px;">APELLIDO MATERNO:</label> 
          <input type="text" class="form-control" id="am" name="am" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-correo" style="margin-bottom: 20px;">
  <label for="correo" style="margin-bottom: 10px;">CORREO ELECTRÓNICO:</label> 
          <input type="email" class="form-control" id="correo" name="correo" style="color: black;" placeholder="ej.: tunombre@email.com"/>
</div>

<div class="form-group mt-2" id="group-password" style="margin-bottom: 20px;">
  <label for="password" style="margin-bottom: 10px;">CONTRASEÑA:</label> 
          <input type="password" class="form-control" id="password" name="password" style="color: black;" placeholder="Debe contener 8 caracteres por minimo"/>
          <button id="mostrarContrasenia" style="background: black; border: none;"><i class="fas fa-eye"></i></button>
</div>
    </form>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="btn-guardar" class="btn btn-success">
          <i class="fas fa-save"></i>
        Enviar
      </button>
      
        <button class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-ban"></i>
        Cancelar
      </button>

      </div>
    </div>
  </div>
</div>

<script>
  // Obtiene el campo de contraseña y el botón
  const contraseniaInput = document.getElementById('password');
  const mostrarContraseniaBtn = document.getElementById('mostrarContrasenia');

  // Agrega un evento de clic al botón
  mostrarContraseniaBtn.addEventListener('click', function() {
    if (contraseniaInput.type === 'password') {
      // Si el campo es de tipo contraseña, cambia a tipo texto
      contraseniaInput.type = 'text';
       mostrarContraseniaBtn.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Cambia el ícono a ojo cerrado
    } else {
      // Si el campo es de tipo texto, cambia a tipo contraseña
      contraseniaInput.type = 'password';
       mostrarContraseniaBtn.innerHTML = '<i class="fas fa-eye"></i>'; // Cambia el ícono a ojo abierto
    }
  });
</script>

<div id="mensajee" class="mt-4 ps-2">
</div>

</body>
</html>
