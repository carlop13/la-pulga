  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Carlos Guadalupe López Trejo">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
   <link href="<?=base_url()?>static/css/alert.css" rel="stylesheet">
    <script src="<?=base_url()?>static/js/mensajes.js" ></script>
    <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>


    
    <title><?= ucfirst($accion) ?></title>
</head>

<body class="bg-light">

    <style>
    .alert-dismissible{
      position: fixed;
      bottom: 20px;
      right: 10px;
    }

      nav {
            background-color: brown;
            color: #fff;
            padding: 20px;
            text-align: center;
            animation: slideDown 0.5s ease-in-out;
        }


    .mb-8 {
  margin-bottom: 190px;
}



    </style>
    
    
    <script>
        var appData = {
        uri_app : "<?= base_url() ?>",
        uri_ws  : "<?= base_url() ?>../webservice/",
        id_pro : "<?=$id_pro?>",
        }
    </script>

<?php 
if($accion == "alta"):
  ?>

<script>
  $(document).ready(function() {
    borra_mensajes();

    $("form").submit(function(event) {
      event.preventDefault(); // Previene el envío del formulario

      const descr = document.getElementById('descr').value;

      $(".form-group").keydown(borra_mensajes);
      borra_mensajes();

const fotoInput = document.getElementById('foto');
const foto = fotoInput.files[0];
var formData = new FormData();
formData.append('foto', foto);

const fotoInput1 = document.getElementById('foto1');
const foto1 = fotoInput1.files[0];
var formData1 = new FormData();
formData1.append('foto1', foto1);

const fotoInput2 = document.getElementById('foto2');
const foto2 = fotoInput2.files[0];
var formData2 = new FormData();
formData2.append('foto2', foto2);

const fotoInput3 = document.getElementById('foto3');
const foto3 = fotoInput3.files[0];
var formData3 = new FormData();
formData3.append('foto3', foto3);



    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
      if (foto1) {
      if (!allowedTypes.includes(foto1.type)) {
        error_formulario("foto1", "El archivo seleccionado no es una imagen");
        return false;
      }
    }

    if (foto2) {
      if (!allowedTypes.includes(foto2.type)) {
        error_formulario("foto2", "El archivo seleccionado no es una imagen");
        return false;
      }
    }

    if (foto3) {
      if (!allowedTypes.includes(foto3.type)) {
        error_formulario("foto3", "El archivo seleccionado no es una imagen");
        return false;
      }
    }
      if ($("#nombre").val() == "") {
        error_formulario("nombre", "El nombre es requerido");
        return false;
      } else if ($("#prec").val() == "") {
        error_formulario("prec", "El precio es requerido");
        return false;
      } else if ($("#cant").val() == "") {
        error_formulario("cant", "La cantidad es requerida");
        return false;
      } 
      else if (descr.trim() !== "" && descr.length > 200) {
        error_formulario("descr", "La descripción no debe superar los 200 caracteres");
        return false;
      } else if ($("#cat").val() == "0") {
        error_formulario("cat", "La categoría es requerida");
        return false;
    } else if ($("#foto").val() == "") {
        error_formulario("foto", "La foto es requerida");
        return false;
      }
      else if (!allowedTypes.includes(foto.type)) {
        error_formulario("foto","El archivo seleccionado no es una imagen");
       return false;
  }
   else {
        // Realizar aquí cualquier acción adicional que desees antes de enviar el formulario
        $(this).unbind("submit").submit(); // Envía el formulario manualmente
      }
    });

    $.ajax({
    "url" : appData.uri_ws + "backend/getcat/",
    "dataType" : "json"
})
.done(function(obj){
        $.each(obj, function(i,c){
            $("#cat").append($("<option>",{
                text : c.categoria,
                value : c.id
            }))
        });
})
.fail(error_ajax)


  });
</script>


<?php 
elseif($accion == "editar"):
?>

