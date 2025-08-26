  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
    <link href="<?=base_url()?>static/css/alert.css" rel="stylesheet">
    <script src="<?=base_url()?>static/js/mensajes.js" ></script>
    <script src="<?=base_url()?>static/js/carritos.js" ></script>
    
    <title>Modificar datos</title>
</head>
<body class="bg-light">
    
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

    <script>
 $( document ).ready(function(){
borra_mensajes();

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

else if ($("#ciudad").val()=="") {
    error_formulario("ciudad","La ciudad es requerída");

    return false;
  }

else if ($("#col").val()=="") {
    error_formulario("col","La colonia es requerída");

    return false;
  }

else if ($("#calle").val()=="") {
    error_formulario("calle","La calle es requerída");

    return false;
  }

else if ($("#ne").val()=="") {
    error_formulario("ne","El número exterior es requerído");

    return false;
  }

else if ($("#cp").val()=="") {
        error_formulario("cp","El CP es requerído");

        return false;
    }

else if ($("#cp").val().length !== 5) {
        error_formulario("cp","Ingresa un cp válido");

        return false;
    }

else if ($("#tel").val()=="") {
        error_formulario("tel","El teléfono es requerído");

        return false;
    }

else if ($("#tel").val().length !== 10) {
        error_formulario("tel","Ingresa un teléfono válido");

        return false;
    }

else{

 $.ajax({
        "url"   :   appData.uri_ws + "backend/updateusuario",
        "dataType"  :   "json",
        "type"  :   "post",
        "data"  :   {
    "id_cli" : appData.idusuario,
    "id_usu" : appData.id_usu,
    "nombre" : $("#nombre").val(),
    "ap" : $("#ap").val(),
    "am" : $("#am").val(),
    "correo" : $("#correo").val(),
    "ciudad" : $("#ciudad").val(),
    "col" : $("#col").val(),
    "calle" : $("#calle").val(),
    "ni" : $("#ni").val(),
    "ne" : $("#ne").val(),
    "cp" : $("#cp").val(),
    "tel" : $("#tel").val(),
    "token" : appData.token

  }

    })
    .done( function( obj ) {
      $(location).attr("href","");
  })
    .fail( error_ajax );

}

});

});
</script>


    <div class="container" >
        
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
            
            <div class="botones" >
                <a href="<?= base_url() ?>frontend/deseos/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Lista de deseos">
                    <i class="fa-solid fas fa-heart"></i>
                    <script>
                        actualizarCantidadD( <?= $this->session->id_cli ?> );
                    </script>
                    <span id="cantidadDeseos" ></span>
                </a>
                <a href="<?= base_url() ?>frontend/historial/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Historial de compras" >
                    <i class="fa-solid fa-list-alt"></i>
                </a>
                <a href="<?= base_url() ?>frontend/ajuste/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Perfil" >
                    <i class="fa-solid fa-user"></i>
                </a>
                <a href="<?= base_url() ?>frontend/carrito/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn bg-info" title="Carrito de compras">
                    <i class="fa-solid fas fa-cart-shopping"></i>
                    <script>
                        actualizarCantidad( <?= $this->session->id_cli ?> );
                    </script>
                    <span id="cantidadCarrito" ></span>
                </a>
                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sessión">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    Cerrar sesión
                </a>
            </div>
        </nav>

        <br><br><br><br><br><br><br><br>

        <div class=" row d-flex mt-5 text-center">
            <h2>Modificar datos</h2>

        </div>
<?php 

$consulta = $this->db->select("*")->from("datos_cliente")->where("id",$this->session->id_cli)->get()->result_array();

$nombre = $consulta["0"]["nombre"];

$ap = $consulta["0"]["ap"];

$am = $consulta["0"]["am"];

$correo = $consulta["0"]["correo"];

$ciudad = $consulta["0"]["ciudad"];

$col = $consulta["0"]["col"];

$calle = $consulta["0"]["calle"];

$noint = $consulta["0"]["noint"];

$noext = $consulta["0"]["noext"];

$cp = $consulta["0"]["cp"];

$telefono = $consulta["0"]["telefono"];

?>


<div class="row mt-4">

<form method="post">

<div class="row mt-1 justify-content-center">
  <div class="col col-md-6">

    <div class="form-group" id="group-nombre">
      <label for="nombre"><strong>Nombre:</strong></label>
      <input type="text" name="nombre" id="nombre" value="<?=$nombre?>" class="form-control" />
    </div>

    <div class="form-group" id="group-ap">
      <label for="ap"><strong>Apellido:</strong></label>
      <input type="text" name="ap" id="ap" value="<?=$ap?>" class="form-control" />
    </div>



    <div class="form-group" id="group-am">
      <label for="am"><strong>Apellido:</strong></label>
      <input type="text" name="am" id="am" value="<?=$am?>" class="form-control" />
    </div>



    <div class="form-group" id="group-ciudad">
      <label for="ciudad"><strong>Ciudad:</strong></label>
      <input type="text" name="ciudad" id="ciudad" value="<?=$ciudad?>" class="form-control" />
    </div>


    <div class="form-group" id="group-col">
      <label for="col"><strong>Colonia:</strong></label>
      <input type="text" name="col" id="col" value="<?=$col?>" class="form-control" />
    </div>


    <div class="form-group" id="group-calle">
      <label for="calle"><strong>Calle:</strong></label>
      <input type="text" name="calle" id="calle" value="<?=$calle?>" class="form-control" />
    </div>


    <div class="form-group" id="group-ni">
      <label for="ni"><strong>NO. Int:</strong></label>
      <input type="text" name="ni" id="ni" value="<?=$noint?>" class="form-control" />
    </div>



    <div class="form-group" id="group-ne">
      <label for="ne"><strong>No. Ext:</strong></label>
      <input type="text" name="ne" id="ne" value="<?=$noext?>" class="form-control" />
    </div>

    <div class="form-group" id="group-cp">
      <label for="cp"><strong>CP:</strong></label>
      <input type="text" name="cp" id="cp" value="<?=$cp?>" class="form-control" />
    </div>

    <div class="form-group" id="group-tel">
      <label for="tel"><strong>Telefono:</strong></label>
      <input type="text" name="tel" id="tel" value="<?=$telefono?>" class="form-control" />
    </div>

  </div>

<style type="text/css">
    .mb-8 {
  margin-bottom: 150px;
}

</style>


  <div class="mt-2 justify-content-center d-flex mb-8">
  <button class="btn btn-success mx-2" type="button" id="btn-guardar" name="btn-guardar">
    <i class="fas fa-save fa-2x"></i>
    Guardar
  </button>
  <a href="<?=base_url()?>frontend/ajuste/<?=$this->session->id_usu?>/<?=$this->session->token?>" class="btn btn-secondary mx-2">
    <i class="fas fa-arrow-circle-left fa-2x"></i>
    Cancelar
  </a>
</div>



</form>



</body>
</html>
