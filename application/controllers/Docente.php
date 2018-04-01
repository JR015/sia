<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente extends CI_Controller
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
    public $peridoActual;

    function __construct()
    {
        parent::__construct();

        $this->login = $this->session->userdata('documento');
        $this->peridoActual = $this->session->userdata('periodo');

        $this->load->model("Docentes_model", "docente");



        if ($this->session->userdata('tipo') != DOCENTES) {

            redirect(base_url());

        }
    }


    public function vistaProgramasOrientados()
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js');

        $datos['titulo'] = "Gestionar docente";
        $datos['programas'] = $this->docente->consultarProgramasOrientados($this->login);
        $datos['contenido'] = '../docente/notas/selecionar_programa';
        $this->load->view("docente/plantilla", $datos);


    }

    public function vistaVerAsignaturasOrientadas($programa)
    {



        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js');
        $datos['carga_academica'] = $this->docente->consultarGruposPorPrograma($this->login, $programa);
        $datos['titulo'] = "Gestionar docente";
        $datos['contenido'] = '../docente/notas/selecionar_asignatura';
        $this->load->view("docente/plantilla", $datos);

    }


    public function vistaVerLitadoDeEstudiantesMatriculadosPorAsignatura($asinatura)
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js', 'jquery.numeric.js');
        $datos['estudiantes'] = $this->docente->consultarListadoDeEstudiantesMatriculadosPorAsignatura($this->login, $asinatura);
        $datos['titulo'] = "Gestionar docente";
        $datos['contenido'] = '../docente/notas/listado_estudiantes_matriculados';
        $this->load->view("docente/plantilla", $datos);

    }


    public function vistaPlataformaCerrada()
    {



        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js', 'jquery.numeric.js');
        $datos['titulo'] = "Gestionar docente";
        $datos['contenido'] = '../docente/notas/plataforma_cerrada';
        $this->load->view("docente/plantilla", $datos);

    }

    function index()
    {



        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js');

        $datos['titulo'] = "Gestionar docente";
        $datos['contenido'] = '../docente/inicio/contenido';
        $this->load->view("docente/plantilla", $datos);

    }


    function registrarNota()
    {


        $notas = $this->input->post("notas");




        foreach ($notas as &$nota) {


            $valores = explode("-", $nota);


            $datos = [


                "asignatura_matriculada" => $valores[0],
                "nota1" => $valores[1]

            ];


            $this->docente->registrarNota($datos);

        }


        echo ":)";


    }


    public function notas($accion = 1, $parametro = null)
    {


        if ($this->consultarFechasDigitacionNotas() > 0) {


            if ($accion == 1 || $accion == "por-programa") {

                $this->vistaProgramasOrientados();

            } else if ($accion == "por-asignatura") {

                $this->vistaVerAsignaturasOrientadas($parametro);


            } else if ($accion == "digitar") {


                $this->vistaVerLitadoDeEstudiantesMatriculadosPorAsignatura($parametro);


            }

        }else {


            $this->vistaPlataformaCerrada();
        }

    }


    function consultarFechasDigitacionNotas()
    {


        $result = $this->docente->consultarFechasDigitacionNotas($this->peridoActual);


        return count($result);

    }


    function p($parametro)
    {

        echo var_dump($this->vistaVerLitadoDeEstudiantesMatriculadosPorAsignatura($parametro));

    }
}
