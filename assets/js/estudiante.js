


function filtrarEstudiante() {

    event.preventDefault();


    var nombres = $('#filtro-estudiante').val();


    $.ajax({
        type: 'POST',
        url: baseUrl + "coordinador/filtrarEstudiante",
        data: {nombres: nombres},
        success: function (resp) {

            $('#agrega-registros').html(resp);
        }
    });



}


function abrirModalCrearEstudiante() {


    $('#form-inscribir-estudiante')[0].reset();
    abrirModal("modal-registrar");

    deshablitarCamposDelFormularioDeInscripcion(false);

}

function consultarInscripciones() {

    event.preventDefault();

    $.ajax({

        url: $('#form-consulta').attr("action"),
        type: "POST",
        data: $('#form-consulta').serialize(),

        success: function (resp) {



            // valores = eval(resp);
            $('#consulta-por-tipo').html(resp);
       //     $('#datatable-tipos-propuesta').DataTable();







        }, error: function () {

            alert("Error");

        }
    });



}


function deshablitarCamposDelFormularioDeInscripcion(estado) {


    $('#tipo-documento').attr('readonly', estado);
    $("#documento").attr('readonly', estado);
    $("#nombres").attr('readonly', estado);
    $("#apellidos").attr('readonly', estado);
    $("#fecha-nacimiento").attr('readonly', estado);
    $("#tipo-documento").attr('readonly', estado);
    $("#correo").attr('readonly', estado);
    $("#sexo").attr('readonly', estado);
    $("#direccion").attr('readonly', estado);

    $("#telefono-fijo").attr('readonly', estado);
    $("#telefono-celular").attr('readonly', estado);


}

function abrirModalEditarEstudiante(documento) {




    $.ajax({
        url: baseUrl + "coordinador/consultarEstudiante",
        type: "POST",
        data: {documento: documento},
        success: function (resp) {

            var estudiante = eval(resp);

            $.each(estudiante, function (i, item) {

                $("#documento").val(estudiante[i].documento);
                $("#nombres").val(estudiante[i].nombres);
                $("#apellidos").val(estudiante[i].apellidos);
                $("#fecha-nacimiento").val(estudiante[i].fecha_nacimiento);
                $("#tipo-documento").val(estudiante[i].tipo_documento);
                $("#correo").val(estudiante[i].correo);
                $("#sexo").val(estudiante[i].sexo);
                $("#direccion").val(estudiante[i].direccion);

                $("#telefono-fijo").val(estudiante[i].telefono_fijo);
                $("#telefono-celular").val(estudiante[i].telefono_celular);



                $('#municipio').html('<option value="' + estudiante[i].municipio + '">' + estudiante[i].nombre_municipio+ '</option>');


                $("#municipio").val(estudiante[i].municipio);


                $('#documento').attr('readonly', true);
                $('#tipo-documento').attr('readonly', true);

            });



            abrirModal("modal-registrar");


        }, error: function () {

            alert("Error");

        }
    });


}



function consultarEstudiante() {

   var documento = $("#documento").val();


    $.ajax({
        url: baseUrl + "coordinador/consultarEstudiante",
        type: "POST",
        data: {documento: documento},
        success: function (resp) {

            var estudiante = eval(resp);

            $.each(estudiante, function (i, item) {

                $("#documento").val(estudiante[i].documento);
                $("#nombres").val(estudiante[i].nombres);
                $("#apellidos").val(estudiante[i].apellidos);
                $("#fecha-nacimiento").val(estudiante[i].fecha_nacimiento);
                $("#tipo-documento").val(estudiante[i].tipo_documento);
                $("#correo").val(estudiante[i].correo);
                $("#sexo").val(estudiante[i].sexo);
                $("#direccion").val(estudiante[i].direccion);

                $("#telefono-fijo").val(estudiante[i].telefono_fijo);
                $("#telefono-celular").val(estudiante[i].telefono_celular);



                $('#municipio').html('<option value="' + estudiante[i].municipio + '">' + estudiante[i].nombre_municipio+ '</option>');


                $("#municipio").val(estudiante[i].municipio);


                deshablitarCamposDelFormularioDeInscripcion(true);


            });


            /*
            $("#titulo-modal").html("Edición de estudiantes");

            $('#operacion').val("editar");
            $('#bt-operacion').val("Editar");

            abrirModal("modal-registrar");

            */


        }, error: function () {

            alert("Error");

        }
    });


}


function inscribirEstudiante() {

    event.preventDefault();

    $.ajax({
        type: $('#form-inscribir-estudiante').attr('method'),
        url: $('#form-inscribir-estudiante').attr('action'),
        data: $('#form-inscribir-estudiante').serialize(),
        success: function (resp) {


            if (resp != '-1') {


                var op = $('#operacion').val();

                if (op == 'editar') {


                    if(resp == '2'){

                        location.reload(true);

                    }else{
                        var mensaje = '<div class="alert alert-warning"><strong>Advertencia!</strong>No se pudo editar </div>';


                    }

                } else if (resp=='1'){


                    var mensaje = '<div class="alert alert-info"><strong>Éxito!</strong>La información del estudiante se ha registrado correctamente</div>';

                    $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);
                    $('#form-inscribir-estudiante')[0].reset();



                    $("#municipio").val("");

                    $("#tipo-documento").focus();
                }

            } else {



                var mensaje = '<div class="alert alert-danger"><strong>Error!</strong> Ya existe un estudiante con ese documento</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);

            }

        },

        error: function () {
            alert("Error");

        }

    });



}

function actualizarEstudiante() {

    event.preventDefault();

    $.ajax({
        type: $('#form-editar-estudiante').attr('method'),
        url: $('#form-editar-estudiante').attr('action'),
        data: $('#form-editar-estudiante').serialize(),
        success: function (resp) {

                    if(resp == '2'){

                        location.reload(true);

                    }else{
                        var mensaje = '<div class="alert alert-warning"><strong>Advertencia!</strong>No se pudo editar </div>';


                    }



        },

        error: function () {
            alert("Error");

        }

    });



}


