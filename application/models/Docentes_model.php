<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docentes_model extends CI_Model {



    public $semestreVigente;

    function __construct()
    {
        parent::__construct();

        $this->semestreVigente = $this->consultarSemestreVigente();
    }


    function consultarCargaAcademica($documento){


        $this->db->select("c.codigo,c.horas_semanales, as.nombre as asignaturas, g.nombre as grado");
        $this->db->from("cargas_academicas c");
        $this->db->join('planes_de_estudio a', 'a.codigo = c.codigo_asignatura_asignada');
        $this->db->join('asignaturas as', 'as.codigo = a.codigo_asignatura');

        $this->db->join('programas g', 'g.codigo = a.codigo_semestre');

        $this->db->where("c.codigo_semestre",$this->semestreVigente);
        $this->db->where("c.documento_docente",$documento);


        $result = $this->db->get();
        return $result->result_array();
    }



    function autoCompletar($nombres){

        $this->db->select("documento AS value, CONCAT(nombres,' ',apellidos)  AS label", FALSE);
        $this->db->like('nombres', $nombres);
        $this->db->or_like('apellidos', $nombres);
        $this->db->from('docentes');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }


    function consultarSemestreVigente(){

        $this->db->select("codigo");
        $this->db->from("semestres");
        $this->db->order_by("codigo","DES");
        $this->db->limit(1);


        $result = $this->db->get();


        return $result->result_array()[0]['codigo'];



    }










    function filtrar($nombres){

        $this->db->select("*");
        $this->db->like('nombres', $nombres);
        $this->db->or_like('apellidos', $nombres);
        $this->db->from('docentes');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }


    function  consultarTodos(){

        $result= $this->db->get("docentes");
        return  $result->result_array();

    }



    function  consultarProgramas(){

        $result= $this->db->get("programas");
        return  $result->result_array();

    }


    function  consultarGrupos(){



        $result= $this->db->get("grupos");

        return  $result->result_array();



    }
}
