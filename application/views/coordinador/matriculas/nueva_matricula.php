<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">


    <title> SIA - Matrícula </title>


    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/select2/select2.min.css') ?>" rel="stylesheet">


    <noscript>

        <meta http-equiv="Refresh" content="0;URL=<?= base_url('error/no_script') ?>">

    </noscript>


</head>

<body class="login" style="background-color: white ; ">
<div>


    <style>

        table {

            border-collapse: inherit;
            font-size: 8pt;
        }

        td {

            color: black;
        }

        .borde-derecho {

            border-right: 1px solid black;

        }

        textarea { resize: vertical; }

        .borde-izquierdo {

            border-left: 1px solid black;

        }

        .form-control{

            height: 25px !important;
            font-size: 11px !important;

        }

        .dato{

            color: red;

            font-weight: bold;
            font-size: 11pt;
        }

        .mayus{
            text-transform: uppercase;
        }

        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 5px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #000;
        }

        .titulos {

            background-color: #008b1e;
            border-top-right-radius: 50px;
            height: 10px;
            color: white;
            font-weight: bold;
            font-size: 9pt;
        }

    </style>

    <div class="container" style="width: 55%;  border: 1px solid black">


        <div class="row" style="border-radius: 10px">


            <form method="post" style="margin: 0px; border-radius: 2px; color: white "
                  action="<?= base_url('coordinador/matricular') ?>">

                <table class="table" border="0">


                    <thead>


                    <tr>


                        <td colspan="8">

                        </td>


                        <td colspan="4" rowspan="2" class="text-center">

                            <img src="<?= base_url("assets/img/logo2.png") ?>">

                        </td>

                    </tr>


                    <tr>

                        <td colspan="8" class="titulos">

                            <b>
                                FORMATO DE MATRICULA DE ESTUDIANTES
                            </b>

                        </td>


                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td colspan="10"></td>
                    </tr>

                    <tr>

                        <td colspan="6" class="borde-derecho"><label for="">MATRICULA NO. <b class="dato">00000</b> </label></td>

                        <td class="borde-derecho" colspan="2" width="160"><b>FECHA :</b> <span class="dato"> <?= date('Y-m-d') ?></span></td>


                        <td colspan="2">

                            <b>VALOR :</b>

                            <b class="dato">425.000</b>

                        </td>

                    </tr>


                    <tr>

                        <td colspan="5" >

                            PROGRAMA


                            <select name="programa" style="width: 100%" class="form-control mi-select2"  id="programa">
                                <option value="">SELECCIONE</option>

                                <?php

                                foreach ($programas as $programa) {

                                    echo ' <option value="' . $programa['codigo'] . '">' . $programa['nombre'] . '</option>';

                                }

                                ?>

                            </select>

                        </td>

                        <td class="borde-derecho">

                            SEMESTRE

                            <select style="width: 100%" class="form-control mi-select2" name="semestre" id="numero-semestre">

                                <option value="">SELECCIONE</option>

                                <?php


                                foreach ($semestres as $semestre){

                                    echo ' <option value="'.$semestre[' numero'].'">'.$semestre['nombre'].'</option>';

                                }



                                ?>
                            </select>

                        </td>

                        <td class="borde-derecho" colspan="2">
                            JORNADA

                            <select style="width: 100%" onchange="consultarGrupos()" class="form-control" name="" id="jornada">

                                <option value="">SELECCIONE</option>


                                <?php

                                foreach ($jornadas as $jornada) {

                                    echo ' <option value="' . $jornada['codigo'] . '">' . $jornada['nombre'] . '</option>';

                                }

                                ?>

                            </select>


                        </td>
                        <td class="" colspan="2">
                            GRUPO

                            <select required class="form-control" name="grupo" id="grupo">

                                <option value="">SELECCIONE</option>
                            </select>


                        </td>


                    </tr>

                    <tr>

                        <td colspan="10"></td>


                    </tr>

                    <tr>

                        <td colspan="7" class="titulos">

                            INFORMACIÓN DEL ESTUDIANTE
                        </td>


                    </tr>




                    <tr>

                        <td colspan="2" class="borde-derecho">

                            TIPO DOCUMENTO<span>*</span>

                            <select class="form-control form-control-input" required name="tipo-documento" id="tipo-documento">
                                <option value="">SELECCIONE</option>

                                <option value="CC">CEDULA DE CIUDADANÍA</option>
                                <option value="TI">TARJETA DE IDENTIDAD</option>
                                <option value="RC">REGISTRO CIVIL</option>

                            </select>

                        </td>

                        <td colspan="4" class="borde-derecho">

                            DOCUMENTO<span>*</span>
                            <input  required type="number" class="form-control mayus form-control-input2" name="documento-estudiante" id="documento-estudiante">
                        </td>
                        <td colspan="4">

                            EXPEDIDA<span>*</span>


                            <select required class="form-control mayus lugares form-control-input" name="lugar-expedicion" id="lugar-expedicion">
                                <option value=""></option>
                            </select>



                        </td>
                    </tr>

                    <tr>


                        <td colspan="6" class="borde-derecho">


                            NOMBRES<span>*</span>
                            <input required class="form-control mayus form-control-input" type="text" name="nombres" id="nombres">

                        </td>


                        <td colspan="9">

                            APELLIDOS<span>*</span>
                            <input type="text" required class="form-control mayus form-control-input" name="apellidos" id="apellidos">

                        </td>


                    </tr>
                    <tr>

                        <td colspan="2" class="borde-derecho">
                            FECHA DE NACIMIENTO<span>*</span>

                            <input class="form-control form-control-input" type="date" required max="<?= date('Y-m-d')?>" name="fecha-nacimiento" id="fecha-nacimiento">

                        </td>


                        <td colspan="5" class="borde-derecho">
                            LUGAR NACIMIENTO<span>*</span>



                            <select  class="form-control mayus lugares form-control-input" required name="lugar-nacimiento" id="lugar-nacimiento">
                                <option value=""></option>
                            </select>
                        </td>

                        <td colspan="5" class="">LUGAR RESIDENCIA<span>*</span>


                            <select  class="form-control mayus lugares form-control-input"  required name="lugar-residencia" id="lugar-residencia">
                                <option value=""></option>
                            </select>



                        </td>


                    </tr>


                    <tr>


                        <td class="borde-derecho form-control-input" colspan="2">

                            SEXO<span>*</span>

                            <select name="sexo" class="form-control" required id="sexo">
                                <option value="">SELECIONE</option>
                                <option value="F">FEMENINO</option>
                                <option value="M">MASCULINO</option>

                            </select>
                        </td>

                        <td class="borde-derecho form-control-input" colspan="6">
                            DIRECCIÓN<span>*</span>
                            <input class="form-control mayus" type="text"  name="direccion" id="direccion">
                        </td>
                        <td colspan="2" class="">


                            BARRIO<span>*</span>
                            <input type="text" class="form-control mayus form-control-input" required name="barrio" id="barrio">
                        </td>

                    </tr>

                    <tr>

                        <td colspan="3" class="borde-derecho">
                            ZONA<span>*</span>


                            <select name="zona" required class="form-control form-control-input" id="zona">
                                <option value="">SELECCIONE</option>
                                <option value="URBANA">URBANA</option>
                                <option value="RURAL">RURAL</option>


                            </select>
                        </td>


                        <td colspan="3" class="borde-derecho">
                            ESTRATO<span>*</span>

                            <select name="estrato" class="form-control form-control-input" required id="estrato">
                                <option value="">SELECCIONE</option>
                                <option value="1">UNO</option>
                                <option value="2">DOS</option>
                                <option value="3">TRES</option>
                                <option value="4">CUATRO</option>
                                <option value="5">CINCO</option>

                            </select>

                        </td>
                        <td colspan="2" class="borde-derecho">
                            SISBEM
                            <input class="form-control form-control-input" type="text" name="sisbem" id="sisbem">
                        </td>

                        <td colspan="2" class="">
                            TIPO DE SANGRE

                            <select class="form-control mayus form-control-input" required type="text" name="tipo-sangre" id="tipo-sangre">
                                <option value="0-">0-</option>
                                <option value="0+">0+</option>
                                <option value="A−">A−</option>
                                <option value="A+">A+</option>
                                <option value="B−">B−</option>
                                <option value="B+">B+</option>
                                <option value="AB−">AB−</option>
                                <option value="AB+">AB+</option>

                            </select>

                        </td>

                    </tr>


                    <tr>

                        <td class="borde-derecho" colspan="6">
                            I.P.S AFILIADO <input type="text" class="form-control mayus form-control-input" name="ips" id="ips">
                        </td>
                        <td colspan="6">E.P.S ASIGANADA
                            <input class="form-control mayus form-control-input" type="text" name="eps" id="eps">
                        </td>
                    </tr>


                    <tr>

                        <td class="borde-derecho" colspan="7">
                            TELÉFONO CELULAR<span>*</span>
                            <input type="number" required class="form-control mayus form-control-input" name="telefono-celular" id="telefono-celular">
                        </td>
                        <td colspan="5">TELÉFONO FIJO<span>*</span>
                            <input class="form-control mayus form-control-input" type="number"  name="telefono-fijo" id="telefono-fijo">
                        </td>
                    </tr>

                    <tr>

                        <td colspan="10"></td>


                    </tr>

                    <tr>


                        <td colspan="7" class="titulos">

                            INFORMACIÓN ACADÉMICA


                        </td>


                    </tr>


                    <tr>


                        <td colspan="7" class="borde-derecho">
                            INSTITUCIÓN EDUCATIVA<span>*</span>
                            <select name="institucion" class="form-control form-control-input" id="institucion">
                                <option value=""></option>
                            </select>

                        </td>

                        <td colspan="2" class="borde-derecho">

                           ULT. GRADO CURSADO<span>*</span>

                            <select required class="form-control form-control-input" name="ultimo-grado-cursado" id="ultimo-grado-cursado">
                                <option value="">SELECCIONE</option>


                                <?php


                                        foreach ($grados as $grado){

                                            echo ' <option value="'.$grado['numero'].'">'.$grado['nombre'].'</option>';

                                        }

                                ?>

                            </select>

                        </td>

                        <td colspan="1">

                            AÑO<span>*</span>

                            <input class="form-control form-control-input"  min="1900" type="number" max="<?= date('Y')?>" name="anio-ultimo-grado-cursado" id="anio-ultimo-grado-cursado">


                        </td>


                    </tr>


                    <tr>

                        <td colspan="10"></td>


                    </tr>

                    <tr>


                        <td colspan="3" class="borde-derecho">

                            NIVEL DE ESTUDIOS<span>*</span>
                            <select name="nivel-estudios" required class="form-control mi-select2 form-control-input" id="nivel-estudios">
                                <option value="">SELECCIONAR</option>

                                <?php


                                foreach ($niveles as $grado){

                                    echo ' <option value="'.$grado['codigo'].'">'.$grado['nombre'].'</option>';

                                }

                                ?>

                            </select>

                        </td>


                        <td colspan="6" class="borde-derecho form-control-input">TÍTULO OPTENIDO

                            <input type="text" class="form-control mayus" name="titulo" id="titulo">
                        </td>

                        <td colspan="1">AÑO

                            <input class="form-control mayus form-control-input"  type="number" max="<?= date('Y')?>" name="anio-titulo" id="anio-titulo">
                        </td>


                    </tr>


                    <tr>

                        <td colspan="10"></td>


                    </tr>


                    <tr>


                        <td colspan="7" class="titulos">

                            CONDICIONES ESPECIALES
                        </td>


                    </tr>

                    <tr>
                        <td colspan="1" class="borde-derecho">

                            DESPLAZADO
                            <br>
                            <input type="checkbox" id="desplazado" class="form-control-input" name="desplazado" value="">
                        </td>
                        <td colspan="1" class="borde-derecho">

                            AFRO
                            <br>
                            <input name="afro" id="afro" class="form-control-input" type="checkbox" value="">
                        </td>

                        <td colspan="1" class="borde-derecho">

                            INDIGENA
                            <br>

                            <input name="indigena" id="indigena" class="form-control-input" type="checkbox" value="">
                        </td>
                        <td colspan="1" class="borde-derecho">

                            ROM
                            <br>
                            <input type="checkbox" class="form-control-input" name="rom" id="rom" value="">
                        </td>

                        <td colspan="3" class="borde-derecho">

                            MADRE CABEZA DE FLA
                            <br>
                            <input type="checkbox" class="form-control-input" name="cabeza-familia" id="cabeza-familia" value="">
                        </td>

                        <td colspan="1" class="borde-derecho">

                            EMBARAZADA
                            <br>
                            <input name="embarazada"  class="form-control-input" id="embarazada" type="checkbox" value="">
                        </td>
                        <td colspan="1" class="borde-derecho">

                            ADULTO MAYOR
                            <br>
                            <input type="checkbox" class="form-control-input" name="adulto-mayor" id="adulto-mayor" value="">
                        </td>
                        <td colspan="1" class="">

                            LGBTI
                            <br>
                            <input name="lgbti" class="form-control-input" id="lgbti" type="checkbox" value="">
                        </td>


                    </tr>

                    <tr>




                        <td colspan="1" class="">



                            OTRO
                            <br>
                            <input type="checkbox" class="form-control-input" name="otra-poblacion-especial" id="otra-poblacion-especial" value="">
                        </td>

                        <td colspan="10">
                            CUAL
                            <input class="form-control mayus form-control-input" disabled id="nombre-otra-poblacion-especial" name="nombre-otra-poblacion-especial" type="text" value="">
                        </td>

                    </tr>


                    <tr>
                        <td colspan="5" class="borde-derecho">

                            SOLICITA AUXILIO ACADÉMICO
                            <input type="checkbox" class="form-control-input" name="solicita-auxilio" id="solicita-auxilio" value="">
                        </td>
                        <td colspan="3" class="borde-derecho">

                            % APROBADO
                            <input type="number" disabled class="form-control form-control-input" value="0" min="0" max="100" name="porcentaje-auxilio" id="porcentaje-auxilio" >
                        </td>

                        <td colspan="4">

                            VB RECTORA
                            <input type="checkbox" class="form-control-input" name="vb-direccion" id="vb-direccion" value="">
                        </td>


                    </tr>


                    <tr>

                        <td colspan="10"></td>


                    </tr>


                    <tr>


                        <td colspan="6" class="titulos">

                            DISCAPACIDAD
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2" class="borde-derecho">

                            AUDITIVA
                            <br>
                            <input type="checkbox" class="form-control-input" name="discapacidad-auditiva" id="discapacidad-auditiva" value="">
                        </td>
                        <td colspan="3" class="borde-derecho">

                            COGNITIVA
                            <br>
                            <input type="checkbox" value="" class="form-control-input" name="discapacidad-cognitiva" id="discapacidad-cognitiva">
                        </td>

                        <td colspan="1" class="borde-derecho">

                            FISÍCA
                            <br>
                            <input type="checkbox" value="" class="form-control-input" id="discapacidad-fisica" name="discapacidad-fisica">
                        </td>


                        <td colspan="1">

                            OTRO
                            <br>
                            <input type="checkbox" value="" class="form-control-input" name="otra-discapacidad" id="otra-discapacidad">
                        </td>

                        <td colspan="4">

                            CUAL
                            <input class="form-control mayus form-control-input" disabled name="nombre-otra-discapacidad" id="nombre-otra-discapacidad" type="text" value="">
                        </td>


                    </tr>


                    <tr>

                        <td colspan="10"></td>


                    </tr>

                    <tr>


                        <td colspan="6" class="titulos">

                            INFORMACION FAMILIAR
                        </td>

                    </tr>


                    <tr>


                        <td class="borde-derecho" colspan="6">

                            NOMBRES Y APELLIDOS DE LA MADRE

                            <input type="text"  class="form-control mayus form-control-input" name="nombres-madre" id="nombres-madre">

                        </td>


                        <td colspan="5">

                            NOMBRES Y APELLIDOS DEL PADRE

                            <input type="text"  class="form-control mayus form-control-input" name="nombres-padre" id="nombres-padre">

                        </td>

                    </tr>

                    <tr>




                        <td colspan="2" class="borde-derecho">

                            TELÉFONO CELULAR
                            <br>
                            <input  class="form-control form-control-input" type="number" name="telefono-celular-madre" id="telefono-celular-madre">

                        </td>

                        <td colspan="4" class="borde-derecho">

                            TELÉFONO FIJO
                            <input type="number" class="form-control form-control-input" name="telefono-fijo-madre" id="telefono-fijo-madre">

                        </td>

                        <td colspan="2" class="borde-derecho">

                            TELÉFONO CELULAR
                            <br>
                            <input  class="form-control form-control-input" type="number" name="telefono-celular-padre"  id="telefono-celular-padre">

                        </td>

                        <td colspan="2" >

                            TELÉFONO FIJO
                            <input type="number" class="form-control form-control-input" name="telefono-fijo-padre" id="telefono-fijo-padre">

                        </td>



                    </tr>

                    <tr>

                        <td colspan="8" class="borde-derecho">
                            NOMBRES Y APELLIDOS DEL ACUDIENTE

                            <input class="form-control mayus form-control-input" required type="text" name="nombres-acudiente" id="nombres-acudiente">
                        </td>

                        <td colspan="2">

                            TÉLEFONO CELULAR

                            <input class="form-control form-control-input" required type="number" name="telefono-celular-acudiente"  id="telefono-celular-acudiente">

                        </td>

                    </tr>

                    <tr>

                        <td colspan="10"></td>

                    </tr>
                    <tr>


                        <td colspan="6" class="titulos">

                            DOCUMENTOS
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" class="borde-derecho" title="Copia del documento de indentidad">

                            COPIA D.I

                            <br>
                            <input type="checkbox" class="form-control-input" name="copia-documento" id="copia-documento">

                        </td>

                        <td colspan="3" class="borde-derecho">

                            Cert de estudios
                            <br>
                            <input type="checkbox" class="form-control-input" name="certificado-estudio" id="certificado-estudio">

                        </td>

                        <td colspan="1" class="borde-derecho">

                            C del Diploma
                            <br>
                            <input type="checkbox" class="form-control-input" name="copia-diploma" id="copia-diploma">

                        </td>

                        <td colspan="2" class="borde-derecho">

                            Recibo S. Público
                            <br>
                            <input  type="checkbox" class="form-control-input" name="recibo-servicio-publico" id="recibo-servicio-publico">

                        </td>

                        <td class="borde-derecho">

                            Foto
                            <br>
                            <input type="checkbox" class="form-control-input" name="foto" id="foto">

                        </td>
                        <td colspan="1">

                            Carta Especial
                            <br>
                            <input type="checkbox" class="form-control-input" name="carta-especial" id="carta-especial">

                        </td>


                    </tr>


                    <tr>

                        <td colspan="10"></td>

                    </tr>

                    <tr>


                        <td colspan="6" class="titulos">

                            OBSERVACIONES
                        </td>


                    </tr>


                    <tr>


                        
                        <td colspan="10">

                            <textarea class="mayus form-control-input" style="width: 100%;" name="observaciones" id="observaciones" cols="30" rows="10"></textarea>
                            
                        </td>


                    </tr>



                    <tr>

                        <td style="padding-top:  50px;" colspan="10"></td>

                    </tr>


                    <tr>


                        <td style="border: 0 solid white; width: 20px"></td>
                        <td colspan="2" class="text-center">


                            <label for="" class="control-label">  FIRMA <br> ESTUDIANTE </label>

                        </td>

                        <td style="border: 0 solid white; width: 40px"></td>
                        <td colspan="3" class="text-center" style="padding-right: 20px">


                            <label for="" class="control-label"> FIRMA <br> ACUDIENTE </label>

                        </td>
                        <td style="border: 0 solid white; width: 20px"></td>

                        <td colspan="1" class="text-center" style="">

                            <label for="" class="control-label">  FIRMA DIRECTOR(A) </label>

                        </td>
                        <td style="border: 0 solid white; width: 20px"></td>


                    </tr>


                    <tr>


                        <td colspan="10">

                            <p>Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido
                                del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que
                                tiene una distribución más o menos normal de las letras,</p>

                        </td>


                    </tr>

                    <tr  class="text-center">

                        <td colspan="10" style="border: 0 solid white; width: 20px">


                            <input type="reset" class="btn-info btn" name="" value="Cancela" id="">

                            <input type="submit" class="btn-success btn" name="" value="Matricular" id="">

                        </td>

                    </tr>

                    </tbody>


                </table>
            </form>

        </div>


    </div>
</div>

<script src="<?= base_url('assets/js/config.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery-ui.js') ?>"></script>
<script src="<?= base_url('assets/js/filtrarMunicipios.js') ?>"></script>
<script src="<?= base_url('assets/js/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/mostrarDatosEstudiante.js') ?>"></script>
<script src="<?= base_url('assets/js/matricula.js') ?> "></script>



<script !src="">


    $("#programa").select2({

        placeholder: 'BUSCAR PROGRAMA'

    });

</script>

</body>
</html>
