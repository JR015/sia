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

                                <h2>Cargas académicas</h2>

                            </div>

                            <div class="col-xs-2">

                                <button class="right btn btn-primary full-width" onclick="abrirModalAsigancionAcademica()">Nuevo

                                    <i class="fa fa-plus-circle"></i>

                                </button>
                            </div>


                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form  class="form-horizontal" >


                            <div class="form-group">

                                <label class="col-md-2 control-label" for="name">Buscar docente</label>
                                <div class="col-md-6">

                                    <input  placeholder="Nombres o apellidos" id="filtro-docente" type="text" class="form-control">

                                </div>


                                <div class="col-md-3">


                                    <input  readonly id="documento-docente" type="text" class="form-control">


                                </div>

                                <div class="col-md-1">


                                    <button type="button" class="full-width btn btn-primary" onclick="qutarDocente()">

                                        <i class="fa fa-remove"></i>


                                    </button>

                                </div>


                            </div>

                        </form>


                        <table id="datatable-asignar-directores"
                               class="table table-striped table-bordered dt-responsive"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th >Asignatura</th>
                                <th width="150">Grado</th>

                                <th  title="Número de horas semanales" width="80"># horas</th>



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


<div class="modal modal-wide2 fade" id="modal-asignar-carga-academica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">

                    <i class="fa fa-bars"></i>
                    <b id="titulo-modal">Asignación académica</b></h4>
            </div>


            <form id="crear-docente" class="form-horizontal" method="post" action="<?= base_url('docente/crear') ?>"
                  onsubmit="return registrarDocente();">
                <div class="modal-body">




                    <div class="form-group">

                        <label class="col-md-3 control-label" for="name">Docente </label>
                        <div class="col-md-7">

                            <input required id="nombre-docente" placeholder="buscar"  type="text" class="form-control">


                        </div>

                        <div class="col-md-2">

                            <input required id="documento-docente-modal" readonly  type="text" class="form-control">


                        </div>



                    </div>


                    <div class="form-group">

                        <label class="col-md-3 control-label" for="name">Grupo *</label>
                        <div class="col-md-9">

                            <select required class="form-control" name="grado" id="grado" onchange="">
                                <option value="">SELECCIONE</option>


                                <?php

                                foreach ($grupos as $grupo){

                                    echo ' <option value="'.$grupo['codigo'].'">'.$grupo['codigo'].'</option>';

                                }

                                ?>

                            </select>

                        </div>


                    </div>

                    <div class="form-group">

                        <label class="col-md-3 control-label" for="name">Asignatura *</label>
                        <div class="col-md-7">
                            <input required id="apellidos" name="apellidos" type="text" class="form-control mayus">

                        </div>

                        <div class="col-md-2">

                            <input required id="codigo-asignatura" readonly  type="text" class="form-control">


                        </div>


                    </div>




                </div>
                <div class="form-group ">

                    <div id="mensaje" class="col-md-offset-2 col-md-9">

                    </div>


                </div>

                <div class="modal-footer">

                    <input type="button" data-dismiss="modal" value="Cancelar" class="btn btn-success"/>
                    <input type="submit" id="bt-operacion" value="Crear" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>
</div>

