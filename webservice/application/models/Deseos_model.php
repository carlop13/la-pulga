<?php

class Deseos_model extends CI_Model{


    public function borrar_deseo( $idusuario , $idproducto ){
        
        $this->db->where('id_clie', $idusuario)
        ->where( 'id_pro' , $idproducto );
        $this->db->delete('listadeseos');

        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }



}

?>