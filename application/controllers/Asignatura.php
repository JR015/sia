<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignatura extends CI_Controller {

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
        $this->load->model("Programa_model","programa");

        if(!isset($this->login)) {


            redirect(base_url());
        }
    }

    function index(){




        $datos['css'] = array('');
        $datos['js'] = array('modalBootstrap.js','asignatura.js');


        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['titulo'] = "Gestonar asignaturas";
        $datos['contenido'] = '../coordinador/asignaturas/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }




    function vista_asignar(){

        $datos['css'] = array('');
        $datos['js'] = array('modalBootstrap.js','asignatura.js');

        $datos['titulo'] = "Gestonar asignaturas";
        $datos['contenido'] = '../coordinador/asignaturas/asignar';
        $this->load->view("coordinador/plantilla", $datos);

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
                    <td>' . $asignatura['abreviatura'] . '</td>
                     <td class="text-center">' .$asignatura['horas_semanales'] . '</td>
                    <td class="text-center"><a href="javascript:abrirModalEditarAsignatura('.$asignatura['codigo'].')" class="fa fa-edit"></a></td>
                </tr>';

            }
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



    function listarGrados(){

        return $this->programa->consultarTodo();


    }



}
