<?php 
class Usuarioss_model extends CI_Model{


public function exists_usuario3( $correo ) {
	$rs= $this->db
				->from("cliente")
				->join("usuario","cliente.id_usu=usuario.id")
				->where("correo",$correo)
				->where("activo",1)
				->get();
				return $rs->num_rows() > 0 ? 1 : 2;
}

public function exists_usuario4( $correo ) {
	$rs= $this->db
				->from("administrador")
				->join("usuario","administrador.id_usu=usuario.id")
				->where("correo",$correo)
				->where("activo",1)
				->get();
				return $rs->num_rows() > 0 ? 1 : 2;
}

}
?>