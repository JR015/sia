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

                        <form class="form-horizontal">


                            <div class="form-group">

                                <label class="col-md-3 control-label" for="name">Buscar estudiante</label>
                                <div class="col-md-9">

                                    <input placeholder="Nombres o apellidos" id="filtro-estudiante" type="text"
                                           class="form-control mayus" onkeyup="return filtrarEstudiante()">

                                </div>


                            </div>

                        </form>


                        <table id="datatable-asignar-directores"
                               class="table table-striped table-bordered dt-responsive"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="100">Documento</th>
                                <th>Nombres y apellidos</th>
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


<div class="modal modal-wide3 fade" id="modal-registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
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

            <form id="form-editar-estudiante" class="form-horizontal" method="post" onsubmit="return editarEstudiante();">
                <div class="modal-body">


                    <div class="form-group">


                        <label class="col-md-2 control-label" for="name">Documento*</label>

                        <div class="col-md-3">

                            <input required id="documento" name="documento" type="number" class="form-control">

                        </div>

                        <label class="col-md-1 control-label" for="name">Tipo*</label>
                        <div class="col-md-2">


                            <select required class="form-control" id="tipo-documento" name="tipo-documento">
                                <option value="">Seleccione</option>
                                <option value="CC">Cedulas de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="RC">Registro Civil</option>


                            </select>


                        </div>

                        <label class="col-md-1 control-label" for="name">De<span>*</span> </label>

                        <div class="col-md-3">

                            <select class="form-control lugares" style="width: 100%" name="lugar-expedicion"
                                    id="lugar-expedicion">
                                <option value=""></option>
                            </select>

                        </div>

                    </div>


                    <div class="form-group">

                        <label class="col-md-2 control-label" for="name">Nombres*</label>
                        <div class="col-md-4">
                            <input required id="nombres" name="nombres" type="text" class="form-control mayus">

                        </div>

                        <label class="col-md-1 control-label" for="name">Apellidos*</label>
                        <div class="col-md-5">
                            <input required id="apellidos" name="apellidos" type="text" class="form-control mayus">

                        </div>


                    </div>





                    <div class="form-group">

                        <label class="col-md-2 control-label" for="name">Correo institucional</label>
                        <div class="col-md-4">
                            <input id="correo-institucional" name="correo-institucional" type="email"
                                   class="form-control mayus">

                        </div>

                        <label class="col-md-1 control-label" for="name">Correo</label>
                        <div class="col-md-5">
                            <input id="correo" name="correo" type="email" class="form-control mayus">

                        </div>

                    </div>


                    <div class="form-group">


                        <label class="col-md-2 control-label" for="name">Ult. grado cursado</label>

                        <div class="col-md-2">

                            <select class="form-control mi-select2" style="width: 100%" name="ultimo-grado-cursado"
                                    id="ultimo-grado-cursado">
                                <option value="">SELECCIONE</option>


                                <?php


                                foreach ($grados as $grado) {

                                    echo ' <option value="' . $grado['numero'] . '">' . $grado['nombre'] . '</option>';

                                }

                                ?>

                            </select>


                        </div>


                        <label class="col-md-1 control-label" for="name">Año</label>
                        <div class="col-md-1">
                            <input class="form-control" min="1900" type="number" max="<?= date('Y') ?>" name="" id="">

                        </div>

                        <label class="col-md-1 control-label" for="name">Institución</label>
                        <div class="col-md-5">
                            <select name="institucion" style="width: 100%" class="form-control" id="institucion">
                                <option value=""></option>
                            </select>
                        </div>


                    </div>


                    <div class="form-group">


                        <label class="col-md-2 control-label" for="name">Dirección</label>
                        <div class="col-md-4">
                            <input id="direccion" name="direccion" type="text" class="form-control mayus">

                        </div>


                        <label class="col-md-1 control-label" for="name">Barrio</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control mayus"  name="barrio" id="barrio">

                        </div>


                    </div>

                    <div class="form-group">


                        <label class="col-md-2 control-label" for="name">Teléfono fijo </label>
                        <div class="col-md-4">

                            <input id="telefono-fijo" name="telefono-fijo" type="number" class="form-control mayus">

                        </div>

                        <label class="col-md-1 control-label" for="name">Celular</label>
                        <div class="col-md-5">
                            <input id="telefono-celular" name="telefono-celular" type="number"
                                   class="form-control mayus">

                        </div>

                    </div>


                    <div class="form-group">






                        <label class="col-md-2 control-label" for="name">Lugar nacimiento*</label>
                        <div class="col-md-4">
                            <select class="form-control mayus lugares" style="width: 100%" required
                                    name="lugar-nacimiento" id="lugar-nacimiento">
                                <option value=""></option>
                            </select>
                        </div>


                        <label class="col-md-1 control-label" for="name">Fecha nacimiento*</label>
                        <div class="col-md-2">

                            <input id="fecha-nacimiento" name="fecha-nacimiento" type="date" class="form-control">

                        </div>

                        <label class="col-md-1 control-label" for="name">Sexo*</label>
                        <div class="col-md-2">

                            <select class="form-control" id="sexo" name="sexo">
                                <option value="">Seleccione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>

                            </select>



                    </div>


                    </div>

                <div class="form-group ">


                    <label class="col-md-2 control-label" for="name">Lugar de residencia </label>
                    <div class="col-md-4">


                        <select required class="form-control lugares" name="lugar-residencia" id="lugar-residencia"
                                style="width: 100%"></select>

                    </div>




                    </div>





                <div class="form-group ">



                    <div class="col-md-offset-1 col-md-10">

