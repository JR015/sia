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
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">

    <title> SIA - Inicio de sesión </title>


    <link href="<?= base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/nprogress.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style-dashboard.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/responsive.bootstrap.css')?>" rel="stylesheet">

    <!--
    <link href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" rel="stylesheet">
    -->


    <noscript>

        <meta http-equiv="Refresh" content="0;URL=<?=base_url('error/no_script')?>">

    </noscript>






</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">

                <img width="50%" src="<?=base_url('assets/img/logo.png')?>" alt="Escuela de Bella Artes y Humanidades">
                <form method="post" action="<?=base_url('sesion/iniciarCoordinador')?>">


                    <h2>REGISTRO Y CONTROL</h2>
                    <div>
                        <input name="documento" type="text" class="form-control" placeholder="Documento de indentidad" autofocus required="" />
                    </div>
                    <div>
                        <input name="clave" type="password" class="form-control" placeholder="Clave de acceso" required="" />
                    </div>




                    <br>

                    <div>

                        <a class="reset_pass" href="#">¿Olvidó su contraseña?</a>
                        <input class="btn btn-primary submit" type="submit" value="Iniciar sesión">

                    </div>

                    <div class="clearfix"></div>

                    <?php

                    if(isset($_GET['error'])){

                        ?>
                        <div class="alert alert-error alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            El documento de identidad y la clave de acceso no coinciden.
                        </div>
                        <?php

                    }

                    ?>




                    <div class="separator">
                        <div>
                            <h2>
                                Escuela de Bellas Artes y Humanidades</h2>
                            <p>©  <?=date('Y')?> Todos los derechos reservados.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>


    </div>
</div>
</body>
</html>
