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


    <title> SIA - Inscripción </title>


    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/jquery-ui.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style-inscripcion-matricula') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/select2/select2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style-inscripcion-matricula.css') ?>" rel="stylesheet">


    <!--
    <link href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" rel="stylesheet">
-->


    <noscript>

        <meta http-equiv="Refresh" content="0;URL=<?= base_url('error/no_script') ?>">

    </noscript>


</head>

<body class="login" style="background-color: darkslategray">
<div style=" border 10px solid red">


    <div class="container" style="width: 50%;">


        <div class="row" style="border-radius: 10px">


            <form method="post" style="margin: 5px; border-radius: 2px" action="<?= base_url('coordinador/inscribirEstudiante') ?>">

                <table class="table tabla-matricula">
                    <thead style="background-color: white">
                    <tr>
                        <th class="text-center borde-izquierdo ">


                            <img class="logos" src="<?= base_url("assets/img/logo2.png") ?>">

                        </th>
                        <th class="text-center" colspan="3">

                            <p>


                                <b>ESCUELA DE BELLAS ARTES Y HUMNIADES</b> <br>


                                OFICINA DE REGISTRO Y CONTROL <br>
                                INSCRIPCIÓN DE ESTUDIANTES <br>


                            </p>


                        </th>
                        <th class="text-center borde-derecho">


                            <img class="logos" src="<?= base_url("assets/img/logo2.png") ?>">

                        </th>

                    </tr>


                    </thead>
                    <tbody style="background-color: white">


                    <td colspan="5" class="borde-derecho">
                    </td>


                    <tr style="height: 15px;    padding: 1px;">


                        <th colspan="1" class="borde-izquierdo th-fecha text-center" width="6" height="5">


                            <b>FECHA</b>


                        </th>


                        <th class="th-verdes th-verdes-bordes-blancos text-center" width="16">
                            PERÍODO

                        </th>

                        <th  colspan="2" class="th-verdes th-verdes-bordes-blancos"></th>


                        <th class="th-verdes th-verdes-bordes-blancos borde-derecho text-center">
                            <b>VALOR</b>


                        </th>


                    </tr>

                    <tr>

                        <td align="center">

                            <b><?= date('Y-m-d') ?></b>


                        </td>


                        <td align="center" class="td-blancos-bordes-verdes">

                            <b>   <?= $this->session->userdata('periodo'); ?></b>

                        </td>


                        <td></td>
                        <td></td>
                        <td align="center" class="borde-derecho borde-izquierdo">

                            <b style="color: red;"> $425.000.000</b>


                        </td>


                    </tr>


                    <tr>


                        <td colspan="5" class="borde-derecho">

                        </td>

                    </tr>


                    <tr>
                        <th class="text-center th-verdes borde-derecho" colspan="5" scope="row">DATOS GENERALES DEL
                            ESTUDIANTE
                        </th>

                    </tr>


                    <tr>


                        <td>


                            <b> TIPO DOCUMENTO</b>

                            <select class="form-control" required id="tipo-documento" name="tipo-documento">

                                <option value="">Seleccione</option>
                                <option value="CC">Cedulas de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="RC">Registro Civil</option>


                            </select>

                        </td>

                        <td colspan="3">



                            <b>DOCUMENTO</b>
                            <input type="number" onblur="consultarEstudiante()" id="documento"
                                   class="form-control mayus" name="documento">


                        </td>


                        <td class="borde-derecho">

                            <b>FECHA DE NACIMIENTO</b>

                            <input type="date" required id="fecha-nacimiento" name="fecha-nacimiento"
                                   class="form-control" type="date">

                        </td>


                    </tr>

                    <tr>


                        <td colspan="4">


                          <b>  APELLIDOS Y NOMBRES</b>

                            <input class="form-control mayus" id="nombres" required type="nombres" name="">

                        </td>


                        <td class="borde-derecho">

                            <b>SEXO</b>

                            <select class="form-control" id="sexo" required name="sexo">


                                <option value="">Seleccione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>


                            </select>

                        </td>


                    </tr>


                    <tr>


                        <td colspan="2">


                            <b>CORREO</b>

                            <input class="form-control mayus" id="correo" type="mail" name="correo">

                        </td>

                        <td colspan="2">


                            <b>CELULAR</b>

                            <input class="form-control mayus" type="number" id="celular" required name="celular">

                        </td>

                        <td colspan="1" class="borde-derecho">


                            <b>TELÉFONO</b>

                            <input class="form-control mayus" type="number" id="telefono" name="telefono">

                        </td>


                    </tr>

                    <tr>


                        <td colspan="2">


                           <b> LUGAR DE RESICENCIA</b>

                            <select required class="form-control estilos-select2" name="municipio" id="municipio">


                            </select>

                        </td>

                        <td colspan="3" class="borde-derecho">


                            <b>DIRECCIÓN</b>

                            <input class="form-control mayus" type="text" id="direccion" name="direccion">

                        </td>


                    </tr>


                    <tr class="tr">


                        <td colspan="2">


                            <b>PROGRAMA</b>
                            <select class="form-control" id="programa" required name="programa">


                                <option value="">SELECCIONE</option>


                                <?php

                                foreach ($programas as $programa) {

                                    echo '<option value="' . $programa['codigo'] . '">' . $programa['nombre'] . '</option>';

                                }

                                ?>

                            </select>

                        </td>

                        <td colspan="2">


                            <b>JORNADA</b>
                            <select class="form-control" required name="jormada">


                                <option value="">SELECCIONE</option>

                                <option value="">Seleccione</option>
                                <option value="M">Mañana</option>
                                <option value="T">Tarde</option>
                                <option value="S">Sábados</option>
                            </select>

                        </td>

                        <td class="borde-derecho"></td>


                    </tr>


                    <tr>

                        <td colspan="2"></td>

                        <td class="text-center">

                            <input type="reset" id="btn-cancelar" class="btn btn-succes" value="CANCELAR" name="">

                        </td>

                        <td class="text-center">

                            <input type="submit" id="btn-inscribir" class="btn btn-primary" value="INSCRIBIR" name="">

                        </td>
                        <td colspan="2"></td>
                    </tr>


                    </tbody>
                </table>
            </form>

        </div>


    </div>
</div>


<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery-ui.js') ?>"></script>
<script src="<?= base_url('assets/js/filtrarMunicipios.js') ?>"></script>
<script src="<?= base_url('assets/js/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/select2/es.js') ?>"></script>
<script src="<?= base_url('assets/js/estudiante.js') ?> "></script>
<script src="<?= base_url('assets/js/config.js'); ?>"></script>


<script !src="">


    $("#programa").select2({

        placeholder: 'BUSCAR PROGRAMA'

    });

</script>

</body>
</html>
