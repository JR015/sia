<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo_model extends CI_Model {






    function  editar($codigo, $datos){


        $this->db->where("codigo",$codigo);

        $this->db->update("grupos",$datos);


        return $this->db->affected_rows();
    }







    function filtrar($codigo){

        $this->db->select("g.codigo,p.nombre AS programa,g.jornada, g.numero_semestre As semestre ");
        $this->db->like('g.jornada', $codigo);
        $this->db->or_like('p.nombre', $codigo);
        $this->db->from('grupos g');
        $this->db->join('programas p', 'p.codigo = g.codigo_programa');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }


    function  consultarTodos(){


        $this->db->select("g.codigo,p.nombre AS programa,g.jornada, g.numero_semestre As semestre ");

        $this->db->from('grupos g');
        $this->db->join('programas p', 'p.codigo = g.codigo_programa');
        $reslt = $this->db->get();
        return $reslt->result_array();



    }


}
