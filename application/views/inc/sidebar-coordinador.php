<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Coordinación académica</h3>
        <ul class="nav side-menu">

            <li><a href="<?=base_url('coordinacion-academica')?>"><i class="fa fa-home"></i> Inicio </a> </li>

            <li><a><i class="fa fa-pencil-square"></i>Académico<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">

                    <li><a>Inscripciones<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?=base_url('coordinacion-academica/inscripciones')?>">Nueva inscripción</a>
                            </li>
                            <li><a href="<?=base_url('coordinacion-academica/listado-inscripciones')?>">Listado de incripciones</a>
                            </li>

                        </ul>
                    </li>

                    <li><a href="<?=base_url('coordinacion-academica/periodos-academicos')?>">Periodos académicos</a></li>

                </ul>


            </li>


            <li><a><i class="fa fa-user"></i>Estudiantes <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">


                    <li><a href="<?=base_url("coordinacion-academica/gestionar-estudiantes")?>">Gestionar</a></li>


                </ul>
            </li>

           <!--



            <li><a><i class="fa fa-user-o"></i>Docentes <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">


                    <li><a href="<?/*=base_url('coordinacion-academica/gestionar-docentes')*/?>">Gestonar</a></li>
                    <li><a href="<?/*=base_url('admin/cargas-academicas')*/?>">Carga académica</a></li>
                    <li><a href="<?/*=base_url('admin/planes-de-estudio')*/?>">Planes de estudio</a></li>


                </ul>
            </li>

            <li><a><i class="fa fa-book"></i>Asiganaturas<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?/*=base_url('coordinacion-academica/gestionar-asignaturas')*/?>">Gestonar</a></li>
                    <li><a href="<?/*=base_url('asignatura/vista_asignar')*/?>">Asignar</a></li>

                </ul>
            </li>

            <li><a><i class="fa fa-users"></i>Grupos<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?/*=base_url('coordinacion-academica/gestionar-grupos')*/?>">Gestonar</a></li>


                </ul>
            </li>


-->




    </div>




</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Cerrar sesión" href="<?=base_url('login/cerrar')?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>
