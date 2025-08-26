<?php 
class Backend extends CI_Controller{
	public function __construct(){
		parent :: __construct();
		$this->load->model("back_model");
		$this->load->model("usuarios_model");
	}

	public function index(){
		echo "<h3>Acceso restringido</h3>";
	}


//LOGIN
public function verificausuario(){
	$correo=$this->input->post("correo");
	$contrasenia=$this->input->post("contrasenia");

	$contr=md5($contrasenia);

	$exis = $this->usuarios_model->exists_usuario($correo,$contr);

	$exis2 = $this->usuarios_model->exists_usuario2($correo,$contr);
		
		if($exis == 1 || $exis2 == 1){
			//CREA LAS VARIABLES DE TOKEN
			session_regenerate_id();
			$token = md5(session_id());

			if ($exis == 1) {
			$nomus = $this->db->select("usuario.nombre as nombre")->from("usuario")->join("cliente","cliente.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();
			$usunom = $nomus["0"]["nombre"]; 

			$clin = $this->db->select("cliente.nombre")->from("usuario")->join("cliente","cliente.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();

			$clinom = $clin["0"]["nombre"]; 

			$id_us = $this->db->select("usuario.id as id")->from("usuario")->join("cliente","cliente.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();

			$id_usuu = $id_us["0"]["id"];

			$id_clii = $this->db->select("cliente.id as id_cli")->from("usuario")->join("cliente","cliente.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();

			$id_cli = $id_clii["0"]["id_cli"];

			$this->db->select('tipo');
			$this->db->from('usuario');
			$this->db->join('cliente', 'cliente.id_usu = usuario.id');
			$this->db->where('correo', $correo);
			$query = $this->db->get();

			 $row = $query->row();
    		 $tipo = $row->tipo;

		}
		else{
			$nomus = $this->db->select("usuario.nombre as nombre")->from("usuario")->join("administrador","administrador.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();
			$usunom = $nomus["0"]["nombre"]; 

			$clin = $this->db->select("administrador.nombre")->from("usuario")->join("administrador","administrador.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();

			$clinom = $clin["0"]["nombre"]; 

			$id_us = $this->db->select("usuario.id as id")->from("usuario")->join("administrador","administrador.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();

			$id_usuu = $id_us["0"]["id"];

			$id_clii = $this->db->select("administrador.id as id_cli")->from("usuario")->join("administrador","administrador.id_usu=usuario.id")->where("correo",$correo)->where("activo",1)->get()->result_array();

			$id_cli = $id_clii["0"]["id_cli"];

			$this->db->select('tipo');
			$this->db->from('usuario');
			$this->db->join('administrador', 'administrador.id_usu = usuario.id');
			$this->db->where('correo', $correo);
			$query = $this->db->get();

			 $row = $query->row();
    		 $tipo = $row->tipo;
		}


			if ($this->usuarios_model->update_token($id_usuu,$token)) {
				$obj = array(
					"resultado" => true,
					"id_usu" => $id_usuu,
					"mensaje" => "Bienvenido ".$clinom,
					"token" => $token,
					"nomus" => $usunom,
					"correo" => $correo,
					"id_cli" => $id_cli,
					"tipo" => $tipo,
					"nomcli" => $clinom
				);
				
			}
			else{
				$obj = array(
				"resultado" =>false,
				"mensaje" => "Imposible crear sesión"
			);
				

			}

		}
		else{
			$obj = array(
				"resultado" =>false,
				"mensaje" => "Correo o password incorrectos"

			);
			
		}

		echo json_encode($obj);
	}




//REGISTRO
	public function registrausuario(){	
		$idus = $this->db->select("max(usuario.id)+1 as id_usua")->from("usuario")->get()->result_array();
		$iduss=$idus["0"]["id_usua"];

		if( $iduss == NULL ){
            $iduss = 1;
        }

		$fec= $this->db->select("now() as fecha")->get()->result_array();
		$fecc=$fec["0"]["fecha"];

		$idclii= $this->db->select("max(cliente.id)+1 as id_cliie")->from("cliente")->get()->result_array();
		$idcl = $idclii["0"]["id_cliie"];

		$password = $this->input->post("password");
		$tipo = "cliente";
		$nombreu = "123";
		$activo = "1";		

		$nombre = $this->input->post("nombre");
		$ap = $this->input->post("ap");
		$am = $this->input->post("am");
		$correo = $this->input->post("correo");
		$ciudad = $this->input->post("ciudad");
		$col = $this->input->post("col");
		$calle = $this->input->post("calle");
		$noint = $this->input->post("ni");
		$noext = $this->input->post("ne");
		$cp = $this->input->post("cp");
		$id_usu = $iduss;
		//$foto = $this->input->post("foto");
		$fec_registro = $fecc;
		$latitud = $this->input->post("latitud") ?? null;
		$longitud = $this->input->post("longitud") ?? null;

		$telefono = $this->input->post("tel");

		$excor = $this->usuarios_model->exists_correo($correo);

		$mail = $this->back_model->comprobar_email($correo);

		if($mail != 1){
			$obj=array(
					"resultado" => false,
					"mensaje" => "Correo inválido"
				);
			

		}

		else if ($excor == 1) {
				$obj=array(
					"resultado" => false,
					"mensaje" => "Ya existe este correo"
				);
					
			}
		else{

		$data1 = array(
			"password" => md5($password),
			"tipo" => $tipo,
			"nombre" => $nombreu,
			"activo" => $activo,
			"token" => " "
		);

		$data2 = array(
			"nombre" => mb_strtoupper($nombre),
			"ap" => mb_strtoupper($ap),
			"am" => mb_strtoupper($am),
			"correo" => $correo,
			"ciudad" => mb_strtoupper($ciudad),
			"col" => mb_strtoupper($col),
			"calle" => mb_strtoupper($calle),
			"noint" => $noint,
			"noext" => $noext,
			"cp" => $cp,
			"id_usu" => $id_usu,
			"foto" => $_FILES['foto']['name']??"sinfoto",
			"fec_registro" => $fec_registro,
			"latitud" => $latitud,
			"longitud" => $longitud
		);

		$data3 = array(
			"telefono" => $telefono,
			"id_cli" => $idcl
		);
		

		$obj["resultado"] = $this->usuarios_model->insert_usuario($data1,$data2,$data3);

		$obj["mensaje"] = $obj["resultado"] ? "Registro exitoso" : "Imposible insertar cliente";

	}

echo json_encode($obj);
	}


//REGISTRO ADMINISTRADOR
	public function registradmin(){	
		$idus = $this->db->select("max(usuario.id)+1 as id_usua")->from("usuario")->get()->result_array();
		$iduss=$idus["0"]["id_usua"];

		$fec= $this->db->select("now() as fecha")->get()->result_array();
		$fecc=$fec["0"]["fecha"];

		$idclii= $this->db->select("max(id)+1 as id_cliie")->from("administrador")->get()->result_array();
		$idcl = $idclii["0"]["id_cliie"];

		$password = $this->input->post("password");
		$tipo = "administrador";
		$nombreu = "123";
		$activo = "1";		

		$nombre = $this->input->post("nombre");
		$ap = $this->input->post("ap");
		$am = $this->input->post("am");
		$correo = $this->input->post("correo");
		$id_usu = $iduss;
		//$foto = $this->input->post("foto");
		$fec_registro = $fecc;


		$excor = $this->usuarios_model->exists_correo2($correo);

		$mail = $this->back_model->comprobar_email($correo);

		if($mail != 1){
			$obj=array(
					"resultado" => false,
					"mensaje" => "Correo inválido"
				);
			

		}

		else if ($excor == 1) {
				$obj=array(
					"resultado" => false,
					"mensaje" => "Ya existe este correo"
				);
					
			}
		else{

		$data1 = array(
			"password" => md5($password),
			"tipo" => $tipo,
			"nombre" => $nombreu,
			"activo" => $activo,
			"token" => " "
		);

		$data2 = array(
			"nombre" => mb_strtoupper($nombre),
			"ap" => mb_strtoupper($ap),
			"am" => mb_strtoupper($am),
			"correo" => $correo,
			"id_usu" => $id_usu,
			"foto" => $_FILES['foto']['name']??"sinfoto",
			"fec_registro" => $fec_registro
		);


		$obj["resultado"] = $this->usuarios_model->insert_usuario2($data1,$data2);

		$obj["mensaje"] = $obj["resultado"] ? "Registro exitoso" : "Imposible insertar";

	}

echo json_encode($obj);
	}




	public function updateusuario(){
		$id_cli = $this->input->post("id_cli");
		$id_usu = $this->input->post("id_usu");
		$nombre = mb_strtoupper($this->input->post("nombre"));
		$ap = mb_strtoupper($this->input->post("ap"));
		$am = mb_strtoupper($this->input->post("am"));
		$correo = $this->input->post("correo");
		$ciudad = mb_strtoupper($this->input->post("ciudad"));
		$col = mb_strtoupper($this->input->post("col"));
		$calle = mb_strtoupper($this->input->post("calle"));
		$ni = $this->input->post("ni");
		$ne = $this->input->post("ne");
		$cp = $this->input->post("cp");
		$tel = $this->input->post("tel");
		$token=$this->input->post("token");


		
		$this->session->set_userdata( "nombre", $nombre);



		//$data = $this->usuarios_model->update_usuario($id_usu,$contra);

		$data = $this->usuarios_model->update_cliente($id_cli,$nombre,$ap,$am,$correo,$ciudad,$col,$calle,$ni,$ne,$cp);

		$data = $this->usuarios_model->update_tel($id_cli,$tel);

		//redirect(base_url()."../app/frontend/modatos/".$id_usu."/".$token);
		
		echo json_encode($data);
	}

	public function deleteusuario(){
		$id_cli = $this->session->id_cli;
		$id_usu = $this->input->post("id_usu");

		$data = $this->usuarios_model->delete_usuario($id_usu);
		$this->db->where("id_cli",$id_cli)->delete("carrito");
		$this->db->where("id_cli",$id_cli)->delete("lista");

		$obj = "Se eliminó con éxito";

		echo json_encode($obj??"hola");
	}

	public function getcar($idcli){
		$obj["resultado"] = $this->back_model->get_cart($idcli);

		$productos = $this->db->select( "carrito.*, prec, producto.cantidad as stock" )
        ->from('carrito')
        ->join( 'producto' , 'carrito.id_pro = producto.id' )
        ->where('id_cli' , $idcli)
        ->where(' producto.cantidad >' , 0)
        ->where(' producto.estado' , 1)
        ->get()->result();

        $tot = 0;

        foreach ($productos as $producto) {
        
        if ($producto->cantidad > $producto->stock) {
            $subtotal = $producto->stock * $producto->prec;
            $canti = $producto->stock;
        }
        else{
        $subtotal = $producto->cantidad * $producto->prec;
        $canti = $producto->cantidad;
        }

        $tot = $tot+$subtotal;

    }

        $obj["total"] = $tot;

		echo json_encode($obj);
	}

	public function detalleventa(){
$correo = $this->input->post("corr");

$data = $this->back_model->detalle_venta($correo);

echo json_encode($data??"hola");
}

	public function ventas(){
$data = $this->back_model->ventas();

echo json_encode($data??"hola");
}

public function telefonos(){
$data = $this->back_model->tel();

echo json_encode($data??"hola");
}

public function ventassemana(){

	// inicio
$sql1 = "SELECT REPLACE((SELECT DATE_ADD(DATE(NOW()), INTERVAL (1 - DAYOFWEEK(DATE(NOW()))) DAY)), '-', '') as inicio";
$query1 = $this->db->query($sql1);
$row1 = $query1->row_array();
extract($row1);

// fin
$sql2 = "SELECT REPLACE((SELECT DATE_ADD(DATE(NOW()), INTERVAL (7 - DAYOFWEEK(DATE(NOW()))) DAY)), '-', '') as fin";
$query2 = $this->db->query($sql2);
$row2 = $query2->row_array();
extract($row2);

$data = $this->back_model->ventas_reportes($inicio,$fin);

$sql = "SELECT DATE_FORMAT((SELECT DATE_ADD(DATE(NOW()), INTERVAL (1 - DAYOFWEEK(DATE(NOW()))) DAY)), '%d-%m-%Y') AS inicio";
$rs3 = $this->db->query($sql);
$row3 = $rs3->row_array();

$sql = "SELECT DATE_FORMAT((SELECT DATE_ADD(DATE(NOW()), INTERVAL (7 - DAYOFWEEK(DATE(NOW()))) DAY)), '%d-%m-%Y') AS fin";
$rs2 = $this->db->query($sql);
$row2 = $rs2->row_array();

$inicio = $row3['inicio'];
$fin = $row2['fin'];


$obj["inicio"] = $inicio;
$obj["fin"] = $fin;
$obj["data"] = $data;

echo json_encode($obj??"hola");

}



public function ventasmes(){

$sql = "SELECT REPLACE((SELECT CAST(DATE_FORMAT(NOW(), '%Y-%m-01') AS DATE) PRIMER_DIA), '-', '') AS inicio";
$rs3 = $this->db->query($sql);
$row3 = $rs3->row_array();
$inicio = $row3['inicio'];

$sql = "SELECT REPLACE((SELECT LAST_DAY(NOW()) ULTIMO_DIA), '-', '') AS fin";
$rs2 = $this->db->query($sql);
$row2 = $rs2->row_array();
$fin = $row2['fin'];

$sql = "SELECT MONTHNAME(NOW()) as mes";
$rs4 = $this->db->query($sql);
$row4 = $rs4->row_array();
$mes = $row4['mes'];


$data = $this->back_model->ventas_reportes($inicio,$fin);

if ($mes == "January"){
$mes ="Enero";
}

elseif ($mes == "February"){
$mes ="Febrero";
}

elseif ($mes == "March"){
$mes ="Marzo";
}

elseif ($mes == "April"){
$mes ="Abril";
}

elseif ($mes == "May"){
$mes ="Mayo";
}

elseif ($mes == "June"){
$mes ="Junio";
}

elseif ($mes == "July"){
$mes ="Julio";
}

elseif ($mes == "August"){
$mes ="Agosto";
}

elseif ($mes == "September"){
$mes ="Semptiembre";
}

elseif ($mes == "October"){
$mes ="Octubre";
}

elseif ($mes == "November"){
$mes ="Noviembre";
}

elseif ($mes == "December"){
$mes ="Diciembre";
}

$obj["mes"] = $mes;
$obj["data"] = $data;
$obj["inicio"] = $inicio;
$obj["fin"] = $fin;

echo json_encode($obj??"hola");

}


public function ventasanio(){

//inicio
$sql = "SELECT REPLACE((SELECT CAST(DATE_FORMAT(NOW(), '%Y-01-01') AS DATE) PRIMER_DIA), '-', '') AS inicio";
$rs3 = $this->db->query($sql);
$row3 = $rs3->row_array();
$inicio = $row3['inicio'];

//fin
$sql = "SELECT REPLACE((SELECT CAST(DATE_FORMAT(NOW(), '%Y-12-31') AS DATE) ULTIMO_DIA), '-', '') AS fin";
$rs2 = $this->db->query($sql);
$row2 = $rs2->row_array();
$fin = $row2['fin'];

//año
$sql = "SELECT LEFT(NOW(), 4) as anio";
$rs4 = $this->db->query($sql);
$row4 = $rs4->row_array();
$anio = $row4['anio'];


$data = $this->back_model->ventas_reportes($inicio,$fin);

$obj["anio"] = $anio;
$obj["inicio"] = $inicio;
$obj["fin"] = $fin;
$obj["data"] = $data;

echo json_encode($obj??"hola");

}


public function usuac(){

$data = $this->back_model->usu_act();

echo json_encode($data??"hola");

}

	public function borracarrito(){
		$id_cart = $this->input->post("id_car");

		//echo $id_list;

		$obj["resultado"] = $this->back_model->delete_carrito($id_cart);
		$obj["mensaje"] = $obj["resultado"] ? "Se elimino de tu carrito" : "Imposible eliminar producto";

		echo json_encode($obj["mensaje"]);
		

	}

	public function detalleventaxml($id_inve){
		//$correo = $this->input->post("correo");

		$data = $this->usuarios_model->get_factura($id_inve);

		$this->output->set_content_type("application/xml");

		$var = $this->load->view("factura_view_xml", array("factura" => $data),true);

		echo $var;

		//header("Location: $var");

	}

	public function ventadetalles(){
$id_vent = $this->input->post("id_vent");

$data = $this->back_model->venta_detalle($id_vent);

echo json_encode($data??"hola");
}

public function ventames()
{
    $data = $this->back_model->venta_mes();

    $results = array();
    $fechaActual = new DateTime();

    foreach ($data as $row) {
        $mess = $row->mes;
        $año = $row->anio;
        $total_mes = $row->total_mes;

        if ($año == $fechaActual->format('Y')) {
            if ($mess == 1) {
                $mes = "Enero";
            } elseif ($mess == 2) {
                $mes = "Febrero";
            } elseif ($mess == 3) {
                $mes = "Marzo";
            } elseif ($mess == 4) {
                $mes = "Abril";
            } elseif ($mess == 5) {
                $mes = "Mayo";
            } elseif ($mess == 6) {
                $mes = "Junio";
            } elseif ($mess == 7) {
                $mes = "Julio";
            } elseif ($mess == 8) {
                $mes = "Agosto";
            } elseif ($mess == 9) {
                $mes = "Semptiembre";
            } elseif ($mes == 10) {
                $mes = "Octubre";
            } elseif ($mess == 11) {
                $mes = "Noviembre";
            } elseif ($mess == 12) {
                $mes = "Diciembre";
            }

            $results[] = array(
                'mes' => $mes,
                'total' => $total_mes
            );
        }
    }

    echo json_encode($results);
}

public function ventamesdin()
{
    $data = $this->back_model->venta_mes_din();

    $results = array();
    $fechaActual = new DateTime();

    foreach ($data as $row) {
        $mess = $row->mes;
        $año = $row->anio;
        $total_mes = $row->total_mes;

        if ($año == $fechaActual->format('Y')) {
            if ($mess == 1) {
                $mes = "Enero";
            } elseif ($mess == 2) {
                $mes = "Febrero";
            } elseif ($mess == 3) {
                $mes = "Marzo";
            } elseif ($mess == 4) {
                $mes = "Abril";
            } elseif ($mess == 5) {
                $mes = "Mayo";
            } elseif ($mess == 6) {
                $mes = "Junio";
            } elseif ($mess == 7) {
                $mes = "Julio";
            } elseif ($mess == 8) {
                $mes = "Agosto";
            } elseif ($mess == 9) {
                $mes = "Semptiembre";
            } elseif ($mes == 10) {
                $mes = "Octubre";
            } elseif ($mess == 11) {
                $mes = "Noviembre";
            } elseif ($mess == 12) {
                $mes = "Diciembre";
            }

            $results[] = array(
                'mes' => $mes,
                'total' => $total_mes
            );
        }
    }

    echo json_encode($results);
}


public function getadmin(){
	$data = $this->usuarios_model->get_admin();

		echo json_encode($data);

}

public function getenvio(){
	$data = $this->db
	->select("count(id) as pendiente")
	->from("venta")
	->where("envio",0)
	->get()->result_array();

	$dataa = $data["0"]["pendiente"];


		echo json_encode($dataa);

}

	public function getcliente(){
		$data = $this->usuarios_model->get_cliente();
		$obj["resultado"] = $data !=null;
		$obj["mensaje"] = $obj["resultado"] ? "Se recuperaron ".count($data)." cliente(s)" : "No hay clientes";
		$obj["cliente"] = $data;
		echo json_encode($obj);
	}


public function getdes(){
	$id = $this->input->post("idproducto");

	$consulta = $this->db
    ->select("foto")
    ->from("producto")
    ->where("id", $id)
    ->get()
    ->result_array();

    $foto = $consulta[0]["foto"];

		$data = $this->db
    ->select("foto")
    ->from("foto")
    ->where("id_pro", $id)
    ->get()
    ->result_array();

$numerationData = array();
$numerationData[] = array('foto1' => $foto);
$i = 2;

foreach ($data as $item) {
    $numerationData[] = array('foto'. $i => $item['foto']);
    $i++;
}

$obj["fotos"] = $numerationData;

$obj["descripcion"] = $this->db
    ->select("foto, descripcion")
    ->from("producto")
    ->join("descripcion","producto.id_descr = descripcion.id")
    ->where("producto.id", $id)
    ->get()
    ->result_array();



		echo json_encode($obj);
	}



public function getdatoscliente(){
	$correo = $this->input->post("corr");
	$data = $this->usuarios_model->get_datos_cliente($correo);

		echo json_encode($data);
}

public function getdatosproductos()
{
    $data = $this->back_model->get_datos_productos();
    
    // Ordenar los objetos por el campo 'id' en orden ascendente
    usort($data, function($a, $b) {
        return $a->id - $b->id;
    });
    
    $obj["resultado"] = $data != null;
    $obj["mensaje"] = $obj["resultado"] ? "Tienes ".count($data)." productos en stock" : "No hay productos";
    $obj["data"] = array_map(function($item, $index) {
        $item->num = $index + 1;
        return $item;
    }, $data, array_keys($data));
    $obj["total"] = count($data);

    echo json_encode($obj);
}



public function getcat(){

	$data = $this->back_model->get_cat();

		echo json_encode($data);
}


public function getcat2(){
    $id = $this->input->post("id_pro");

    $idus = $this->db->select("id_cat")->from("producto")->where("id", $id)->get()->result_array();
    $id_usu = $idus[0]["id_cat"];

    $consulta =  $this->db->select("*")->from("categoria")->where("id", $id_usu)->get()->result_array();
    $cate = $consulta[0]["categoria"];

     $obj = array();
    $obj[] = array('id' => $id_usu, 'categoria' => $cate);

    $data = $this->back_model->get_cat2($id_usu);

    foreach ($data as $item) {
        $id = $item['id'];
        $categoria = $item['categoria'];
        $obj[] = array('id' => $id, 'categoria' => $categoria);
    }

    echo json_encode($obj);
}


public function getcatedit($id){
	$data = $this->back_model->get_cat_edit($id);

		echo json_encode($data);
}

public function getdatoscli(){
	$data = $this->back_model->get_cli();

		echo json_encode($data);
}

public function getpedidos(){
	$data = $this->back_model->get_pedidos();

		echo json_encode($data);
}

public function getdetalle(){
	$id = $this->input->post("id");

	$data = $this->back_model->get_detalle($id);

		echo json_encode($data);
}

public function getdire(){
	$id = $this->input->post("id");

	$data = $this->back_model->get_dire($id);

		echo json_encode($data);
}

public function getubi(){
	$id = $this->input->post("id");

	$data = $this->back_model->get_ub($id);

		echo json_encode($data);
}

public function actualizaubi() {

		$id = $this->input->post("id");
		$latitud = $this->input->post("latitud") ?? null;
		$longitud = $this->input->post("longitud") ?? null;

	
			$obj["resultado"] = $this->back_model->updat($id,$latitud,$longitud);
			$obj["mensaje"] = $obj["resultado"] ? "Actualizado" : "No se pudo actualizar";
 		
 		echo json_encode($obj);
	}


public function updateenvio(){
	$id = $this->input->post("id");

	$data = $this->back_model->updateeenvio($id);

	$mensaje = $data ? "Se actualizó" : "Imposible Actualizar";

		echo json_encode($mensaje);
}


public function foto(){
	$data = $this->back_model->get_foto();

		echo json_encode($data);
}

public function recuperacontra(){
	$correo = $this->input->post("correo");

	$data = $this->back_model->recu_contra($correo);

		echo json_encode($data);
}


public function cambiacontra($id=0,$contra=""){

	$idus = $this->db->select("id_usu as id_usua")->from("cliente")->where("id",$id)->get()->result_array();
		$id_usu=$idus["0"]["id_usua"];

		$con = md5($contra);


	$data = $this->usuarios_model->update_usuario($id_usu,$con);

	//$data = $this->back_model->recu_contra($correo);

	redirect(base_url()."../app/acceso/login");

}



public function carrusel(){
	$id_usu=$this->session->id_usu;
	$token=$this->session->token;

	$id = $this->input->post("accion");

	if($id==1){
		$fot = $this->input->post("foto1");
		$foto = $_FILES['foto1']['name'];
		$data = $this->back_model->insert_fto($foto,$id);

	$mensaje = $data ? "Actualizada" : "No_se_pudo_actualizar";

	if (!move_uploaded_file($_FILES["foto1"]["tmp_name"],"../app/static/images/".$_FILES["foto1"]["name"])) {
					$mensaje = "Sin_Foto";
			}
	}
	elseif($id==2){
		$fot = $this->input->post("foto2");
		$foto = $_FILES['foto2']['name'];
		$data = $this->back_model->insert_fto($foto,$id);

	$mensaje = $data ? "Actualizada" : "No_se_pudo_actualizar";

	if (!move_uploaded_file($_FILES["foto2"]["tmp_name"],"../app/static/images/".$_FILES["foto2"]["name"])) {
					$mensaje = "Sin_Foto";
			}
	}
	else{
		$fot = $this->input->post("foto3");
		$foto = $_FILES['foto3']['name'];

		$data = $this->back_model->insert_fto($foto,$id);

	$mensaje = $data ? "Actualizada" : "No_se_pudo_actualizar";

	if (!move_uploaded_file($_FILES["foto3"]["tmp_name"],"../app/static/images/".$_FILES["foto3"]["name"])) {
					$mensaje = "Sin_Foto";
			}
	}
	

		redirect(base_url()."../app/frontend/carrusel/$id_usu/$token/$mensaje");
}

public function registrapro(){
	$accion = $this->input->post("accion");
	$nombre = $this->input->post("nombre");
	$prec = $this->input->post("prec");
	$cant = $this->input->post("cant");
	$cat = $this->input->post("cat");
	$descr = trim($this->input->post("descr"));


	if($accion=="alta"){
	$idus = $this->db->select("max(id)+1 as id_usua")->from("producto")->get()->result_array();
		$id=$idus["0"]["id_usua"];
	
	$foto = $this->input->post("foto");

	$foto1 = $this->input->post("foto1");
	$foto2 = $this->input->post("foto2");
	$foto3 = $this->input->post("foto3");

		$data2 = array(
			"nombre" => mb_strtoupper($nombre),
			"prec" => $prec,
			"foto" => $_FILES['foto']['name']??"jkp",
			"estado" => 1,
			"cantidad" => $cant,
			"id_cat" => $cat
		);

		$exist = $this->back_model->get_pro($data2);

		if ($exist) {
			$id_usu=$this->session->id_usu;
			$token=$this->session->token;

			$mensaje = "Existente";
			redirect(base_url()."../app/frontend/ab_producto/$id_usu/$token/$accion/$mensaje");
		}
		else{
			$id_usu=$this->session->id_usu;
			$token=$this->session->token;

			if ($descr !== "") {

			$data4 = array(
				"id" => null,
				"descripcion" => $descr
				);

				$this->db->insert("descripcion",$data4);
				$m = $this->db->select("max(descripcion.id) as id_usua")->from("descripcion")->get()->result_array();
				$maxId=$m["0"]["id_usua"];
			}
			else{
				$maxId=null;
			}

				

				$data = array(
			"id" => $id,
			"nombre" => mb_strtoupper($nombre),
			"prec" => $prec,
			"foto" => $_FILES['foto']['name']??"jkp",
			"estado" => 1,
			"cantidad" => $cant,
			"id_cat" => $cat,
			"id_descr" =>$maxId
		);

			$obj["resultado"] = $this->back_model->insert_pro($data);

			$data5 = array(
				"id" => null,
				"foto" => $_FILES['foto1']['name']??"",
				"id_pro" => $id
			);

			$this->back_model->insert_fotos($data5);

			$data6 = array(
				"id" => null,
				"foto" => $_FILES['foto2']['name']??"",
				"id_pro" => $id
			);

			$this->back_model->insert_fotos($data6);

			$data7 = array(
				"id" => null,
				"foto" => $_FILES['foto3']['name']??"",
				"id_pro" => $id
			);

			$this->back_model->insert_fotos($data7);


				$mensaje = $obj["resultado"] ? "Producto_Insertado" : "Imposible_insertar";
			
			if (!move_uploaded_file($_FILES["foto"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto"]["name"])) {
					$mensaje = "Sin_Foto";
			}

			if (!move_uploaded_file($_FILES["foto1"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto1"]["name"])) {

			}

			if (!move_uploaded_file($_FILES["foto2"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto2"]["name"])) {

			}

			if (!move_uploaded_file($_FILES["foto3"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto3"]["name"])) {

			}



				redirect(base_url()."../app/frontend/gestionP/$id_usu/$token/$mensaje");
		}

	}




	else{

		$l=0;

		$id_pro = $this->input->post("id_pro");

		$foto = $this->input->post("foto");

		$foto1 = $this->input->post("foto1");
		$foto2 = $this->input->post("foto2");
		$foto3 = $this->input->post("foto3");

		if ($_FILES["foto"]["name"] != "") {
			$this->db
			->set("foto",$_FILES["foto"]["name"])
			->where("id",$id_pro)
			->update("producto");

			$l=1;
			$mensaje = "Actualizado";

			if (!move_uploaded_file($_FILES["foto"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto"]["name"])) {
					$mensaje = "Sin_Foto";
			}

		}

		if ($_FILES["foto1"]["name"] != "") {

			$id_f = $this->db->select("id")->from("foto")->where('id_pro', $id_pro)->limit(1)->get()->result_array();
			$id_fot=$id_f["0"]["id"];


			$this->db
			->set("foto",$_FILES["foto1"]["name"])
			->where("id",$id_fot)
			->update("foto");

			$l=1;
			$mensaje = "Actualizado";

			if (!move_uploaded_file($_FILES["foto1"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto1"]["name"])) {
					$mensaje = "Sin_Foto";
			}

		}

		if ($_FILES["foto2"]["name"] != "") {

			$id_ff = $this->db->select("id")->from("foto")->where('id_pro', $id_pro)->limit(1)->get()->result_array();
			$id_in=$id_ff["0"]["id"];


			$id_fff = $this->db->select("id")->from("foto")->where('id_pro', $id_pro)->order_by('id', 'desc')->limit(1)->get()->result_array();
			$id_fin=$id_fff["0"]["id"];

			$id_ffff = $this->db->select("id")->from("foto")->where('id >', $id_in)->where('id <', $id_fin)->get()->result_array();
			$idTuplaEnMedio=$id_ffff["0"]["id"];


			$this->db
			->set("foto",$_FILES["foto2"]["name"])
			->where("id",$idTuplaEnMedio)
			->update("foto");

			$l=1;
			$mensaje = "Actualizado";

			if (!move_uploaded_file($_FILES["foto2"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto2"]["name"])) {
					$mensaje = "Sin_Foto";
			}

		}

		if ($_FILES["foto3"]["name"] != "") {

			$id_f = $this->db->select("id")->from("foto")->where('id_pro', $id_pro)->order_by('id', 'desc')->limit(1)->get()->result_array();
			$id_fot=$id_f["0"]["id"];

			$this->db
			->set("foto",$_FILES["foto3"]["name"])
			->where("id",$id_fot)
			->update("foto");

			$l=1;
			$mensaje = "Actualizado";

			if (!move_uploaded_file($_FILES["foto3"]["tmp_name"],"../app/static/images/producto/".$_FILES["foto3"]["name"])) {
					$mensaje = "Sin_Foto";
			}

		}

		if ($descr !== "") {

			$exist2=$this->back_model->get_desc($id_pro);

			if ($exist2) {
				// update

				$m = $this->db->select("descripcion.id as id_usua")->from("descripcion")->join('producto', 'producto.id_descr = descripcion.id', 'inner')->where("producto.id",$id_pro)->get()->result_array();
				$maxId=$m["0"]["id_usua"];

				$this->db->set("descripcion",$descr)->where("id",$maxId)->update("descripcion");



			}
			else{
				//insert
				

				$data3 = array(
				"id" => null,
				"descripcion" => $descr
				);

				$this->db->insert("descripcion",$data3);

				$m = $this->db->select("max(descripcion.id) as id_usua")->from("descripcion")->get()->result_array();
				$maxId=$m["0"]["id_usua"];


			}
		
		}

		else{
			$maxId=null;
		}

		$data2 = array(
			"nombre" => mb_strtoupper($nombre),
			"prec" => $prec,
			"cantidad" => $cant,
			"id_cat" => $cat,
			"id_descr" => $maxId
		);

		$exist = $this->back_model->get_pro($data2);

		if ($exist) {
			$id_usu=$this->session->id_usu;
			$token=$this->session->token;

			if ($l==0) {
				$mensaje = "No_Actualizado";
			}
			
			redirect(base_url()."../app/frontend/ab_producto/$id_usu/$token/$accion/$mensaje/$id_pro");
		}
		else{
			$id_usu=$this->session->id_usu;
			$token=$this->session->token;

			$obj["resultado"] = $this->back_model->update_pro($id_pro,mb_strtoupper($nombre),$prec,$cant,$cat,$maxId);

			$mensaje = "Actualizado";

			redirect(base_url()."../app/frontend/ab_producto/$id_usu/$token/$accion/$mensaje/$id_pro");
		}

	}

}

public function deletepro(){
	$id_pro = $this->input->post("id_pro");
	$obj["resultado"] = $this->back_model->delete_pro($id_pro);

	$obj["mensaje"] = $obj["resultado"] ? "Producto eliminado" : "No se pudo";

	echo json_encode($obj);
}	
	}
?>