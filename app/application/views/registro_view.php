
 <script>
  var appData = {
    uri_app : "<?= base_url() ?>",
    uri_ws  : "<?= base_url() ?>../webservice/"
  }
</script>

<style>

    .alert-dismissible{
      position: fixed;
      bottom: 20px;
      right: 10px;
    }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v16.0&appId=1257966064809466&autoLogAppEvents=1" nonce="5nJFs8E7"></script>


<div class="row mt-3 justify-content-center">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header text-white" style="text-align:center;">
        <h3 style="margin-top: 20px;" ><strong>Nuevo usuario</strong></h3>
        <img src="<?=base_url()?>static/images/logo.jpeg" style="height: 100px;">
      </div>
      <div class="card-body" >

        <form method="post" enctype="multipart/form-data">
          
           <div class="form-group mt-2" id="group-nombre" style="margin-bottom: 20px;">
  <label for="nombre" style="margin-bottom: 10px; color: #FFFFFF;">NOMBRE:</label> 
          <input type="text" class="form-control" id="nombre" name="nombre" style="color: black;"/>
</div>

        <div class="form-group mt-2" id="group-ap">
          <label for="ap" style="margin-bottom: 10px; color: #FFFFFF;">APELLIDO PATERNO:</label>
          <input type="text" class="form-control" name="ap" id="ap" style="color: black;"/>
        </div>

        <div class="form-group mt-2" id="group-am" style="margin-bottom: 20px;">
  <label for="am" style="margin-bottom: 10px; color: #FFFFFF;">APELLIDO MATERNO:</label> 
          <input type="text" class="form-control" id="am" name="am" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-correo" style="margin-bottom: 20px;">
  <label for="correo" style="margin-bottom: 10px; color: #FFFFFF;">CORREO ELECTRÓNICO:</label> 
          <input type="email" class="form-control" id="correo" name="correo" style="color: black;" placeholder="ej.: tunombre@email.com"/>
</div>

 <div class="form-group mt-2" id="group-password" style="margin-bottom: 20px;">
  <label for="password" style="margin-bottom: 10px; color: #FFFFFF;">CONTRASEÑA:</label> 
          <input type="password" class="form-control" id="password" name="password" style="color: black;" placeholder="Debe contener 8 caracteres por minimo"/>
          <button id="mostrarContrasenia" type="button" style="background: transparent; border: none;"><i class="fas fa-eye"></i></button>
</div>

 <div class="form-group mt-2" id="group-ciudad" style="margin-bottom: 20px;">
  <label for="ciudad" style="margin-bottom: 10px; color: #FFFFFF;">CIUDAD:</label> 
          <input type="text" class="form-control" id="ciudad" name="ciudad" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-col" style="margin-bottom: 20px;">
  <label for="col" style="margin-bottom: 10px; color: #FFFFFF;">COLONIA:</label> 
          <input type="text" class="form-control" id="col" name="col" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-calle" style="margin-bottom: 20px;">
  <label for="calle" style="margin-bottom: 10px; color: #FFFFFF;">CALLE:</label> 
          <input type="text" class="form-control" id="calle" name="calle" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-ni" style="margin-bottom: 20px;">
  <label for="ni" style="margin-bottom: 10px; color: #FFFFFF;">NO. INTERIOR(opcional):</label> 
          <input type="text" class="form-control" id="ni" name="ni" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-ne" style="margin-bottom: 20px;">
  <label for="ne" style="margin-bottom: 10px; color: #FFFFFF;">NO. EXTERIOR:</label> 
          <input type="text" class="form-control" id="ne" name="ne" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-cp" style="margin-bottom: 20px;">
  <label for="cp" style="margin-bottom: 10px; color: #FFFFFF;">CP:</label> 
          <input type="text" class="form-control" id="cp" name="cp" style="color: black;"/>
</div>

 <div class="form-group mt-2" id="group-tel" style="margin-bottom: 20px;">
  <label for="tel" style="margin-bottom: 10px; color: #FFFFFF;">TELEFONO:</label> 
          <input type="text" class="form-control" id="tel" name="tel" style="color: black;"/>
</div>

       </form>  
     </div>
      <div class="card-footer text-center">
<div class="d-flex justify-content-between align-items-center">
 <a type="button" class="btn btn-outline-light btn-lg" href="<?=base_url()?>">CANCELAR</a>

 <button type="button" class="btn btn-outline-light btn-lg" id="btn-guardar" name="btn-guardar">
    GUARDAR
  </button>

</div>

<div class="text-center mt-3">
<p class="mb-0 text-center text-white">¿Ya tienes una cuenta? <a href="<?=base_url()?>acceso/login" class="text-decoration-none text-warning">Ir a login</a></p>
</div>

 

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

<br />
<br />
<br />
<br />
<br />
