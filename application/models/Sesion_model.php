<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion_model extends CI_Model {



    function iniciar($usuario,$clave,$tipo_usuario){

        $this->db->select("documento");
        $this->db->select("nombres");
        $this->db->select("apellidos");
        $this->db->from($tipo_usuario);
        $this->db->where("documento",$usuario);
        $this->db->where("clave",$clave);

        $result = $this->db->get();

        return $result->result_array();
    }


    function consultarPeriodoActual(){

        $this->db->select("codigo AS periodo")
        ->from("periodos")
        ->where("actual",1);

        return  $result = $this->db->get()->result_array()[0]['periodo'];
 }



}
