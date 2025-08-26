<?php
function verifica_sesion($id_usu, $token){
	//Referencia a mi aplicación
	$miApp = &get_instance();

	if(!($miApp->session->has_userdata("id_usu") &&
		$miApp->session->has_userdata("token") &&
		$miApp->session->id_usu == $id_usu &&
		$miApp->session->token == $token)){
		//La sesión es inválida
		mensaje("Sesión inválida","danger");
		redirect(base_url());
	}
}
?>