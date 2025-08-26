<?php 
function mensaje($mensaje,$tipo = "info"){
	$miApp =&get_instance ();
	$miApp->session->set_flashdata("mensaje",$mensaje);
	$miApp->session->set_flashdata("tipo",$tipo);
}


function alert($tipo, $mensaje){
	$icono=" ";
	switch( $tipo ) {
		case "success":
			$icono = "fa-check-circle";
			break;

			case "primary":
		$icono = "fa-info-circle";
			break;
		case "secondary":
		$icono = "fa-info-circle";
			break;
		case "light":
		$icono = "fa-info-circle";
			break;
		case "dark":
		$icono = "fa-info-circle";
			break;

		case "info":
			$icono = "fa-info-circle";
			break;

		case "warning":
			$icono = "fa-exclamation-triangle";
			break;

		case "danger":
			$icono = "fa-ban";
			break;

	}

	echo '<div class="alert alert-'.
	$tipo.' alert-dismissible fade show col-md-16 mt-3" role="alert"><i class="fas '.$icono.' fa-2x"></i>   '.$mensaje.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

}


?>