<!--                        <table           class="table table-bordered"
                                         cellspacing="0" width="100%">
                            <tr>

                                <td colspan="10" >CONDICIONES ESPECIALES</td>



                            </tr>

                            <tbody id="agrega-registros">



                            <tr>
                                <td colspan="1" class="borde-derecho">

                                    DESPLAZADO
                                    <br>
                                    <input type="checkbox" id="desplazado" class="" name="desplazado" value="">
                                </td>
                                <td colspan="1" class="borde-derecho">

                                    AFRO
                                    <br>
                                    <input name="afro" id="afro" class="" type="checkbox" value="">
                                </td>

                                <td colspan="1" class="borde-derecho">

                                    INDIGENA
                                    <br>

                                    <input name="indigena" id="indigena" class="" type="checkbox" value="">
                                </td>
                                <td colspan="1" class="borde-derecho">

                                    ROM
                                    <br>
                                    <input type="checkbox" class="" name="rom" id="rom" value="">
                                </td>

                                <td colspan="3" class="borde-derecho">

                                    MADRE CABEZA DE FLA
                                    <br>
                                    <input type="checkbox" class="" name="cabeza-familia" id="cabeza-familia" value="">
                                </td>

                                <td colspan="1" class="borde-derecho">

                                    EMBARAZADA
                                    <br>
                                    <input name="embarazada"  class="" id="embarazada" type="checkbox" value="">
                                </td>
                                <td colspan="1" class="borde-derecho">

                                    ADULTO MAYOR
                                    <br>
                                    <input type="checkbox" class="" name="adulto-mayor" id="adulto-mayor" value="">
                                </td>
                                <td colspan="1" class="">

                                    LGBTI
                                    <br>
                                    <input name="lgbti" class="" id="lgbti" type="checkbox" value="">
                                </td>


                            </tr>

                            <tr>




                                <td colspan="1" class="">



                                    OTRO
                                    <br>
                                    <input type="checkbox" class="" name="otra-poblacion-especial" id="otra-poblacion-especial" value="">
                                </td>

                                <td colspan="10">
                                    CUAL
                                    <input class="form-control mayus " disabled id="nombre-otra-poblacion-especial" name="nombre-otra-poblacion-especial" type="text" value="">
                                </td>

                            </tr>

                            <tr>


                                <td colspan="10" class="titulos">

                                    DISCAPACIDAD
                                </td>

                            </tr>

                            <tr>
                                <td colspan="2" class="borde-derecho">

                                    AUDITIVA
                                    <br>
                                    <input type="checkbox" class="" name="discapacidad-auditiva" id="discapacidad-auditiva" value="">
                                </td>
                                <td colspan="3" class="borde-derecho">

                                    COGNITIVA
                                    <br>
                                    <input type="checkbox" value="" class="" name="discapacidad-cognitiva" id="discapacidad-cognitiva">
                                </td>

                                <td colspan="1" class="borde-derecho">

                                    FISÍCA
                                    <br>
                                    <input type="checkbox" value="" class="" id="discapacidad-fisica" name="discapacidad-fisica">
                                </td>


                                <td colspan="1">

                                    OTRO
                                    <br>
                                    <input type="checkbox" value="" class="" name="otra-discapacidad" id="otra-discapacidad">
                                </td>

                                <td colspan="4">

                                    CUAL
                                    <input class="form-control mayus" disabled name="nombre-otra-discapacidad" id="nombre-otra-discapacidad" type="text" value="">
                                </td>


                            </tr>




                            </tbody>

                        </table>


                        -->

                    </div>





                </div>

                <div class="form-group ">

                    <div id="mensaje" class="col-md-12">

                    </div>


                </div>

                </div>

                <div class="modal-footer">

                    <input type="submit" id="bt-operacion" value="Editar" class="btn btn-primary"/>
                    <input type="button" data-dismiss="modal" value="Cancelar" class="btn btn-success"/>

                </div>
            </form>
        </div>
    </div>
</div>
