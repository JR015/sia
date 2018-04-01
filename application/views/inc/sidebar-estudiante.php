<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Estudiante</h3>
        <ul class="nav side-menu">



            <li><a href="<?=base_url('estudiante')?>"><i class="fa fa-home active"></i> Inicio </a> </li>

            <li><a><i class="fa fa-edit"></i>Notas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">


                    <li><a href="<?=base_url("estudiante/notas")?>">Notas del semestre actual</a></li>


                <!--    <li><a href="<?/*=base_url("estudiante/HistorialNotas")*/?>">Historial</a></li>
-->

                </ul>
            </li>

        </ul>




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
