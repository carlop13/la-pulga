<?php

	header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");



class Carrito extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("back_model");
        $this->load->model( "carrito_model" );
    }

    public function index(){
        echo "Acceso restingido";
    }

    public function agregarcarrito(){
           
        $idp = $this->input->post( "idproducto" );
        $idu = $this->input->post( "idusuario" );
        $can = $this->input->post( "cantidad" );

        $idusuario  = intval( $idu );
        $idproducto = intval( $idp );
        $cantidad   = intval( $can );

        $cantidadValida = $this->carrito_model->validar_cantidad( $idproducto , $cantidad );

        if( $cantidadValida == true ){
            $existe = $this->carrito_model->existe_carrito( $idusuario, $idproducto );
            

            if( $existe ){
                $actualizar = $this->carrito_model->actualizar_cantidadp( $idusuario, $idproducto, $cantidad );
                if( $actualizar ){
                    $obj = array(
                        "resultado" => true,
                        "mensaje" => "Se actualizó la cantidad del producto"
                    );
                }else{
                    $obj = array(
                        "resultado" => false,
                        "mensaje"  => "No se pudo actualizar la cantidad"
                    );
                }
            }else{
                $resultado = $this->carrito_model->agregar_carrito( $idproducto, $idusuario, $cantidad );

                if( $resultado ){
                    $obj = array(
                        "resultado" => true,
                        "mensaje" => "Se agregó el producto al carrito"
                    );
                }else{
                    $obj = array(
                        "resultado" => false,
                        "mensaje"  => "No se pudo agregar el producto al carrito"
                    );
                }

            }
        }else{
            $obj = array(
                "resultado" => false,
                "mensaje"   => "Cantidad no valida"
            );
        }
        echo json_encode( $obj );
    }

    public function actualizarCantidad(){
        $idusuario = $this->session->id_cli;
        $resultado = $this->carrito_model->actualizar_cantidad( $idusuario );

        if( $resultado > 0 ){
            $obj = array(
                "resultado" => TRUE,
                "cantidad" => $resultado
            );
        }else{
            $obj = array(
                "resultado" => FALSE,
            );
        }

        echo json_encode( $obj );

    }

    public function actualizarCantidadD(){
        $idusuario = $this->session->id_cli;
        $resultado = $this->carrito_model->actualizar_cantidadD( $idusuario );

        if( $resultado > 0 ){
            $obj = array(
                "resultado" => TRUE,
                "cantidad" => $resultado
            );
        }else{
            $obj = array(
                "resultado" => FALSE,
            );
        }

        echo json_encode( $obj );

    }

    public function borrardeseo(){
        $id_list = $this->input->post("id_list");

        //echo $id_list;

        $obj["resultado"] = $this->back_model->delete_lista($id_list);
        $obj["mensaje"] = $obj["resultado"] ? "Se eliminó de tu lista de deseos" : "Imposible eliminar producto";

        echo json_encode($obj["mensaje"]);
    }


     public function mostrardeseos(){
        $idusuario = $this->input->post( "idus" );
        $resultado = $this->carrito_model->get_productos_deseo( $idusuario );
        if( $resultado != NULL ){
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
                                <small><strong>Categoría: </strong>" . $fila->categoria . "<br />
                                <strong> Precio: </strong>$" .number_format( $fila->prec, 2, '.', ',')  ."</small><br />
                                <small><strong>Cantidad Disponible: </strong>" . $fila->cantidad . "<br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                                <br /><br />

                                <div class='d-flex justify-content-center mb-2'>
                                <button title='Borrar Deseo' type='button' class='btn btn-danger' onclick='borrar_deseos(". $fila->id_list .")'  ><i class='fa-solid fa-trash'></i></i></button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <button title='Agregar al Carrito' type='button' class='btn btn-primary' onclick='click_carritoD(". $fila->id .")'  ><i class='fas fa-shopping-cart'></i></i></button>
                                 </div>
                                    
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

        }else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p><strong>No tienes productos agregados en tu lista de deseos<strong/></p>";
        }
        //echo json_encode( $obj );
        echo $salida;

    }   



    public function mostrarcarrito(){
        $idusuario = $this->input->post( "idus" );
        $resultado = $this->carrito_model->get_productos( $idusuario );
        if( $resultado != NULL ){
            $monto=0;
            $salida = "";

             $salida .= "<div class='container'>
                    <div class='row'>";

    foreach ($resultado as $fila) {
        $monto += $fila->prec * $fila->cant;

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
                                <strong> Cantidad: </strong>" . $fila->cant . "</small><br />
                                <strong>Subtotal: </strong> $" . number_format( $fila->prec * $fila->cant,  2, '.', ',') . "</small><br />
                                <a type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#detallesModal' onclick='mostrarDetalles(" . $fila->id . ")'>Ver detalles</a>
                                <br /><br />
                                 <button title='Borrar del Carrito' type='button' class='btn btn-danger' onclick='borrar_producto(". $fila->id .")'  ><i class='fa-solid fa-trash'></i></i></button>
                                        
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





            // Scripts de JavaScript
$salida .= "

<script>
            $(document).ready(function(){
  var showAlert = true;

  function obtenerDatosCarrito() {
    $.ajax({
      'url' : appData.uri_ws+'../webservice/Backend/getcar/'+appData.idusuario,
      'dataType' : 'json',
      'type' : 'GET'
    })
    .done(function(obj) {
      if (obj.resultado) {
        var tota = obj.total;
        var totalCarInput = document.getElementById('totalcar');
        totalCarInput.value = tota;
      } else {
        var tota = obj.total;
        var totalCarInput = document.getElementById('totalcar');
        totalCarInput.value = tota;

        var comInput = document.getElementById('com');
        var comisd =  parseInt(comInput.value);
        if (comisd === 1 && showAlert == true) {
          alert('Lo siento, este producto ya fue comprado');
          showAlert = false;
        }
      
        $(location).attr('href', '');
      }
    })
    .fail(error_ajax);
  }
  
  setInterval(obtenerDatosCarrito, 1000);
});
 //FIN DEL READY
        </script>

";


$total = $monto;
$total = round($total, 2);

$salida .= "<h2 class='total-price'>TOTAL: $" . number_format(  $total, 2, '.', ',') . "</h2>
            </div>
            <input type='hidden' type='number' value='" . $total . "' id='totalcar'> 
            <input type='hidden' type='number' value='1' id='com'>

            <div><strong>Agrega ubicación de envío: </strong> <button class='btn btn-sm btn-success' data-bs-toggle='modal' data-bs-target='#modal-mapa'><i class='fas fa-map-pin fa-2x'></i>
</button></div>";

// Estilos CSS
$salida .= "
<style>
    .m-2 {
        margin: 2rem;
    }

    .d-block {
        display: block;
    }

    .total-price {
        font-weight: bold;
        font-size: 1.5rem;
        color: #333;
    }
</style>";   

        }else{
            $obj = array(
                "resultado" => NULL,
                "mensaje"   => "No se encontraron productos",
                "productos" => $resultado
            );
            $salida = "<p><strong>No tienes productos agregados en tu carrito de compras<strong/></p>";
        }
        //echo json_encode( $obj );
        echo $salida;
        }





    public function eliminarproducto(){
        $idusuario = $this->session->id_cli;
        $idproducto = $this->input->post( "idpro" );
        $resultado = $this->carrito_model->eliminar_producto( $idusuario, $idproducto );


        if( $resultado ){
            $obj = array(
                "resultado" => TRUE,
                "mensaje" => "Se eliminó el producto del carrito"
            );

        }else{
            $obj = array(
                "resultado" => FALSE,
                "mensaje"  => "No se pudo eliminar el producto"
            );
        }
        echo json_encode( $obj );

    }

     public function compracarrito(){
        $idu = $this->session->id_cli;
        $tot = $this->input->post( "total" );
        
        $idusuario = intval( $idu );
        $total = doubleval( $tot );

        $idventa = $this->carrito_model->inserta_venta( $idusuario, $total );

        if( $idventa != false ){
            $resultado = $this->carrito_model->inserta_detalles( $idusuario , $idventa );

            if( $resultado ){

                $eliminar = $this->carrito_model->eliminar_carrito( $idusuario );
                
                if( $eliminar ){
                    $obj = array(
                        "resultado" => TRUE,
                    );
                }else{
                    $obj = array(
                        "resultado" => FALSE,
                    );
                }
            }else{
                $obj = array(
                    "resultado" => FALSE,
                );
            }
        }else{
            $obj = array(
                "resultado" => FALSE,
            );

        }
        echo json_encode($obj);
    }
    





    
    public function mostrarhistorial(){
        $idusuario = $this->input->post( "idus" );
        $resultado = $this->carrito_model->get_hitorial( $idusuario );
        if( $resultado != NULL ){
            $salida = "";
            $salida.= "<table class='tabla_datos table table-hover text-center mx-auto shadow' style='width:100%;'>
                                <thead>
                                    <tr class='text-white' style='background: linear-gradient(to right, #0077FF, #00F4FF);' >
                                        <th scope='col'>Folio</th>
                                        <th scope='col'>Fecha</th>
                                        <th scope='col'>Total</th>
                                        <th scope='col'>Ver detalles</th>
                                        <th scope='col'>Generar factura</th>
                                    </tr>
                                </thead>
                                <tbody>";
                               foreach ($resultado as $fila) {
                                    $salida .= "<tr>" .
                                    "<td  style='text-align: center;'>
                                        ". $fila->folio ."
                                    </td>" .
                                    "<td>" . $fila->fecha . "</td>" .
                                    "<td>" . $fila->total . "</td>" .
                                    "<td>
                                        <a href='http://dtai.uteq.edu.mx/~davgui202/AWOS/proyecto/app/frontend/detalles/".$fila->id."' class='btn btn-primary'><i class='fa-solid fa-circle-info'></i></a>
                                    </td>" .
                                    "<td>
                                        <button type='button' class='btn btn-danger' onclick='factura(". $fila->id .")'  ><i class='fa-solid fa-file-pdf'></i></i></button>
                                    </td>" .
                                    "</tr>";
                                }
            $salida.= "</tbody></table>";
            
        }else{
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

    public function mostrardetalles(){
        $costototal = 0;
        $idusuario = $this->input->post( "idus" );
        $idventa = $this->input->post( "idve" );
        $resultado = $this->carrito_model->get_detalles( $idventa );
        if( $resultado != NULL ){
            $salida = "";
            $salida.= "<table class='tabla_datos table table-hover text-center mx-auto shadow' style='width:100%;'>
                                <thead>
                                    <tr class='text-white' style='background: linear-gradient(to right, #0077FF, #00F4FF);' >
                                        <th scope='col'>Nombre del producto</th>
                                        <th scope='col'>Cantidad</th>
                                        <th scope='col'>Precio</th>
                                        <th scope='col'>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>";
                               foreach ($resultado as $fila) {
                                    $costototal += $fila->subtotal;
                                    $salida .= "<tr>" .
                                    "<td  style='text-align: center;'>
                                        ". $fila->nombre ."
                                    </td>" .
                                    "<td>" . $fila->cantidad . "</td>" .
                                    "<td>" . $fila->precio . "</td>" .
                                    "<td>" . $fila->subtotal . "</td>" .
                                    "</tr>";
                                }
            $costototal += $costototal*0.16;
            $salida.= "</tbody></table><div><h2>TOTAL(+IVA16%): ".$costototal."</h2></div>";
            
        }else{
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


    public function agregardeseo(){
        $idproducto = $this->input->post( "idproducto" );
        $idusuario = $this->input->post( "idusuario" );


        $existe = $this->carrito_model->existe_deseo( $idusuario, $idproducto );

        if( $existe==1 ){
            $obj = array(
                "resultado" => FALSE,
                "mensaje" => "El producto ya está agregado"
            );
        }else{
            $resultado = $this->carrito_model->agregar_deseos( $idusuario, $idproducto );

            if( $resultado ){
                $obj = array(
                    "resultado" => TRUE,
                    "mensaje" => "Se agregó el producto a la lista de deseos"
                );
            }else{
                $obj = array(
                    "resultado" => FALSE,
                    "mensaje"  => "No se pudo agregar el producto a la lista de deseos"
                );
            }
        }
        echo json_encode( $obj );
    }

    public function mostrarc(){
        $idu = $this->input->post( "idusuario" );

        $idusuario = intval( $idu );
        $resultado = $this->carrito_model->get_carrito( $idusuario );

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

    public function borrarproducto(){

        
        
        $idp = $this->input->post( "idproducto" );
        $idu = $this->input->post( "idusuario" );

        $idproducto = intval( $idp );
        $idusuario = intval( $idu );

        $resultado = $this->carrito_model->borrar_producto( $idusuario, $idproducto );

        if( $resultado ){
            $obj = array(
                "resultado" => true,
                "mensaje" => "Se elimino el producto de la lista de deseos"
            );
        }else{
            $obj = array(
                "resultado" => false,
                "mensaje"  => "No se pudo eliminar el producto a la lista de deseos"
            );
        }
        echo json_encode( $obj );
    }

    public function actualizarcantidadp(){        
        
        $idp = $this->input->post( "idproducto" );
        $idu = $this->input->post( "idusuario" );
        $can = $this->input->post( "cantidad" );

        $idproducto = intval( $idp );
        $idusuario = intval( $idu );
        $cantidad = intval( $can );

        $resultado = $this->carrito_model->actualizar_cantidadp( $idusuario, $idproducto, $cantidad );

        if( $resultado ){
            $obj = array(
                "resultado" => true,
                "mensaje" => "Se actualizó la cantidad del producto"
            );
        }else{
            $obj = array(
                "resultado" => false,
                "mensaje"  => "No se pudo actualizar la cantidad"
            );
        }
        echo json_encode( $obj );
    }






}
?>


