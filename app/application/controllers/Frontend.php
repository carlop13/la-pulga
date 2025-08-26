<?php 
class FrontEnd extends CI_Controller
{
	
		public function index(){
		$data = array(
			"titulo" => "Almacén La Pulga",
			"js" => array("js/mapa.js"),
			"css" => array("css/estilo.css")

		);

		$this->load->helper("mensaje");
		$this->load->view("headerr_page_view",$data);
		$this->load->view("prin_view");
		$this->load->view("footerr_page_view");
	}


	public function principalCliente($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view("catalogo_view");

	}


	public function principalAdmin($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view("panel_ad_view");


	}

		public function ajuste($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);

		$this->load->helper("mensaje");
		$this->load->view("ajustes_view");

	}

	public function ajustead($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);

		$this->load->helper("mensaje");
		$this->load->view("ajustes_ad_view");

	}

	public function modatos($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view("modificar_datos_view");
	}

	public function deseos($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view( "deseos_view" );
	}

	public function carrito($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view("carrito_view");
	}

	public function historial($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);		
		$this->load->view("historial_view");

	}

	public function detalleventas($id_usu=0,$token="",$idvent=0){
		verifica_sesion($id_usu,$token,$idvent);
		$data = array(
			"titulo" => "Detalles de la venta",
			"css" => array("css/alert.css","css/estilos.css"),
			"js" => array("js/mensajes.js","js/detalle_venta.js")
		);

		$data2 = array(
			"idvent"=>$idvent
		);

		$this->load->helper("mensaje");
		$this->load->view("header_page_view",$data);
		$this->load->view("detalle_venta_view",$data2);
		$this->load->view("footer_page_view");
	}


	public function facturapdf($id_usu=0,$token="",$idvent=0){
		verifica_sesion($id_usu,$token);
		$data = array(
			"titulo" => "Factura",
			"css" => array("css/alert.css","css/estilos.css"),
			"js" => array("js/mensajes.js","js/detalle_venta.js")
		);

		$data2 = array(
			"idvent"=>$idvent
		);

		$this->load->helper("mensaje");
		$this->load->view("header_page_view",$data);
		$this->load->view("factura_pdf_view",$data2);
		$this->load->view("footer_page_view");
	}

	public function gestionP($id_usu=0,$token="",$mensaje=""){
		verifica_sesion($id_usu,$token);
		$data = array(
			"mensaje"=>$mensaje
		);
		$this->load->helper("mensaje");
		$this->load->view("productos_view",$data);
	}

	public function ab_producto($id_usu=0,$token="",$accion="",$mensaje="",$id=""){
		verifica_sesion($id_usu,$token);
		$data = array(
			"accion"=>$accion,
			"mensaje"=>$mensaje,
			"id_pro"=>$id
		);
		$this->load->helper("mensaje");
		$this->load->view("ab_pro_view",$data);
	}

	public function reportes($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view("reportes_view");
	}

	public function clientes($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view("clientes_view");
	}

	public function carrusel($id_usu=0,$token="",$mensaje=""){
		verifica_sesion($id_usu,$token);

		$data = array(
			"mensaje"=>$mensaje
		);

		$this->load->helper("mensaje");
		$this->load->view("carrusel_view",$data);
	}

	public function pedidos($id_usu=0,$token=""){
		verifica_sesion($id_usu,$token);
		$this->load->helper("mensaje");
		$this->load->view("pendientes_view");
	}

	public function recuperacontrasenia($id=0,$nombre="",$ap="",$am="",$correo=""){

		$data = array(
			"id"=>$id,
			"nombre"=>$nombre,
			"ap"=>$ap,
			"am"=>$am,
			"correo"=>$correo

		);

		$this->load->view("recuperar_view",$data);
	}

	public function catalogousux(){

		$this->load->view("catalogox_view");
	}

	public function muebles(){

		$this->load->view("muebles_view");
	}

	public function decoracion(){

		$this->load->view("decoracion_view");
	}

	public function ropa(){

		$this->load->view("ropa_view");
	}

	public function calzado(){

		$this->load->view("calzado_view");
	}

	public function juguetes(){

		$this->load->view("juguetes_view");
	}

	public function otro(){

		$this->load->view("otro_view");
	}

	
}

?>