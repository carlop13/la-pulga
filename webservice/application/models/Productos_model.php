<?php

class Productos_model extends CI_Model{

    public function get_productos( $consulta="" ){    
        if( $consulta != "" ){
            $resultado = $this->db->select('producto.id as id, nombre, prec, foto, cantidad, categoria')
    ->from('producto')
    ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
    ->where('cantidad >', 0)
    ->where('producto.estado', 1)
    ->group_start()
        ->like('nombre', $consulta)
        ->or_like('prec', $consulta)
        ->or_like('foto', $consulta)
        ->or_like('cantidad', $consulta)
        ->or_like('categoria', $consulta)
    ->group_end()
    ->get();

        }else{
            $resultado=$this->db->select( "producto.*, categoria" )->from( "producto" )->join( 'categoria' , 'producto.id_cat = categoria.id' , 'inner' )->where( 'cantidad >', 0 )->where( 'estado', 1 )->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            NULL;
        }
    } 

    public function get_productosmue( $consulta="" ){    
        if( $consulta != "" ){
            $resultado = $this->db->select('producto.id as id, nombre, prec, foto, cantidad, categoria')
    ->from('producto')
    ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
    ->where('cantidad >', 0)
    ->where('producto.estado', 1)
    ->where('categoria.id', 1)
    ->group_start()
        ->like('nombre', $consulta)
        ->or_like('prec', $consulta)
        ->or_like('foto', $consulta)
        ->or_like('cantidad', $consulta)
    ->group_end()
    ->get();

        }else{
            $resultado=$this->db->select( "producto.*, categoria" )->from( "producto" )->join( 'categoria' , 'producto.id_cat = categoria.id' , 'inner' )->where( 'cantidad >', 0 )->where( 'estado', 1 )->where('categoria.id', 1)->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            NULL;
        }
    } 


    public function get_productosdec( $consulta="" ){    
        if( $consulta != "" ){
            $resultado = $this->db->select('producto.id as id, nombre, prec, foto, cantidad, categoria')
    ->from('producto')
    ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
    ->where('cantidad >', 0)
    ->where('producto.estado', 1)
    ->where('categoria.id', 2)
    ->group_start()
        ->like('nombre', $consulta)
        ->or_like('prec', $consulta)
        ->or_like('foto', $consulta)
        ->or_like('cantidad', $consulta)
    ->group_end()
    ->get();

        }else{
            $resultado=$this->db->select( "producto.*, categoria" )->from( "producto" )->join( 'categoria' , 'producto.id_cat = categoria.id' , 'inner' )->where( 'cantidad >', 0 )->where( 'estado', 1 )->where('categoria.id', 2)->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            NULL;
        }
    } 


    public function get_productosropa( $consulta="" ){    
        if( $consulta != "" ){
            $resultado = $this->db->select('producto.id as id, nombre, prec, foto, cantidad, categoria')
    ->from('producto')
    ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
    ->where('cantidad >', 0)
    ->where('producto.estado', 1)
    ->where('categoria.id', 3)
    ->group_start()
        ->like('nombre', $consulta)
        ->or_like('prec', $consulta)
        ->or_like('foto', $consulta)
        ->or_like('cantidad', $consulta)
    ->group_end()
    ->get();

        }else{
            $resultado=$this->db->select( "producto.*, categoria" )->from( "producto" )->join( 'categoria' , 'producto.id_cat = categoria.id' , 'inner' )->where( 'cantidad >', 0 )->where( 'estado', 1 )->where('categoria.id', 3)->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            NULL;
        }
    } 


    public function get_productoscalzado( $consulta="" ){    
        if( $consulta != "" ){
            $resultado = $this->db->select('producto.id as id, nombre, prec, foto, cantidad, categoria')
    ->from('producto')
    ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
    ->where('cantidad >', 0)
    ->where('producto.estado', 1)
    ->where('categoria.id', 4)
    ->group_start()
        ->like('nombre', $consulta)
        ->or_like('prec', $consulta)
        ->or_like('foto', $consulta)
        ->or_like('cantidad', $consulta)
    ->group_end()
    ->get();

        }else{
            $resultado=$this->db->select( "producto.*, categoria" )->from( "producto" )->join( 'categoria' , 'producto.id_cat = categoria.id' , 'inner' )->where( 'cantidad >', 0 )->where( 'estado', 1 )->where('categoria.id', 4)->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            NULL;
        }
    }


    public function get_productosjuguetes( $consulta="" ){    
        if( $consulta != "" ){
            $resultado = $this->db->select('producto.id as id, nombre, prec, foto, cantidad, categoria')
    ->from('producto')
    ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
    ->where('cantidad >', 0)
    ->where('producto.estado', 1)
    ->where('categoria.id', 5)
    ->group_start()
        ->like('nombre', $consulta)
        ->or_like('prec', $consulta)
        ->or_like('foto', $consulta)
        ->or_like('cantidad', $consulta)
    ->group_end()
    ->get();

        }else{
            $resultado=$this->db->select( "producto.*, categoria" )->from( "producto" )->join( 'categoria' , 'producto.id_cat = categoria.id' , 'inner' )->where( 'cantidad >', 0 )->where( 'estado', 1 )->where('categoria.id', 5)->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            NULL;
        }
    } 


public function get_productosotro( $consulta="" ){    
        if( $consulta != "" ){
            $resultado = $this->db->select('producto.id as id, nombre, prec, foto, cantidad, categoria')
    ->from('producto')
    ->join('categoria', 'producto.id_cat = categoria.id', 'inner')
    ->where('cantidad >', 0)
    ->where('producto.estado', 1)
    ->where('categoria.id', 6)
    ->group_start()
        ->like('nombre', $consulta)
        ->or_like('prec', $consulta)
        ->or_like('foto', $consulta)
        ->or_like('cantidad', $consulta)
    ->group_end()
    ->get();

        }else{
            $resultado=$this->db->select( "producto.*, categoria" )->from( "producto" )->join( 'categoria' , 'producto.id_cat = categoria.id' , 'inner' )->where( 'cantidad >', 0 )->where( 'estado', 1 )->where('categoria.id', 6)->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            NULL;
        }
    } 

      

    public function get_productosf( $consulta="" ){    
        if( $consulta != "" ){
            $resultado=$this->db->select('*')
            ->from('producto')
            ->where( 'categoria', $consulta )
            ->get();
        }else{
            $resultado=$this->db->select( "*" )->from( "producto" )->get();
        }
        $num_rows = $resultado->num_rows();
        if( $num_rows > 0 ){
            return $resultado;
        }else{
            false;
        }
    }

    public function get_producto( $idproducto ){    
        $resultado=$this->db->select('*')
        ->from('producto')
        ->where( 'id', $idproducto )
        ->get();

        $num_rows = $resultado->num_rows();

        if( $num_rows > 0 ){
            return $resultado->result();
        }else{
            false;
        }
    }




    public function agregar_deseos( $idusuario , $idproducto ){
        
        $id_des = $this->db->select("max(id)+1 as id_des")->from("listadeseos")->get();
        $fila = $id_des->row();
        $id= $fila->id_des;

        if( $id == NULL ){
            $id = 1;
        }

        $data = array(
            "id" => $id,
            "id_clie" => $idusuario,
            "id_pro" => $idproducto,
        );
        
        $this->db->insert( "listadeseos" , $data );
        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }


}

?>