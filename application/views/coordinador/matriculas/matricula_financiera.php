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

                                <h2>Matricula</h2>

                            </div>

                            <div class="col-xs-2"></div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <!-- -->

                        <form id="form-matricula" class="form-horizontal" method="post" action="<?=base_url('coordinador/matriculaFinanciera')?>" onsubmit=" matricular()" >


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
                                    <input    type="hidden" name="codigo-programa" id="codigo-programa" class="form-control">

                                </div>





                            </div>


                            <div class="form-group">

                                <label class="col-md-1 control-label" for="name">Semestre</label>
                                <div class="col-md-3">

                                    <input readonly   type="text" name="semestre" id="semestre" class="form-control">

                                </div>

                                <label class="col-md-1 control-label" for="name">Jornada</label>
                                <div class="col-md-2">

                                    <input disabled   type="text" id="jornada" class="form-control">

                                </div>


                                <label class="col-md-1 control-label"  for="name">Grupo </label>
                                <div class="col-md-4">


                                    <input disabled   type="text" id="numero" class="form-control">

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



