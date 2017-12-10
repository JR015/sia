<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

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


    function __construct()
    {
        parent::__construct();

        $this->load->model('Sesion_model','sesion');

    }


    public function vista_inicio(){

        redirect(base_url('docentes'));

    }

    public function index()
	{

        $login = $this->session->userdata('documento');



        if(isset($login)){

            $tipo_usuario = $this->session->userdata('tipo');

            if(strcmp($tipo_usuario,"coordinadores")==0){

                redirect(base_url('coordinacion-academica'));

            }else if (strcmp($tipo_usuario,"docentes")==0){

                redirect(base_url('docentes'));


            }else{


                redirect(base_url('docentes'));
            }

        }else{



            $datos['titulo'] = "Inicio";
            $datos['contenido'] = "index";

            $this->load->view('inicio/plantilla', $datos);

//            $this->load->view('sesion');
        }


	}


	public function vistaInicioCordinacion(){


        $this->load->view('inicio/sesion/coordinacion');
    }



    function iniciar(){


        $documento = $this->input->post("documento");
        $clave = $this->input->post("clave");
        $tipo_usuario= $this->input->post("tipo-usuario");


        $result= $this->sesion->iniciar($documento,$clave,$tipo_usuario);

        if(count($result)>0){

            $datos = array(
                "documento"=>$result[0]['documento'],
                "nombres"=>$result[0]['nombres'],
                "tipo"=>$tipo_usuario,


                               );

            $this->session->set_userdata($datos);


            if(strcmp($tipo_usuario,"coordinadores")==0){

                redirect(base_url('coordinacion-academica'));

            }else if (strcmp($tipo_usuario,"docentes")==0){

                redirect(base_url('docentes'));


            }else{


                redirect(base_url('docentes'));
            }






        }else{

           redirect(base_url('incio/coordinacion-academica')."?error=1");

        }


    }
    function iniciarCoordinador(){


        $documento = $this->input->post("documento");
        $clave = $this->input->post("clave");
        $tipo_usuario= "coordinadores";


        $result= $this->sesion->iniciar($documento,$clave,$tipo_usuario);

        if(count($result)>0){

            $datos = array(
                "documento"=>$result[0]['documento'],
                "nombres"=>$result[0]['nombres'],
                "tipo"=>$tipo_usuario,


                               );

            $this->session->set_userdata($datos);


                redirect(base_url('coordinacion-academica'));


        }else{

            redirect(base_url('incio/coordinacion-academica')."?error=1");

        }


    }




    function cerrar(){

        $this->session->sess_destroy();
        redirect(base_url());

    }
}
