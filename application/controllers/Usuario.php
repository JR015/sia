<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Usuario extends CI_Controller {

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


        $this->load->model("Usuario_model","usuario");



    }

    function index(){



        $datos['titulo'] = "SIA - Cambiar clave de acceso";
        $datos['contenido'] = '../cambiar_clave/cambiar_clave_de_acceso';
        $datos['js'] = array("sia/cambiarClave.js");


        $tipo = $this->session->userdata('tipo');


        $ruta = "";

        if ($tipo==ESTUDIANTES){



            $ruta="estudiante";
        }else if ($tipo==COORDINADORES){


            $ruta="coordinador";
        }


        $this->load->view($ruta."/plantilla", $datos);


    }


    function cambiarClaveDeAcceso()
    {

        $clave_antigua = $this->input->post('clave-actual');
        $clave_nueva = $this->input->post('clave-nueva');
        $clave_nueva_confirmada = $this->input->post('clave-nueva-confirmada');


        if (strcmp($clave_nueva, $clave_nueva_confirmada) == 0) {


            $datos = array(

                "clave" => $clave_nueva_confirmada

            );

            $result = $this->usuario->cambiarClaveDeAcceso($clave_antigua, $datos);

            echo $result;

        }


    }






}
