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

    .register-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        margin-top: 40px;
        margin-bottom: 50px;
    }

    .register-header {
        background-color: var(--primary-color);
        padding: 30px 20px;
        text-align: center;
        border-bottom: none;
    }

    .register-logo {
        height: 90px;
        width: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        background-color: white;
        margin-top: 15px;
    }

    .register-body {
        padding: 40px 40px;
        background-color: white;
    }

    /* Estilo de los inputs */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
        color: var(--primary-color);
    }

    .form-control {
        border-left: none;
        padding-left: 0;
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

    /* Separadores de sección en el formulario */
    .section-divider {
        font-size: 1.1rem;
        color: var(--primary-color);
        font-weight: 700;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    /* Botones */
    .btn-register {
        background-color: var(--primary-color);
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
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
</style>

<div class="row mt-3 justify-content-center">
    <div class="col-md-10 col-lg-8">
        
        <div class="card register-card">
            
            <div class="card-header register-header text-white">
                <h3 class="mb-0 fw-bold">Crear Cuenta Nueva</h3>
                <img src="<?=base_url()?>static/images/logo.jpeg" class="register-logo" alt="Logo La Pulga">
            </div>
            
            <div class="card-body register-body">
                <form method="post" enctype="multipart/form-data">
                    
                    <h4 class="section-divider"><i class="fas fa-user-circle me-2"></i> Datos de Acceso</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="group-correo">
                                <label for="correo">CORREO ELECTRÓNICO:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="ej.: tunombre@email.com"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="group-password">
                                <label for="password">CONTRASEÑA:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mínimo 8 caracteres"/>
                                    <button id="mostrarContrasenia" type="button" class="toggle-password" title="Mostrar/Ocultar">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="section-divider"><i class="fas fa-address-card me-2"></i> Información Personal</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="group-nombre">
                                <label for="nombre">NOMBRE(S):</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="nombre" name="nombre"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group" id="group-ap">
                                <label for="ap">APELLIDO PATERNO:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" name="ap" id="ap"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="group-am">
                                <label for="am">APELLIDO MATERNO:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="am" name="am"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group" id="group-tel">
                                <label for="tel">TELÉFONO A 10 DÍGITOS:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Ej: 5512345678"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="section-divider"><i class="fas fa-map-marked-alt me-2"></i> Dirección de Envío</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="group-ciudad">
                                <label for="ciudad">CIUDAD:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="group-col">
                                <label for="col">COLONIA:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-signs"></i></span>
                                    <input type="text" class="form-control" id="col" name="col"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" id="group-calle">
                                <label for="calle">CALLE:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-road"></i></span>
                                    <input type="text" class="form-control" id="calle" name="calle"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" id="group-ne">
                                <label for="ne">NO. EXTERIOR:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    <input type="text" class="form-control" id="ne" name="ne"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" id="group-ni">
                                <label for="ni">NO. INTERIOR (Opcional):</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                                    <input type="text" class="form-control" id="ni" name="ni"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" id="group-cp">
                                <label for="cp">CÓDIGO POSTAL:</label> 
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                                    <input type="text" class="form-control" id="cp" name="cp"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <a href="<?=base_url()?>" class="btn-cancel">
                            <i class="fas fa-times-circle me-1"></i> CANCELAR
                        </a>
                        <button type="button" class="btn-register" id="btn-guardar" name="btn-guardar">
                            <i class="fas fa-save me-1"></i> GUARDAR REGISTRO
                        </button>
                    </div>

                    <div class="text-center mt-5 auth-links">
                        <p class="mb-0 text-muted">¿Ya tienes una cuenta? <a href="<?=base_url()?>acceso/login">Ir a login</a></p>
                    </div>

                </form>
            </div>
            
        </div>

    </div>
</div>

<script>
    const contraseniaInput = document.getElementById('password');
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

<br><br><br>