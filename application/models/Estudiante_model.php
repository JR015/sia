<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        //  $this->semestreVigente = $this->consultarSemestreVigente();
    }


    function consultarProgramasMatriculados($documento){


        $this->db->select('p.nombre, p.codigo, g.periodo')
                 ->from("matriculas m")
                 ->join("estudiantes e","e.documento = m.estudiante")
                 ->join("grupos g","g.codigo = m.grupo")
                 ->join("programas p","g.programa = p.codigo")
                 ->where(" e.documento",$documento);



        return  $this->db->get()->result_array();


    }

    function consultarMateriasMatriculadas($documento,$programa,$periodo){


        $this->db->select("a.nombre, n.nota1,n.nota2,n.nota3,n.nota_definitiva")
             ->from("asignaturas_matriculadas ams")
             ->join("asignaturas_semestrales asig_sem", "asig_sem.codigo = ams.asignatura_semestral")
             ->join("matriculas m", "m.codigo = ams.matricula")
             ->join("estudiantes e", "e.documento = m.estudiante")
            ->join("asignaturas a","a.codigo=asig_sem.asignatura")

            ->join("notas n","n.asignatura_matriculada=ams.codigo")

            ->join("planes_de_estudio ps","ps.codigo=asig_sem.plan_de_estudio")

            ->where(" ps.programa",$programa)
            ->where(" e.documento",$documento);


        return  $result = $this->db->get()->result_array();

    }


}
