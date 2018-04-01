<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Error extends CI_Controller{




    function error404(){



        $datos['titulo'] = "Página no encontrada!!!";






        $datos['contenido'] = "../errors/error_404";

        $this->load->view('inicio/plantilla', $datos);

    }

    function no_script(){


        $datos['titulo'] = "No puede desactivar JavaScript";

        $this->load->view('inicio/inc/header', $datos);
        $this->load->view('errors/error_no_script');
        $this->load->view('inicio/inc/footer');


    }






}