<?php

class Carrito_model extends CI_Model{

    public function agregar_carrito( $idproducto , $idusuario, $cantidad ){

        $id_car = $this->db->select("max(id)+1 as id_car")->from("carrito")->get();
        $fila = $id_car->row();
        $id= $fila->id_car;

        if( $id == NULL ){
            $id = 1;
        }

        $data = array(
			"id" => $id,
            "id_cli" => $idusuario,
            "id_pro" => $idproducto,
            "cantidad" => $cantidad
			
		);
        
		$this->db->insert( "carrito" , $data );
        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }

    }

    public function validar_cantidad( $idproducto, $cantidad ){
        $datosProducto = $this->db->select( "cantidad" )
        ->from( "producto" )
        ->where( "id" , $idproducto )
        ->get();

        if ($datosProducto->num_rows() > 0) {
            $row = $datosProducto->row();
            $cantidadP = $row->cantidad;

            if( $cantidad <= $cantidadP && $cantidad > 0 ){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function agregar_deseos( $idusuario , $idproducto ){
        
        $id_des = $this->db->select("max(id)+1 as id_des")->from("lista")->get();
        $fila = $id_des->row();
        $id= $fila->id_des;

        if( $id == NULL ){
            $id = 1;
        }

        $data = array(
			"id" => $id,
            "id_cli" => $idusuario,
            "id_pro" => $idproducto,
		);
        
		$this->db->insert( "lista" , $data );
        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function borrar_deseo( $idusuario , $idproducto ){
        
        $this->db->where('id_cli', $idusuario)
        ->where( 'id_pro' , $idproducto );
        $this->db->delete('lista');

        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }


    public function actualizar_cantidad( $idusuario ){
        $consulta = $this->db->select( "count(carrito.id) as total" )->from("carrito")->join('producto', 'carrito.id_pro = producto.id', 'inner')->where( "id_cli", $idusuario )->where(' producto.cantidad >' , 0)->where( 'estado', 1 )->get();

        $datos = $consulta->row();
        $cantidad = $datos->total;
        return $cantidad;
    }

    public function actualizar_cantidadD( $idusuario ){
        $consulta = $this->db->select( "count(lista.id) as total" )->from("lista")->join('producto', 'lista.id_pro = producto.id', 'inner')->where( "id_cli", $idusuario )->where( 'estado', 1 )->get();
        $datos = $consulta->row();
        $cantidad = $datos->total;
        return $cantidad;
    }

    public function get_productos( $idusuario ){
        $resultado = $this->db->select( 'carrito.cantidad as cant, producto.id as id , foto, nombre, prec, categoria' )
        ->from( "carrito" )
        ->join('producto', 'carrito.id_pro = producto.id', 'inner')
        ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
        ->where( "id_cli" , $idusuario )
        ->where( 'producto.estado', 1 )
        ->where(' producto.cantidad >' , 0)
        ->get();

        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            return NULL;
        }

    }

    public function get_productos_deseo( $idusuario ){
        $resultado = $this->db->select( 'lista.id as id_list, producto.id, foto , producto.nombre , prec,cantidad,categoria' )
        ->from( "lista" )
        ->join( 'producto' , 'lista.id_pro = producto.id' , 'inner' )
        ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
        ->where( 'id_cli' , $idusuario )
        ->where( 'estado', 1 )
        ->get();

        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            return NULL;
        }

    }

    public function inserta_venta( $idusuario, $total ){
        $fec= $this->db->select("now() as fecha")->get()->result_array();
        $fecha = $fec["0"]["fecha"];

        $id_ven = $this->db->select("max(id)+1 as id_ven")->from("venta")->get()->result_array();

        if (!empty($id_ven)) {
            $id=$id_ven["0"]["id_ven"];
        }else{
            $id = 1;
        }

        $data = array(
            "id" => $id,
            "fech" => $fecha,
            "folio" => $id,
            "total" => $total,
            "id_cli" => $idusuario,
            "envio" => 0
        );
        
        $this->db->insert( "venta" , $data );

        if( $this->db->affected_rows() > 0 ){
            return $id;
        }else{
            return false;
        }
    }

    public function inserta_detalles( $idusuario, $idventa ){
        $productos = $this->db->select( "carrito.*, prec, producto.cantidad as stock" )
        ->from('carrito')
        ->join( 'producto' , 'carrito.id_pro = producto.id' )
        ->where('id_cli' , $idusuario)
        ->where(' producto.cantidad >' , 0)
        ->get()->result();

        $id_det = $this->db->select("max(id)+1 as id_det")->from("detalle_venta")->get()->result_array();

        if (!empty($id_det)) {
            $id=$id_det["0"]["id_det"];
        }else{
            $id = 1;
        }        

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

        $data = array(
            "id" => $id,
            "cant" => $canti,
            "prec" => $producto->prec,
            "subtotal" => $subtotal,
            "id_pro" => $producto->id_pro,
            "id_vent" => $idventa
        );

        $this->db->insert( "detalle_venta" , $data );
        $id = $id+1;

        $tot = $tot+$subtotal;

    }

        $this->db->set("total",$tot)->where("id",$idventa)->update("venta");

        if( $tot > 0 ){
            return true;
        }else{
            $this->db->where('id', $idventa)->delete('venta');
            return false;
        }
    }

    public function eliminar_carrito( $idusuario ){
        $this->db->where('id_cli', $idusuario)
        ->delete('carrito');

        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }









    
    public function get_hitorial( $idusuario ){
        $resultado = $this->db->select( '*' )
        ->from( "venta" )
        ->where( 'id_cli' , $idusuario )
        ->get();

        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            return NULL;
        }

    }

    public function get_detalles( $idventa ){
        $resultado = $this->db->select( 'venta_producto.* , nombre' )
        ->from( "venta_producto" )
        ->join( 'producto' , 'venta_producto.id_pro = producto.id' , 'inner' )
        ->where( 'id_vent' , $idventa  )
        ->get();

        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            return NULL;
        }

    }

    public function compra_carrito( $idusuario ){
        $total = $this->db->select( 'SUM(carrito.cantidad*precio)as tot' )
        ->from( "carrito" )
        ->join( 'producto' , 'carrito.id_pro = producto.id', 'inner' )
        ->where( 'id_cli' , $idusuario )->get()->result_array();

        // $productosData = $this->db->selec( 'id_pro , cantidad' )->from( "carrito" )->where( 'id_clie' , $idusuario )->get();

        if( $total != NULL ){
            $valorto = $total["0"]["tot"];
        }else{
            $valorto = 0;
        }

        $idv = $this->db->select("max(venta.id)+1 as idve")->from("venta")->get()->result_array();
        if( $idv != null ){
            $id = $idv["0"]["idve"];
        }else{
            $id = 1;
        }
        $fecha_actual = date("Y-m-d");

        $valorto += $valorto*0.16;

        $data1 = array(
            "id" => $id,
            "fecha" => $fecha_actual,
            "folio" => $id,
            "total" => $valorto,
            "id_cli" => $idusuario,
        );

        $var = $this->db->insert( "venta" , $data1 );


        $datos_carrito = $this->db->select( '*' )
        ->from( 'carrito' )
        ->where( 'id_cli' , $idusuario )
        ->get()->result();

        if($datos_carrito != NULL)
        {
            foreach($datos_carrito as $fila)
            {

                $idvp = $this->db->select("max(id)+1 as idvep")->from("venta_producto")->get()->result_array();
                if( $idv != null ){
                    $idvpro = $idvp["0"]["idvep"];
                }else{
                    $idvpro = 1;
                }

                $valorprecio = $this->db->select( '*' )
                ->from( 'producto' )
                ->where( 'id' , $fila['id_pro'] )
                ->get();

                if($valorprecio != NULL )
                {
                    $datos_producto = $valorprecio->row_array();
                    $precio = $datos_producto['precio'];
                }

                $subtot = $precio * $fila['cantidad'];

                $data2 = array(
                    "id" => $idvpro,
                    "cantidad" => $fila['cantidad'],
                    "precio" => $precio,
                    "subtotal" => $subtot,
                    "id_pro" => $fila['id_pro'],
                    "id_vent" => $id,
                );

                $this->db->insert( "venta_producto" , $data2);  
                $this->eliminar_producto( $idusuario, $fila['id_pro']  );              
            }
            return true;

        }else{
            return false;
        }
    }

    public function eliminar_producto( $idusuario , $idproducto ){
        $this->db->where('id_cli', $idusuario);
        $this->db->where('id_pro', $idproducto);
        $this->db->delete('carrito');

        return true; 
    }

    public function get_carrito( $idusuario ){    
            $resultado=$this->db->select('producto.*, carrito.cantidad as cantidadcarrito')
            ->from('carrito')
            ->join( 'producto' , 'carrito.id_pro = producto.id' )
            ->where('id_cli' , $idusuario)
            ->get();
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            return false;
        }
    }

    public function borrar_producto( $idusuario , $idproducto ){
        
        $this->db->where('id_cli', $idusuario)
        ->where( 'id_pro' , $idproducto );
        $this->db->delete('carrito');

        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function actualizar_cantidadp($idusuario,$idproducto,$cantidad){
        $data = array(
            'cantidad' => $cantidad
        );

        $this->db->where('id_cli', $idusuario);
        $this->db->where('id_pro', $idproducto);
        $this->db->update('carrito', $data);
        $cambio = $this->db->affected_rows();
        if( $cambio > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function existe_deseo( $idusuario, $idproducto ){

        $rs= $this->db
                ->from("lista")
                ->where("id_pro",$idproducto)
                ->where("id_cli",$idusuario)
                ->get();
                return $rs->num_rows() > 0 ? 1 : 2;  
    }


    public function existe_carrito( $idusuario, $idproducto ){
        $query = $this->db->get_where( "carrito", array( "id_cli" => $idusuario, "id_pro" => $idproducto ) );
    
        if( $query->num_rows() == 0 ){
            return false;
        }else{
            return true;
        }
    }



}

?>