<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordinador extends CI_Controller
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

        $this->load->model("Coordinador_model", "coordinador");


        if ($this->session->userdata('tipo') != COORDINADORES) {

            redirect(base_url());

        }
    }

    function index()
    {



        $this->vistaInscripciones();

    }

    function consultarMunicipios(){




            if (isset($_GET['term'])) {

                // $nombres = $_GET['term'];

                $nombre = strtolower($_GET['term']);
                $valores = $this->coordinador->consultarMunicipios($nombre);


                echo json_encode($valores);


            }



    }



    public function matriculaFinanciera()
    {

        $documento_estudiante = $this->input->post("documento");
        $codigo_grupo = $this->input->post("grupo");




        $datos = array(

            "estudiante" => $documento_estudiante,
            "grupo" => $codigo_grupo,


        );

        $existe = $this->coordinador->consultarMatriculaFinanciera($documento_estudiante, $codigo_grupo);




        if (count($existe) == 0) {

            $this->coordinador->matriculaFinanciera($datos);

        } else {

            echo -1;

        }
    }

    function vistaGestionarDocente()
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'docente.js');
        $datos['periodo']= $this->coordinador->consultarPeriodoAcademicoActual();
        $datos['titulo'] = "Gestionar docentes";

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();


        $datos['contenido'] = '../coordinador/docentes/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }

    public function filtrarAsignatura(){



        $nombre = $this->input->post("nombre");

        if (!empty($nombre)) {

            $asiganturas = $this->coordinador->filtrarAsignatura(mb_strtoupper($nombre));

            foreach ($asiganturas as $asignatura) {

                echo '<tr>

                    <td>' . $asignatura['codigo'] . '</td>
                    <td>' . $asignatura['nombre'] . '</td>
                    <td>' . $asignatura['programa'] . '</td>
                     <td>' . $asignatura['horas_semanales'] . '</td>
                       
                 

                    <td class="text-center"><a href="javascript:abrirModalEditarAsignatura('.$asignatura['codigo'].')" class="fa fa-edit"></a></td>
                </tr>';

            }
        }else {


            echo '<tr>

                            <td colspan="5">No existen coinicidencias </td>
                      </tr>';
        }

    }

    function vistaGestionarAsignatura(){




        $datos['css'] = array('');
        $datos['js'] = array('modalBootstrap.js','asignatura.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['titulo'] = "Gestonar asignaturas";
        $datos['contenido'] = '../coordinador/asignaturas/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }


    public function registrarAsignatura()
    {


        $operacion = $this->input->post('operacion');
        $codigo = $this->input->post('codigo');
        $nombre = mb_strtoupper($this->input->post('nombre'));
        $horas_semanales = $this->input->post('horas-semanales');
        $programa = $this->input->post('programa');
        $abreviatura = $this->input->post('abreviatura');


        $datos = array(


            "nombre" => $nombre,
            "horas_semanales" => $horas_semanales,
            "programa" => $programa,
            "abreviatura" => $abreviatura,


        );

        if (strcmp($operacion, 'registrar') == 0) {


            $existe = $this->coordinador->consultarAsignaturaPorNombre($nombre);

            if (count($existe) == 0) {

                $this->coordinador->registrarAsignatura($datos);

            } else {

                echo -1;

            }


        } else {


            $editado = $this->coordinador->editarAsignatura($codigo, $datos);

            if ($editado > 0) {

                echo 2;

            } else {

                echo -2;
            }


        }

    }

    function vistaGestionarEstudiante()
    {
        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'estudiante.js');

        $datos['titulo'] = "Gestionar estudiantes";
        $datos['contenido'] = '../coordinador/estudiantes/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }


    public function vistaListadodeInscripciones(){


        $datos['css'] = array('dataTables.bootstrap.css');
        $datos['js'] = array('jquery-ui.js','modalBootstrap.js','estudiante.js','datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['periodos'] = $this->coordinador->consultarPeriodosAcademicos();

        $datos['titulo'] = "Listado de inscripciones";
        $datos['contenido'] = '../coordinador/inscripciones/listado';
        $this->load->view("coordinador/plantilla", $datos);


    }

    function crearPeriodo()
    {


        $anio = $this->input->post('anio');
        $semestre = $this->input->post('mes');

        $fecha_incio = $this->input->post('fecha-incio');
        $fecha_fin = $this->input->post('fecha-fin');

        $fr = new DateTime($fecha_incio);
        $fs = new DateTime($fecha_fin);

        if ($fr > $fs) {

            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error ! </strong> Las fecha incio no puede ser mayor a la fecha de finalización del período académico, verifíque las fechas ingresadas!</strong></div>';


        } elseif ($fr < $fs) {

            $this->coordinador->crearPeriodo($anio, $semestre, $fecha_incio, $fecha_fin);
            echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Registro completado con exito!</strong></div>';

        } else {

            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Fechas Iguales! </strong> La fecha de incio no puede ser igual a la fecha de finalización del período académico, verifíque las fechas ingresadas!</div>';


        }


    }

    public function vistaCrearPeriodos(){

        $datos['css'] = array('');
        $datos['js'] = array('modalBootstrap.js','periodo.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

        $datos['titulo'] = "Definir periodos académicos";
        $datos['contenido'] = '../coordinador/periodos/crear_periodos';
        $this->load->view("coordinador/plantilla", $datos);


    }


    public function crearGrupo(){

        $codigo = $this->input->post('codigo');
        $programa = $this->input->post('programa');
        $semestre = $this->input->post('numero-semestre');
        $jornada = $this->input->post('jornada');
        $periodo = $this->coordinador->consultarPeriodoAcademicoActual();
        $descripcion = $this->input->post('descripcion');



        $datos=array(

            "codigo"=>$codigo,
            "programa"=>$programa,
            "numero_semestre"=>$semestre,
            "jornada"=>$jornada,
            "periodo"=>$periodo,
            "descripcion"=>$descripcion


        );


        $existe = $this->coordinador->consultarGrupo($codigo);

         $registro =-1;

        if(count($existe)==0){


            $registro = $this->coordinador->crearGrupo($datos);
        }





        echo $registro;

    }

    public function vistaGestionarGrupos(){


        $datos['periodo']= $this->coordinador->consultarPeriodoAcademicoActual();
        $datos['css'] = array('dataTables.bootstrap.css');
        $datos['js'] = array('jquery-ui.js','modalBootstrap.js','grupo.js','datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['grupos']= $this->coordinador->consultarTodosLosGruposDelPeriodoActual();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

        $datos['titulo'] = "Gestonar grupos";
        $datos['contenido'] = '../coordinador/grupos/gestionar';
        $this->load->view("coordinador/plantilla", $datos);
    }



    function vistaNuevaMatricula()
    {


        $datos['css'] = array('dataTables.bootstrap.css');
        $datos['js'] = array('modalBootstrap.js', 'matricula.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

        $datos['estudiantes'] = $this->coordinador->consultarTodosLosEstudiantes();
        $datos['grupos']= $this->coordinador->consultarTodosLosGruposDelPeriodoActual();

        $datos['titulo'] = "Matrículas";
        $datos['contenido'] = '../coordinador/matriculas/matricula_financiera';
        $this->load->view("coordinador/plantilla", $datos);

    }




    public function actualizarEstudiante()
    {


        $documento = $this->input->post("documento");
        $nombres = mb_strtoupper($this->input->post("nombres"));
        $apellidos = mb_strtoupper($this->input->post("apellidos"));
        $fecha_nacimiento = $this->input->post("fecha-nacimiento");
        $correo = mb_strtoupper($this->input->post("correo"));
        $tipo_documento = mb_strtoupper($this->input->post("tipo-documento"));
        $telefono = mb_strtoupper($this->input->post("telefono-fijo"));
        $celular = mb_strtoupper($this->input->post("telefono-celular"));

        $sexo = mb_strtoupper($this->input->post("sexo"));

        $direccion = mb_strtoupper($this->input->post("direccion"));
        $lugar_de_residencia= $this->input->post("municipio");



        $datosRegistro = array(

            "documento" => $documento,
            "clave" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "fecha_nacimiento" => $fecha_nacimiento,
            "tipo_documento" => $tipo_documento,
            "correo" => $correo,
            "sexo" => $sexo,
            "direccion" => $direccion,
            "telefono_fijo" => $telefono,
            "telefono_celular" => $celular,
            "municipio" => $lugar_de_residencia,

        );





            $editado = $this->coordinador->editarEstudiante($documento,$datosRegistro);

            if($editado>0){

                echo 2;

            }else{

                echo -2;
            }





    }

    public function inscribirEstudiante()
    {


        $documento = $this->input->post("documento");
        $programa = $this->input->post("programa");
        $nombres = mb_strtoupper($this->input->post("nombres"));
        $apellidos = mb_strtoupper($this->input->post("apellidos"));
        $fecha_nacimiento = $this->input->post("fecha-nacimiento");
        $correo = mb_strtoupper($this->input->post("correo"));
        $tipo_documento = mb_strtoupper($this->input->post("tipo-documento"));
        $telefono = mb_strtoupper($this->input->post("telefono-fijo"));
        $celular = mb_strtoupper($this->input->post("telefono-celular"));

        $sexo = mb_strtoupper($this->input->post("sexo"));

        $direccion = mb_strtoupper($this->input->post("direccion"));
        $lugar_de_residencia = $this->input->post("municipio");


        $datosRegistro = array(

            "documento" => $documento,
            "clave" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "fecha_nacimiento" => $fecha_nacimiento,
            "tipo_documento" => $tipo_documento,
            "correo" => $correo,
            "sexo" => $sexo,
            "direccion" => $direccion,
            "telefono_fijo" => $telefono,
            "telefono_celular" => $celular,
            "municipio" => $lugar_de_residencia,

        );

        $datosInscripcion = array(

            "estudiante" => $documento,
            "programa" => $programa,
            "periodo" => $this->coordinador->consultarPeriodoAcademicoActual()


        );


        $existe = $this->coordinador->consultarEstudiante($documento);

        if (count($existe)  == 0) {

            $registro = $this->coordinador->registrarEstudiante($datosRegistro);
            $inscripcion = $this->coordinador->inscribirEstudiante($datosInscripcion);


            if ($registro > 0 && $inscripcion > 0) {

                redirect(base_url('coordinador/inscripciones'));
            }

        }else{
            $inscripcion = $this->coordinador->inscribirEstudiante($datosInscripcion);

            if ($inscripcion > 0) {

                redirect(base_url('coordinacion-academica/inscripciones'));
            }


        }

    }


    public function registrarDocente()
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


            $existe = $this->coordinador->consultarDocente($documento);

            if (count($existe)  == 0) {

                $this->coordinador->registrarDocente($datos);

            } else {

                echo -1;

            }


        }else{



            $editado = $this->coordinador->editarDocente($documento,$datos);

            if($editado>0){

                echo 2;

            }else{

                echo -2;
            }


        }



    }


    function filtrarEstudiante(){



        $nombres = $this->input->post("nombres");





        if (!empty($nombres)) {

            $estudiantes = $this->coordinador->filtrarEstudiante(mb_strtoupper($nombres));

            foreach ($estudiantes as $estudiante) {

                echo '<tr>

                    <td>' . $estudiante['documento'] . '</td>
                    <td>' . $estudiante['nombres'] .' '.$estudiante['apellidos']. '</td>
                    <td>' . $estudiante['apellidos'] . '</td>
                    <td class="text-center"><a href="javascript:abrirModalEditarEstudiante('.$estudiante['documento'].')" class="fa fa-edit"></a></td>
                </tr>';

            }
        }else {


            echo '<tr>

                            <td colspan="5">No existen coinicidencias </td>
                      </tr>';
        }


    }

    function filtrarDocente(){



            $nombres = $this->input->post("nombres");





            if (!empty($nombres)) {

                $docentes = $this->coordinador->filtrarDocente(mb_strtoupper($nombres));

                foreach ($docentes as $docente) {

                    echo '<tr>

                    <td>' . $docente['documento'] . '</td>
                    <td>' . $docente['nombres'] .' '. $docente['apellidos'] . '</td>
                    <td>' . $docente['correo'] . '</td>
                    <td class="text-center"><a href="javascript:abrirModalEditarDocente('.$docente['documento'].')" class="fa fa-edit"></a></td>
                </tr>';

                }
            }else {


               echo '<tr>

                            <td colspan="5">No existen coinicidencias </td>
                      </tr>';
            }


    }


    public function consultarInscripciones(){


        $programa = $this->input->post('programa');
        $periodo = $this->input->post('periodo');

        $inscripcionees = $this->coordinador->consultarInscripciones($periodo, $programa);

        echo '<table id="datatable-tipos-propuesta" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%"  >
                                <thead>
                                <tr>

                                    <th width="20">Período</th>
                                    <th width="250">Programa</th>
                                     <th >Estudiante</th>
                                 



                                </tr>
                                </thead>


                             <tbody>




';

        foreach ($inscripcionees as $inscripcion) {

            echo '  <tr>
                                    
                                                     
                                                <td class="mayus" > ' . $inscripcion['periodo'] . '</td >
                                                <td class="mayus" > ' . $inscripcion['programa'] . '</td >
                                                <td class="mayus" > ' . $inscripcion['estudiante'] . '</td >
                                                
                                       


                </tr >';


        }


        echo '

                                </tbody>

                            </table>


        ';


    }

function vistaInscripciones(){


    $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css','select2/select2.min.css');
    $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js','filtrarMunicipios.js','select2/select2.min.js','select2/es.js', 'estudiante.js');

    $datos['titulo'] = "Inscripciones";

    $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

    $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
    $datos['dg'] = $this->coordinador->consultarEstudiantesInscritos("DG");
    $datos['ap'] = $this->coordinador->consultarEstudiantesInscritos("AP");
    $datos['cd'] = $this->coordinador->consultarEstudiantesInscritos("CD");
    $datos['ti'] = $this->coordinador->consultarEstudiantesInscritos("TI");
    $datos['mi'] = $this->coordinador->consultarEstudiantesInscritos("MI");

    $datos['total'] = $this->coordinador->consultarEstudiantesInscritos("");


    $datos['contenido'] = '../coordinador/inscripciones/inscripcion';
    $this->load->view("coordinador/plantilla", $datos);

}



    function vistaCargasAcademicas()
    {

        $datos['css'] = array('jquery-ui.css');
        $datos['js'] = array('jquery-ui.js', 'cargaAcademica.js', 'modalBootstrap.js');
        $datos['grupos'] = $this->consultarGrupos();

        $datos['titulo'] = "Cargas académicas";
        $datos['contenido'] = '../admistrador/docentes/carga_academica';
        $this->load->view("admistrador/plantilla", $datos);


    }

    public function consultarPeriodoAcademicoActual(){

        return $this->coordinador->consultarPeriodoAcademicoActual();
    }


    function consultarDetallesDeGrupo(){

       $grupo =  $this->input->post('grupo');

      $result=  $this->coordinador->consultarDetallesDeGrupo($grupo);

        echo json_encode($result);
    }


    function vistaPlanesDeEstudio()
    {

        $datos['css'] = array('jquery-ui.css');
        $datos['js'] = array('jquery-ui.js', 'cargaAcademica.js');

        $datos['titulo'] = "Cargas académicas";
        $datos['contenido'] = '../admistrador/asignaturas/plan_de_estudio';
        $this->load->view("admistrador/plantilla", $datos);


    }

    function autoCompletar()
    {


        if (isset($_GET['term'])) {


            $nombres = strtolower($_GET['term']);
            $valores = $this->docente->autoCompletar($nombres);


            echo json_encode($valores);
        }
    }






    function consultarAsignatura(){

        $codigo = $this->input->post("codigo");

        if (isset($codigo)) {


            $docente = $this->coordinador->consultarAsignatura($codigo);


            echo json_encode($docente);
        }

    }



    function consultarDocente(){

        $documento = $this->input->post("documento");

        if (isset($documento)) {


            $docente = $this->coordinador->consultarDocente($documento);


            echo json_encode($docente);
        }

    }

    function consultarEstudiante()
    {


        $documento = $this->input->post("documento");

        if (isset($documento)) {


            $estudiante = $this->coordinador->consultarEstudiante($documento);


            echo json_encode($estudiante);
        }
    }


    function consultarCargaAcademica()
    {

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




}
