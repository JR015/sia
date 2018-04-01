<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordinador_model extends CI_Model
{


    function consultarEstudiante($documento)
    {


        $this->db->select("e.*, 
        
        i.nombre as nombre_institucion,
        consultar_municipio(e.lugar_residencia) AS nombre_lugar_residencia, 
        consultar_municipio(e.lugar_nacimiento) AS nombre_lugar_nacimiento,
        consultar_municipio(e.lugar_expedicion_documento) AS nombre_lugar_expedicion_documento
        
        
        
        ")

            ->from("estudiantes e")
            ->join("instituciones i", "i.codigo=e.institucion")
            ->where("e.documento", $documento);
        $result = $this->db->get();

        return $result->result_array();


    }


    function consultarGrados()
    {


        $this->db->select("numero,nombre");
        $this->db->from("grados");

        return  $this->db->get()->result_array();


    }

    function consultarNivelesEducacion()
    {


        $this->db->select("codigo,nombre");
        $this->db->from("niveles_educacion");

        return  $this->db->get()->result_array();

    }


    function filtrarEstudiante($nombres)
    {

        $this->db->select("apellidos,nombres,documento,correo");
        $this->db->like('apellidos', $nombres);
        $this->db->or_like('nombres', $nombres);

        // $this->db->or_like('apellidos', $nombres);
        $this->db->from('estudiantes');
        return  $this->db->get()->result_array();
    }

    function filtrarInstitucion($nombre)
    {

        $this->db->select("i.codigo,  i.nombre, m.nombre AS municipio")
            ->like('i.nombre', $nombre)
            ->from('instituciones i')
            ->join("municipios m", "m.codigo=i.municipio");

        return $this->db->get()->result_array();

    }


    function consultarTodosLosEstudiantes()
    {


        $result = $this->db->get("estudiantes");

        return $result->result_array();


    }


    function filtrarMunicipios($nombre)
    {


        $this->db->select("m.codigo, m.nombre, d.nombre AS dpto", false);
        $this->db->from("municipios m");
        $this->db->join("departamentos d", "d.codigo=m.codigo_departamento");

        $this->db->like("m.nombre", $nombre);

        return  $this->db->get()->result_array();

    }

    function consultarMunicipios($nombre_departamento)
    {


        $this->db->select("m.codigo AS id, m.nombre AS text, d.nombre AS dpto", false);
        $this->db->from("municipios m");
        $this->db->join("departamentos d", "d.codigo=m.codigo_departamento");

        $this->db->like("m.nombre", $nombre_departamento);

        return  $this->db->get()->result_array();

    }


    function registrarDocente($datos)
    {


        $this->db->insert("docentes", $datos);


        return $this->db->affected_rows();
    }




    function consultarDocente($documento)
    {


        $this->db->select("e.*, m.nombre AS nombre_municipio");
        $this->db->from("docentes e");
        $this->db->join("municipios m", "m.codigo=e.municipio");
        $this->db->where("e.documento", $documento);
        return  $this->db->get()->result_array();

    }


    function consultarTodosLosGrupos()
    {


        $this->db->select("g.codigo,p.nombre AS programa,g.jornada, g.semestre As semestre ");

        $this->db->from('grupos g');
        $this->db->join('programas p', 'p.codigo = g.programa');
        return  $this->db->get()->result_array();

    }


    function consultarTodosLosGruposDelPeriodoActual($periodo)
    {


        $this->db->select("g.codigo,p.nombre AS programa,j.nombre AS jornada, g.semestre, numero ")
            ->from('grupos g')
            ->join('programas p', 'p.codigo = g.programa')
            ->join('jornadas j', 'j.codigo = g.jornada')
            ->join('periodos pe', 'pe.codigo = g.periodo')
            ->where("g.periodo", $periodo);
        return $this->db->get()->result_array();


    }


    function consultarAsignaturasPorPrograma($codigoPrograma)
    {


        $this->db->select("a.codigo, a.nombre")
            ->from("planes_de_estudio ps")
            ->join("asignaturas_semestrales as", "as.plan_de_estudio=ps.codigo")
            ->join("asignaturas a", "as.asignatura=a.codigo")
            ->where("ps.programa", $codigoPrograma);


        return $this->db->get()->result_array();
    }

    function crearPeriodo($anio, $semestre, $fecha_inicio, $fecha_fin)
    {


        $this->db->update("periodos", array("actual" => 0));

        $datos = array(

            "codigo" => $anio . "" . $semestre,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "actual" => 1,


        );

        return $this->db->insert("periodos", $datos);

    }

    function inscribirEstudiante($datos)
    {


        $this->db->insert("inscripciones", $datos);


        return $this->db->affected_rows();
    }


    function calcularNotaFinal($asignaturaMatriculada)
    {


        $this->db->query("CALL calcular_nota_definitiva($asignaturaMatriculada);");

    }


    /*
     * Este medtodo
     *
     * */
    function cambiarEstadoEvaluacionPorCorte($carga, $corte)
    {


        $this->db->set("evaluado_corte" . $corte, 1)
            ->where("codigo", $carga)
            ->update("cargas_academicas");


        return $this->db->affected_rows();

    }


    function consultarAsignaturasGruposPorPrograma($programa, $corte)
    {


        //  ->where("ps.programa",$programa);


        $this->db->select("ased.codigo, a.nombre, ase.semestre, j.nombre AS jornada, ased.grupo AS numero, d.apellidos, d.nombres as docente")
            ->from("asignaturas_semestrales ase")
            ->join('cargas_academicas ased', 'ased.asignatura_semestral =  ase.codigo', "inner")
            ->join('asignaturas a', 'a.codigo = ase.asignatura', "inner")
            ->join("planes_de_estudio ps", "ps.codigo = ase.plan_de_estudio", "inner")
            ->join("jornadas j", "j.codigo = ased.jornada", "inner")
            ->join("docentes d", "d.documento = ased.docente", "inner")
            ->where("evaluado_corte" . $corte, 0)
            ->where("a.codigo", $programa);


        return $this->db->get()->result_array();
    }

    function consultarAsiganaturasPorPrograma($programa, $corte)
    {


        $this->db->select("ps.programa, a.codigo, a.nombre")
            ->from("asignaturas_semestrales ase")
            ->join('cargas_academicas ased', 'ased.asignatura_semestral =  ase.codigo', "inner")
            ->join('asignaturas a', 'a.codigo = ase.asignatura', "inner")
            ->join("planes_de_estudio ps", "ps.codigo = ase.plan_de_estudio", "inner")
            ->where("evaluado_corte" . $corte, 0)
            ->where("ps.programa", $programa)
            ->group_by("a.codigo");

        return $this->db->get()->result_array();
    }


    function consultarAsignaturasPorProgramaSemestre($programa, $semestre)
    {


        $this->db->select("ase.codigo")
            ->from("asignaturas_semestrales ase")
            ->join("planes_de_estudio ps", "ps.codigo = ase.plan_de_estudio", "inner")
            ->where(" ase.semestre", $semestre)
            ->where("ps.programa", $programa)
            ->where("ps.activo ", 1);


        return $this->db->get()->result_array();
    }


    function registrar($tabla, $datos)
    {

        $this->db->insert($tabla, $datos);

        return $this->db->affected_rows();


    }

    function guardarNota($asignaura, $datos)
    {


        $this->db->where("asignatura_matriculada", $asignaura)
            ->update("notas", $datos);
        return $this->db->affected_rows();


    }


    function consultarListadoDeEstudiantesMatriculadosPorAsignatura($carga)
    {


        /*
         *
         *
         * */

        $this->db->select("ams.codigo as codigo_matricula ,e.documento, e.apellidos, e.nombres as nombre");
        $this->db->from("asignaturas_matriculadas ams");
        $this->db->join("asignaturas_semestrales asig_sem", "asig_sem.codigo = ams.asignatura_semestral");
        $this->db->join("matriculas m", "m.codigo = ams.matricula");
        $this->db->join("estudiantes e", "e.documento = m.estudiante");
        $this->db->join("cargas_academicas ca", "ca.asignatura_semestral = asig_sem.codigo");


        $this->db->where("ca.codigo", $carga);

        return $this->db->get()->result_array();
    }


    function consultarGruposPorPrograma($programa, $semestre = null, $jornada=null)
    {


        $this->db->select("g.codigo, g.jornada, g.numero, CONCAT(g.semestre,' SEMESTRE ', j.nombre,' #', g.numero) as nombre")
            ->from("grupos g")
            ->join("programas p", "p.codigo = g.programa", "inner")
            ->join("jornadas j", "g.jornada = j.codigo", "inner")
            ->where("g.programa", $programa);



        if (isset($semestre) && !empty($semestre)) {

            $this->db->where("semestre", $semestre);

        }

        if (isset($jornada) && !empty($jornada)) {

            $this->db->where("g.jornada", $jornada);

        }


        return $this->db->get()->result_array();

    }

    function consultarAsignaturasPorGrupos($programa, $semestre, $jornada, $numeroGrupo)
    {


        $this->db->select("ase.codigo,a.nombre")
            ->from("asignaturas_semestrales ase")
            ->join("asignaturas a", "a.codigo = ase.asignatura", "inner")
            ->join("planes_de_estudio ps", "ps.codigo = ase.plan_de_estudio", "inner")
            ->join("grupos g", "g.programa=ps.programa", "inner")
            ->where("ase.semestre", $semestre)
            ->where("ps.programa", $programa);


        if ($jornada != 'TDS') {

            $this->db->where("g.jornada", $jornada);

        }


        $this->db->group_by("a.codigo");

        return $this->db->get()->result_array();
    }


    function consultarEstudiantesInscritos($programa)
    {


        $this->db->select("COUNT(i.codigo) AS cantidad");
        $this->db->from("inscripciones i ");

        if (!empty($programa)) {

            $this->db->where("i.programa", $programa);


        }

        $result = $this->db->get();

        $cantidad = (int)$result->result_array()[0]['cantidad'];
        return $cantidad;


    }

    function registrarEstudiante($datos)
    {


        $this->db->insert("estudiantes", $datos);


        return $this->db->affected_rows();
    }


    function consultarCargaAcademicaPorDocente($docente, $periodo)
    {


        $this->db->select("a.nombre AS asignatura, ase.semestre, j.nombre AS jornada, ca.grupo")
            ->from("cargas_academicas ca")
            ->join("docentes d", "d.documento =  ca.docente", "inner")
            ->join("asignaturas_semestrales ase", "ase.codigo =  ca.asignatura_semestral")
            ->join("asignaturas a", "a.codigo =  ase.asignatura", "inner")
            ->join("jornadas j", "j.codigo =  ca.jornada", "inner")
            ->where("d.documento", $docente)
            ->where("ca.periodo", $periodo)
            ->order_by("a.nombre", "DESC");


        return $this->db->get()->result_array();


    }

    function editarPorDocumento($tabla,$documento, $datos)
    {


        $this->db->where("documento", $documento);

        $this->db->update($tabla, $datos);


        return $this->db->affected_rows();
    }


    public function consultarProximoNumeroDeGrupo($periodo, $programa, $semestre, $jornada)
    {


        $this->db->select("COUNT(*)+1  AS numero")
            ->from("grupos")
            ->where("periodo", $periodo)
            ->where("jornada", $jornada)
            ->where("programa", $programa)
            ->where("semestre", $semestre);

        return $result = $this->db->get()->result_array()[0]['numero'];


    }

    function autoCompletarDocentes($nombres)
    {

        $this->db->select("documento AS value,  CONCAT( apellidos,' ', nombres)  AS label", FALSE)
            ->like('nombres', $nombres)
            ->or_like('apellidos', $nombres)
            ->from('docentes');

        return $result = $this->db->get()->result_array();

    }

    function registrarAsignatura($datos)
    {


        $this->db->insert("asignaturas", $datos);


        return $this->db->affected_rows();
    }


    function editarAsignatura($codigo, $datos)
    {


        $this->db->where("codigo", $codigo);

        $this->db->update("asignaturas", $datos);


        return $this->db->affected_rows();
    }

    function consultarAsignaturaPorNombre($nombre)
    {


        $this->db->select("*");
        $this->db->from("asignaturas");
        $this->db->where("nombre", $nombre);
        $result = $this->db->get();

        return $result->result_array();


    }


    function consultarAsignatura($codigo)
    {


        $this->db->select("*");
        $this->db->from("asignaturas");
        $this->db->where("codigo", $codigo);
        $result = $this->db->get();

        return $result->result_array();


    }

    function consultarPeriodoAcademicoActual()
    {


        $this->db->select("codigo AS periodo");
        $this->db->from("periodos");
        $this->db->where("actual", 1);
        $result = $this->db->get();

        return $result->result_array()[0]["periodo"];


    }

    function consultarJornadas()
    {


        $this->db->select("*");
        $this->db->from("jornadas");

        $result = $this->db->get();

        return $result->result_array();


    }

    function consultarPeriodosAcademicos()
    {


        $this->db->select("codigo AS periodo");
        $this->db->from("periodos");
        $this->db->order_by("codigo", "DESC");

        $result = $this->db->get();

        return $result->result_array();


    }


    public function consultarInscripciones($periodo = null, $programa = null)
    {


        $this->db->select("i.periodo,i.programa, e.apellidos,e.nombres AS estudiante, p.nombre AS programa", FALSE);
        $this->db->from("inscripciones i");
        $this->db->join("estudiantes e", "i.estudiante= e.documento");
        $this->db->join("programas p", "i.programa= p.codigo");

        if (!empty($periodo)) {

            $this->db->where("i.periodo", $periodo);
        }

        if (!empty($programa)) {

            $this->db->where("i.programa", $programa);
        }


        $this->db->order_by("i.periodo", "DESC");
        $result = $this->db->get();

        return $result->result_array();


    }

    public function consultarProgramasOrientados($documento_docente = null)
    {

        $this->db->select("p.nombre,p.codigo");
        $this->db->from("cargas_academicas ca");


        $this->db->join('asignaturas_semestrales aps', 'aps.codigo = ca.asignatura_semestral');
        $this->db->join('planes_de_estudio ps', 'ps.codigo = aps.plan_de_estudio');
        $this->db->join('programas p', 'p.codigo = ps.programa');


        if (!is_null($documento_docente)) {

            $this->db->where("ca.docente", $documento_docente);

        }


        $this->db->group_by("p.nombre");

        return $this->db->get()->result_array();
    }

    function consultarFechasDigitacionNotas($periodo)
    {


        $this->db->select("*");
        $this->db->from("fechas_digitaciones_notas f")
            ->where("periodo", $periodo)
            ->where("CURDATE() >= fecha_inicio")
            ->where(" CURDATE()<= fecha_fin");

        return $this->db->get()->result_array();

    }


    public function consultarMatriculas($periodo = null, $programa = null, $semestre = null, $jornada = null)
    {


        $this->db->select("g.periodo,g.semestre AS semestre, j.nombre AS jornada, CONCAT( e.nombres,' ',e.apellidos) AS estudiante, p.nombre AS programa, g.numero AS grupo", FALSE)
                 ->from("matriculas m")
                 ->join("estudiantes e", "m.estudiante= e.documento")
                 ->join("grupos g", "g.codigo= m.grupo")
                 ->join("programas p", "g.programa= p.codigo")
                 ->join("jornadas j", "j.codigo= g.jornada");

        if (!empty($periodo)) {

            $this->db->where("g.periodo", $periodo);
        }

        if (!empty($programa)) {

            $this->db->where("g.programa", $programa);
        }


        if (!empty($semestre)) {

            $this->db->where("g.semestre", $semestre);
        }

        if (!empty($jornada)) {

            $this->db->where("g.jornada", $jornada);
        }

        $this->db->order_by("g.periodo", "DESC");
        return $this->db->get()->result_array();


    }

    public function consultarGrupos()
    {


        $this->db->select("g.codigo,p.nombre AS programa,g.jornada, g.semestre As semestre ")
              ->from('grupos g')
              ->join('programas p', 'p.codigo = g.programa');

        return $this->db->get()->result_array();

    }


    function filtrarAsignatura($nombre)
    {


        $this->db->select('a.codigo,a.nombre,a.creditos')
      ->like('a.nombre', $nombre)
      ->from('asignaturas a');

        return $this->db->get()->result_array();

    }


    function filtrarDocente($nombres)
    {

        $this->db->select("documento, CONCAT(nombres,' ',apellidos)  as nombres")
       ->like('nombres', $nombres)
        ->or_like('apellidos', $nombres)
        ->from('docentes');

        return $this->db->get()->result_array();

    }


    public function consultarTodosLosProgramas()
    {

        $result = $this->db->get("programas");

        return $result->result_array();

    }

    function consultarTodasLasAsignatura()
    {


        $result = $this->db->get("asignaturas");

        return $result->result_array();


    }


    function crearGrupo($datos)
    {


        $this->db->insert("grupos", $datos);


        return $this->db->affected_rows();
    }

    function consultarGrupo($codigo)
    {


        $this->db->select("*")
        ->from("grupos")
        ->where("codigo", $codigo);
        return $this->db->get()->result_array();

    }

    function consultarDetallesDeGrupo($codigo)
    {


         $this->db->select("p.nombre AS programa , p.codigo AS codigo_programa,   j.nombre AS jornada, g.semestre AS semestre, g.numero")
        ->from("grupos g")
        ->join('programas p', 'p.codigo = g.programa')
        ->join('jornadas j', 'j.codigo = g.jornada')
        ->where("g.codigo", $codigo);

        return $this->db->get()->result_array();

    }

    function registrarOptenerUltimoID($tabla, $datos)
    {


        $this->db->insert($tabla, $datos);


        return $this->db->insert_id();
    }


    function consultarMatriculaFinanciera($documento_estudiante, $codigo_grupo)   {


        $this->db->select("*")
       ->from("matriculas")
       ->where("estudiante", $documento_estudiante)
       ->where("grupo", $codigo_grupo);
 return $this->db->get()->result_array();


    }


    function consultarSemestre(){



        return $this->db->get("semestres")->result_array();

    }


}
