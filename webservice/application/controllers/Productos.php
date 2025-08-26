<?php
	header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");




class Productos extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model( "productos_model" );

        // Establecer la codificación UTF-8
        header('Content-Type: text/html; charset=utf-8');
    }


    public function index(){
        echo "Acceso restingido";
    }



    public function getproductos( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productos( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>

                            <div class='card-footer'>
                            <br />
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
<a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>

<br /><br />

                              <div class='input-group'>
  <div class='input-group-prepend'>
    <button class='btn btn-outline-secondary' type='button' id='btn-remove' onclick=\"decrementValue('cantidad".$fila->id."')\"><i class='fas fa-minus'></i></button>
  </div>
  <input type='text' name='cantidad".$fila->id."' value='1' step='1' data-decimals='0' id='cantidad".$fila->id."' class='form-control text-center' readonly>
  <div class='input-group-append'>
   <button class='btn btn-outline-secondary' type='button' id='btn-add' onclick=\"incrementValue('cantidad".$fila->id."', ".$fila->cantidad.")\"><i class='fas fa-plus'></i></button>

  </div>
</div>


                                <br />
                                <div class='d-flex justify-content-center mb-2'>
<button title='Agregar a la Lista de Deseos' type='button' class='btn btn-danger ".$clase."' onclick='click_deseo(".$fila->id.")' ><i class='fas fa-heart'></i></button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button title='Agregar al Carrito' type='button' class='btn btn-primary ".$clase."' onclick='click_carrito(". $fila->id.")'  ><i class='fas fa-shopping-cart'></i></button>
</div>

                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

                <script>
function incrementValue(inputId, max) {
  var input = document.getElementById(inputId);
  var value = parseInt(input.value); // Convertir a número entero
  var maxx = parseInt(max);
  if (value < maxx) {
    input.value = value + 1;
  }
}

function decrementValue(inputId) {
  var input = document.getElementById(inputId);
  var value = parseInt(input.value); // Convertir a número entero
  if (value > 1) {
    input.value = value - 1;
  }
}
</script>



<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }





       public function getproductosx( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productos( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>
                            <div class='card-footer'>
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }



     public function getproductosmue( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productosmue( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>
                            <div class='card-footer'>
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }


    public function getproductosdec( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productosdec( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>
                            <div class='card-footer'>
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }



     public function getproductoropa( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productosropa( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>
                            <div class='card-footer'>
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }


     public function getproductosjugue( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productosjuguetes( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>
                            <div class='card-footer'>
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }


    public function getproductoscal( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productoscalzado( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>
                            <div class='card-footer'>
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }


 public function getproductosotro( ){
        $consulta = $this->input->post( "consulta" );
        $val = $this->input->post( "valor" );

        $clase = ( $val != "" ) ? "" : "disabled";

        $resultado = $this->productos_model->get_productosotro( $consulta );
     if ($resultado != NULL) {
    $obj = array(
        "resultado" => TRUE,
        "mensaje" => "Productos recuperados",
        "productos" => $resultado
    );
    $salida = "";
    $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $salida .= "<div class='col-md-3'>
                        <div class='card mb-3'>
                            <h6 class='card-header'>" . $fila->nombre . "</h6>
                            <div class='card-body'>
                                <img src='" . base_url() . "../app/static/images/producto/" . $fila->foto . "' class='img-producto'  width='100' alt='texto alternativo' style='display: block; margin: 0 auto; border-top-left-radius: 15%; border-bottom-right-radius: 15%;' class='shadow' />
                            </div>
                            <div class='card-footer'>
                                <strong>Precio: </strong> $" . number_format($fila->prec, 2, '.', ',') . "<br />
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong>Cantidad Disponible: </strong>" . $fila->cantidad . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                            </div>
                        </div>
                    </div>";
    }

    $salida .= "</div>
                </div>

<style>
    
    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: bold;
    }
    
    .card-footer {
        background-color: #f0f0f0;
        padding: 10px 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>
                ";
}

else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p>No hay datos</p>";
        }
        //echo json_encode( $obj );
        echo $salida;
    }





    public function getproductosf(){
        $consulta = $this->input->post( "consulta" );
        $resultado = $this->productos_model->get_productos( $consulta );

        if( $resultado != NULL ){
            $obj = array(
                "resultado" => true,
                "data" => $resultado
            );
        }else{
            $obj = array(
                "resultado" => false
            );
        }

        echo json_encode( $obj );


    }
    
    public function getproductof(){
        $idp = $this->input->post( "idproducto" );


        $idproducto = intval( $idp );

        $resultado = $this->productos_model->get_producto( $idproducto );

        if( $resultado != false ){
            $obj = array(
                "resultado" => true,
                "data" => $resultado
            );
        }else{
            $obj = array(
                "resultado" => false
            );
        }

        echo json_encode( $obj );


    }





    public function agregardeseo(){
        $idproducto = $this->input->post( "idproducto" );
        $idusuario = $this->input->post( "idusuario" );
        $resultado = $this->productos_model->agregar_deseos( $idusuario, $idproducto );

        if( $resultado ){
            $obj = array(
                "resultado" => true,
                "mensaje" => "Se agrego el producto a la lista de deseos"
            );
        }else{
            $obj = array(
                "resultado" => false,
                "mensaje"  => "No se pudo agregar el producto a la lista de deseos"
            );
        }
        echo json_encode( $obj );
    }




}
?>



