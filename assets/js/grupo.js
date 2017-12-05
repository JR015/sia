$(document).ready(function () {




    $("#datatable-grupos").DataTable();




    $( ".close").click(function() {



        location.reload(true);

    });

});







function filtrarGrupo() {


    var nombre = $('#filtro-grupo').val();


    $.ajax({
        type: 'POST',
        url: baseUrl + "grupo/filtrar",
        data: {nombre: nombre},
        success: function (datos) {
            $('#agrega-registros').html(datos);
        }
    });


    $("#datatable-grupos").DataTable();

    return false;
}


function abrirModalCrearGrupos() {


    $("#titulo-modal").html("Registro de grupos");
    $('#operacion').val("crear");
    $('#bt-operacion').val("Registrar");

    $('#crear-grupo')[0].reset();

    abrirModal("modal-crear-grupo");
}


function abrirModalEditarDocente(documento) {


    $.ajax({
        url: baseUrl + "docente/consultar",
        type: "POST",
        data: {documento: documento},
        success: function (resp) {

            var docente = eval(resp);

            $.each(docente, function (i, item) {

                $("#documento").val(docente[i].documento);
                $("#nombres").val(docente[i].nombres);
                $("#apellidos").val(docente[i].apellidos);
                $("#fecha-nacimiento").val(docente[i].fecha_nacimiento);
                $("#tipo-documento").val(docente[i].tipo_documento);
                $("#correo").val(docente[i].correo);


                var profesiones = docente[i].profesiones.split(",");

                for (var j = 0; j < profesiones.length; j++) {

                    $('#profesiones').addTag(profesiones[j]);
                }


            });


            $("#titulo-modal").html("Edición de docente");

            $('#operacion').val("editar");
            $('#bt-operacion').val("Editar");

            abrirModal("modal-crear-docente");


        }, error: function () {

            alert("Error");

        }
    });


}


function generarCodigoDeGrupo() {


    var programa = $("#programa").val();
    var semestre = $("#semestre").val();
    var jornada = $("#jornada").val();
    var numeroSemestre = $("#numero-semestre").val();


    if (!programa == "" && !jornada == "") {

       $("#codigo").val(programa+"-"+numeroSemestre+"-"+jornada+"-" + semestre);

      //  $("#codigo").val(programa+"-"+numeroSemestre+""+jornada+"" + semestre);
    }



    return false;
}


function crearGrupo() {


    $.ajax({
        type: $('#crear-grupo').attr('method'),
        url: $('#crear-grupo').attr('action'),
        data: $('#crear-grupo').serialize(),
        success: function (resp) {


            if (resp != '-1') {


                var mensaje = '<div class="alert alert-info"><strong>Éxito!</strong> El grupo se ha creado correctamente</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);


                $('#crear-grupo')[0].reset();

                $("#grado").focus();


                filtrarGrupo();

            } else {

                var mensaje = '<div class="alert alert-danger"><strong>Error!</strong>El grupo que intenta crear ya existe</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);

            }

        },

        error: function () {
            alert("Error");

        }

    });


    return false;
}

