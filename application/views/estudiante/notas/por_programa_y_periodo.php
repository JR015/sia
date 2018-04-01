<!-- page content -->
<div class="right_col" role="main">
    <div class="">


        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Notas del semestre actual</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <table id="datatable-responsive"  class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>


<!--                                <th>Asignatura</th>
                                <th width="80" class="text-center">Nota corte 1</th>
                                <th width="80" class="text-center">Nota corte 2</th>
                                <th width="80" class="text-center">Nota corte 3</th>
                                <th width="80" class="text-center">Nota definitiva</th>-->

                                <th>Asignatura</th>
                                <th width="80" title="Nota corte 1" class="text-center">NC1</th>
                                <th width="80" title="Nota corte 2" class="text-center">NC2</th>
                                <th width="80"  title="Nota corte 3"class="text-center">NC3</th>
                                <th width="80" title="Nota definitiva" class="text-center">NDEF</th>

                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            foreach ($asignaturas as $asignatura) {


                                echo '<tr>
                                        
                                               
                                                  <td >' . $asignatura['nombre'] . '</td>
                                                  <td class="text-center">' . $asignatura['nota1'] . '</a></td>
                                                  <td class="text-center">' . $asignatura['nota2'] . '</a></td>
                                                  <td class="text-center">' . $asignatura['nota3'] . '</a></td>
                                                  <td class="text-center"> <b> ' . $asignatura['nota_definitiva'] . '</b></a></td>

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

