
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

                                        <h2>Inscripciones acádemicas</h2>

                                    </div>

                                    <div class="col-xs-2">

                                        <button class="right btn btn-primary full-width" onclick="abrirModalCrearEstudiante()">Nueva

                                            <i class="fa fa-plus-circle"></i>

                                        </button>
                                    </div>

                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div>

                                    <?php




                                    if ($total==0){

                                        $total=1;
                                    }

                                    ?>

                                <div class="row tile_count">
                                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-user"></i> Artes plásticas</span>
                                        <div class="count"><?=$ap?></div>
                                        <span class="count_bottom"><i class="green"><?= number_format (($ap/$total)*100,1) ?> % </i> de la población</span>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-user"></i> Música Instrumental</span>
                                        <div class="count"><?=$mi?></div>
                                        <span class="count_bottom"><i class="green"><?= number_format (($mi/$total)*100,1) ?> % </i> de la población</span>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-user"></i> Diseño gráfico</span>

                                        <div class="count"><?=$dg?></div>
                                        <span class="count_bottom"><i class="green"><?= number_format (($dg/$total)*100,1) ?> % </i> de la población</span>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-user"></i> Coreografía para la danza</span>
                                        <div class="count"><?=$cd?></div>
                                        <span class="count_bottom"><i class="green"><?= number_format (($cd/$total)*100,1) ?> % </i> de la población</span>

                                    </div>

                                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-user"></i> Taller infantil</span>
                                        <div class="count"><?=$ti?></div>

                                        <span class="count_bottom"><i class="green"><?= number_format (($ti/$total)*100,1) ?> % </i> de la población</span>
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-user"></i>Total inscripciones</span>
                                        <div class="count"><?= (int) $total?></div>
                                     </div>
                                </div>



                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->



        <div class="modal modal-wide2 fade" id="modal-registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">

                            <i class="fa fa-bars"></i>
                            <b id="titulo-modal">Inscripción de estudiantes </b></h4>
                    </div>

                    <!--


                    onsubmit="return crearEstudiante();"
                    -->

                    <form id="form-inscribir-estudiante" class="form-horizontal" method="post" action="<?=base_url('coordinador/inscribirEstudiante')?>" >
                        <div class="modal-body">


                            <div class="form-group">

                                <label class="col-md-2 control-label" for="name">Documento*</label>

                                <div class="col-md-5">

                                    <input required  id="documento" onblur="consultarEstudiante()" name="documento" type="number"  class="form-control">

                                </div>


                                <label class="col-md-2 control-label" for="name">Tipo documento*</label>
                                <div class="col-md-3">


                                    <select required class="form-control" id="tipo-documento" name="tipo-documento">
                                        <option value="">Seleccione</option>
                                        <option value="CC">Cedulas de Ciudadanía</option>
                                        <option value="TI">Tarjeta de Identidad</option>
                                        <option value="RC">Registro Civil</option>


                                    </select>
                                    
                                    
                                </div>




                            </div>


                            <div class="form-group">

                                <label class="col-md-2 control-label" for="name">Nombres*</label>
                                <div class="col-md-10">
                                    <input required  id="nombres" name="nombres" type="text"  class="form-control mayus">

                                </div>


                            </div>




                            <div class="form-group">

                                <label class="col-md-2 control-label" for="name">Apellidos*</label>
                                <div class="col-md-10">
                                    <input required  id="apellidos" name="apellidos" type="text"  class="form-control mayus">

                                </div>


                            </div>

                            <div class="form-group">

                                <label class="col-md-2 control-label" for="name">Correo</label>
                                <div class="col-md-4">
                                    <input    id="correo" name="correo" type="email"  class="form-control mayus">

                                </div>

                                <label class="col-md-1 control-label" for="name">Programa*</label>
                                <div class="col-md-5">


                                    <select required class="form-control" id="programa" name="programa" onchange="buscarGrupo()"  >
                                        <option value="">Seleccione</option>


                                        <?php

                                        foreach ($programas as $programa){

                                            echo '<option value="'.$programa['codigo'].'">'.$programa['nombre'].'</option>';

                                        }

                                        ?>


                                    </select>

                                </div>

                            </div>

                            <div class="form-group">



                                <label class="col-md-2 control-label" for="name">Lugar de residencia*</label>
                                <div class="col-md-4">


                                    <select required class="form-control select" name="municipio" id="municipio" multiple="multiple" style="width: 100%; border: solid;"></select>

                                </div>

                                <label class="col-md-1 control-label" for="name">Dirección</label>
                                <div class="col-md-5">
                                    <input   id="direccion" name="direccion" type="text"  class="form-control mayus">

                                </div>

                            </div>

                            <div class="form-group">



                                <label class="col-md-2 control-label" for="name">Teléfono fijo </label>
                                <div class="col-md-4">

                                    <input   id="telefono-fijo" name="telefono-fijo" type="number"  class="form-control mayus">

                                </div>

                                <label class="col-md-1 control-label" for="name">Celular</label>
                                <div class="col-md-5">
                                    <input   id="telefono-celular" name="telefono-celular" type="number"  class="form-control mayus">

                                </div>

                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label"  for="name">Fecha nacimiento*</label>
                                <div class="col-md-4">

                                    <input required  id="fecha-nacimiento" name="fecha-nacimiento" type="date"  class="form-control">

                                </div>


                                <label class="col-md-1 control-label" for="name">Sexo*</label>
                                <div class="col-md-5">

                                    <select required class="form-control" id="sexo" name="sexo">
                                        <option value="">Seleccione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>

                                    </select>




                                </div>

                            </div>

                        </div>

                        <div class="form-group ">

                            <div id="mensaje" class="col-md-12">

                            </div>


                        </div>

                        <div class="modal-footer">

                            <input type="button" data-dismiss="modal" value="Cancelar" class="btn btn-success"  />
                            <input type="submit" id="bt-operacion" value="Inscribir" class="btn btn-primary"  />
                        </div>
                    </form>
                </div>
            </div>
        </div>
