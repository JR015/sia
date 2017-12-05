<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignatura_model extends CI_Model {



    function  registrarAsignatura($datos){


        $this->db->insert("asignaturas",$datos);


        return $this->db->affected_rows();
    }


    function  editarAsignatura($codigo, $datos){


        $this->db->where("codigo",$codigo);

        $this->db->update("asignaturas",$datos);


        return $this->db->affected_rows();
    }

    function  consultarAsignaturaPorNombre($nombre){


        $this->db->select("*");
        $this->db->from("asignaturas");
        $this->db->where("nombre",$nombre);
        $result= $this->db->get();

        return  $result->result_array();


    }

    function  consultarAsignaturaPorCodigo($codigo){


        $this->db->select("*");
        $this->db->from("asignaturas");
        $this->db->where("codigo",$codigo);
        $result= $this->db->get();

        return  $result->result_array();


    }




    function filtrarAsignatura($nombre){

        $this->db->select("*");
        $this->db->like('nombre', $nombre);
        $this->db->or_like('abreviatura', $nombre);
        $this->db->from('asignaturas');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }


    function  consultarTod(){



        $result= $this->db->get("asignaturas");

        return  $result->result_array();



    }



}
