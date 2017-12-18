
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="clearfix"></div>



                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">


                                <div class="row">

                                    <div class="col-xs-10">

                                        <h2>Listado de matriculas</h2>

                                    </div>



                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">


                                <form id="form-consulta" class="formulario form-horizontal" method="POST"


                                      action="<?= base_url('coordinador/consultarMatriculas') ?>" onsubmit="return consultarMatriculas();" >


                                    <div class="form-group">

                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Período: </label>


                                        <div class="col-md-2 col-sm-12 col-xs-12">

                                            <select name="periodo"  class="form-control select" >


                                                <option value="">TODOS</option>

                                                <?php

                                                foreach ($periodos as $periodo){


                                                    echo ' <option value="'.$periodo['periodo'].'">'.$periodo['periodo'].'</option>';

                                                }



                                                ?>




                                            </select>
                                        </div>





                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Programa: </label>


                                        <div class="col-md-2 col-sm-12 col-xs-12">

                                            <select name="programa"  class="form-control">


                                                <option value="">TODOS</option>

                                                <?php

                                                foreach ($programas as $periodo){


                                                    echo ' <option value="'.$periodo['codigo'].'">'.$periodo['nombre'].'</option>';

                                                }



                                                ?>




                                            </select>
                                        </div>


                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Semestre: </label>


                                        <div class="col-md-1 col-sm-12 col-xs-12">

                                            <select name="semestre"  class="form-control select" >


                                                <option value="">TODOS</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>


                                            </select>
                                        </div>


                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Jornada: </label>


                                        <div class="col-md-2 col-sm-12 col-xs-12">

                                            <select name="jornada"  class="form-control select" >


                                                <option value="">TODOS</option>


                                                <?php

                                                foreach ($jornadas as $jornada){

                                                    echo '<option value="'.$jornada['codigo'].'">'.$jornada['nombre'].'</option>';
                                                }





                                                ?>


                                            </select>
                                        </div>

                                        <div class="col-md-1 col-sm-12 col-xs-12">
                                        <input class="btn btn-primary" type="submit" value="Consultar">

                                        </div>


                                    </div>





                            </form>




                                <div class="row" id="consulta-por-tipo">





                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

