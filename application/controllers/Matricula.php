<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public $login;

    function __construct()
    {
        parent::__construct();

        $this->login = $this->session->userdata('documento');

        $this->load->model("Matricula_model", "matricula");

        if (!isset($this->login)) {


            redirect(base_url());
        }
    }

    function index()
    {


        $datos['css'] = array('dataTables.bootstrap.css');
        $datos['js'] = array('modalBootstrap.js', 'matricula.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');


        $datos['estudiantes'] = $this->consultarTodosLosEstudiantes();
        $datos['programas'] = $this->consultarTodosLosProgramas();

        $datos['titulo'] = "Matrícula";
        $datos['contenido'] = '../coordinador/matriculas/matricular';
        $this->load->view("coordinador/plantilla", $datos);

    }


    public function crear()
    {

        $documento_estudiante = $this->input->post("documento");
        $codigo_grupo = ($this->input->post("grupo"));


        $datos = array(

            "documento_estudiante" => $documento_estudiante,
            "codigo_grupo" => $codigo_grupo,


        );

        $existe = $this->matricula->consultar($documento_estudiante, $codigo_grupo);

        if (count($existe) == 0) {

            $this->matricula->crear($datos);

        } else {

            echo -1;

        }
    }

    function filtrar()
    {

        $nombre = $this->input->post("nombre");


        if (isset($nombre)) {

            $asignaturas = $this->asginatura->filtrar($nombre);


            foreach ($asignaturas as $asignatura) {

                echo '<tr>

                    <td>' . $asignatura['codigo'] . '</td>
                    <td>' . $asignatura['nombre'] . '</td>

                    <td class="text-center"><a href="javascript:abrirModalEditarAsignatura(' . $asignatura['codigo'] . ')" class="fa fa-edit"></a></td>
                </tr>';

            }
        }


    }


    function consultar()
    {


        $documento = $this->input->post("documento");

        if (isset($documento)) {


            $estudiante = $this->asginatura->consultar($documento);


            echo json_encode($estudiante);
        }
    }

    function consultarPorCodigo()
    {


        $codigo = $this->input->post("codigo");

        if (isset($codigo)) {


            $asignatura = $this->asginatura->consultarPorCodigo($codigo);


            echo json_encode($asignatura);
        }
    }


    function listarGrados()
    {

        return $this->grados->consultarTodo();


    }


    function consultarTodosLosEstudiantes()
    {

        return $this->matricula->consultarTodosLosEstudiantes();
    }

    function consultarTodosLosProgramas()
    {

        return $this->matricula->consultarTodosLosProgramas();
    }

    function consultarGradoYNivelEscolarPorGrado()
    {


        $codigo = $this->input->post("codigo");

        $info = $this->matricula->consultarGradoYNivelEscolarPorGrado($codigo);


        echo json_encode($info);


    }


    function consultarCodigoGrupo(){


        $codigoPrograma = $this->input->post("programa");
        $numeroSemestre = $this->input->post("semestre");
        $jornada = $this->input->post("jornada");
       $grupos = $this->matricula->consultarCodigoGrupo($codigoPrograma,$numeroSemestre,$jornada);


        echo '<option value="">Seleccione</option>';


        foreach ($grupos as $grupo){

           echo '<option value="'.$grupo['codigo'].'">'.$grupo['codigo'].'</option>';

        }


    }




}
