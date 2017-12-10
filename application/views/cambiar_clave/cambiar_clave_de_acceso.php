<!-- page content -->



<div class="right_col" role="main">
    <div class="">


        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cambiar clave de acceso</h2>
                        <ul class="nav navbar-right panel_toolbox"></ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form id="cambiar-clave" class="form-horizontal form-label-left" method="post" action="<?=base_url('usuario/cambiarClaveDeAcceso')?>" onsubmit="return cambiarClave();">


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Clave de acceso actual :</label>
                                <div class="col-md-8 col-sm-8 col-xs-12" id="div-clave-actual">
                                    <input type="password" class="form-control" value="" name="clave-actual" id="clave_actual">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nueva clave de acceso :</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="password" class="form-control" name="clave-nueva" minlength="8" id="clave_nueva" value="" onchange="comprobarClaves()" onkeyup="comprobarClaves()">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Confirmar nueva clave :</label>
                                <div class="col-md-8 col-sm-8 col-xs-12" id="c">
                                    <input type="password" name="clave-nueva-confirmada" minlength="8"  class="form-control" id="clave_confirmada" value="" onchange="comprobarClaves()" onkeyup="comprobarClaves()">
                                </div>
                            </div>

                            <div class="form-group ">

                                <div id="mensaje" class="col-md-offset-1 col-md-11 text-center">

                                </div>


                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">

                                    <input type="reset"  class="btn btn-primary" value="Cancelar">

                                    <input type="submit" disabled  class="btn btn-success" value="Cambiar clave">

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-4">



                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lo que debe de tener en cuenta!!!</h2>
                        <ul class="nav navbar-right panel_toolbox"></ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="alert alert-warning alert-dismissible fade in" style="color: #31708f; background-color: #d9edf7; border-color: #bce8f1; height: 203px" role="alert">
                            <p class="text-justify"> <span class="fa fa-check-circle"></span> Para realizar el  cambio de clave, debe digitar correctamente su clave de acceso actual y la nueva clave.</p>

                            <p class="text-justify"> <span class="fa fa-check-circle"></span> La clave debe contener como mínino <strong>8</strong> caracteres de longitud.</p>

                            <p class="text-justify"> <span class="fa fa-check-circle"></span> El cambio de clave se realiza de forma inmediata. Podrá usar su nueva clave apartir del próximo inicio de sesión.</p>

                        </div>



                    </div>
                </div>


            </div>




        </div>
    </div>
</div>
<!-- /page content
Rojo
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
 Amarillo
 color: #8a6d3b;
    background-color: #fcf8e3;
    border-color: #faebcc;
 -->


