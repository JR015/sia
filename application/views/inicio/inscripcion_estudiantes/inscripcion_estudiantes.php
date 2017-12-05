<div class="login-bg">
    <div class="container">


        <div class="row">

            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6 div-login">

                <div class="form-wrapper">
                    <form id="form-inscripcion-estudiante" class="form-inscripcion wow fadeInUp" action="<?= base_url('inscripcion/inscribir_estudiante') ?>" method="POST" onsubmit="return registroEstudiante() ;">
                        <h2 class="form-signin-heading">FORMULARIO DE INSCRIPCIÓN</h2>
                        <div class="login-wrap">


                            <input type="text" required  name="nombres" id="nombre"   class="form-control mayus letras-espacio" placeholder="Nombres" ">
                            <input type="text" required  name="apellidos" id="primer-apellido" class="form-control mayus letras-espacio" placeholder="Apellidos">
                          

                            <select name="programa" id="carrera" class="form-control select" required>

                                <option value="">Seleccione programa académico :</option>

                                <?php


                                foreach ($programas as $programa){

                                    echo  '<option value="'.$programa['codigo'].'">'.$programa['nombre'].'</option>';

                                }

                                ?>


                            </select>


                            <select name="grupo-investigacion" id="programa" class="form-control select mayus" required>

                                <option value="">Seleccione  grupo de investigación :</option>

                                <?php


                                foreach ($grupos as $grupo){

                                    echo  '<option value="'.$grupo['codigo'].'">'.$grupo['nombre'].'</option>';





                                }

                                ?>


                            </select>


                            <!--pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" -->

                            <input type="email" required name="email" id="email" class="form-control mayus"   placeholder="Correo Electrónico Institucional" title="La dirección de correo electrónico debe ser ser institucional" onchange="validarCorreoInstitucional()" onblur="validarCorreoInstitucional()">


                            <input type="password" required name="clave" id="clave" class="form-control mayus" placeholder="Contraseña" minlength="8" onkeyup="comprobarClavesRegistro()">
                            <input type="password" required name="clave-confirmada" id="clave-confirmada" class="form-control mayus" minlength="8" placeholder="confirmar contraseña" onkeyup="comprobarClavesRegistro()">


                            <div id="mensaje">

                            </div>


                            <br>

                            <button  type="submit" class="btn btn-lg btn-login btn-block">


                                <i id="loading" class="">

                                </i>Registrar

                            </button>







                        </div>


                    </form>
                </div>



            </div>

            <br>

            <br>

            <div class="col-lg-6 col-sm-6 col-xs-12 wow fadeInRight">
                <h1>
                    Pasos de inscripción
                </h1>
                <hr>
                <p>
                    <i class="fa fa-check fa-lg pr-10 chulos">
                    </i>
					
					Llene el formulario que aparece en pantalla, todos los campos son obligatorios, la contraseña debe  contener como mínimo 8 carácteres.
                </p>
                <p>
                    <i class="fa fa-check fa-lg pr-10 chulos">
                    </i>
					
				Al completar el formulario, le parecerá un mensaje notificando que la cuenta se creó exitosamente. Para ingresar al sistema, debe ir a su cuenta de correo institucional y activar su cuenta.
					
                </p>
                <p>
                    <i class="fa fa-check fa-lg pr-10 chulos">
                    </i>
					
					
                
				En su bandeja de entrada encontrará un mensaje  del correo <b> coordinacioninvestigacionfcbia@cecar.edu.co </b> con el asunto  <b> Inscripción de estudiante</b>, abra el mensaje y de click sobre el enlace que dice  su  <u>aquí</u> , 
Al hacerlo, su cuenta se activará y el sistema se encargará de llevarlo a la pagina principal del sistema.

				
				
				</p>

                <a target="_blank" href="http://mail.google.com/a/cecar.edu.co" class="btn btn-purchase">


                    <i class="fa fa-envelope"></i> Ir al correo institucional

                </a>

                <!-- Code snippet -->
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <span ></span>
                    </div>
                </div>

            </div>



            <br>
            <br>
            <br>

        </div>  <!--row end-->


    </div>


</div>





