<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once APPPATH.'controllers/Usuario.php';

class Estudiante extends Usuario
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

        $this->load->model("Estudiante_model", "estudiante");


       $this->peridoActual= $this->session->userdata('periodo');

        if ($this->session->userdata('tipo') != ESTUDIANTES) {

            redirect(base_url());

        }
    }

    function index(){




        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'estudiante2.js');

        $datos['titulo'] = "SIA - Estudiantes";

        $datos['contenido'] = '../estudiante/inicio/contenido';

         $this->load->view("estudiante/plantilla", $datos);


    }


    function notas($opcion=1,$programa=1, $periodo=1){





        if ($programa==1){


            $this->vistaNotasSemestreActual();

        }else if ($opcion=="de"){


          $this->vistaNotasPorSemestre($programa,$periodo);



        }





    }


    function HistorialNotas(){






        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js', 'estudiante2.js');

        $datos['titulo'] = "SIA - Historial de Notas";

        $datos['contenido'] = '../estudiante/notas/hostorial';

        $this->load->view("estudiante/plantilla", $datos);



    }




    function vistaNotasSemestreActual($programa=1, $periodo=1){


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'estudiante.js');

        $datos['titulo'] = "SIA - Notas";




        $datos['programas'] = $this->estudiante->consultarProgramasMatriculados($this->login);


        $datos['contenido'] = '../estudiante/notas/semestre_actual';
        $this->load->view("estudiante/plantilla", $datos);


    }

    function vistaNotasPorSemestre($programa=1, $periodo=1){


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'estudiante.js');

        $datos['titulo'] = "SIA - Estudiantes";




        $datos['asignaturas'] = $this->estudiante->consultarMateriasMatriculadas($this->login,$programa,$periodo);


        $datos['contenido'] = '../estudiante/notas/por_programa_y_periodo';
        $this->load->view("estudiante/plantilla", $datos);


    }




}
