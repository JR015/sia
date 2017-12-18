$(document).ready(function () {

    function onAddTag(tag) {
        alert("Added a tag: " + tag);
    }

    function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
    }

    function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
    }

    $('#profesiones').tagsInput({
        width: 'auto'
    });

});







function filtrarDocente() {


    var nombres = $('#filtro-docente').val();

    $.ajax({
        type: 'POST',
        url: baseUrl+"coordinador/filtrarDocente",
        data:  {nombres:nombres},
        success: function (datos) {
            $('#agrega-registros').html(datos);
        }
    });


}


function abrirModalCrearDocente() {


    $("#titulo-modal").html("Registro de docente");
    $('#operacion').val("registrar");
    $('#bt-operacion').val("Registrar");

    $('#crear-docente')[0].reset();



    abrirModal("modal-registrar");
}



function quitarInputs() {


    var profesiones = $('#profesiones').val();

    profesiones= profesiones.split(",");

    for (var j = 0; j < profesiones.length; j++) {

        $('#profesiones').removeTag(profesiones[j]);
    }


}

function abrirModalEditarDocente(documento) {


    quitarInputs();



    $.ajax({
        url: baseUrl+"coordinador/consultarDocente",
        type: "POST",
        data: {documento: documento},
        success: function (resp) {

            var docente = eval(resp);




            $.each(docente, function (i, item) {

                $("#documento").val(docente[i].documento);
                $("#nombres").val(docente[i].apellidos_nombres);
                $("#fecha-nacimiento").val(docente[i].fecha_nacimiento);
                $("#correo").val(docente[i].correo);

                $("#sexo").val(docente[i].sexo);
                $("#direccion").val(docente[i].direccion);
                $("#telefono-fijo").val(docente[i].telefono_fijo);
                $("#telefono-celular").val(docente[i].telefono_celular);

                $('#municipio').html('<option value="' + docente[i].municipio + '">' + docente[i].nombre_municipio+ '</option>');


                $("#municipio").val(docente[i].municipio);


                $('#documento').attr('readonly', true);


                var profesiones= docente[i].profesiones;

                if(profesiones!=null){

                    profesiones = docente[i].profesiones.split(",");

                    for (var j = 0; j < profesiones.length; j++) {

                        $('#profesiones').addTag(profesiones[j]);
                    }

                }

                var telefonos= docente[i].telefonos;

                if(telefonos!=null){

                    telefonos = docente[i].telefonos.split(",");

                    for (var j = 0; j < telefonos.length; j++) {

                        $('#telefonos').addTag(telefonos[j]);
                    }

                }





            });


            $("#titulo-modal").html("Edición de docente");

            $('#operacion').val("editar");
            $('#bt-operacion').val("Editar");

            abrirModal("modal-registrar");


        }, error: function () {

            alert("Error");

        }
    });


}


function registrarDocente() {


    event.preventDefault();

    $.ajax({
        type: $('#crear-docente').attr('method'),
        url: $('#crear-docente').attr('action'),
        data: $('#crear-docente').serialize(),
        success: function (resp) {


            if (resp != '-1') {


                var op= $('#operacion').val();

                if(op=='editar'){


                    if(resp == '2'){


                        location.reload(true);
                    }else{
                        var mensaje = '<div class="alert alert-warning"><strong>Advertencia!</strong>No se pudo editar </div>';


                    }

                }else{



                    var mensaje = '<div class="alert alert-info"><strong>Éxito!</strong> Él docente se ha registrado correctamente</div>';

                    $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);


                    quitarInputs();

                    $('#crear-docente')[0].reset();

                    $("#documento").focus();
                }



            } else {



                var mensaje = '<div class="alert alert-danger"><strong>Error!</strong> Ya existe un docente con ese documento</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);

            }

        },

        error: function () {
            alert("Error");

        }

    });


}

