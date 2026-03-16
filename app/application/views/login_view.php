<script>
    var appData = {
        uri_app : "<?= base_url() ?>",
        uri_ws  : "<?= base_url() ?>../webservice/"
    }
</script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v16.0&appId=1257966064809466&autoLogAppEvents=1" nonce="5nJFs8E7"></script>

<style>
    :root {
        --primary-color: #bf2c3b; 
        --primary-hover: #9f2430;
    }

    .login-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        margin-top: 40px;
        margin-bottom: 50px;
    }

    .login-header {
        background-color: var(--primary-color);
        padding: 30px 20px;
        text-align: center;
        border-bottom: none;
    }

    .login-logo {
        height: 90px;
        width: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        background-color: white;
        margin-top: 15px;
    }

    .login-body {
        padding: 40px 30px;
        background-color: white;
    }

    /* Estilo de los inputs */
    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
        color: var(--primary-color);
    }

    .form-control {
        border-left: none;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }

    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control,
    .input-group:focus-within .toggle-password {
        border-color: var(--primary-color);
    }

    .toggle-password {
        background-color: transparent;
        border: 1px solid #ced4da;
        border-left: none;
        color: #6c757d;
        border-radius: 0 0.25rem 0.25rem 0;
        cursor: pointer;
        padding: 0 15px;
        transition: color 0.3s;
    }

    .toggle-password:focus { outline: none; }
    .toggle-password:hover { color: var(--primary-color); }

    /* Botones */
    .btn-login {
        background-color: var(--primary-color);
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: var(--primary-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(191, 44, 59, 0.3);
    }

    .btn-cancel {
        background-color: #6c757d;
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
        color: white;
        transform: translateY(-2px);
    }

    /* Links de ayuda */
    .auth-links a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
        cursor: pointer;
    }

    .auth-links a:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    /* Modal */
    #modal-contra .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    #modal-contra .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-bottom: none;
    }
    #modal-contra .btn-close { filter: invert(1); }
</style>

<div class="row mt-3 justify-content-center">
    <div class="col-md-6 col-lg-5">
        
        <div class="card login-card">
            
            <div class="card-header login-header text-white">
                <h3 class="mb-0 fw-bold">Bienvenido</h3>
                <img src="<?=base_url()?>static/images/logo.jpeg" class="login-logo" alt="Logo La Pulga">
            </div>
            
            <div class="card-body login-body">
                <form method="post" enctype="multipart/form-data">
                    
                    <div class="form-group mb-4" id="group-correo">
                        <label for="correo" class="fw-bold text-secondary mb-2">CORREO ELECTRÓNICO:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="ej.: tunombre@email.com"/>
                        </div>
                    </div>

                    <div class="form-group mb-4" id="group-contrasenia">
                        <label for="contrasenia" class="fw-bold text-secondary mb-2">CONTRASEÑA:</label> 
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Tu contraseña..." />
                            <button id="mostrarContrasenia" type="button" class="toggle-password" title="Mostrar/Ocultar">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="<?=base_url()?>" class="btn-cancel">
                            <i class="fas fa-times-circle me-1"></i> CANCELAR
                        </a>
                        <button type="button" class="btn-login" id="btn-entrar" name="btn-entrar">
                            INGRESAR <i class="fas fa-sign-in-alt ms-1"></i>
                        </button>
                    </div>

                    <div class="text-center mt-5 auth-links">
                        <p class="mb-2 text-muted">¿No tienes una cuenta? <a href="<?=base_url()?>acceso/registro">Regístrate aquí</a></p>
                        <p class="mb-0 text-muted">¿Olvidaste tu contraseña? <a data-bs-toggle="modal" data-bs-target="#modal-contra">Click aquí</a></p>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
    const contraseniaInput = document.getElementById('contrasenia');
    const mostrarContraseniaBtn = document.getElementById('mostrarContrasenia');

    mostrarContraseniaBtn.addEventListener('click', function() {
        if (contraseniaInput.type === 'password') {
            contraseniaInput.type = 'text';
            mostrarContraseniaBtn.innerHTML = '<i class="fas fa-eye-slash"></i>'; 
        } else {
            contraseniaInput.type = 'password';
            mostrarContraseniaBtn.innerHTML = '<i class="fas fa-eye"></i>'; 
        }
    });
</script>

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
            return true;
        }
    });
});
</script>

<div class="modal fade" id="modal-contra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-key me-2"></i>Recuperar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4">
                <form>
                    <div class="form-group" id="group-correorecu">
                        <label for="correorecu" class="fw-bold text-secondary mb-2">Ingresa tu correo registrado:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="correorecu" id="correorecu" placeholder="ej.: tunombre@email.com"/>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer d-flex justify-content-center border-0 pb-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 20px; padding: 8px 25px;">
                    <i class="fas fa-ban me-1"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-recuperar" style="background-color: var(--primary-color); border: none; border-radius: 20px; padding: 8px 25px;">
                    <i class="fas fa-paper-plane me-1"></i> Enviar Código
                </button>
            </div>
            
        </div>
    </div>
</div>