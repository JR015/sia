<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public  $login;

    function __construct()
    {
        parent::__construct();

        $this->login = $this->session->userdata('documento');

        $this->load->model("Docentes_model","docente");

        if(!isset($this->login)) {


            redirect(base_url());
        }
    }

    function index(){



        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','docente.js');

        $datos['titulo'] = "Gestionar docentes";
        $datos['contenido'] = '../coordinador/docentes/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }


    function vista_selecionar_grupo(){


       // $cargaAcademica = $this->docente->colsultarCargaAcademica($this->login);


        $datos['titulo'] = "Portal docentes";

        $datos['contenido'] = 'notas/selecionar_grupo';
        $this->load->view("docentes/plantilla", $datos);

    }


    function vistaCargasAcademicas(){

        $datos['css'] = array('jquery-ui.css');
        $datos['js'] = array('jquery-ui.js','cargaAcademica.js', 'modalBootstrap.js');
        $datos['grupos'] =$this->consultarGrupos();

        $datos['titulo'] = "Cargas académicas";
        $datos['contenido'] = '../coordinador/docentes/carga_academica';
        $this->load->view("coordinador/plantilla", $datos);


    }


    function vistaPlanesDeEstudio(){

        $datos['css'] = array('jquery-ui.css');
        $datos['js'] = array('jquery-ui.js','cargaAcademica.js');

        $datos['titulo'] = "Cargas académicas";
        $datos['contenido'] = '../coordinador/asignaturas/plan_de_estudio';
        $this->load->view("coordinador/plantilla", $datos);


    }

    function autoCompletar()
    {



        if (isset($_GET['term'])) {


            $nombres = strtolower($_GET['term']);
            $valores = $this->docente->autoCompletar($nombres);


            echo json_encode($valores);
        }
    }




    public function crear()
    {

        $operacion = $this->input->post("operacion");


        $documento = $this->input->post("documento");
        $nombres = mb_strtoupper($this->input->post("nombres"));
        $apellidos = mb_strtoupper($this->input->post("apellidos"));
        $fecha_nacimiento = $this->input->post("fecha-nacimiento");
        $correo = mb_strtoupper($this->input->post("correo"));
        $profesiones = mb_strtoupper($this->input->post("profesiones"));
        $telefono = mb_strtoupper($this->input->post("telefono-fijo"));
        $celular = mb_strtoupper($this->input->post("telefono-celular"));

        $sexo = mb_strtoupper($this->input->post("sexo"));

        $direccion = mb_strtoupper($this->input->post("direccion"));
        $lugar_de_residencia= $this->input->post("municipio");



        $datos = array(

            "documento" => $documento,
            "clave" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "fecha_nacimiento" => $fecha_nacimiento,
            "profesiones" => $profesiones,
            "correo" => $correo,
            "sexo" => $sexo,
            "direccion" => $direccion,
            "telefono_fijo" => $telefono,
            "telefono_celular" => $celular,
            "municipio" => $lugar_de_residencia,

        );

        if (strcmp($operacion,'crear')==0){


            $existe = $this->docente->consultar($nombres);

            if (count($existe)  == 0) {

                $this->docente->crear($datos);

            } else {

                echo -1;

            }


        }else{



            $this->docente->editar($documento,$datos);



        }



    }

    function filtrar()
    {

        $nombres = $this->input->post("nombres");


        if (isset($nombres)) {

            $docentes = $this->docente->filtrar($nombres);

            foreach ($docentes as $docente) {

                echo '<tr>

                    <td>' . $docente['documento'] . '</td>
                    <td>' . $docente['nombres'] . '</td>
                    <td>' . $docente['apellidos'] . '</td>
                    <td>' . $docente['correo'] . '</td>
                    <td class="text-center"><a href="javascript:abrirModalEditarDocente('.$docente['documento'].')" class="fa fa-edit"></a></td>
                </tr>';

            }
        }


    }






    function consultarCargaAcademica(){

        $documento = $this->input->post("documento");


        $asignaturas = $this->docente->consultarCargaAcademica($documento);


        foreach ($asignaturas as $asignatura) {

            echo '<tr>

                   
                    <td>' . $asignatura['asignaturas'] . '</td>
                    <td>' . $asignatura['grado'] . '</td>
                     <td class="text-center">' . $asignatura['horas_semanales'] . '</td>
                
                
                </tr>';

        }

    }

    function consultarProgramas(){


        return  $this->programa->consultarProgramas();



    }

    function consultarGrupos(){

        return  $this->docente->consultarGrupos();

    }
}
