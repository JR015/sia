
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

                                        <h2>formulario de busqueda</h2>

                                    </div>



                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">


                                <form id="form-consulta" class="formulario form-horizontal" method="POST"


                                       onsubmit=" consultarMatriculas();" >


                                    <div class="form-group">

                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Período: </label>


                                        <div class="col-md-2 col-sm-12 col-xs-12">

                                            <select name="periodo"  class="form-control select" >


                                                <option value="">TODOS</option>

                                                <?php

                                                foreach ($periodos as $programa){


                                                    echo ' <option value="'.$programa['periodo'].'">'.$programa['periodo'].'</option>';

                                                }



                                                ?>




                                            </select>
                                        </div>





                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Programa: </label>


                                        <div class="col-md-2 col-sm-12 col-xs-12">

                                            <select name="programa"  class="form-control">


                                                <option value="">TODOS</option>

                                                <?php

                                                foreach ($programas as $programa){


                                                    echo ' <option value="'.$programa['codigo'].'">'.$programa['nombre'].'</option>';

                                                }



                                                ?>




                                            </select>
                                        </div>


                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Semestre: </label>


                                        <div class="col-md-1 col-sm-12 col-xs-12">

                                            <select name="semestre"  class="form-control select" >


                                                <option value="">TODOS</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>



                                            </select>
                                        </div>


                                        <label class="control-label col-md-1 col-sm-12 col-xs-12" for="name">Jornada: </label>


                                        <div class="col-md-2 col-sm-12 col-xs-12">

                                            <select name="jornada"  class="form-control select" >


                                                <option value="">TODOS</option>


                                                <?php

                                                foreach ($jornadas as $jornada){

                                                    echo '<option value="'.$jornada['codigo'].'">'.$jornada['nombre'].'</option>';
                                                }





                                                ?>


                                            </select>
                                        </div>

                                        <div class="col-md-1 col-sm-12 col-xs-12">
                                        <input class="btn btn-primary" type="submit" value="Consultar">

                                        </div>


                                    </div>





                            </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <div class="x_panel">
                        <div class="x_title">
                            <h2>LISTADO DE MATRICULAS</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>






                        <table id="datatable-matriculas"  class="table table-striped table-bordered" >
                            <thead>
                            <tr>

                                <th width="20">Período</th>
                                <th width="250">Programa</th>
                                <th >Estudiante</th>
                                <th width="20">Semestre</th>
                                <th width="100">Jornada</th>
                                <th width="10">grupo</th>

                            </tr>
                            </thead>


                            <tbody id="consulta-por-tipo">






                            </tbody>

                        </table>

                    </div>
                </div>
            </div>




            </div>
        <!-- /page content -->

