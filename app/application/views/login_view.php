<script>
  var appData = {
    uri_app : "<?= base_url() ?>",
    uri_ws  : "<?= base_url() ?>../webservice/"
  }
</script>



<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v16.0&appId=1257966064809466&autoLogAppEvents=1" nonce="5nJFs8E7"></script>





<div class="row mt-3 justify-content-center">

  <div class="col-md-6">
    <div class="card" style="margin-top: 1px; ">
      <div class="card-header text-white" style="text-align:center;">
        <h3 style="margin-top: 20px;" ><strong>Bienvenido</strong></h3>
        <img src="<?=base_url()?>static/images/logo.jpeg" style="height: 100px;">
      </div>
      <div class="card-body" >

        <form method="post" enctype="multipart/form-data">
          

        <div class="form-group mt-2" id="group-correo">
          <label for="correo" style="margin-bottom: 10px; color: #FFFFFF;">CORREO:</label>
          <input type="email" class="form-control" name="correo" id="correo" style="color: black;" placeholder="ej.: tunombre@email.com"/>
        </div>

        <div class="form-group mt-2" id="group-contrasenia" style="margin-bottom: 20px;">
  <label for="contrasenia" style="margin-bottom: 10px; color: #FFFFFF;">CONTRASEÑA:</label> 
          <input type="password" class="form-control" id="contrasenia" name="contrasenia" style="color: black;"/>
          <button id="mostrarContrasenia" type="button" style="background: transparent; border: none;"><i class="fas fa-eye"></i></button>
</div>

<div class="d-flex justify-content-between align-items-center">
 <a type="button" class="btn btn-outline-light btn-lg" href="<?=base_url()?>">CANCELAR</a>

  <button type="button" class="btn btn-outline-light btn-lg" id="btn-entrar" name="btn-entrar">
    INGRESAR 
  </button>
</div>

<div class="text-center mt-3">
<p class="mb-0 text-center text-white" >¿No tienes una cuenta? <a href="<?=base_url()?>acceso/registro" class="text-decoration-none text-warning">Registrate aquí</a></p></div>

<div class="text-center mt-3">
<p class="mb-0 text-center text-white" >¿Olvidaste tu contraseña? <a type="button" class="text-decoration-none text-warning" data-bs-toggle="modal" data-bs-target="#modal-contra">Click aquí</a></p></div>

        </form>
      </div>
    </div>

    <script>
  // Obtiene el campo de contraseña y el botón
  const contraseniaInput = document.getElementById('contrasenia');
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

  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

  $("#btn-recuperar").click(function(){
$(".form-group").keydown(borra_mensajes);
borra_mensajes();

let formato = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;


if ($("#correorecu").val()=="") {
    error_formulario("correorecu","El correo es requerído");

    return false;
  }

else if (!formato.test($("#correorecu").val())) {
    error_formulario("correorecu","El formato de correo es incorrecto");

    return false;
  }

  else{

$.ajax({
  "url": appData.uri_ws+"backend/recuperacontra/",
  "dataType" : "json",
  "type" : "post",
  "data" : {
    "correo" : $("#correorecu").val(),
  }
})
.done(function(obj){

  if (obj) {

    var user = obj[0];

    alert("success","El correo coincide");

    $("#correorecu").val("");

    setTimeout(function(){
      $(location).attr("href",appData.uri_app + "frontend/recuperacontrasenia/"+user.id+"/"+user.nombre+"/"+user.ap+"/"+user.am+"/"+user.correo );
    },2000);

  }
  else{
    alert("danger", "No hay cuenta registrada con ese correo");
  }

})
.fail(error_ajax);

return true

}


});

  });
</script>

     <!-- Modal Contrasenia-->
<div class="modal fade" id="modal-contra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-secondary">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar Contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
    <form>
       <div class="form-group mt-2" id="group-correorecu">
          <label for="correorecu" style="margin-bottom: 10px;"><strong>Ingresa tu correo:</strong></label>
          <input type="email" class="form-control" name="correorecu" id="correorecu" style="color: black;" placeholder="ej.: tunombre@email.com"/>
        </div>
    

      </div>
      <div class="modal-footer d-flex justify-content-center">

        <button type="button" class="btn btn-primary" id="btn-recuperar">
          <i class="fas fa-save"></i>
        Enviar
      </button>


        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-ban"></i>
        Cancelar
      </button>
      
      </form>
        
      </div>
    </div>
  </div>
</div>

<br />
<br />
