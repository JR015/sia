<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {


    public $tipo;

    function __construct()
    {
        parent::__construct();


        $this->tipo = $this->session->userdata('tipo');
    }

    function cambiarClaveDeAcceso($clave,$datos){


        if(strcmp($clave,$this->obtenerClave())==0){

            $this->db->where('documento=',$this->session->userdata('documento') );

            $this->db->update($this->tipo,$datos);

            return $this->db->affected_rows();
        }

        return 0;

    }


    function obtenerClave(){

        $this->db->select("clave");
        $this->db->where('documento=',$this->session->userdata('documento') );
        $this->db->from($this->tipo);

        $reslt = $this->db->get();

        return $reslt->result_array()[0]['clave'];

    }

}
