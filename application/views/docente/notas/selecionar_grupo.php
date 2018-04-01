
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <h2 class="mayus">Seleccionar la asignatura a evaluar en el <b> corte #<?=$corte?></b> </h2>


                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"  >
                                    <thead>
                                    <tr>

                                        <th>Asignatura</th>
                                        <th>Docente</th>

                                        <th width="50">Semestre</th>
                                        <th width="50">Jornada</th>
                                        <th width="50">Grupo</th>



                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php

                                        foreach ($grupos as $grupo){


                                            echo '<tr>
                                        
                                               
                                                <td><a  href="'.base_url('coordinador/notas/digitar/'.strtolower( $grupo['codigo'])).'">' . $grupo['nombre'] . '</a></td>
                                               
                                                <td>'.$grupo['docente'].'</td>
                                                 <td>'.$grupo['semestre'].'</td>
                                                 <td>'.$grupo['jornada'].'</td>
                                                 <td>'.$grupo['numero'].'</td>

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
