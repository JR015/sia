<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docentes_model extends CI_Model
{


    public $semestreVigente;

    function __construct()
    {
        parent::__construct();

        //  $this->semestreVigente = $this->consultarSemestreVigente();
    }


    public function consultarProgramasOrientados($documento)
    {

        $this->db->select("p.nombre,p.codigo");
        $this->db->from("cargas_academicas ca");


        $this->db->join('asignaturas_semestrales aps', 'aps.codigo = ca.asignatura_semestral');
        $this->db->join('planes_de_estudio ps', 'ps.codigo = aps.plan_de_estudio');
        $this->db->join('programas p', 'p.codigo = ps.programa');
        $this->db->where("ca.docente", $documento);
        $this->db->group_by("p.nombre");

        return $this->db->get()->result_array();
    }



    function consultarFechasDigitacionNotas($periodo)
    {


        $this->db->select("*");
        $this->db->from("fechas_digitaciones_notas f")
            ->where("periodo", $periodo)
            ->where("CURDATE() >= fecha_inicio")

              ->where(" CURDATE()< fecha_fin");

        return  $this->db->get()->result_array()[0];

    }

    function consultarListadoDeEstudiantesMatriculadosPorAsignatura($docente, $asinatura)
    {






        $this->db->select("ams.codigo as codigo_matricula ,e.documento, CONCAT(e.nombres,' ',e.apellidos) as nombre");
        $this->db->from("asiganturas_matriculadas ams");
        $this->db->join("asignaturas_semestrales asig_sem", "asig_sem.codigo = ams.asignatura_semestral");
        $this->db->join("matriculas m", "m.codigo = ams.matricula");
        $this->db->join("estudiantes e", "e.documento = m.estudiante");
        $this->db->join("cargas_academicas ca", "ca.asignatura_semestral = asig_sem.codigo");

        $this->db->where("ams.asignatura_semestral", $asinatura);
        $this->db->where("ca.docente", $docente);
        return  $this->db->get()->result_array();
    }


    function registrarNota($datos)
    {


        $this->db->insert("notas", $datos);

        return $this->db->affected_rows();
    }


    function autoCompletar($nombres)
    {

        $this->db->select("documento AS value, CONCAT(nombres,' ',apellidos)  AS label", FALSE)
            ->like('nombres', $nombres)
            ->or_like('apellidos', $nombres)
            ->db->from('docente');

        return  $this->db->get()->result_array();

    }



    function filtrar($nombres)
    {

        $this->db->select("*")
            ->like('nombres', $nombres)
            ->or_like('apellidos', $nombres)
            ->from('docente');

        return  $this->db->get()->result_array();
    }


    function consultarTodos()
    {

        $result = $this->db->get("docente");
        return $result->result_array();


    }


    function consultarProgramas()
    {

        $result = $this->db->get("programas");
        return $result->result_array();

    }


    function consultarGrupos()
    {


        $result = $this->db->get("grupos");

        return $result->result_array();


    }
}
