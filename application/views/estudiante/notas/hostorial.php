
        <!-- page content -->
        <div class="right_col" role="main">


            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <div class="x_panel">
                        <div class="x_title">




                            <div class="row">

                                <div class="col-xs-6">

                                    <h2>historial de notas</h2>

                                </div>

                                <div class=" col-xs-6">


                                    <form id="form-consulta" class="formulario form-horizontal pull-rights" method="POST"


                                          action="<?= base_url('coordinador/consultarMatriculas') ?>" onsubmit="return consultarMatriculas();" >


                                        <div class="form-group">

                                            <div class="col-md-10 col-sm-12 col-xs-12">

                                                <select name="programa"  class="form-control">


                                                    <option value="">PROGRAMA</option>

                                                    <?php

                                                    /*

                                                    foreach ($programas as $periodo){


                                                        echo ' <option value="'.$periodo['codigo'].'">'.$periodo['nombre'].'</option>';

                                                    }



                                                    */

                                                    ?>




                                                </select>
                                            </div>



                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <input class="btn btn-primary" type="submit" value="Consultar">

                                            </div>


                                        </div>





                                    </form>









                                </div>

                            </div>

                            <div class="clearfix"></div>


                        </div>






                        <table id="datatable-hostorial-notas"  class="table table-striped table-bordered" >
                            <thead>
                            <tr>


                                <th width="250">Programa</th>
                                <th >asiganatura</th>
                                <th width="20">semeste</th>
                                <th width="100">nota</th>


                            </tr>
                            </thead>


                            <tbody id="consulta-por-tipo">






                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

        </div>
        <!-- /page content -->

