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

                                <h2>Gestonar grupos</h2>

                            </div>

                            <div class="col-xs-2">

                                <button class="right btn btn-primary full-width" onclick="abrirModalCrearGrupos()">Nuevo

                                    <i class="fa fa-plus-circle"></i>

                                </button>
                            </div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">




                        <table id="datatable-grupos"
                               class="table table-striped table-bordered dt-responsive"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="100">Código</th>
                                <th>Programa</th>
                                <th width="10px">Semestre</th>
                                <th  width="10px">Jornada</th>

                            </tr>
                            </thead>
                            <tbody id="agrega-registros">


                            <?php

                            foreach ($grupos as $grupo) {

                                echo '<tr>

                                        <td>' . $grupo['codigo'] . '</td>
                                        <td>' . $grupo['programa'] . '</td>
                                         <td class="text-center">' . $grupo['semestre'] . '</td>
                                         <td class="text-center">' .$grupo['jornada'] . '</td>
                 
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


<div class="modal modal-wide2 fade" id="modal-crear-grupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">

                    <i class="fa fa-bars"></i>
                    <b id="titulo-modal">Registro de grupos</b></h4>
            </div>


            <form id="crear-grupo" class="form-horizontal" method="post" action="<?= base_url('coordinador/crearGrupo') ?>"
                  onsubmit="return crearGrupo()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-md-2 control-label" for="name">Programa*</label>


                        <div class="col-md-6">


                            <select required class="form-control" name="programa" id="programa"
                                    onchange="generarCodigoDeGrupo()">
                                <option value="">Seleccione</option>


                                <?php

                                foreach ($programas as $programa) {

                                    echo ' <option value="' . $programa['codigo'] . '">' . $programa['nombre'] . '</option>';

                                }

                                ?>

                            </select>


                        </div>

                        <label class="col-md-1 control-label" for="name">Semeste*</label>
                        <div class="col-md-2">


                            <select class="form-control" onchange="generarCodigoDeGrupo()" required name="numero-semestre" id="numero-semestre">
                                <option value="">Seleccione</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                            </select>


                            <input class="form-control" readonly value="<?=$periodo?>" type="hidden" id="periodo" name="periodo">

                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-md-2 control-label" for="name">Código </label>
                        <div class="col-md-4">


                            <input required id="codigo" name="codigo" type="text" readonly class="form-control ">

                        </div>

                        <label class="col-md-2 control-label" for="name">Jornada*</label>
                        <div class="col-md-3">


                            <select required id="jornada" name="jornada" class="form-control"
                                    onchange="generarCodigoDeGrupo()">
                                <option value="">Seleccione</option>
                                <option value="M">Mañana</option>
                                <option value="T">Tarde</option>
                                <option value="S">Sábados</option>

                            </select>

                        </div>


                    </div>


                    <div class="form-group">

                        <label class="col-md-2 control-label" for="name">Descripción</label>

                        <div class="col-md-9">

                            <textarea id="descripcion" name="descripcion" class="form-control mayus"></textarea>

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

                    <input type="submit" id="bt-operacion" value="Crear" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>
</div>

