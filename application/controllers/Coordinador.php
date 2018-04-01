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
    public $peridoActual;

    function __construct()
    {
        parent::__construct();

        $this->login = $this->session->userdata('documento');
        $this->peridoActual = $this->session->userdata('periodo');

        $this->load->model("Coordinador_model", "coordinador");


        if ($this->session->userdata('tipo') != COORDINADORES) {

            redirect(base_url());

        }
    }

    function index()
    {


        $datos['css'] = array('');
        $datos['js'] = array('');

        $datos['titulo'] = "SIA - Inicio";


        $datos['contenido'] = 'inicio/inicio';
        $this->load->view("coordinador/plantilla", $datos);

    }

    function filtrarMunicipios()
    {


        if (isset($_GET['nombre'])) {

            // $nombres = $_GET['term'];

            $nombre = strtolower($_GET['nombre']);
            $valores = $this->coordinador->filtrarMunicipios($nombre);


            echo json_encode($valores);


        }


    }
    public function matriculaAsignaturas()
    {

        $documento_estudiante = $this->input->post("documento");
        $codigo_grupo = $this->input->post("grupo");
        $semestre = $this->input->post("semestre");


        $codigoPrograma = $this->input->post("codigo-programa");

        $datos = array(

            "estudiante" => $documento_estudiante,
            "grupo" => $codigo_grupo,


        );

        $existe = $this->coordinador->consultarMatriculaFinanciera($documento_estudiante, $codigo_grupo);


        if (count($existe) == 0) {

            $codigoMatricula = $this->coordinador->registrarOptenerUltimoID("matriculas", $datos);


            $asignaturasPorMatricular = $this->coordinador->consultarAsignaturasPorProgramaSemestre($codigoPrograma, $semestre);


            $s = 0;

            foreach ($asignaturasPorMatricular as $asignatura) {


                $datosMatriculaAsignatura = [

                    "matricula" => $codigoMatricula,
                    "asignatura_semestral" => $asignatura['codigo']


                ];


                $s += $this->coordinador->registrar("asignaturas_matriculadas", $datosMatriculaAsignatura);


            }


            echo $s;


        } else {

            echo -1;

        }
    }

    public function matriculaFinanciera()
    {

        $documento_estudiante = $this->input->post("documento");
        $codigo_grupo = $this->input->post("grupo");
        $semestre = $this->input->post("semestre");


        $codigoPrograma = $this->input->post("codigo-programa");

        $datos = array(

            "estudiante" => $documento_estudiante,
            "grupo" => $codigo_grupo,


        );

        $existe = $this->coordinador->consultarMatriculaFinanciera($documento_estudiante, $codigo_grupo);


        if (count($existe) == 0) {

            $codigoMatricula = $this->coordinador->registrarOptenerUltimoID("matriculas", $datos);


            $asignaturasPorMatricular = $this->coordinador->consultarAsignaturasPorProgramaSemestre($codigoPrograma, $semestre);


            $s = 0;

            foreach ($asignaturasPorMatricular as $asignatura) {


                $datosMatriculaAsignatura = [

                    "matricula" => $codigoMatricula,
                    "asignatura_semestral" => $asignatura['codigo']


                ];


                $s += $this->coordinador->registrar("asignaturas_matriculadas", $datosMatriculaAsignatura);


            }


            echo $s;


        } else {

            echo -1;

        }
    }

    function vistaGestionarDocente()
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css', 'select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'select2/select2.min.js', 'select2/es.js', 'docente.js');
        $datos['periodo'] = $this->coordinador->consultarPeriodoAcademicoActual();
        $datos['titulo'] = "SIA - Docentes";

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();


        $datos['contenido'] = '../coordinador/docentes/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }

    public function filtrarAsignatura()
    {


        $nombre = $this->input->post("nombre");

        if (!empty($nombre)) {

            $asiganturas = $this->coordinador->filtrarAsignatura(mb_strtoupper($nombre));

            foreach ($asiganturas as $asignatura) {

                echo '<tr>

                    <td>' . $asignatura['codigo'] . '</td>
                    <td>' . $asignatura['nombre'] . '</td>
                    <td>' . $asignatura['creditos'] . '</td>
                       
                 

                    <td class="text-center"><a href="javascript:abrirModalEditarAsignatura(' . $asignatura['codigo'] . ')" class="fa fa-edit"></a></td>
                </tr>';

            }
        } else {


            echo '<tr>

                            <td colspan="5">No existen coinicidencias </td>
                      </tr>';
        }

    }

    function vistaGestionarAsignatura()
    {


        $datos['css'] = array('');
        $datos['js'] = array('modalBootstrap.js', 'asignatura.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['titulo'] = "SIA - Asignaturas";
        $datos['contenido'] = '../coordinador/asignaturas/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }


    public function registrarAsignatura()
    {


        $operacion = $this->input->post('operacion');
        $codigo = $this->input->post('codigo');
        $nombre = mb_strtoupper($this->input->post('nombre'));
        $horas_semanales = $this->input->post('creditos');
        $programa = $this->input->post('programa');
        $abreviatura = $this->input->post('abreviatura');


        $datos = array(


            "nombre" => $nombre,
            "creditos" => $horas_semanales,
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

        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css', 'select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js','mostrarDatosEstudiante.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'filtrarMunicipios.js', 'select2/select2.min.js', 'select2/es.js', 'estudiante.js');

        $datos['titulo'] = "SAI - Estudiantes";
        $datos['grados'] = $this->coordinador->consultarGrados();
        $datos['contenido'] = '../coordinador/estudiantes/gestionar';
        $this->load->view("coordinador/plantilla", $datos);

    }


    public function vistaListadoDeInscripciones()
    {


        $datos['css'] = array('dataTables.bootstrap.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'estudiante.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['periodos'] = $this->coordinador->consultarPeriodosAcademicos();

        $datos['titulo'] = "Listado de inscripciones";
        $datos['contenido'] = '../coordinador/inscripciones/listado';
        $this->load->view("coordinador/plantilla", $datos);


    }

    public function vistaListadoDeMatriculas()
    {


        $datos['css'] = array('dataTables.bootstrap.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'estudiante.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['periodos'] = $this->coordinador->consultarPeriodosAcademicos();
        $datos['jornadas'] = $this->coordinador->consultarJornadas();

        $datos['titulo'] = "Listado de matrículas";
        $datos['contenido'] = '../coordinador/matriculas/listado_matriculas';
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


            $periodo =  $this->consultarPeriodoAcademicoActual();

            $this->session->set_userdata("periodo",$periodo);


            echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Registro completado con exito!</strong></div>';

        } else {

            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Fechas Iguales! </strong> La fecha de incio no puede ser igual a la fecha de finalización del período académico, verifíque las fechas ingresadas!</div>';


        }


    }

    public function vistaCrearPeriodos()
    {

        $datos['css'] = array('');
        $datos['js'] = array('modalBootstrap.js', 'periodo.js');

        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

        $datos['titulo'] = "SIA - Períodos académicos";
        $datos['contenido'] = '../coordinador/periodos/crear_periodos';
        $this->load->view("coordinador/plantilla", $datos);


    }


    public function crearGrupo()
    {

        $codigo = $this->input->post('codigo');
        $programa = $this->input->post('programa');
        $semestre = $this->input->post('numero-semestre');
        $jornada = $this->input->post('jornada');
        $numero = $this->input->post('numero');

        $descripcion = $this->input->post('descripcion');


        $datosGrupos = [

            "codigo" => $codigo,
            "programa" => $programa,
            "semestre" => $semestre,
            "jornada" => $jornada,
            "periodo" => $this->peridoActual,
            "descripcion" => $descripcion,
            "numero" => $numero

        ];


        $existe = $this->coordinador->consultarGrupo($codigo);

        $registro = -1;

        if (count($existe) == 0) {


            $registro = $this->coordinador->crearGrupo($datosGrupos);
        }


        echo $registro;

    }


    function consultarProximoNumeroDeGrupo()
    {


        $programa = $this->input->post("programa");
        $semestre = $this->input->post("semestre");
        $jornada = $this->input->post("jornada");


        if (isset($periodo) || isset($programa) || isset($jornada) || isset($semestre)) {


            echo $this->coordinador->consultarProximoNumeroDeGrupo($this->peridoActual, $programa, $semestre, $jornada);

        } else {

            echo "-1";

        }


    }



    public function vistaGestionarGrupos()
    {


        $datos['css'] = array('dataTables.bootstrap.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'grupo.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['grupos'] = $this->coordinador->consultarTodosLosGruposDelPeriodoActual($this->peridoActual);
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['periodo'] = $this->consultarPeriodoAcademicoActual();

        $datos['titulo'] = "SAI - Grupos";
        $datos['contenido'] = '../coordinador/grupos/gestionar';
        $this->load->view("coordinador/plantilla", $datos);
    }



    public function editarEstudiante()
    {

        $this->load->helper("mi_helper");

        $tipoDocumento = $this->input->post("tipo-documento");
        $documento = $this->input->post("documento");
        $lugarExpedicionDocumento = $this->input->post("lugar-expedicion");

        $nombres = mb_strtoupper($this->input->post("nombres"));
        $apellidos = mb_strtoupper($this->input->post("apellidos"));

        $fechaNacimiento = $this->input->post("fecha-nacimiento");
        $lugarNacimiento = $this->input->post("lugar-nacimiento");

        $direccion = mb_strtoupper($this->input->post("direccion"));
        $barrio = mb_strtoupper($this->input->post("barrio"));
        $lugarDeResidencia = $this->input->post("lugar-residencia");
        $zona = $this->input->post("zona");
        $estrato = $this->input->post("estrato");
        $sisbem = $this->input->post("sisbem");

        $tipoSangre = mb_strtoupper($this->input->post("tipo-sangre"));
        $sexo = mb_strtoupper($this->input->post("sexo"));

        $eps = mb_strtoupper($this->input->post("eps"));
        $ips = mb_strtoupper($this->input->post("ips"));


        // $correo = mb_strtoupper($this->input->post("correo"));
        $telefono = mb_strtoupper($this->input->post("telefono-fijo"));
        $celular = mb_strtoupper($this->input->post("telefono-celular"));


        $nivelEducacion = $this->input->post("nivel-estudios");
        $ultimoGradoCursado = $this->input->post("ultimo-grado-cursado");
        $titulo=mb_strtoupper($this->input->post("titulo"));
        $unioTitulo=$this->input->post("anio-titulo");

        $institucion = $this->input->post("institucion");
        $unioUltimoGradoCursado = $this->input->post("anio-ultimo-grado-cursado");




        $nombresMadre = mb_strtoupper($this->input->post("nombres-madre"));
        $celularMadre = $this->input->post("telefono-celular-madre");
        $fijoMadre = $this->input->post("telefono-fijo-madre");

        $nombresPadre = mb_strtoupper($this->input->post("nombres-padre"));
        $celularPadre = $this->input->post("telefono-celular-padre");
        $fijoPadre = $this->input->post("telefono-fijo-padre");

        $nombresAcudiente = mb_strtoupper($this->input->post("nombres-acudiente"));
        $celularAcudiente = $this->input->post("telefono-celular-acudiente");

        /*
 * Discapacidades
 * */
        $discapacidadAuditiva = is_checked($this->input->post("discapacidad-auditiva"));
        $discapacidadCognitiva = is_checked($this->input->post("discapacidad-auditiva"));
        $discapacidadFisica = is_checked($this->input->post("discapacidad-fisica"));
        $otraDiscapacidad = is_checked($this->input->post("otra-discapacidad"));
        $nombreOtraDiscapacidad = is_checked($this->input->post("nombre-otra-discapacidad"));


        /*
         * Poblaciones especiales
         * */


        $desplazado = is_checked($this->input->post("desplazado"));
        $afro = is_checked($this->input->post("afro"));
        $indigena = is_checked($this->input->post("indigena"));
        $rom = is_checked($this->input->post("rom"));
        $cabezaFamilia = is_checked($this->input->post("cabeza-familia"));
        $lgbti = is_checked($this->input->post("lgbti"));
        $embarazada = is_checked($this->input->post("embarazada"));
        $adulto_mayor = is_checked($this->input->post("adulto-mayor"));
        $otraPoblacionEspecial = is_checked($this->input->post("otra-poblacion-especial"));

        $nombreOtraPoblacionEspecial = mb_strtoupper($this->input->post("nombre-otra-poblacion-especial"));


        $copiaDocumento = is_checked($this->input->post("copia-documento"));
        $copiaDiploma = is_checked($this->input->post("copia-diploma"));
        $certificadoEstudio = is_checked($this->input->post("certificado-estudio"));
        $reciboServicioPublico = is_checked($this->input->post("recibo-servicio-publico"));
        $foto = is_checked($this->input->post("foto"));
        $cartaEspecial = is_checked($this->input->post("carta-especial"));


        $solicitaAuxilio = is_checked($this->input->post("solicita-auxilio"));
        $vbDirreccion = is_checked($this->input->post("vb-direccion"));
        $porcentajeAuxilio = $this->input->post("porcentaje-auxilio");
        $observaciones = mb_strtoupper($this->input->post("observaciones"));


        $grupo = $this->input->post("grupo");




        $datosRegistro = array(


            "copia_documento" => $copiaDocumento,
            "certificado_estudio" => $certificadoEstudio,
            "copia_diploma" => $copiaDiploma,
            "recibo_servicio_publico" => $reciboServicioPublico,
            "foto" => $foto,
            "carta_especial" => $cartaEspecial,

            "documento" => $documento,
            "tipo_documento" => $tipoDocumento,
            "lugar_expedicion_documento" => $lugarExpedicionDocumento,

            "clave" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,

            "fecha_nacimiento" => $fechaNacimiento,
            "lugar_nacimiento" => $lugarNacimiento,


            "zona" => $zona,
            "direccion" => $direccion,
            "telefono_fijo" => $telefono,
            "telefono_celular" => $celular,
            "barrio" => $barrio,
            "lugar_residencia" => $lugarDeResidencia,

            "tipo_sangre" => $tipoSangre,
            "sexo" => $sexo,







        );




        $editado = $this->coordinador->editarPorDocumento("estudiantes", $documento, $datosRegistro);

        if ($editado > 0) {

            echo 2;

        } else {

            echo -2;
        }


    }


    public function matricular()
    {


        $this->load->helper("mi_helper");

        $tipoDocumento = $this->input->post("tipo-documento");
        $documento = $this->input->post("documento-estudiante");
        $lugarExpedicionDocumento = $this->input->post("lugar-expedicion");

        $nombres = mb_strtoupper($this->input->post("nombres"));
        $apellidos = mb_strtoupper($this->input->post("apellidos"));

        $fechaNacimiento = $this->input->post("fecha-nacimiento");
        $lugarNacimiento = $this->input->post("lugar-nacimiento");

        $direccion = mb_strtoupper($this->input->post("direccion"));
        $barrio = mb_strtoupper($this->input->post("barrio"));
        $lugarDeResidencia = $this->input->post("lugar-residencia");
        $zona = $this->input->post("zona");
        $estrato = $this->input->post("estrato");
        $sisbem = $this->input->post("sisbem");

        $tipoSangre = mb_strtoupper($this->input->post("tipo-sangre"));
        $sexo = mb_strtoupper($this->input->post("sexo"));

        $eps = mb_strtoupper($this->input->post("eps"));
        $ips = mb_strtoupper($this->input->post("ips"));


        // $correo = mb_strtoupper($this->input->post("correo"));
        $telefono = mb_strtoupper($this->input->post("telefono-fijo"));
        $celular = mb_strtoupper($this->input->post("telefono-celular"));


        $nivelEducacion = $this->input->post("nivel-estudios");
        $ultimoGradoCursado = $this->input->post("ultimo-grado-cursado");
        $titulo=mb_strtoupper($this->input->post("titulo"));
        $unioTitulo=$this->input->post("anio-titulo");

        $institucion = $this->input->post("institucion");
        $unioUltimoGradoCursado = $this->input->post("anio-ultimo-grado-cursado");




        $nombresMadre = mb_strtoupper($this->input->post("nombres-madre"));
        $celularMadre = $this->input->post("telefono-celular-madre");
        $fijoMadre = $this->input->post("telefono-fijo-madre");

        $nombresPadre = mb_strtoupper($this->input->post("nombres-padre"));
        $celularPadre = $this->input->post("telefono-celular-padre");
        $fijoPadre = $this->input->post("telefono-fijo-padre");

        $nombresAcudiente = mb_strtoupper($this->input->post("nombres-acudiente"));
        $celularAcudiente = $this->input->post("telefono-celular-acudiente");

        /*
 * Discapacidades
 * */
        $discapacidadAuditiva = is_checked($this->input->post("discapacidad-auditiva"));
        $discapacidadCognitiva = is_checked($this->input->post("discapacidad-auditiva"));
        $discapacidadFisica = is_checked($this->input->post("discapacidad-fisica"));
        $otraDiscapacidad = is_checked($this->input->post("otra-discapacidad"));
        $nombreOtraDiscapacidad = is_checked($this->input->post("nombre-otra-discapacidad"));


        /*
         * Poblaciones especiales
         * */


        $desplazado = is_checked($this->input->post("desplazado"));
        $afro = is_checked($this->input->post("afro"));
        $indigena = is_checked($this->input->post("indigena"));
        $rom = is_checked($this->input->post("rom"));
        $cabezaFamilia = is_checked($this->input->post("cabeza-familia"));
        $lgbti = is_checked($this->input->post("lgbti"));
        $embarazada = is_checked($this->input->post("embarazada"));
        $adulto_mayor = is_checked($this->input->post("adulto-mayor"));
        $otraPoblacionEspecial = is_checked($this->input->post("otra-poblacion-especial"));

        $nombreOtraPoblacionEspecial = mb_strtoupper($this->input->post("nombre-otra-poblacion-especial"));


        $copiaDocumento = is_checked($this->input->post("copia-documento"));
        $copiaDiploma = is_checked($this->input->post("copia-diploma"));
        $certificadoEstudio = is_checked($this->input->post("certificado-estudio"));
        $reciboServicioPublico = is_checked($this->input->post("recibo-servicio-publico"));
        $foto = is_checked($this->input->post("foto"));
        $cartaEspecial = is_checked($this->input->post("carta-especial"));


        $solicitaAuxilio = is_checked($this->input->post("solicita-auxilio"));
        $vbDirreccion = is_checked($this->input->post("vb-direccion"));
        $porcentajeAuxilio = $this->input->post("porcentaje-auxilio");
        $observaciones = mb_strtoupper($this->input->post("observaciones"));


        $grupo = $this->input->post("grupo");

        $semestre = $this->input->post("semestre");
        $programa = $this->input->post("programa");

        $datosMatricula = [


            "solicita_auxilio" => $solicitaAuxilio,
            "grupo" => $grupo,
            "porcentaje_auxilio" => $porcentajeAuxilio,
            "vb_direccion" => $vbDirreccion,
            "observaciones" => $observaciones,
            "estudiante"=>$documento

        ];


        $datosRegistro = array(


            "copia_documento" => $copiaDocumento,
            "certificado_estudio" => $certificadoEstudio,
            "copia_diploma" => $copiaDiploma,
            "recibo_servicio_publico" => $reciboServicioPublico,
            "foto" => $foto,
            "carta_especial" => $cartaEspecial,

            "documento" => $documento,
            "tipo_documento" => $tipoDocumento,
            "lugar_expedicion_documento" => $lugarExpedicionDocumento,

            "clave" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,

            "fecha_nacimiento" => $fechaNacimiento,
            "lugar_nacimiento" => $lugarNacimiento,


            "zona" => $zona,
            "direccion" => $direccion,
            "telefono_fijo" => $telefono,
            "telefono_celular" => $celular,
            "barrio" => $barrio,
            "lugar_residencia" => $lugarDeResidencia,

            "tipo_sangre" => $tipoSangre,
            "sexo" => $sexo,

            "estrato" => $estrato,
            "sisbem" => $sisbem,
            "ips" => $ips,
            "eps" => $eps,

            "institucion" => $institucion,
            "nivel_educacion" => $nivelEducacion,
            "ultimo_grado_cursado" => $ultimoGradoCursado,
            "anio_ultimo_grado_cursado" => $unioUltimoGradoCursado,
            "anio_titulo" => $unioTitulo,
            "titulo"=>$titulo,


            "indigena" => $indigena,
            "desplazado" => $desplazado,
            "afro" => $afro,
            "rom" => $rom,
            "cabeza_familia" => $cabezaFamilia,
            "embarazada" => $embarazada,
            "adulto_mayor" => $adulto_mayor,
            "lgbti" => $lgbti,
            "otra_poblacion_especial" => $otraPoblacionEspecial,
            "nombre_otra_poblacion_especial" => $nombreOtraPoblacionEspecial,


            "discapacidad_auditiva" => $discapacidadAuditiva,
            "discapacidad_cognitiva" => $discapacidadCognitiva,
            "discapacidad_fisica" => $discapacidadFisica,
            "otra_discapacidad" => $otraDiscapacidad,
            "nombre_otra_discapacidad" => $nombreOtraDiscapacidad,


            "nombres_madre" => $nombresMadre,
            "nombres_padre" => $nombresPadre,
            "telefono_fijo_madre" => $fijoMadre,
            "telefono_fijo_padre" => $fijoPadre,
            "telefono_celular_padre" => $celularPadre,
            "telefono_celular_madre" => $celularMadre,

            "nombres_acudiente" => $nombresAcudiente,
            "telefono_celular_acudiente" => $celularAcudiente


        );


        $existe = $this->coordinador->consultarEstudiante($documento);


        $this->db->trans_begin();

        if (count($existe) == 0) {

            $registro = $this->coordinador->registrar("estudiantes", $datosRegistro);




            if ($registro > 0) {

                echo "estudiante registado"."<br>";




                $codigoMatricula = $this->coordinador->registrarOptenerUltimoID("matriculas", $datosMatricula);


                $asignaturasPorMatricular = $this->coordinador->consultarAsignaturasPorProgramaSemestre($programa, $semestre);


                $s = 0;

                foreach ($asignaturasPorMatricular as $asignatura) {


                    $datosMatriculaAsignatura = [

                        "matricula" => $codigoMatricula,
                        "asignatura_semestral" => $asignatura['codigo']


                    ];


                    $s += $this->coordinador->registrar("asignaturas_matriculadas", $datosMatriculaAsignatura);


                }


                echo $s;





            }

        } else {



            $codigoMatricula = $this->coordinador->registrarOptenerUltimoID("matriculas", $datosMatricula);

            $asignaturasPorMatricular = $this->coordinador->consultarAsignaturasPorProgramaSemestre($programa, $semestre);


            $s = 0;

            foreach ($asignaturasPorMatricular as $asignatura) {


                $datosMatriculaAsignatura = [

                    "matricula" => $codigoMatricula,
                    "asignatura_semestral" => $asignatura['codigo']


                ];


                $s += $this->coordinador->registrar("asignaturas_matriculadas", $datosMatriculaAsignatura);


            }


            echo $s;


        }


        $this->db->trans_complete();

        redirect(base_url("registro-y-control/nueva-matricula"));

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

        if (count($existe) == 0) {

            $registro = $this->coordinador->registrarEstudiante($datosRegistro);
            $inscripcion = $this->coordinador->inscribirEstudiante($datosInscripcion);


            if ($registro > 0 && $inscripcion > 0) {

                redirect(base_url('registro-y-control/inscripciones'));
            }

        } else {
            $inscripcion = $this->coordinador->inscribirEstudiante($datosInscripcion);

            if ($inscripcion > 0) {

                redirect(base_url('registro-y-control/inscripciones'));
            }


        }

    }


    function matricula()
    {


        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();

        $this->load->view("coordinador/inscripciones/nueva_inscripcion", $datos);

    }


    function inscribir()
    {


        $datos['grados'] = $this->coordinador->consultarGrados();
        $datos['niveles'] = $this->coordinador->consultarNivelesEducacion();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['semestres'] = $this->coordinador->consultarSemestre();
        $datos['jornadas'] = $this->coordinador->consultarJornadas();

        $this->load->view("coordinador/inscripciones/nueva_inscripcion", $datos);

    }


    function vistaNuevaMatricula()
    {


        $datos['grados'] = $this->coordinador->consultarGrados();
        $datos['niveles'] = $this->coordinador->consultarNivelesEducacion();
        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['semestres'] = $this->coordinador->consultarSemestre();
        $datos['jornadas'] = $this->coordinador->consultarJornadas();

        $this->load->view("coordinador/matriculas/nueva_matricula", $datos);

    }



    public function registrarDocente()
    {

        $operacion = $this->input->post("operacion");


        $documento = $this->input->post("documento");
        $nombres = mb_strtoupper($this->input->post("nombres"));
        $apellidos = mb_strtoupper($this->input->post("apellidos"));

        $fecha_nacimiento = $this->input->post("fecha-nacimiento");
        $correo = mb_strtoupper($this->input->post("correo"));
        $correo_institucional = mb_strtoupper($this->input->post("correo-institucional"));

        $telefono = mb_strtoupper($this->input->post("telefono-fijo"));
        $celular = mb_strtoupper($this->input->post("telefono-celular"));

        $sexo = mb_strtoupper($this->input->post("sexo"));

        $direccion = mb_strtoupper($this->input->post("direccion"));
        $lugar_de_residencia = $this->input->post("municipio");


        $datos = array(

            "documento" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "fecha_nacimiento" => $fecha_nacimiento,
            "correo" => $correo,
            "sexo" => $sexo,
            "direccion" => $direccion,
            "telefono_fijo" => $telefono,
            "telefono_celular" => $celular,
            "municipio" => $lugar_de_residencia,
            "correo_institucional" => $correo_institucional

        );

        if (strcmp($operacion, 'registrar') == 0) {


            $datos['clave'] = $documento;


            $existe = $this->coordinador->consultarDocente($documento);

            if (count($existe) == 0) {

                $registro = $this->coordinador->registrarDocente($datos);

                echo $registro;

            } else {

                echo -1;

            }


        } else {


            $editado = $this->coordinador->editarPorDocumento("docentes", $documento, $datos);

            if ($editado > 0) {

                echo 2;

            } else {

                echo -2;
            }


        }


    }


    function filtrarEstudiante()
    {


        $nombres = $this->input->post("nombres");


        if (!empty($nombres)) {

            $estudiantes = $this->coordinador->filtrarEstudiante(mb_strtoupper($nombres));

            foreach ($estudiantes as $estudiante) {

                echo '<tr>

                    <td>' . $estudiante['documento'] . '</td>
                    <td>' . $estudiante['nombres'] . ' ' . $estudiante['apellidos'] . '</td>
                     <td>' . $estudiante['correo'] . '</td>
                    <td class="text-center">
                    
                    <a href="javascript:abrirModalEditarEstudiante(' . $estudiante['documento'] . ')" class="fa fa-edit"></a>
                    
                    
                    </td>
                </tr>';

            }
        } else {


            echo '<tr>

                            <td colspan="5">No existen coinicidencias </td>
                      </tr>';
        }


    }


    function filtrarDocente2()
    {


        if (isset($_GET['q'])) {

            $nombres = strtolower($_GET['q']);

            $docentes = $this->coordinador->filtrarDocente(mb_strtoupper($nombres));

            echo json_encode($docentes);

        }
    }

    function filtrarInstitucion()
    {


        if (isset($_GET['nombre'])) {

            $nombre = strtolower($_GET['nombre']);

            $institucion = $this->coordinador->filtrarInstitucion(mb_strtoupper($nombre));

            echo json_encode($institucion);

        }
    }

    function filtrarDocente()
    {


        $nombres = $this->input->post("nombres");


        if (!empty($nombres)) {

            $docentes = $this->coordinador->filtrarDocente(mb_strtoupper($nombres));

            foreach ($docentes as $docente) {

                echo '<tr>

                    <td>' . $docente['documento'] . '</td>
                    <td>' . $docente['nombres'] . '</td>
               
                    <td class="text-center"><a href="javascript:abrirModalEditarDocente(' . $docente['documento'] . ')" class="fa fa-edit"></a></td>
                </tr>';

            }
        } else {


            echo '<tr>

                            <td colspan="5">No existen coinicidencias </td>
                      </tr>';
        }


    }

    function filtrarDocenteCargasAcademicas()
    {


        $nombres = $this->input->post("nombres");


        if (!empty($nombres)) {

            $docentes = $this->coordinador->filtrarDocente(mb_strtoupper($nombres));

            foreach ($docentes as $docente) {


                $nombres = "'" . $docente['nombres'] . "'";

                echo '<tr>

                    <td>  <a href="javascript:seleccionarDocenteCargarAcademica(' . $docente['documento'] . ',' . $nombres . ')" >' . $docente['documento'] . '</a> </td>
                    <td> <a href="javascript:seleccionarDocenteCargarAcademica(' . $docente['documento'] . ',' . $nombres . ')" >' . $docente['nombres'] . '</a></td>
               
                </tr>';

            }
        } else {


            echo '<tr>

                            <td colspan="5">No existen coinicidencias </td>
                      </tr>';
        }


    }


    public function consultarInscripciones()
    {


        $programa = $this->input->post('programa');
        $periodo = $this->input->post('periodo');

        $inscripcionees = $this->coordinador->consultarInscripciones($periodo, $programa);

        echo '<table id="datatable-matriculas" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%"  >
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


    public function consultarMatriculas()
    {


        $programa = $this->input->post('programa');
        $periodo = $this->input->post('periodo');
        $semestre = $this->input->post('semestre');
        $jornada = $this->input->post('jornada');

        $matriculas = $this->coordinador->consultarMatriculas($periodo, $programa, $semestre, $jornada);


        foreach ($matriculas as $matricula) {

            echo '  <tr>
                                    
                                                     
                                                <td class="mayus" > ' . $matricula['periodo'] . '</td >
                                                <td class="mayus" > ' . $matricula['programa'] . '</td >
                                                <td class="mayus" > ' . $matricula['estudiante'] . '</td >
                                                  <td class="mayus text-center" > ' . $matricula['semestre'] . '</td >
                                                    <td class="mayus text-center" > ' . $matricula['jornada'] . '</td >
                                                
                                             <td class="mayus text-center" > ' . $matricula['grupo'] . '</td >
                                              


                </tr >';


        }



    }


    function vistaInscripciones()
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css', 'select2/select2.min.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'filtrarMunicipios.js', 'select2/select2.min.js', 'select2/es.js', 'estudiante.js');

        $datos['titulo'] = "SIA - Inscripciones";

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


    function vistaCargasAcademicasDocentes()
    {

        $datos['css'] = array('jquery-ui.css', 'select2/select2.min.css', 'dataTables.bootstrap.css');

        $datos['js'] = array('jquery-ui.js', 'cargaAcademica.js', 'modalBootstrap.js', 'select2/select2.min.js', 'select2/es.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['semestres'] = $this->coordinador->consultarSemestre();

        $datos['titulo'] = "SIA - Cargas académicas";
        $datos['contenido'] = '../coordinador/docentes/consultar_cargas_academicas';
        $this->load->view("coordinador/plantilla", $datos);


    }

    function vistaCrearCargaAcademicasDocentes()
    {

        $datos['css'] = array('jquery-ui.css', 'select2/select2.min.css', 'dataTables.bootstrap.css');

        $datos['js'] = array('jquery-ui.js', 'cargaAcademica.js', 'modalBootstrap.js', 'select2/select2.min.js', 'select2/es.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap.min.js', 'datatables/dataTables.responsive.min.js');

        $datos['programas'] = $this->coordinador->consultarTodosLosProgramas();
        $datos['semestres'] = $this->coordinador->consultarSemestre();

        $datos['titulo'] = "Cargas académicas";
        $datos['contenido'] = '../coordinador/docentes/crear_cargas_academicas';
        $this->load->view("coordinador/plantilla", $datos);


    }

    public function consultarPeriodoAcademicoActual()
    {

        return $this->coordinador->consultarPeriodoAcademicoActual($this->peridoActual);
    }


    function consultarDetallesDeGrupo()
    {

        $grupo = $this->input->post('grupo');

        $result = $this->coordinador->consultarDetallesDeGrupo($grupo);

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

    function autoCompletarDocentes()
    {


        if (isset($_GET['term'])) {


            $nombres = strtolower($_GET['term']);
            $valores = $this->coordinador->autoCompletarDocentes($nombres);


            echo json_encode($valores);
        }
    }

    function consultarAsignaturasPorPrograma()
    {

        $programa = $this->input->post("programa");


        $programas = $this->coordinador->consultarAsignaturasPorPrograma($programa);


        echo json_encode($programas);

    }


    function consultarGruposPorPrograma()
    {

        $programa = $this->input->post("programa");

        $semestre = $this->input->post("semestre");
        $jornada = $this->input->post("jornada");

        $programas = $this->coordinador->consultarGruposPorPrograma($programa, $semestre, $jornada);


        echo json_encode($programas);

    }


    function consultarAsignatura()
    {

        $codigo = $this->input->post("codigo");

        if (isset($codigo)) {


            $docente = $this->coordinador->consultarAsignatura($codigo);


            echo json_encode($docente);
        }

    }

    function consultarAsignaturasPorGrupos()
    {

        $programa = $this->input->post("programa");
        $semestre = $this->input->post("semestre");
        $jornada = $this->input->post("jornada");
        $numeroGrupo = $this->input->post("numeroGrupo");


        $asignturas = $this->coordinador->consultarAsignaturasPorGrupos($programa, $semestre, $jornada, $numeroGrupo);


        echo json_encode($asignturas);


    }


    function guardarCargaAcademica()
    {


        $docenteDocumento = $this->input->post("docenteDocumento");
        $jornadaCodigo = $this->input->post("jornadaCodigo");
        $asignatura = $this->input->post("asignatura");
        $numeroGrupo = $this->input->post("numeroGrupo");


        $carga = 0;


        $datosCargaAcademica = [

            "asignatura_semestral" => $asignatura,
            "grupo" => $numeroGrupo,
            "jornada" => $jornadaCodigo,
            "periodo" => $this->session->userdata('periodo'),
            "docente" => $docenteDocumento,


        ];


        $carga = $this->coordinador->registrar("cargas_academicas", $datosCargaAcademica);


        echo $carga;


    }


    public function notas($accion = 1, $parametro = null)
    {


        $fechas = $this->coordinador->consultarFechasDigitacionNotas($this->peridoActual);


        if (count($fechas) > 0) {


            $corteActual = $fechas[0]['corte'];

            if ($accion == 1 || $accion == "por-programa") {

                $this->vistaProgramasOrientados($corteActual);

            } else if ($accion == "asignatura") {

                $this->vistaVerAsignaturasPorPrograma($parametro, $corteActual);


            } else if ($accion == "digitar") {


                $this->vistaVerLitadoDeEstudiantesMatriculadosPorAsignatura($parametro, $corteActual);


            } else if ('grupos') {


                $this->vistaVerAsignaturasPorGrupo($parametro, $corteActual);
            }

        } else {


            $this->vistaPlataformaCerrada();
        }

    }

    public function vistaVerAsignaturasPorPrograma($programa, $corte)
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js');
        $datos['carga_academica'] = $this->coordinador->consultarAsiganaturasPorPrograma($programa, $corte);
        $datos['titulo'] = "SIA - Notas";
        $datos['corte'] = $corte;
        $datos['contenido'] = '../docente/notas/selecionar_asignatura';
        $this->load->view("coordinador/plantilla", $datos);

    }

    public function vistaVerAsignaturasPorGrupo($programa, $corte)
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js');
        $datos['grupos'] = $this->coordinador->consultarAsignaturasGruposPorPrograma($programa, $corte);
        $datos['titulo'] = "SIA - Notas";
        $datos['corte'] = $corte;
        $datos['contenido'] = '../docente/notas/selecionar_grupo';
        $this->load->view("coordinador/plantilla", $datos);

    }


    public function vistaVerLitadoDeEstudiantesMatriculadosPorAsignatura($carga, $corte)
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js', 'jquery.numeric.js');
        $datos['estudiantes'] = $this->coordinador->consultarListadoDeEstudiantesMatriculadosPorAsignatura($carga);
        $datos['titulo'] = "SIA - Notas";
        $datos['corte'] = $corte;
        $datos['carga'] = $carga;


        $datos['contenido'] = '../docente/notas/listado_estudiantes_matriculados';
        $this->load->view("coordinador/plantilla", $datos);

    }


    public function vistaProgramasOrientados($corte)
    {


        $datos['css'] = array('jquery-ui.css', 'jquery.tagsinput.css');
        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js');

        $datos['titulo'] = "SIA - Notas";
        $datos['corte'] = $corte;

        $datos['programas'] = $this->coordinador->consultarProgramasOrientados();
        $datos['contenido'] = '../docente/notas/selecionar_programa';
        $this->load->view("coordinador/plantilla", $datos);


    }

    public function vistaPlataformaCerrada()
    {


        $datos['js'] = array('jquery-ui.js', 'modalBootstrap.js', 'jquery.tagsinput.js', 'docente.js', 'jquery.numeric.js');
        $datos['titulo'] = "Gestionar docente";
        $datos['contenido'] = '../docente/notas/plataforma_cerrada';
        $this->load->view("coordinador/plantilla", $datos);

    }

    function consultarFechasDigitacionNotas()
    {


        $result = $this->coordinador->consultarFechasDigitacionNotas($this->peridoActual);


        return $result;

    }


    function consultarDocente()
    {

        $documento = $this->input->post("documento");

        if (isset($documento)) {


            $docente = $this->coordinador->consultarDocente($documento);


            echo json_encode($docente);
        }

    }

    function consultarCargaAcademicaPorDocente()
    {


        $documento_docente = $this->input->post("documento");


        $x = $this->coordinador->consultarCargaAcademicaPorDocente($documento_docente, $this->peridoActual);


        echo json_encode($x);

    }

    function consultarEstudiante()
    {


        $documento = $this->input->post("documento");

        if (isset($documento)) {


            $estudiante = $this->coordinador->consultarEstudiante($documento);


            echo json_encode($estudiante);
        }
    }


    function x2()
    {

        $estudiante = $this->coordinador->consultarEstudiante(51985965);

        echo var_dump($estudiante);

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


    public function consultarProgramasOrientados($documento)
    {

        $this->db->select("p.nombre,p.codigo");
        $this->db->from("cargas_academicas ca");


        $this->db->join('asignaturas_semestrales aps', 'aps.codigo = ca.asignatura_semestral');
        $this->db->join('planes_de_estudio ps', 'ps.codigo = aps.plan_de_estudio');
        $this->db->join('programas p', 'p.codigo = ps.programa');
        $this->db->where("ca.docente", $documento);
        $this->db->group_by("p.nombre");

        return $this->db->get()->result_array();
    }


    function registrarNota()
    {


        $notas = $this->input->post("notas");

        $corte = $this->input->post("corte");
        $carga = $this->input->post("carga");


        $n = 0;

        foreach ($notas as &$nota) {


            $valores = explode("-", $nota);


            $datos = [


                "nota" . $corte => $valores[1]

            ];


            $n += $this->coordinador->guardarNota($valores[0], $datos);

            $this->coordinador->calcularNotaFinal($valores[0]);


        }


        $this->coordinador->cambiarEstadoEvaluacionPorCorte($carga, $corte);

        echo ":) " . $n;


    }


    function autoCompletar($nombres)
    {

        $this->db->select("documento AS value, CONCAT(nombres,' ',apellidos)  AS label", FALSE)
            ->like('nombres', $nombres)
            ->or_like('apellidos', $nombres)
            ->db->from('docente');

        return $this->db->get()->result_array();

    }


    function filtrar($nombres)
    {

        $this->db->select("*")
            ->like('nombres', $nombres)
            ->or_like('apellidos', $nombres)
            ->from('docente');

        return $this->db->get()->result_array();
    }


    function consultarTodos()
    {

        $result = $this->db->get("docente");
        return $result->result_array();


    }


    function consultarProgramas()
    {

        $result = $this->db->get("programas");
        return $result->result_array();

    }


    function consultarGrupos()
    {


        $result = $this->db->get("grupos");

        return $result->result_array();


    }


}
