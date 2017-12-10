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

                                <h2>Matricula financiera</h2>

                            </div>

                            <div class="col-xs-2"></div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <form id="form-matricula" class="form-horizontal" method="post" action="<?=base_url('coordinador/matriculaFinanciera')?>" onsubmit="return matricular()">


                            <div class="form-group">

                                <label class="col-md-1 control-label" for="name">Documento</label>
                                <div class="col-md-2">

                                    <input readonly required id="documento" name="documento" type="text"
                                            class="form-control">

                                </div>

                                <label class="col-md-2 control-label" for="name">Nombes y apellidos</label>
                                <div class="col-md-6">

                                    <input disabled   type="text" id="nombres-apellidos" class="form-control">

                                </div>


                                <div class="col-md-1">


                                    <button   type="button" class="btn btn-primary full-width" onclick="abrirModalBuscarEstudiante()">
                                        <i class="fa fa-search"></i>
                                    </button>

                                </div>



                            </div>


                            <div class="form-group">


                                <label class="col-md-1 control-label" for="name">Grupo *</label>
                                <div class="col-md-6">




                                    <select required id="grupo" onchange="buscarGrupo()" name="grupo" class="form-control">
                                        <option value="">Seleccione</option>


                                        <?php

                                        foreach ($grupos as $grupo){


                                            echo ' <option value="'.$grupo['codigo'].'">'.$grupo['codigo'].'</option>';
                                        }

                                        ?>


                                    </select>




                                </div>




                                <label class="col-md-1 control-label"  for="name">Programa </label>
                                <div class="col-md-4">


                                    <input disabled   type="text" id="programa" class="form-control">

                                </div>





                            </div>


                            <div class="form-group">

                                <label class="col-md-1 control-label" for="name">Semestre</label>
                                <div class="col-md-3">

                                    <input disabled   type="text" id="semestre" class="form-control">

                                </div>

                                <label class="col-md-1 control-label" for="name">Jornada</label>
                                <div class="col-md-2">

                                    <input disabled   type="text" id="jornada" class="form-control">

                                </div>


                                <label class="col-md-1 control-label"  for="name">Período </label>
                                <div class="col-md-4">


                                    <input disabled   type="text" id="periodo" class="form-control">

                                </div>




                            </div>

                            <div class="form-group ">

                                <div id="mensaje" class="col-md-12">

                                </div>


                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">

                                    <input  class="btn btn-success"  onclick="restablecerFormularioDeMatricular()" type="button" value="Cancelar">

                                    <input  class="btn btn-primary" disabled id="btn-matricular" type="submit" value="Matricular">

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


<div class="modal modal-wide2 fade" id="modal-buscar-estudiante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">

                    <i class="fa fa-bars"></i>
                    <b id="titulo-modal">Buscar estudiante</b></h4>
            </div>


            <form id="crear-grupo" class="form-horizontal" method="post" action="<?= base_url('grupo/crear') ?>"
                  onsubmit="return crearGrupo()">
                <div class="modal-body">


                    <table id="datatable-estudiante" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                        <thead>
                        <tr>

                            <th width="150">Documento</th>
                            <th>Nombres y apellidos</th>

                            <th  class="width100px">Seleccionar</th>

                        </tr>
                        </thead>
                        <tbody >

                        <?php

                            foreach ($estudiantes as $estudiante){



                                $nomres_apellidos = "'".$estudiante['nombres'].' '.$estudiante['apellidos']."'";


                                echo '<tr>

                                        <td>' . $estudiante['documento'] . '</td>
                                        <td>' . $estudiante['nombres'].' '.$estudiante['apellidos'] . '</td>
                                        <td class="text-center"><a href="javascript:seleccionarEstudiante(' . $estudiante['documento'] . ','.$nomres_apellidos.')" class="fa fa-check"></a></td>
                                    
                                    </tr>';

                            }

                        ?>


                        </tbody>

                    </table>
                </div>

            </form>
        </div>
    </div>
</div>

