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

// REEMPLAZO DE LA VISTA 'datos_cliente' EN FACTURA
public function get_factura($idven){
    $rs = $this->db
        ->select("usuario.nombre as usuario, cliente.nombre, ap, am, ciudad, col, calle, noint, noext, cp, telefono, venta.id as folio, fech, cliente.correo, COUNT(detalle_venta.id) as numproductos, SUM(detalle_venta.cant * detalle_venta.prec) as total")
        ->from("venta")
        ->join("detalle_venta", "detalle_venta.id_vent = venta.id", "inner")
        ->join("cliente", "venta.id_cli = cliente.id", "inner")
        ->join("usuario", "cliente.id_usu = usuario.id", "inner")
        ->join("telefono", "cliente.id = telefono.id_cli", "inner")
        ->where("venta.id", $idven)
        ->where("usuario.activo", 1)
        ->group_by("venta.id")
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

// REEMPLAZO DE LA VISTA 'datos_cliente'
public function get_datos_cliente($correo){
    $rs = $this->db
        ->select("cliente.id, cliente.nombre as nombre, usuario.nombre as usuario, ap, am, correo, ciudad, col, calle, noint, noext, cp, foto, fec_registro, telefono")
        ->from("cliente")
        ->join("usuario", "cliente.id_usu = usuario.id", "inner")
        ->join("telefono", "cliente.id = telefono.id_cli", "inner")
        ->where("correo", $correo)
        ->where("activo", 1)
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
    
    // REEMPLAZO DE TRIGGERS (nom_us, nom_usu y nom_usuario)
public function generar_nombre_usuario($nombre, $ap, $id_usu_excluir = null) {
    $nom = mb_strtoupper(substr(trim($nombre), 0, 3));
    $ape = mb_strtoupper(substr(trim($ap), 0, 3));
    $nomus_base = $nom . $ape;
    $nomus = $nomus_base;
    $num = 1;
    $existe = true;

    while ($existe) {
        $this->db->where('nombre', $nomus);
        if ($id_usu_excluir != null) {
            $this->db->where('id !=', $id_usu_excluir);
        }
        $query = $this->db->get('usuario');
        
        if ($query->num_rows() > 0) {
            $num++;
            $nomus = $nomus_base . $num;
        } else {
            $existe = false;
        }
    }
    return $nomus;
}

public function update_nombre_usuario($id_usu, $nuevo_nombre) {
    $this->db->set("nombre", $nuevo_nombre)
             ->where("id", $id_usu)
             ->update("usuario");
}

}
?>