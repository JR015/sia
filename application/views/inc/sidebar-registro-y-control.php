<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Registro y control</h3>
        <ul class="nav side-menu">

            <li><a href="<?=base_url('registro-y-control')?>"><i class="fa fa-home"></i> Inicio </a> </li>



  <!--          <li><a><i class="fa fa-pencil-square"></i>Inscripciones <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">


                    <li ><a href="<?/*=base_url('coordinador/inscribir')*/?>">Nueva inscripción</a>
                    </li>
                    <li><a href="<?/*=base_url('registro-y-control/listado-inscripciones')*/?>">Listado de inscripciones</a>
                    </li>


                </ul>
            </li>
-->

            <li><a><i class="fa fa-pencil"></i>Matriculas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">

                    <li><a href="<?=base_url('registro-y-control/nueva-matricula')?>">Nueva matricula</a>
                    </li>
                    <li><a href="<?=base_url('registro-y-control/listado-matriculas')?>">Listado de matriculas</a>
                    </li>


                </ul>
            </li>

            <li><a><i class="fa fa-user"></i>Estudiantes <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">


                    <li><a href="<?=base_url("registro-y-control/gestionar-estudiantes")?>">Gestionar</a></li>


                </ul>
            </li>


            <li><a><i class="fa fa-user-o"></i>Docentes <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">


                    <li><a href="<?=base_url('registro-y-control/gestionar-docente')?>">Gestonar</a></li>
                    <li><a href="<?=base_url('registro-y-control/ver-cargas-academicas')?>">Cargas académica</a></li>



                </ul>
            </li>


            <li><a><i class="fa fa-edit"></i>Notas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">



                    <li><a href="<?=base_url('coordinador/notas/')?>"></i>Notas</a></li>


                </ul>
            </li>







            <li><a><i class="fa fa-book"></i>Asiganaturas<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?=base_url('registro-y-control/gestionar-asignaturas') ?>">Gestonar</a></li>


                </ul>
            </li>




            <li><a><i class="fa fa-users"></i>Grupos<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?=base_url('registro-y-control/gestionar-grupos')?>">Gestonar</a></li>


                </ul>
            </li>






            <li><a><i class="fa fa-clock-o"></i>Períodos académicos<span class="fa fa-chevron-down""></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?=base_url('registro-y-control/periodos-academicos')?>">Gestonar</a></li>


                </ul>
            </li>




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
    <a data-toggle="tooltip" data-placement="top" title="Cerrar sesión" href="<?=base_url('sesion/cerrar')?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>
