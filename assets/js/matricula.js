$(document).ready(function () {


    $('#datatable-estudiante').DataTable();


});


function buscarGrupo() {


    var grupo = $('#grupo').val();



    if( grupo!=""){

        $.ajax({
            type: 'POST',
            url: baseUrl + "coordinador/consultarDetallesDeGrupo",
            data: {grupo:grupo},
            success: function (resp) {




                var grupo = eval(resp);


                $.each(grupo, function (i, item) {



                    $("#programa").val(grupo[i].programa);
                    $("#jornada").val(grupo[i].jornada);
                    $("#semestre").val(grupo[i].semestre);
                    $("#periodo").val(grupo[i].periodo);


                });

            },error:function () {

                alert("Error");
            }

        });

    }




    return false;


}





function matricular() {

    event.preventDefault();
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