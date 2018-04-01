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


    <title>SIA - Inscripción </title>


    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/style-inscripcion-matricula') ?>" rel="stylesheet">

    <!--
    <link href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" rel="stylesheet">
-->


    <noscript>

        <meta http-equiv="Refresh" content="0;URL=<?= base_url('error/no_script') ?>">

    </noscript>


    <style type="text/css">





    </style>


</head>

<body class="login">
<div>


    <div class="container" class="width:80%">

        <div class="row">


            <br>

            <br>


            <form method="post" action="<?=base_url('coordinador/inscribirEstudiante')?>">

            <table class="table tabla-matricula" >
                <thead >
                <tr>
                    <th class="text-center">


                        <img src="<?= base_url("assets/img/logo2.png") ?>">

                    </th>
                    <th class="text-center" colspan="2">

                        <p>

                            ESCUELA DE BELLAS ARTES Y HUMNIADES <br>

                            NIT 1233232-1 <br>
                            INSCRIPCION <br>


                        </p>


                    </th>
                    <th class="text-center borde-derecho" >


                        <img src="<?= base_url("assets/img/logo2.png") ?>">

                    </th>

                </tr>
                </thead>
                <tbody>



                <td colspan="4" class="borde-derecho">
                </td>




                <tr  class="">


                    <td class="th-verdes text-center">


                        <b>FECHA</b>


                    </td>

                    <td></td>
                    <td></td>
                    <td class="borde-derecho"></td>
                </tr>

                <tr>

                    <td>


                        <input type="date" readonly class="form-control" value="<?= date('Y-m-d') ?>" name="">

                    </td>
                    <td colspan="3" class="borde-derecho"></td>

                </tr>


                </td>


                <td colspan="4" class="borde-derecho">

                </td>

                </tr>


                <tr>
                    <th class="text-center th-verdes borde-derecho" colspan="4" scope="row">DATOS GENERAL DEL ESTUDIANTE</th>

                </tr>


                <tr>


                    <td>

                        TIPO DOCUMENTO
                        <select class="form-control" required name="tipo-documento">

                            <option value="">Seleccione</option>
                            <option value="CC">Cedulas de Ciudadanía</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="RC">Registro Civil</option>


                        </select>

                    </td>

                    <td colspan="2">

                        DOCUMENTO

                        <input type="number"  class="form-control mayus" name="documento">


                    </td>


                    <td class="borde-derecho">FECHA DE NACIMIENTO


                        <input type="date" required name="fecha-nacimiento" class="form-control" type="date">

                    </td>


                </tr>

                <tr>


                    <td colspan="3">


                        APELLIDOS Y NOMBRES

                        <input class="form-control mayus" required type="nombres" name="">

                    </td>


                    <td class="borde-derecho">

                        SEXO

                        <select class="form-control" required name="sexo">


                            <option value="">Seleccione</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>


                        </select>

                    </td>

                </tr>


                <tr>


                    <td colspan="2">


                        CORREO

                        <input class="form-control mayus"  type="mail" name="correo">

                    </td>

                    <td colspan="1">


                        CELULAR

                        <input class="form-control mayus" type="number"  name="celular">

                    </td>

                    <td colspan="1" class="borde-derecho">


                        TELÉFONO

                        <input class="form-control mayus" type="number"  name="telefono">

                    </td>

                </tr>

                <tr>


                    <td colspan="2">


                        LUGAR DE RESICENCIA

                        <select required class="form-control" name="municipio" id="municipio">




                        </select>

                    </td>

                    <td colspan="3" class="borde-derecho">


                        DIRECCIÓN

                        <input class="form-control mayus" type="text" name="direccion">

                    </td>


                </tr>


                <tr class="tr">


                    <td colspan="2">


                        PROGRAMA
                        <select class="form-control"  required name="programa">


                            <option value="">SELECCIONE</option>


                            <?php

                            foreach ($programas as $programa){

                                echo '<option value="'.$programa['codigo'].'">'.$programa['nombre'].'</option>';

                            }

                            ?>

                        </select>

                    </td>

                    <td colspan="1">


                        JORNADA
                        <select class="form-control" required name="jormada">


                            <option value=""></option>
                        </select>

                    </td>

                    <td class="borde-derecho"></td>



                </tr>


                <tr>

                    <td colspan="3"></td>

                    <td class="text-center borde-derecho">

                        <input type="submit" class="btn btn-primary" value="INSCRIBIR" name="">

                    </td>

                </tr>


                </tbody>
            </table>
            </form>

        </div>


    </div>
</div>
</body>
</html>
