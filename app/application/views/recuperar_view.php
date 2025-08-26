<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta author="Carlos Guadalupe López Trejo">
  <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">

   <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <title>Recuperar Contraseña</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 10px;
    }

    input[type="password"],
    input[type="text"],
    #log,#resetPasswordBtn {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    #log,#resetPasswordBtn {
      background-color: #4caf50;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

     a {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    a {
      background-color: #4caf50;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    button[type="button"]:hover {
  transform: scale(1.05);
}

 a[type="button"]:hover {
  transform: scale(1.05);
}

    #log,#resetPasswordBtn:hover {
      background-color: #45a049;
    }

    a:hover {
      background-color: #45a049;
    }

    .message {
      text-align: center;
      margin-bottom: 20px;
    }

    .success-message {
      color: green;
    }

    .error-message {
      color: red;
    }

    #mostrarContrasenia {
  background-color: transparent;
  border: none;
  cursor: pointer;
  outline: none;
}

#mostrarContrasenia i {
  color: #555;
  font-size: 18px;
}

#mostrarContrasenia:hover i {
  color: #000;
}



  </style>
</head>
<body>
  <br />
  <div class="container">
    <h1>Recuperar Contraseña</h1>

   <div><strong>Nombre: </strong><?=$nombre?> <?=$ap?> <?=$am?></div>
   <br />
   <div><strong>correo: </strong><?=$correo?></div>
   <br />

    <div id="message" class="message" style="display: none;"></div>

    <label for="password">Nueva Contraseña:</label>
    <input type="password" id="password" placeholder="Ingresa tu nueva contraseña">

    <button id="mostrarContrasenia"><i class="fas fa-eye"></i></button>
    <br />
    <br />

    <label for="confirmPassword">Confirmar Contraseña:</label>
    <input type="password" id="confirmPassword" placeholder="Confirma tu nueva contraseña">
    <button type="button" id="resetPasswordBtn">Restablecer Contraseña</button>
    <button type="button" id="log" href="">Regresar al login</button>
  </div>

   <script>
  
    document.getElementById("resetPasswordBtn").addEventListener("click", function() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;

      if (password && confirmPassword) {
        if(password.length > 8){
        if (password === confirmPassword) {
          
          // Aquí puedes agregar la lógica para restablecer la contraseña
          console.log("Contraseña restablecida correctamente.");
          document.getElementById("message").innerHTML = "Contraseña restablecida correctamente.";
          document.getElementById("message").style.display = "block";
          document.getElementById("message").style.color = "green";
          document.getElementById("password").value = "";
          document.getElementById("confirmPassword").value = "";

          setTimeout(function(){
      window.location.href = '<?=base_url()?>../webservice/backend/cambiacontra/<?=$id?>/'+password;
    },3000);

        }
        else{
          document.getElementById("message").innerHTML = "Las contraseñas no coinciden.";
          document.getElementById("message").style.display = "block";
          document.getElementById("message").style.color = "red";
        }

        } else {
          document.getElementById("message").innerHTML = "La contraseña debe contener más de 8 caracteres";
          document.getElementById("message").style.display = "block";
          document.getElementById("message").style.color = "red";
        }
      } else {
        document.getElementById("message").innerHTML = "Por favor ingresa una nueva contraseña y confírmala.";
        document.getElementById("message").style.display = "block";
        document.getElementById("message").style.color = "red";
      }
    });

    document.getElementById("log").addEventListener("click", function() {
      window.location.href = '<?=base_url()?>acceso/login';
    });
  </script>

    <script>
  // Obtiene el campo de contraseña y el botón
  const contraseniaInput = document.getElementById('password');
  const contrasenia = document.getElementById('confirmPassword');
  const mostrarContraseniaBtn = document.getElementById('mostrarContrasenia');

  // Agrega un evento de clic al botón
  mostrarContraseniaBtn.addEventListener('click', function() {
    if (contraseniaInput.type === 'password') {
      // Si el campo es de tipo contraseña, cambia a tipo texto
      contraseniaInput.type = 'text';
      contrasenia.type = 'text';
       mostrarContraseniaBtn.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Cambia el ícono a ojo cerrado
    } else {
      // Si el campo es de tipo texto, cambia a tipo contraseña
      contraseniaInput.type = 'password';
      contrasenia.type = 'password';
       mostrarContraseniaBtn.innerHTML = '<i class="fas fa-eye"></i>'; // Cambia el ícono a ojo abierto
    }
  });
</script>

    </div>
</body>
</html>
