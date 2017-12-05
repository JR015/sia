<div class="login-bg">
    <div class="container">




        <div class="row">

            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-8 div-login">


                    <form id="restablecer-clave" class="form-signin wow fadeInUp" action="<?= base_url('sesion/restablecer_clave') ?>" method="POST">
                        <h2 class="form-signin-heading">Restablecer clave de acceso</h2>
                        <div class="login-wrap">

                            <input type="email" required name="email" id="email-rc" class="form-control mayus"
                                   placeholder="Correo electrónico institucional" autocomplete autofocus title="Introduzca un correo institucional">

                            <div id="error-rc">

                            </div>

                            <br>

                            <button type="submit" class="btn btn-lg btn-login btn-block">Restablecer  <i id="loading-rc" class=""></i>


                            </button>






                        </div>


                    </form>
                </div>





        </div>  <!--row end-->


    </div>
</div>
