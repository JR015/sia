<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programa_model extends CI_Model {


    function  consultarTodos(){

        $result= $this->db->get("programas");

        return  $result->result_array();



    }
}
