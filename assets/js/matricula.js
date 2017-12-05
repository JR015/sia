$(document).ready(function () {


    $('#datatable-estudiante').DataTable();


});


function buscarGrupo() {


    var programa = $('#programa').val();
    var semestre = $('#semestre').val();
    var jornada = $('#jornada').val();


    if(programa!="" &&  semestre!="" && jornada!=""){

        $.ajax({
            type: 'POST',
            url: baseUrl + "matricula/consultarCodigoGrupo",
            data: {programa: programa,semestre:semestre,jornada:jornada},
            success: function (resp) {


                $("#grupo").html(resp);

            }

        });

    }




    return false;


}


function consultarGradoYNivelEscolarPorGrado() {


    var codigo = $('#grupo').val();


    $.ajax({
        type: 'POST',
        url: baseUrl + "matricula/consultarGradoYNivelEscolarPorGrado",
        data: {codigo: codigo},
        success: function (resp) {

            datos = eval(resp);

            $.each(datos, function (i, item) {

                $("#grado").val(datos[i].grado);
                $("#nivel").val(datos[i].nivel);


            });

        }

    });


    return false;


}


function crearMatricula() {


    $.ajax({


        type: $('#form-matricula').attr('method'),
        url: $('#form-matricula').attr('action'),
        data: $('#form-matricula').serialize(),
        success: function (resp) {


            if (resp != '-1') {


                var mensaje = '<div class="alert alert-info"><strong>Éxito!</strong> La matricula se ha registrado correctamente</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);

                $('#form-matricula')[0].reset();
                $("#btn-matricular").prop("disabled", true);


            } else {

                var mensaje = '<div class="alert alert-danger"><strong>Error!</strong> Ya el estudiante se encuentra matriculado</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);

            }

        },

        error: function () {
            alert("Error");

        }

    });


    return false;
}


function abrirModalBuscarEstudiante() {


    abrirModal("modal-buscar-estudiante");

}


function seleccionarEstudiante(documento, nombresApellidos) {

    $("#documento").val(documento);
    $("#nombres-apellidos").val(nombresApellidos);


    $("#btn-matricular").prop("disabled", false);

    cerrarModal("modal-buscar-estudiante");
}


function restablecerFormularioDeMatricular() {


    $("#form-matricula")[0].reset();
    $("#btn-matricular").prop("disabled", true);


    return false;
}