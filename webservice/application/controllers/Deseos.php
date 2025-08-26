<?php


	header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Deseos extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model( "deseos_model" );
    }

    public function index(){
        echo "Acceso restringido";
    }

    public function borrardeseo(){        
        
        $idp = $this->input->post( "idproducto" );
        $idu = $this->input->post( "idusuario" );

        $idproducto = intval( $idp );
        $idusuario = intval( $idu );

        $resultado = $this->deseos_model->borrar_deseo( $idusuario, $idproducto );

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


}
?>