<script>
  $(document).ready(function() {
    borra_mensajes();

    $("form").submit(function(event) {
  event.preventDefault(); // Previene el envío del formulario

  const descr = document.getElementById('descr').value;

  $(".form-group").keydown(borra_mensajes);
  borra_mensajes();

const fotoInput = document.getElementById('foto');
const foto = fotoInput.files[0];
var formData = new FormData();
formData.append('foto', foto);

const fotoInput1 = document.getElementById('foto1');
const foto1 = fotoInput1.files[0];
var formData1 = new FormData();
formData1.append('foto1', foto1);

const fotoInput2 = document.getElementById('foto2');
const foto2 = fotoInput2.files[0];
var formData2 = new FormData();
formData2.append('foto2', foto2);

const fotoInput3 = document.getElementById('foto3');
const foto3 = fotoInput3.files[0];
var formData3 = new FormData();
formData3.append('foto3', foto3);



    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (foto) {
      if (!allowedTypes.includes(foto.type)) {
        error_formulario("foto", "El archivo seleccionado no es una imagen");
        return false;
      }
    }
      if (foto1) {
      if (!allowedTypes.includes(foto1.type)) {
        error_formulario("foto1", "El archivo seleccionado no es una imagen");
        return false;
      }
    }

    if (foto2) {
      if (!allowedTypes.includes(foto2.type)) {
        error_formulario("foto2", "El archivo seleccionado no es una imagen");
        return false;
      }
    }

    if (foto3) {
      if (!allowedTypes.includes(foto3.type)) {
        error_formulario("foto3", "El archivo seleccionado no es una imagen");
        return false;
      }
    }

  if ($("#nombre").val() == "") {
    error_formulario("nombre", "El nombre es requerido");
    return false;
  } else if ($("#prec").val() == "") {
    error_formulario("prec", "El precio es requerido");
    return false;
  } else if ($("#cant").val() == "") {
    error_formulario("cant", "La cantidad es requerida");
    return false;
  } else if (descr.trim() !== "" && descr.length > 200) {
    error_formulario("descr", "La descripción no debe superar los 200 caracteres");
    return false;
  } else if ($("#cat").val() == "0") {
    error_formulario("cat", "La categoría es requerida");
    return false;
  }  else {
    // Realizar aquí cualquier acción adicional que desees antes de enviar el formulario
    $(this).unbind("submit").submit(); // Envía el formulario manualmente
  }
});


    $.ajax({
    "url" : appData.uri_ws + "backend/getcat2/",
    "type" : "POST",
    "dataType" : "json",
    "data" : {
      "id_pro":appData.id_pro
    }
})
.done(function(obj){
        $.each(obj, function(i,c){
            $("#cat").append($("<option>",{
                text : c.categoria,
                value : c.id
            }))
        });
})
.fail(error_ajax)


  });
</script>

<?php 
endif;
?>


<?php 
if($mensaje == "Existente"):
  ?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("warning","<?=$mensaje?>");
   });
</script>

<?php 
elseif($mensaje == "Actualizado"):
?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("success","<?=$mensaje?>");
   });
</script>

<?php 
elseif($mensaje == "No_Actualizado"):
?>

<script type="text/javascript">
    $(document).ready(function() {
  alert("warning","<?=$mensaje?>");
   });
</script>

<?php 
endif;
?>



    <div class="container" >
        
        <nav class="navbar navbar-dark bg-brown mb-4 p-4 fixed-top">
    <div class="d-flex justify-content-between">
<div>
      <h1 class="text-center"><?= ucfirst($accion) ?> producto</h1>

      </div>

            </div>

             <div class="d-flex justify-content-between">
      <a href="<?=base_url()?>frontend/principalAdmin/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-info text-white" title="Inicio">
                    <i class="fa-solid fa-home text-white"></i>
                    Inicio
                </a>
                </div>

            <div class="botones" >
           
            <div >
                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn bg-danger text-white" title="Cerrar sessión">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    Cerrar sesión
                </a>
                </div>
            </div>
  </nav>

        <br><br><br><br><br>



<?php 

