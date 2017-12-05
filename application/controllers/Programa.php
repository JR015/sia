<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programa extends CI_Controller {

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

        $this->load->model("Asignatura_model","asginatura");

        if(!isset($this->login)) {


            redirect(base_url());
        }
    }

    function index(){



        $datos['css'] = array('');
        $datos['js'] = array('modalBootstrap.js','asignatura.js');

        $datos['titulo'] = "Gestonar asignaturas";
        $datos['contenido'] = '../coordinador/asignaturas/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

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



        $datos = array(

            "documento" => $documento,
            "clave" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "fecha_nacimiento" => $fecha_nacimiento,
            "profesiones" => $profesiones,
            "correo" => $correo


        );

        if (strcmp($operacion,'crear')==0){


            $existe = $this->asginatura->consultar($nombres);

            if (count($existe)  == 0) {

                $this->asginatura->crear($datos);

            } else {

                echo -1;

            }


        }else{



            $this->asginatura->editar($documento,$datos);



        }



    }

    function filtrar()
    {

        $nombres = $this->input->post("nombre");


        if (isset($nombres)) {

            $asignaturas = $this->asginatura->filtrar($nombres);

            foreach ($asignaturas as $asignatura) {

                echo '<tr>

                    <td>' . $asignatura['codigo'] . '</td>
                    <td>' . $asignatura['nombre'] . '</td>

                    <td class="text-center"><a href="javascript:abrirModalEditarAsignatura('.$asignatura['codigo'].')" class="fa fa-edit"></a></td>
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


}
