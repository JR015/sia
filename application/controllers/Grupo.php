<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo extends CI_Controller {

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
        $this->load->model("Grupo_model","grupo");
        $this->load->model("Programa_model","programa");

        if(!isset($this->login)) {


            redirect(base_url());
        }
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



            $grupos = $this->grupo->filtrar($nombre);

            foreach ($grupos as $grupo) {

                echo '<tr>

                    <td>' . $grupo['codigo'] . '</td>
                    <td>' . $grupo['programa'] . '</td>
                     <td class="text-center">' . $grupo['semestre'] . '</td>
                     <td class="text-center">' .$grupo['jornada'] . '</td>
                 
                </tr>';

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



    function listarProgramas(){

        return $this->programa->consultarTodo();


    }



    function consultarTodos(){

        return $this->grupo->consultarTodos();
    }



}