if ($accion == "editar") {

$consulta = $this->db->select("*")->from("producto")->where("id",$id_pro)->get()->result_array();

$nombre = $consulta["0"]["nombre"];

$prec = $consulta["0"]["prec"];

$cant = $consulta["0"]["cantidad"];

$cat = $consulta["0"]["id_cat"];

$foto = $consulta["0"]["foto"];

$fotoss = $this->db->select("foto")->from("foto")->where("id_pro",$id_pro)->get()->result_array();

if (!empty($fotoss)) {
$foto1 = $fotoss[0]["foto"];
$foto2 = $fotoss[1]["foto"];
$foto3 = $fotoss[2]["foto"];
}
else{
$foto1 = ""; 
$foto2 = ""; 
$foto3 = ""; 
}



$consulta2 = $this->db->select("descripcion")->from("producto")->join("descripcion","producto.id_descr = descripcion.id")->where("producto.id",$id_pro)->get()->result_array();

if (!empty($consulta2)) {
$descr = $consulta2["0"]["descripcion"];

}
else{
  $descr="";
}

}
?>





<div class="row mt-4">

<?php 
if ($accion == "alta") :
    ?>

<form action="<?=base_url()?>../webservice/backend/registrapro/"  method="post" enctype="multipart/form-data">



<div class="row mt-1 justify-content-center">

    <input type="hidden"
               class="form-control" 
               id="accion"
               name="accion"
               value="<?=$accion?>" />

  <div class="col col-md-6">
    <div class="form-group" id="group-nombre">
      <label for="nombre"><strong>Nombre:</strong></label>
      <input type="text" name="nombre" id="nombre" class="form-control" />
    </div>
<br>
    <div class="form-group" id="group-prec">
      <label for="prec"><strong>Precio:</strong></label>
      <input type="number" step="1" min="0" name="prec" id="prec" class="form-control" />
    </div>
<br>
    <div class="form-group" id="group-cant">
      <label for="cant"><strong>Cantidad:</strong></label>
      <input type="number" step="1" min="1" name="cant" id="cant" class="form-control" />
    </div>
<br>
    <div class="form-group" id="group-descr">
      <label for="descr"><strong>Descripción(opcional):</strong></label>
      <textarea name="descr" id="descr" class="form-control" placeholder="La descripción no debe de ser mayor a 200 caracteres" rows="5"></textarea>
    </div>
<br>
  <div class="form-group" id="group-cat">
    <label for="cat"><strong>Categoría:</strong></label>
    <select name="cat" id="cat" class="form-control">
      <option value="0">-- Seleccionar --</option>
      <!-- Agrega más opciones según sea necesario -->
    </select>
  </div>
<br>
    <div class="form-group" id="group-foto">
      <label for="foto"><strong>Foto:</strong></label>
      <input type="file" name="foto" id="foto" class="form-control" />
    </div>
<br>
    <div class="form-group" id="group-opcio">
      <br>
     <input type="text" name="opcio" id="opcio" value="Fotos adicionales opcionales:" class="form-control" readonly style="text-align: center;" />
    </div>
<br>
    <div class="form-group" id="group-foto1">
      <label for="foto1"><strong>Foto1 (opcional):</strong></label>
      <input type="file" name="foto1" id="foto1" class="form-control" />
    </div>
<br>
    <div class="form-group" id="group-foto2">
      <label for="foto2"><strong>Foto2 (opcional):</strong></label>
      <input type="file" name="foto2" id="foto2" class="form-control" />
    </div>
<br>
    <div class="form-group" id="group-foto3">
      <label for="foto3"><strong>Foto3 (opcional):</strong></label>
      <input type="file" name="foto3" id="foto3" class="form-control" />
    </div>

  </div>



  <div class="mt-4 justify-content-center d-flex mb-8">
    <button class="btn btn-success mx-2" type="submit" id="btn-guardar" name="btn-guardar">
    <i class="fas fa-save fa-2x"></i>
    Guardar
  </button>

     <a type="button" href="<?=base_url()?>frontend/gestionP/<?=$this->session->id_usu?>/<?=$this->session->token?>" class="btn btn-secondary mx-2">
      <i class="fas fa-arrow-circle-left fa-2x"></i>
        Cancelar
      </a>
  </div> 


</form>



<?php 
else:
    ?>


<form action="<?=base_url()?>../webservice/backend/registrapro/"  method="post" enctype="multipart/form-data">



