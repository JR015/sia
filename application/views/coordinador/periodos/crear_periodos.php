
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Peridos académicos</h2>
                                <ul class="nav navbar-right panel_toolbox">

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">


                                <form id="crear-periodo" method="post" class="form-horizontal form-label-left"  action="<?=base_url('coordinador/crearPeriodo')?>" onsubmit="return crearPeriodo();">


                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Año <span class="required">*</span>
                                        </label>


                                        <div class="col-md-6 col-sm-6 col-xs-12">


                                            <?php

                                             $anio_actual =date('Y');

                                            $anio_siguiente = strtotime ( '+1 year' , strtotime ( $anio_actual ) ) ;
                                            $anio_siguiente = date ( 'Y' , $anio_siguiente );


                                            ?>

                                            <select class="form-control" name="anio" id="">
                                                <option value="">SELECCIONE</option>
                                                <option value="<?= $anio_actual ?>"><?= $anio_actual ?></option>
                                                <option value="<?= $anio_siguiente ?>"><?= $anio_siguiente ?></option>

                                            </select>

                                          </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Período <span>*</span> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <select name="mes" required class="form-control" id="">
                                                <option value="">SELECCIONE</option>
                                                <option value="1">1</option>
                                                <option value="1">2</option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fecha de incio <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">


                                            <input  class="form-control col-md-7 col-xs-12" name="fecha-incio" required="required" type="date">


                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fecha de fin <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">


                                            <input id="name" class="form-control col-md-7 col-xs-12"  name="fecha-fin" required="required" type="date">


                                        </div>
                                    </div>


                                    <div class="form-group ">

                                        <div id="mensaje" class="col-md-offset-3 col-md-6">


                                        </div>


                                    </div>





                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-5">
                                            <button id="send" type="submit" class="btn btn-primary">Aceptar</button>
                                            <button type="reset" class="btn btn-success">Cancelar</button>

                                        </div>
                                    </div>
                                </form>




                            </div>


                        </div>
                    </div>
                </div>



            </div>
        </div>
        <!-- /page content -->
