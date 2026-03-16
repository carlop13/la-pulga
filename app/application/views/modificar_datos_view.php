<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
    <title>Modificar Datos - Almacén La Pulga</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?=base_url()?>static/css/estilos.css" rel="stylesheet">
    <link href="<?=base_url()?>static/css/alert.css" rel="stylesheet">
    
    <script src="<?=base_url()?>static/js/jquery-3.6.1.min.js" ></script>
    <script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>static/js/mensajes.js" ></script>
    <script src="<?=base_url()?>static/js/carritos.js" ></script>

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
                else {
                    $.ajax({
                        "url"       :   appData.uri_ws + "backend/updateusuario",
                        "dataType"  :   "json",
                        "type"      :   "post",
                        "data"      :   {
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

    <style>
        :root {
            --primary-color: #bf2c3b; 
            --primary-hover: #9f2430; 
            --secondary-bg: #f8f9fa;
        }

        body {
            background-color: var(--secondary-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 130px; 
        }

        .promo-bar {
            background-color: #9e1c28; 
            color: white;
            text-align: center;
            padding: 8px 10px;
            font-size: 0.95rem;
            font-weight: 500;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1040;
            letter-spacing: 0.5px;
        }

        .catalog-navbar {
            background-color: var(--primary-color);
            position: fixed;
            top: 35px; 
            width: 100%;
            z-index: 1030;
            padding: 10px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .nav-logo-img {
            height: 55px;
            width: 55px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .search-box {
            position: relative;
            flex-grow: 1;
            max-width: 500px;
            margin: 0 20px;
            visibility: hidden; 
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-action-icon {
            position: relative;
            color: white;
            font-size: 1.2rem;
            background: rgba(255, 255, 255, 0.2);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-action-icon:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .badge-counter {
            position: absolute;
            top: -4px;
            right: -4px;
            background-color: #ffc107; 
            color: #333;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 18px;
            min-height: 18px;
            display: none;
        }

        .btn-logout {
            background-color: #212529; 
            color: white;
            border-radius: 25px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-logout:hover { background-color: #000; color: white; transform: translateY(-2px); }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }
        .page-title::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            height: 3px;
            background-color: var(--primary-color);
        }

        .form-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            padding: 40px;
            margin-bottom: 50px;
        }

        .form-group { margin-bottom: 20px; }
        
        .form-group label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .input-group-text {
            background-color: var(--secondary-bg);
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
        .input-group:focus-within .form-control {
            border-color: var(--primary-color);
        }

        .btn-custom-save {
            background-color: #28a745;
            color: white;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-custom-save:hover { background-color: #218838; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(40,167,69,0.3); }

        .btn-custom-cancel {
            background-color: #6c757d;
            color: white;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-custom-cancel:hover { background-color: #5a6268; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(108,117,125,0.3); }

        .alert-dismissible { position: fixed; bottom: 20px; right: 20px; z-index: 1050; }

        @media (max-width: 768px) {
            body { padding-top: 220px !important; } 
            
            .catalog-navbar { top: 55px !important; }

            .promo-bar {
                height: 56px !important; 
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .catalog-navbar .container {
                flex-direction: column !important;
                align-items: center !important;
            }

            .nav-logo-img { margin-bottom: 15px !important; display: block !important; }

            .search-box { display: none; }

            .action-buttons {
                display: flex !important;
                width: 100% !important;
                justify-content: center !important;
                flex-wrap: wrap !important;
                gap: 10px !important;
            }
            
            .btn-action-icon { width: 38px; height: 38px; font-size: 1rem; }
            .logout-text { display: none; }
            .btn-logout { padding: 8px 12px; border-radius: 50%; }

            .form-card { padding: 20px; }
        }
    </style>
</head>

<body>

    <div class="promo-bar">
        <i class="fas fa-user-circle me-2"></i> Bienvenido(a): <strong><?= $this->session->nombre ?></strong>
    </div>

    <nav class="catalog-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>">
                <img src="<?=base_url()?>static/images/logo.jpeg" class="nav-logo-img" alt="Almacén La Pulga">
            </a>
            
            <div class="search-box"></div>

            <div class="action-buttons">
                <a href="<?= base_url() ?>frontend/principalCliente/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Catálogo">
                    <i class="fa-solid fa-store"></i>
                </a>

                <a href="<?= base_url() ?>frontend/deseos/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Lista de deseos">
                    <i class="fa-solid fa-heart"></i>
                    <script>actualizarCantidadD( <?= $this->session->id_cli ?> );</script>
                    <span id="cantidadDeseos" class="badge-counter"></span>
                </a>

                <a href="<?= base_url() ?>frontend/historial/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Historial de compras">
                    <i class="fa-solid fa-list-alt"></i>
                </a>

                <a href="<?= base_url() ?>frontend/ajuste/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" style="background: white; color: var(--primary-color);" title="Perfil">
                    <i class="fa-solid fa-user"></i>
                </a>

                <a href="<?= base_url() ?>frontend/carrito/<?= $this->session->id_usu ?>/<?= $this->session->token ?>" class="btn-action-icon" title="Carrito de compras">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <script>actualizarCantidad( <?= $this->session->id_cli ?> );</script>
                    <span id="cantidadCarrito" class="badge-counter"></span>
                </a>

                <a href="<?=base_url()?>acceso/cierrasesion/<?=$this->session->id_usu ?>/<?=$this->session->token ?>" class="btn-logout" title="Cerrar sesión">
                    <i class="fa-solid fa-right-from-bracket"></i> <span class="logout-text">Salir</span>
                </a>
            </div>

        </div>
    </nav>

    <?php 
    $consulta = $this->db->select("*")->from("cliente")->where("id",$this->session->id_cli)->get()->result_array();
    $consultatel = $this->db->select("*")->from("telefono")->where("id",$this->session->id_cli)->get()->result_array();                           
    
    $nombre = isset($consulta["0"]["nombre"]) ? $consulta["0"]["nombre"] : "";
    $ap = isset($consulta["0"]["ap"]) ? $consulta["0"]["ap"] : "";
    $am = isset($consulta["0"]["am"]) ? $consulta["0"]["am"] : "";
    $correo = isset($consulta["0"]["correo"]) ? $consulta["0"]["correo"] : "";
    $ciudad = isset($consulta["0"]["ciudad"]) ? $consulta["0"]["ciudad"] : "";
    $col = isset($consulta["0"]["col"]) ? $consulta["0"]["col"] : "";
    $calle = isset($consulta["0"]["calle"]) ? $consulta["0"]["calle"] : "";
    $noint = isset($consulta["0"]["noint"]) ? $consulta["0"]["noint"] : "";
    $noext = isset($consulta["0"]["noext"]) ? $consulta["0"]["noext"] : "";
    $cp = isset($consulta["0"]["cp"]) ? $consulta["0"]["cp"] : "";
    $telefono = isset($consultatel["0"]["telefono"]) ? $consultatel["0"]["telefono"] : "";
    ?>

    <div class="container mt-4 mb-5">
        
        <div class="text-center">
            <h2 class="page-title">Modificar Datos</h2>
            <p class="text-muted mb-4">Actualiza tu información de envío y contacto.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="form-card">
                    <form method="post">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="group-nombre">
                                    <label for="nombre">Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" name="nombre" id="nombre" value="<?=$nombre?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group" id="group-ap">
                                    <label for="ap">Apellido Paterno:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" name="ap" id="ap" value="<?=$ap?>" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" id="group-am">
                                    <label for="am">Apellido Materno:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" name="am" id="am" value="<?=$am?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="group-ciudad">
                                    <label for="ciudad">Ciudad:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                        <input type="text" name="ciudad" id="ciudad" value="<?=$ciudad?>" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" id="group-col">
                                    <label for="col">Colonia:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-signs"></i></span>
                                        <input type="text" name="col" id="col" value="<?=$col?>" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" id="group-calle">
                                    <label for="calle">Calle:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-road"></i></span>
                                        <input type="text" name="calle" id="calle" value="<?=$calle?>" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" id="group-ne">
                                    <label for="ne">No. Ext:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        <input type="text" name="ne" id="ne" value="<?=$noext?>" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" id="group-ni">
                                    <label for="ni">No. Int:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                                        <input type="text" name="ni" id="ni" value="<?=$noint?>" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" id="group-cp">
                                    <label for="cp">C.P.:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                                        <input type="text" name="cp" id="cp" value="<?=$cp?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="group-tel">
                                    <label for="tel">Teléfono:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        <input type="text" name="tel" id="tel" value="<?=$telefono?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <a href="<?=base_url()?>frontend/ajuste/<?=$this->session->id_usu?>/<?=$this->session->token?>" class="btn btn-custom-cancel">
                                <i class="fas fa-times-circle me-2"></i>Cancelar
                            </a>
                            <button class="btn btn-custom-save" type="button" id="btn-guardar" name="btn-guardar">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>

                    </form>
                </div> 

            </div>
        </div>

    </div>

    <div id="mensajee" class="col-md-5 d-flex flex-column-reverse position-fixed" style="bottom:20px; right:20px; z-index: 1060;"></div>

    <script>
        setInterval(function() {
            $('.badge-counter').each(function() {
                var valor = $(this).text().trim();
                if (valor === "" || valor === "0") {
                    $(this).hide();
                } else {
                    $(this).css('display', 'flex');
                }
            });
        }, 500); 
    </script>

</body>
</html>