<div class="row mt-1 justify-content-center">

    <input type="hidden"
               class="form-control" 
               id="accion"
               name="accion"
               value="<?=$accion?>" />

               <input type="hidden"
               class="form-control" 
               id="id_pro"
               name="id_pro"
               value="<?=$id_pro?>" />

  <div class="col col-md-6">
    <div class="form-group" id="group-nombre">
      <label for="nombre"><strong>Nombre:</strong></label>
      <input type="text" name="nombre" id="nombre" class="form-control" value="<?=$nombre?>" />
    </div>
<br>
    <div class="form-group" id="group-prec">
      <label for="prec"><strong>Precio:</strong></label>
      <input type="number" step="1" min="0" name="prec" id="prec" class="form-control" value="<?=$prec?>" />
    </div>
<br>
    <div class="form-group" id="group-cant">
      <label for="cant"><strong>Cantidad:</strong></label>
      <input type="number" step="1" min="1" name="cant" id="cant" class="form-control" value="<?=$cant?>" />
    </div>
<br>
    <div class="form-group" id="group-descr">
      <label for="descr"><strong>Descripción(opcional):</strong></label>
      <textarea name="descr" id="descr" class="form-control" placeholder="La descripción no debe de ser mayor a 200 caracteres" rows="5"><?=$descr?></textarea>
    </div>

<br>

  <div class="form-group" id="group-cat">
    <label for="cat"><strong>Categoría:</strong></label>
    <select name="cat" id="cat" class="form-control">
      <!-- Agrega más opciones según sea necesario -->
    </select>
  </div>
<br>
  <div class="form-group" id="group-foto">
  <label for="foto"><strong>Foto:</strong></label>

    <div>
      <img src="<?= base_url() ?>static/images/producto/<?= $foto ?>" alt="Foto existente" width="169" height="169">
    </div>
<br>
  <input type="file" name="foto" id="foto" class="form-control"  />
</div>

<br>
    <div class="form-group" id="group-opcio">
      <br>
     <input type="text" name="opcio" id="opcio" value="Fotos adicionales opcionales:" class="form-control" readonly style="text-align: center;" />
    </div>
<br>

    <div class="form-group" id="group-foto1">
      <label for="foto1"><strong>Foto1 (opcional):</strong></label>

      <?php if ($foto1!=""): ?>
      <div>
      <img src="<?= base_url() ?>static/images/producto/<?= $foto1 ?>" alt="Foto 1" width="169" height="169">
    </div>
    <?php endif; ?>

<br>

      <input type="file" name="foto1" id="foto1" class="form-control" />
    </div>
<br>

    <div class="form-group" id="group-foto2">
      <label for="foto2"><strong>Foto2 (opcional):</strong></label>

      <?php if ($foto2!=""): ?>
      <div>
      <img src="<?= base_url() ?>static/images/producto/<?= $foto2 ?>" alt="Foto 2" width="169" height="169">
    </div>
    <?php endif; ?>

<br>

      <input type="file" name="foto2" id="foto2" class="form-control" />
    </div>
<br>

    <div class="form-group" id="group-foto3">
      <label for="foto3"><strong>Foto3 (opcional):</strong></label>

      <?php if ($foto3!=""): ?>
      <div>
      <img src="<?= base_url() ?>static/images/producto/<?= $foto3 ?>" alt="Foto 3" width="169" height="169">
    </div>
    <?php endif; ?>

<br>

      <input type="file" name="foto3" id="foto3" class="form-control" />
    </div>


</div>
  

  </div>



  <div class="mt-4 justify-content-center d-flex mb-8">
    <button class="btn btn-success mx-2" type="submit" id="btn-guardar" name="btn-guardar">
    <i class="fas fa-save fa-2x"></i>
    Guardar
  </button>

     <a type="button" href="<?=base_url()?>frontend/gestionP/<?=$this->session->id_usu?>/<?=$this->session->token?>" class="btn btn-secondary mx-2">
      <i class="fas fa-arrow-circle-left fa-2x"></i>
        Cancelar
      </a>
  </div> 


</form>

<?php 
endif;
    ?>




<div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px;right:10px;"></div>

</body>
</html>
