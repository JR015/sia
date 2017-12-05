<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula_model extends CI_Model {



    function  crear($datos){


        $this->db->insert("matriculas",$datos);


        return $this->db->affected_rows();
    }



    function  consultar($documento_estudiante,$codigo_grupo){


        $this->db->select("*");
        $this->db->from("matriculas");
        $this->db->where("documento_estudiante",$documento_estudiante);
        $this->db->where("codigo_grupo",$codigo_grupo);
        $result= $this->db->get();

        return  $result->result_array();


    }

    function  consultarPorCodigo($codigo){


        $this->db->select("*");
        $this->db->from("asignaturas");
        $this->db->where("codigo",$codigo);
        $result= $this->db->get();

        return  $result->result_array();


    }




    function filtrar($nombre){

        $this->db->select("*");
        $this->db->like('nombre', $nombre);
        $this->db->or_like('nombre_corto', $nombre);
        $this->db->from('asignaturas');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }


    function  consultarTodos(){
        $result= $this->db->get("asignaturas");

        return  $result->result_array();

    }



    function  consultarTodosLosEstudiantes(){





        $this->db->select("documento, nombres, apellidos");
        $this->db->from("estudiantes");
        $this->db->order_by("nombres","ASC");


        $result= $this->db->get();


        return  $result->result_array();

    }


    function  consultarTodosLosProgramas(){



        $result= $this->db->get("programas");

        return  $result->result_array();



    }

    function consultarCodigoGrupo($codigoPrograma,$numeroSemestre,$jornada){



        $codigo_semestre= $this->consultarSemestreVigente();


        $this->db->select("codigo");
        $this->db->from("grupos");
        $this->db->where("codigo_programa",$codigoPrograma);

        $this->db->where("numero_semestre",$numeroSemestre);
        $this->db->where("jornada",$jornada);




       $this->db->where("codigo_semestre",$codigo_semestre);

        $result= $this->db->get();

        return  $result->result_array();

    }

    function consultarSemestreVigente(){

        $this->db->select("codigo as codigo_semestre");
        $this->db->from("semestres");
        $this->db->order_by("codigo","DES");
        $this->db->limit(1);


        $result = $this->db->get();


        return $result->result_array()[0]['codigo_semestre'];



    }


}
