<?php 
class Acceso extends CI_Controller
{

	 function __construct(){
        parent::__construct();
        //load user model
        $this->load->helper( "sesiones" );
        $this->load->library('session');	
		$this->load->model("usuarioss_model");
    }


public function index(){
		redirect(base_url());
	}



public function login(){
		if($this->session->userdata( "token" )){

			if($this->session->tipoo === "administrador" ){
            redirect(base_url().'frontend/principalAdmin/'.$this->session->id_usu.'/'.$this->session->token );
        }
        else{
        	redirect(base_url().'frontend/principalCliente/'.$this->session->id_usu.'/'.$this->session->token );
        }
        }


        $this->load->helper("mensaje");
        $this->load->view( "header_page_view", array(
            "titulo" => "Login",
			"css" => array("css/login.css"),
			"js" => array("js/mensajes.js","js/login.js")
        ));
		$this->load->view("login_view");
		$this->load->view("footer_page_view");
	}

public function inicio($id_usu,$token,$nombre,$correo,$id_cli,$contra,$tipo,$nomcli){
	$this->session->set_userdata( array(
		"id_usu" => $id_usu,
		"token" => $token,
		"nombre" => $nomcli,
		"correo" => $correo,
		"id_cli" => $id_cli,
		"contra" => $contra,
		"nomusu" => $nombre,
		"tipoo" => $tipo
	));

	if ($tipo === "administrador") {
		//REDIRIGIR A VISTA DE ADMINISTRADOR
	redirect(base_url()."frontend/principalAdmin/$id_usu/$token");
	}
	else{
		//REDIRIGIR A VISTA DE CLIENTE
	redirect(base_url()."frontend/principalCliente/$id_usu/$token");
	}

}

	public function registro(){
		$data = array(
			"titulo" => "Registro",
			"css" => array("css/alert.css","css/login.css"),
			"js" => array("js/registro.js","js/mensajes.js")
		);
		$this->load->helper("mensaje");
		$this->load->view("header_page_view",$data);
		$this->load->view("registro_view");
		$this->load->view("footer_page_view");
	}

	 public function av(){
    	$data = array(
			"titulo" => "Aviso",
			"css" => array("css/alert.css"),
			"js" => array("js/mensajes.js")
		);
		$this->session->unset_userdata('loggedIn');
    	$this->session->unset_userdata('userData');
		$this->load->view("header_page_view",$data);
		$this->load->view("aviso_view");
		$this->load->view("footer_page_view");
    }


 

public function cierrasesion($correo,$token){
	verifica_sesion($correo,$token);

	if(isset( $this->session->user )){
		$this->session->unset_userdata('loggedIn');
    	$this->session->unset_userdata('userData');
    	$this->session->unset_userdata('user');
            redirect("https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=".base_url()."acceso/cierrasesion/$correo/$token" );
        }

    $this->session->unset_userdata( array("id_usu","token","nombre","correo","id_cli","contra","nomusu","user","tipo"
	));
	$this->session->sess_destroy();

	redirect(base_url());
}



}

?>


