$(document).ready(function () {




    $("#datatable-grupos").DataTable();




    $( ".close").click(function() {



        location.reload(true);

    });

});









function abrirModalCrearGrupos() {


    $("#titulo-modal").html("Registro de grupos");
    $('#operacion').val("crear");
    $('#bt-operacion').val("Registrar");

    $('#crear-grupo')[0].reset();

    abrirModal("modal-crear-grupo");
}


function abrirModalEditarDocente(documento) {


    $.ajax({
        url: BASE_URL + "docente/consultar",
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

    var periodo = $("#periodo").val();

    var jornada = $("#jornada").val();
    var semestre = $("#numero-semestre").val();
    var numeroGrupo = $("#numero").val();


    if (!programa == "" && !jornada == "" ) {



        $.ajax({
            type: 'POST',
            url: BASE_URL + "coordinador/consultarProximoNumeroDeGrupo",
            data: {programa: programa,semestre:semestre,jornada:jornada},
            success: function (datos) {




                $("#numero").val(datos);




                numeroGrupo = $("#numero").val();

                $("#codigo").val(programa+semestre+jornada+numeroGrupo+"-" + periodo);
            }
        });






    }



    return false;
}


function crearGrupo() {

    event.preventDefault();

    $.ajax({
        type: $('#crear-grupo').attr('method'),
        url: $('#crear-grupo').attr('action'),
        data: $('#crear-grupo').serialize(),
        success: function (resp) {


            if (resp != '-1') {


                var mensaje = '<div class="alert alert-info"><strong>Éxito!</strong> El grupo se ha creado correctamente</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);



                $("#numero").val("");

                $("#grado").focus();
                $("#jornada").val("");





            } else {

                var mensaje = '<div class="alert alert-danger"><strong>Error!</strong>El grupo que intenta crear ya existe</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);

            }

        },

        error: function () {
            alert("Error");

        }

    });



}

