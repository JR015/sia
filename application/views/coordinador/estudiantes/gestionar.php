
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

                                        <h2>Gestonar estudiantes</h2>

                                    </div>

                                    <div class="col-xs-2"></div>

                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form  class="form-horizontal" >



                                    <div class="form-group">

                                        <label class="col-md-3 control-label" for="name">Buscar estudiante</label>
                                        <div class="col-md-9">

                                            <input placeholder="Nombres o apellidos" id="filtro-estudiante"  type="text"  class="form-control" onkeyup="return filtrarEstudiante()">

                                        </div>


                                    </div>

                                    </form>



                                <table id="datatable-asignar-directores" class="table table-striped table-bordered dt-responsive"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>

                                        <th width="100">Documento</th>
                                        <th>Apellidos y nombres</th>
                                        <th width="200">Correo</th>
                                        <th width="50">Editar</th>


                                    </tr>
                                    </thead>
                                    <tbody id="agrega-registros">


                                    </tbody>

                                </table>


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
                            <b id="titulo-modal">Actualizar datos de estudiantes </b></h4>
                    </div>

                    <!--


                    onsubmit="return crearEstudiante();"
                    -->

                    <form id="form-editar-estudiante" class="form-horizontal" method="post" action="<?=base_url('coordinador/actualizarEstudiante')?>" onsubmit="return actualizarEstudiante();" >
                        <div class="modal-body">


                            <div class="form-group">


                                <label class="col-md-2 control-label" for="name">Documento*</label>

                                <div class="col-md-5">

                                    <input required  id="documento" name="documento" type="number"  class="form-control">

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

                                <label class="col-md-2 control-label" for="name">Apellidos y nombres*</label>
                                <div class="col-md-10">
                                    <input required  id="nombres" name="nombres" type="text"  class="form-control mayus">

                                </div>


                            </div>







                            <div class="form-group">

                                <label class="col-md-2 control-label" for="name">Correo</label>
                                <div class="col-md-10">
                                    <input    id="correo" name="correo" type="email"  class="form-control mayus">

                                </div>

                            </div>

                            <div class="form-group">





                                <label class="col-md-2 control-label" for="name">Lugar de residencia </label>
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
                            <input type="submit" id="bt-operacion" value="Actualizar" class="btn btn-primary"  />
                        </div>
                    </form>
                </div>
            </div>
        </div>
