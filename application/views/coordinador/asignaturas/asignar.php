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

                                <h2>Asignar asignaturas</h2>

                            </div>

                            <div class="col-xs-2">

                                <button class="right btn btn-primary full-width" onclick="abrirModalCrearAsignatura()">Nuevo

                                    <i class="fa fa-plus-circle"></i>

                                </button>
                            </div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form  class="form-horizontal" >


                            <div class="form-group">

                                <label class="col-md-3 control-label" for="name">Buscar asignatura</label>
                                <div class="col-md-9">

                                    <input  placeholder="Nombres" id="filtro-asignatura" type="text"
                                           class="form-control mayus" onkeyup="return filtrarAsignatura()">

                                </div>


                            </div>

                        </form>


                        <table id="datatable-asignar-directores"
                               class="table table-striped table-bordered dt-responsive"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="100">Código</th>
                                <th>Nombre</th>
                                <th>Abreviatura</th>
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


<div class="modal modal-wide2 fade" id="modal-crear-asignatura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">

                    <i class="fa fa-bars"></i>
                    <b id="titulo-modal">Registro de asignatura</b></h4>
            </div>


            <form id="crear-asignatura" class="form-horizontal" method="post" action="<?= base_url('coordinador/registrarAsignatura') ?>"
                  onsubmit="return registrarAsiganatura();">
                <div class="modal-body">


                    <div class="form-group">


                        <input required id="operacion" name="operacion" value="crear" type="hidden"
                               class="form-control">

                        <input required  id="codigo" name="codigo" type="hidden" class="form-control ">


                    </div>



                    <div class="form-group">

                        <label class="col-md-3 control-label" for="name">Nombre *</label>
                        <div class="col-md-9">


                            <input required autofocus id="nombre" name="nombre" type="text" class="form-control mayus">

                        </div>


                    </div>


                    <div class="form-group">

                        <label class="col-md-3 control-label" for="name">Nombre corto </label>
                        <div class="col-md-9">
                            <input title="EJEMPLO: LENGUA CASTELLANA, L. CASTELLANA"  id="nombre-corto" name="nombre-corto" type="text" class="form-control mayus">

                        </div>


                    </div>


                    <div class="clearfix">

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

