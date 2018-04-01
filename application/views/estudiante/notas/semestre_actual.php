
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Notas del semestre actual</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">




                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"  >
                                    <thead>
                                    <tr>

                                        <th>Programa</th>
                                        <th width="50">Período</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php

                                    foreach ($programas as $programa){


                                        echo '<tr>
                                        
                                               
                                                <td><a  href="'.base_url('estudiante/notas/de/'.strtolower( $programa['codigo'])).'/'.$programa['periodo'].'">' . $programa['nombre'] . '</a></td>
                                               
                                                    <td>' . $programa['periodo'] . '</a></td>

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

