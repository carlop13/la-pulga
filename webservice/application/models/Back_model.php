<?php 
class Back_model extends CI_Model{

public function get_inventario(){
$rs = $this->db
		->select("*")
		->from("video_inven")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_cart($idcli){
$rs = $this->db
		->select("*")
		->from("carrito")
		->join('producto', 'carrito.id_pro = producto.id', 'inner')
		->where("id_cli",$idcli)
		->where(' producto.cantidad >' , 0)
		->where(' producto.estado' , 1)
		->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_lista($corr){
$rs = $this->db
		->select("*")
		->from("datos_lista")
		->where("correo",$corr)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_carrito($corr){
$rs = $this->db
		->select("*")
		->from("datos_carrito")
		->where("correo",$corr)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}


public function detalle_venta($corr){
$rs = $this->db
		->select("*")
		->from("detalle_ventaa")
		->where("correo",$corr)
		->where("activo",1)
		->order_by("fech", "desc")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function ventas(){
$rs = $this->db
		->select("venta.id as id, fech, folio, total, nombre, ap, am")
		->from("venta")
		->join('cliente', 'venta.id_cli = cliente.id', 'inner')
		->order_by("fech", "desc")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function tel(){

$rs = $this->db->query("CALL telefonos()");

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function ventas_reportes($inicio,$fin){
$rs = $this->db
		->select("venta.id as id, fech, folio, total, nombre, ap, am")
		->from("venta")
		->join('cliente', 'venta.id_cli = cliente.id', 'inner')
		->where("fech >=",$inicio)
		->where("fech <=",$fin)
		->order_by("fech", "desc")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function usu_act(){
$rs = $this->db
		->select("cliente.nombre as nombre, ap, am, correo, usuario.nombre as nombreusu")
		->from("cliente")
		->join('usuario', 'cliente.id_usu = usuario.id', 'inner')
		->where("activo",1)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}


public function venta_detalle($id){
$rs = $this->db
		->select("*")
		->from("venta_detalle")
		->where("id_vent",$id)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function venta_mes(){
$rs = $this->db->select('MONTH(fech) AS mes, YEAR(fech) AS anio, count(total) AS total_mes')
                  ->from('venta')
                  ->group_by('MONTH(fech), YEAR(fech)')
                  ->get();

		return $rs->result();
}

public function venta_mes_din(){
$rs = $this->db->select('MONTH(fech) AS mes, YEAR(fech) AS anio, sum(total) AS total_mes')
                  ->from('venta')
                  ->group_by('MONTH(fech), YEAR(fech)')
                  ->get();

		return $rs->result();
}



public function delete_lista($id_list){
		$this->db->where("id",$id_list)->delete("lista");
		return $this->db->affected_rows() == 1;
}


public function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}



public function delete_carrito($id_car){
		$this->db->where("id",$id_car)->delete("carrito");
		return $this->db->affected_rows() == 1;
}


public function insert_venta($data){
		$this->db->insert("venta",$data);
		return $this->db->affected_rows() == 1;
}

public function insert_venta_inventario($data){
		$this->db->insert("venta_inventario",$data);
		return $this->db->affected_rows() == 1;
}

public function get_datos_productos(){
$rs = $this->db->select('producto.*,categoria')
                  ->from('producto')
                  ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
                  ->where('estado',1)
                  ->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_cat(){
	$rs = $this->db
		->select("*")
		->from("categoria")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_cat2($id){
	$rs = $this->db
		->select("*")
		->from("categoria")
		->where('id !=',$id)
		->get();

		return $rs->num_rows() > 0 ? $rs->result_array() : array();
}


public function get_cli(){
	$rs = $this->db
		->select("cliente.id,cliente.nombre as nombre,fec_registro as f,ap,am,correo,usuario.nombre as nomus,telefono")
		->from("cliente")
		->join('usuario', 'cliente.id_usu = usuario.id', 'inner')
		->join('telefono', 'telefono.id_cli = cliente.id', 'inner')
		->order_by("fec_registro", "desc")
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_pedidos(){
	$rs = $this->db
		->select("venta.id as id, cliente.id as id_cli,fech,folio,total,cliente.nombre as nombre,ap,am")
		->from("venta")
		->join('cliente', 'venta.id_cli = cliente.id', 'inner')
		->where("envio",0)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_detalle($id){
	$rs = $this->db
		->select("detalle_venta.id, nombre,foto,detalle_venta.prec,cant,subtotal")
		->from("detalle_venta")
		->join('producto', 'detalle_venta.id_pro = producto.id', 'inner')
		->where("detalle_venta.id_vent",$id)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_dire($id){
	$rs = $this->db
		->select("*")
		->from("cliente")
		->where("id",$id)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_ub($id){
	$rs = $this->db
		->select("latitud,longitud")
		->from("cliente")
		->where("id",$id)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}


public function updateeenvio($id){
	$rs = $this->db
		->set("envio",1)
		->where("id",$id)
		->update("venta");
	
		return $this->db->affected_rows() == 1;
}

public function updat($id,$latitud,$longitud){
	$rs = $this->db
		->set("latitud",$latitud)
		->set("longitud",$longitud)
		->where("id",$id)
		->update("cliente");
	
		return $this->db->affected_rows() == 1;
}

public function get_foto(){
	$rs = $this->db
		->select("*")
		->from("carrusel")
		->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function recu_contra($correo){
	$rs = $this->db
		->select("*")
		->from("cliente")
		->where("correo",$correo)
		->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_cat_edit($id){
	$rs = $this->db
		->select("*")
		->from("categoria")
		->where("id",$id)
		->get();
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_pro($data){
	$rs = $this->db->select("*")->where($data)->get('producto');

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function get_desc($id){
	$rs = $this->db->select("descripcion")->from("producto")->join('descripcion', 'producto.id_descr = descripcion.id', 'inner')
		->where("producto.id",$id)->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
}

public function insert_pro($data){
	$this->db->insert("producto",$data);
	
		return $this->db->affected_rows() == 1;
}

public function insert_fotos($data){
	$this->db->insert("foto",$data);
	
		return $this->db->affected_rows() == 1;
}

public function insert_fto($foto,$id){
	$this->db->set("foto",$foto)->where("id",$id)->update("carrusel");
	
		return $this->db->affected_rows() == 1;
}

public function update_pro($id_pro,$nombre,$prec,$cantidad,$id_cat,$maxId){
	$this->db
	->set("nombre",$nombre)
	->set("prec",$prec)
	->set("cantidad",$cantidad)
	->set("id_cat",$id_cat)
	->set("id_descr",$maxId)
	->where("id",$id_pro)
	->update("producto");
	
		return $this->db->affected_rows() == 1;
}

public function delete_pro($id_pro){
	$this->db
	->set("estado",0)
	->where("id",$id_pro)
	->update("producto");
	
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


}
?>