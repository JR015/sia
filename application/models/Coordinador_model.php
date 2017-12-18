<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordinador_model extends CI_Model {




    function  consultarEstudiante($documento){


        $this->db->select("e.*, m.nombre AS nombre_municipio");
        $this->db->from("estudiantes e");
        $this->db->join("municipios m","m.codigo=e.municipio");
        $this->db->where("e.documento",$documento);
        $result= $this->db->get();

        return  $result->result_array();


    }


    function filtrarEstudiante($nombres){

        $this->db->select("apellidos_nombres,documento,correo");
        $this->db->like('apellidos_nombres', $nombres);
       // $this->db->or_like('apellidos', $nombres);
        $this->db->from('estudiantes');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }


    function  consultarTodosLosEstudiantes(){



        $result= $this->db->get("estudiantes");

        return  $result->result_array();



    }

    function consultarMunicipios($nombre_departamento)
    {



        $this->db->select("m.codigo AS id, m.nombre AS text, d.nombre AS dpto",false);
        $this->db->from("municipios m");
        $this->db->join("departamentos d","d.codigo=m.codigo_departamento");

        $this->db->like("m.nombre", $nombre_departamento);




        $reslt = $this->db->get();

        return $reslt->result_array();

    }


    function  registrarDocente($datos){


        $this->db->insert("docentes",$datos);


        return $this->db->affected_rows();
    }


    function  editarDocente($documento,$datos){


        $this->db->where("documento",$documento);

        $this->db->update("docentes",$datos);


        return $this->db->affected_rows();
    }

    function  consultarDocente($documento){




        $this->db->select("e.*, m.nombre AS nombre_municipio");
        $this->db->from("docentes e");
        $this->db->join("municipios m","m.codigo=e.municipio");
        $this->db->where("e.documento",$documento);
        $result= $this->db->get();

        return  $result->result_array();



    }


    function  consultarTodosLosGrupos(){


        $this->db->select("g.codigo,p.nombre AS programa,g.jornada, g.numero_semestre As semestre ");

        $this->db->from('grupos g');
        $this->db->join('programas p', 'p.codigo = g.programa');
        $reslt = $this->db->get();
        return $reslt->result_array();



    }




    function  consultarTodosLosGruposDelPeriodoActual(){


        $this->db->select("g.codigo,p.nombre AS programa,j.nombre AS jornada, g.numero_semestre As semestre ");

        $this->db->from('grupos g');
        $this->db->join('programas p', 'p.codigo = g.programa');
        $this->db->join('jornadas j', 'j.codigo = g.jornada');
        $reslt = $this->db->get();
        return $reslt->result_array();



    }


    function crearPeriodo($anio, $semestre, $fecha_inicio, $fecha_fin)
    {




        $this->db->update("periodos",array("actual"=>0));

        $datos = array(

            "codigo" => $anio . "" . $semestre,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "actual" => 1,



        );

        return $this->db->insert("periodos", $datos);

    }

    function  inscribirEstudiante($datos){


        $this->db->insert("inscripciones",$datos);


        return $this->db->affected_rows();
    }

    function consultarEstudiantesInscritos($programa){


        $this->db->select("COUNT(i.codigo) AS cantidad");
        $this->db->from("inscripciones i ");

        if(!empty($programa)){

            $this->db->where("i.programa",$programa);


        }

        $result= $this->db->get();

        $cantidad = (int) $result->result_array()[0]['cantidad'];
        return  $cantidad;



    }

    function  registrarEstudiante($datos){


        $this->db->insert("estudiantes",$datos);


        return $this->db->affected_rows();
    }


    function  editarEstudiante($documento,$datos){


        $this->db->where("documento",$documento);

        $this->db->update("estudiantes",$datos);


        return $this->db->affected_rows();
    }



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



    function  consultarAsignatura($codigo){


        $this->db->select("*");
        $this->db->from("asignaturas");
        $this->db->where("codigo",$codigo);
        $result= $this->db->get();

        return  $result->result_array();


    }

    function  consultarPeriodoAcademicoActual(){


        $this->db->select("codigo AS periodo");
        $this->db->from("periodos");
        $this->db->where("actual",1);
        $result= $this->db->get();

        return  $result->result_array()[0]["periodo"];


    }

    function  consultarJornadas(){


        $this->db->select("*");
        $this->db->from("jornadas");

        $result= $this->db->get();

        return  $result->result_array();


    }

    function  consultarPeriodosAcademicos(){


        $this->db->select("codigo AS periodo");
        $this->db->from("periodos");
        $this->db->order_by("codigo","DESC");

        $result= $this->db->get();

        return  $result->result_array();


    }


    public function consultarInscripciones($periodo=null, $programa=null){


        $this->db->select("i.periodo,i.programa, e.nombres_apellidos AS estudiante, p.nombre AS programa",FALSE);
        $this->db->from("inscripciones i");
        $this->db->join("estudiantes e","i.estudiante= e.documento");
        $this->db->join("programas p","i.programa= p.codigo");

        if (!empty($periodo)){

            $this->db->where("i.periodo",$periodo);
        }

        if (!empty($programa)){

            $this->db->where("i.programa",$programa);
        }


        $this->db->order_by("i.periodo","DESC");
        $result= $this->db->get();

        return  $result->result_array();


    }


    public function consultarMatriculas($periodo=null, $programa=null,$semestre=null,$jornada=null){


        $this->db->select("g.periodo,g.numero_semestre AS semestre, j.nombre AS jornada, e.nombres_apellidos AS estudiante, p.nombre AS programa",FALSE);
        $this->db->from("matriculas m");
        $this->db->join("estudiantes e","m.estudiante= e.documento");
        $this->db->join("grupos g","g.codigo= m.grupo");
        $this->db->join("programas p","g.programa= p.codigo");
        $this->db->join("jornadas j","j.codigo= g.jornada");

        if (!empty($periodo)){

            $this->db->where("g.periodo",$periodo);
        }

        if (!empty($programa)){

            $this->db->where("g.programa",$programa);
        }


        if (!empty($semestre)){

            $this->db->where("g.numero_semestre",$semestre);
        }

        if (!empty($jornada)){

            $this->db->where("g.jornada",$jornada);
        }

        $this->db->order_by("g.periodo","DESC");
        $result= $this->db->get();

        return  $result->result_array();


    }

public function consultarGrupos(){


    $this->db->select("g.codigo,p.nombre AS programa,g.jornada, g.numero_semestre As semestre ");

    $this->db->from('grupos g');
    $this->db->join('programas p', 'p.codigo = g.programa');
    $reslt = $this->db->get();
    return $reslt->result_array();

}

    function filtrarAsignatura($nombre){


        $this->db->select('a.codigo,a.nombre,a.horas_semanales, p.nombre AS programa');
        $this->db->like('a.nombre', $nombre);
        $this->db->from('asignaturas a');
        $this->db->join('programas p','p.codigo = a.programa');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }


    function filtrarDocente($nombres){

        $this->db->select("*");
        $this->db->like('apellidos_nombres', $nombres);
      //  $this->db->or_like('apellidos_nombr', $nombres);
        $this->db->from('docentes');
        $reslt = $this->db->get();
        return $reslt->result_array();

    }

    public function consultarTodosLosProgramas(){

        $result= $this->db->get("programas");

        return  $result->result_array();

    }

    function  consultarTodasLasAsignatura(){



        $result= $this->db->get("asignaturas");

        return  $result->result_array();




    }


    function  crearGrupo($datos){


        $this->db->insert("grupos",$datos);


        return $this->db->affected_rows();
    }

    function  consultarGrupo($codigo){


        $this->db->select("*");
        $this->db->from("grupos");
        $this->db->where("codigo",$codigo);
        $result= $this->db->get();

        return  $result->result_array();


    }

    function  consultarDetallesDeGrupo($codigo){


        $this->db->select("p.nombre AS programa ,j.nombre AS jornada, g.numero_semestre AS semestre, g.periodo");
        $this->db->from("grupos g");
        $this->db->join('programas p','p.codigo = g.programa');
        $this->db->join('jornadas j','j.codigo = g.jornada');
        $this->db->where("g.codigo",$codigo);
        $result= $this->db->get();

        return  $result->result_array();


    }

    function  matriculaFinanciera($datos){


        $this->db->insert("matriculas",$datos);


        return $this->db->affected_rows();
    }



    function  consultarMatriculaFinanciera($documento_estudiante,$codigo_grupo){


        $this->db->select("*");
        $this->db->from("matriculas");
        $this->db->where("estudiante",$documento_estudiante);
        $this->db->where("grupo",$codigo_grupo);
        $result= $this->db->get();

        return  $result->result_array();


    }



}
