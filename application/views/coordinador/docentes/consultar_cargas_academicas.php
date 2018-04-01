<!-- page content -->
<div class="right_col" role="main">
    <div class="">


        <div class="clearfix"></div>

        <div class="row" id="datatable-asignar-carga-academica">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">


                        <div class="row">

                            <div class="col-xs-10">


                                <h2 > CARGAS ACADÉMICA</h2>

                            </div>

                            <div class="col-xs-2">

                                <a  class="pull-right full-width btn btn-primary" href="<?=base_url('coordinador/vistaCrearCargaAcademicasDocentes')?>">Nueva

                                    <i class="fa fa-plus-circle"></i>
                                </a>






                            </div>
                            </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" >

                        <!-- onsubmit="guardarCargarAcademica()" -->

                        <form class="form-horizontal" action="<?= base_url('coordinador/guardarCargaAcademica') ?>"
                              method="post">


                            <div class="form-group">

                                <label class="col-md-2 control-label" for="name">Buscar docente</label>
                                <div class="col-md-10">

                                    <input placeholder="Nombres o apellidos" id="filtro-docente" type="text"
                                           class="form-control" onkeyup="return filtrarDocenteCargasAcademicas()">

                                </div>


                            </div>

                        </form>


                        <table id="datatable-asignar-carga-academica"
                               class="table table-striped jambo_table bulk_action"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="150">Documento</th>
                                <th>Apellidos y nombres</th>


                            </tr>
                            </thead>
                            <tbody id="agrega-registros">


                            </tbody>

                        </table>


                    </div>


                </div>
            </div>
        </div>


        <div class="row" id="listado-carga-academica">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">


                        <div class="row"  >




                            <div class="col-xs-10">

                                <h2 id="nombre-docente"> CARGAS ACADÉMICA</h2>

                            </div>




                        </div>

                        <div class="clearfix"></div>
                    </div>


                    <div class="x_content">


                        <table id="datatable2" class="table table-striped table-bordered dt-responsive"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th>ASIGNATURA</th>
                                <th width="20">SEMESTRE</th>
                                <th width="150">JORNADA</th>
                                <th width="20">GRUPO</th>


                            </tr>
                            </thead>


                        </table>
                    </div>

                </div>
            </div>
        </div>



    </div>
</div>

<!-- /page content -->




