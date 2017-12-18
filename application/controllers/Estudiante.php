<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller
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

        $this->load->model("Estudiante_model", "estudiante");


        if ($this->session->userdata('tipo') != ESTUDIANTES) {

            redirect(base_url());

        }
    }

    function index(){


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'estudiante.js');

        $datos['titulo'] = "SIA - Estudiantes";

        //  $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

         $datos['periodo'] = "2018A";

        /*
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['dg'] = $this->coordinador->consultarEstudiantesInscritos("DG");
        $datos['ap'] = $this->coordinador->consultarEstudiantesInscritos("AP");
        $datos['cd'] = $this->coordinador->consultarEstudiantesInscritos("CD");
        $datos['ti'] = $this->coordinador->consultarEstudiantesInscritos("TI");
        $datos['mi'] = $this->coordinador->consultarEstudiantesInscritos("MI");

        $datos['total'] = $this->coordinador->consultarEstudiantesInscritos("");

*/
        $datos['contenido'] = '../estudiante/inicio/contenido';
        $this->load->view("estudiante/plantilla", $datos);


    }













}
