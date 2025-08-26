<?php 
class Usuarios_model extends CI_Model{

public function update_usuario($id_usu,$password){
		$this->db
		 ->set("password",$password)
		 ->where("id",$id_usu)
		 ->update("usuario");

		 return $this->db->affected_rows() == 1;
}


public function update_cliente($id_cli,$nombre,$ap,$am,$correo,$ciudad,$col,$calle,$ni,$ne,$cp){
		$this->db
		 ->set("nombre",$nombre)
		 ->set("ap",$ap)
		 ->set("am",$am)
		 ->set("ciudad",$ciudad)
		 ->set("col",$col)
		 ->set("calle",$calle)
		 ->set("noint",$ni)
		 ->set("noext",$ne)
		 ->set("cp",$cp)
		 ->where("id",$id_cli)
		 ->update("cliente");

		 return $this->db->affected_rows() == 1;
}

public function update_tel($id_cli,$tel){
		$this->db
		 ->set("telefono",$tel)
		 ->where("id_cli",$id_cli)
		 ->update("telefono");

		 return $this->db->affected_rows() == 1;
}

public function delete_usuario($id_cli){
		$this->db
		 ->set("activo",0)
		 ->where("id",$id_cli)
		 ->update("usuario");

		 return $this->db->affected_rows() == 1;
}

public function get_factura($idven){
	$rs = $this->db
    ->select("usuario.nombre as usuario, datos_cliente.nombre, ap, am, ciudad, col, calle, noint, noext, cp, telefono, idven as folio, fech, detalle_ventaa.correo, numproductos, total")
    ->from("detalle_ventaa")
    ->join("datos_cliente", "detalle_ventaa.correo = datos_cliente.correo")
    ->join("usuario", "datos_cliente.id_usu = usuario.id")
    ->where("detalle_ventaa.idven", $idven)
    ->where("usuario.activo", 1)
    ->get();

			return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_cliente(){
$rs = $this->db
		->select("*")
		->from("cliente AS cl")
		->order_by("id")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_admin(){
	$rs = $this->db
		->select("*")
		->from("administrador")
		->order_by("id")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_datos_cliente($correo){
$rs = $this->db
		->select("datos_cliente.id,datos_cliente.nombre as nombre,usuario,ap,am,rfc,correo,ciudad,col,calle,noint,noext,cp,foto,fec_registro,telefono")
		->from("datos_cliente")
		->join("usuario","datos_cliente.usuario = usuario.nombre")
		->where("correo",$correo)
		->where("activo",1)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function update_token($id,$token){
	$this->db
		 ->set("token",$token)
		 ->where("id",$id)
		 ->update("usuario");

		 return $this->db->affected_rows() == 1;
}

public function exists_correo( $correo ) {
	$rs= $this->db
				->from("cliente")
				->join("usuario","cliente.id_usu=usuario.id")
				->where("correo",$correo)
				->where("activo",1)
				->get();
				return $rs->num_rows() > 0 ? 1 : 2;
}

public function exists_correo2( $correo ) {
	$rs= $this->db
				->from("administrador")
				->join("usuario","administrador.id_usu=usuario.id")
				->where("correo",$correo)
				->where("activo",1)
				->get();
				return $rs->num_rows() > 0 ? 1 : 2;
}


public function exists_usuario( $correo,$contra ) {
	$rs= $this->db
				->from("cliente")
				->join("usuario","cliente.id_usu=usuario.id")
				->where("correo",$correo)
				->where("password",$contra)
				->where("activo",1)
				->get();
				return $rs->num_rows() > 0 ? 1 : 2;
}

public function exists_usuario2( $correo,$contra ) {
	$rs= $this->db
				->from("administrador")
				->join("usuario","administrador.id_usu=usuario.id")
				->where("correo",$correo)
				->where("password",$contra)
				->where("activo",1)
				->get();
				return $rs->num_rows() > 0 ? 1 : 2;
}


public function insert_usuario($data1,$data2,$data3){
		$this->db->insert("usuario",$data1);
		$this->db->insert("cliente",$data2);
		$this->db->insert("telefono",$data3);
		return $this->db->affected_rows() == 1;
}

public function insert_usuario2($data1,$data2){
		$this->db->insert("usuario",$data1);
		$this->db->insert("administrador",$data2);
		return $this->db->affected_rows() == 1;
}

}
?>