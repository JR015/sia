
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Listado de propuestas a evaluar</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">



                                <!--
                                                                <p class="text-muted font-13 m-b-30">
                                                                    Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                                                                </p>
                                                                -->
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"  >
                                    <thead>
                                    <tr>

                                        <th>Asignatura</th>
                                        <th width="150">Grado</th>
                                        <th width="50">Digitar</th>


                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php

                                        foreach ($carga_academica as $asignatura){


                                            echo '<tr>
                                        
                                               
                                                <td>' . $asignatura['nombre'] . '</td>
                                                 <td>' . $asignatura['grado'] . '</td>
                                                 <td class="text-center"><a  href="javascript:abrirListadoEstudiantes(' . $asignatura['codigo'] . ');" class="fa fa-pencil"></a></td>
                                               
                                                 

                                            </tr>';


                                        }

                                    ?>


                                    </tbody>

                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <script !src="">

            
            function abrirListadoEstudiantes(asignatura) {

                alert(asignatura);
            }
            
        </script>