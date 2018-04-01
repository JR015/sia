<!-- page content -->
<div class="right_col" role="main">
    <div class="">


        <div class="clearfix"></div>

        <div class="row" id="datatable-asignar-carga-academica"></div>

        <div class="row" id="form-carga-academica">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">


                        <div class="row"  >

                            <div class="col-xs-10">

                                <h2 >ASIGNAR CARGAS ACADÉMICA</h2>

                            </div>


                        </div>

                        <div class="clearfix"></div>
                    </div>


                    <div class="x_content">





                        <form class="form-horizontal" method="post"  >


                            <div class="form-group">

                                <div class="col-md-6">
                                    <label for="nombres">Docente: </label>


                                    <select class="form-control mayus" name="" id="docente">



                                    </select>

                                </div>

                                <div class="col-md-6">

                                    <label for="nombres">Programa: </label>

                                    <select name="" class="form-control select2" id="programa"
                                            onchange="seleccionarGruposPorAsignatura()">


                                        <option value="">Seleccione</option>


                                        <?php

                                        foreach ($programas as $programa) {

                                            echo ' <option value="' . $programa['codigo'] . '">' . $programa['nombre'] . '</option>';

                                        }

                                        ?>

                                    </select>



                                </div>

                            </div>

                            <div class="form-group">

                                <div class="col-md-2">
                                    <label for="nombres">Semestre: </label>


                                    <select class="form-control select2"
                                            onchange="seleccionarGruposPorAsignatura()"
                                            required name="numero-semestre" id="numero-semestre">
                                        <option value="">Seleccione</option>


                                        <?php


                                        foreach ($semestres as $semestre){

                                            echo ' <option value="'.$semestre[' numero'].'">'.$semestre['nombre'].'</option>';

                                        }



                                        ?>

                                    </select>

                                </div>

                                <div class="col-md-4">

                                    <label for="nombres">Grupos: </label>

                                    <select name="" required id="grupos" class="form-control select2">

                                        <option value=""></option>


                                    </select>
                                </div>


                                <div class="col-md-6">

                                    <label for="nombres">Asiganaturas: </label>

                                    <select name="" required id="asignaturas" class="form-control select2">

                                        <option value=""></option>


                                    </select>
                                </div>



                            </div>
                            <div class="form-group">

                                <div class="col-md-offset-11 col-md-1">

                                    <label class="" for="nombres" style="color: white">.</label>

                                    <button class="btn btn-group-xs btn-primary" onclick="guardarCargarAcademica()">

                                        Aceptar
                                    </button>

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




