





function filtrarAsignatura() {


    var nombre = $('#filtro-asignatura').val();


    $.ajax({
        type: 'POST',
        url: baseUrl+"coordinador/filtrarAsignatura",
        data:  {nombre:nombre},
        success: function (datos) {

            $('#agrega-registros').html(datos);
        }
    });

    return false;
}


function abrirModalCrearAsignatura() {


    $("#titulo-modal").html("Registro de asignatura");
    $('#operacion').val("registrar");
    $('#bt-operacion').val("Registrar");

    $('#crear-asignatura')[0].reset();

    abrirModal("modal-crear-asignatura");
    $("#nombre").focus();
}




function abrirModalEditarAsignatura(codigo) {

    $.ajax({
        url: baseUrl+"coordinador/consultarAsignatura",
        type: "POST",
        data: {codigo: codigo},
        success: function (resp) {

            var asignatura = eval(resp);

            $.each(asignatura, function (i, item) {

                $("#codigo").val(asignatura[i].codigo);
                $("#nombre").val(asignatura[i].nombre);
                $("#abreviatura").val(asignatura[i].abreviatura);
                $("#programa").val(asignatura[i].programa);
                $("#horas-semanales").val(asignatura[i].horas_semanales);


            });


            $("#titulo-modal").html("Edición de docente");

            $('#operacion').val("editar");
            $('#bt-operacion').val("Editar");

            abrirModal("modal-crear-asignatura");


        }, error: function () {

            alert("Error");

        }
    });


}


function registrarAsiganatura() {


    $.ajax({
        type: $('#crear-asignatura').attr('method'),
        url: $('#crear-asignatura').attr('action'),
        data: $('#crear-asignatura').serialize(),
        success: function (resp) {


            if (resp != '-1') {



                var op= $('#operacion').val();




                    if (op == 'editar') {


                        if(resp == '2'){

                            location.reload(true);

                        }else{
                            var mensaje = '<div class="alert alert-warning"><strong>Advertencia!</strong>No se pudo editar </div>';


                        }

                }else{


                    var mensaje = '<div class="alert alert-info"><strong>Éxito!</strong>La asignatura de registro correcetamente</div>';

                    $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);




                    $('#crear-asignatura')[0].reset();

                    $("#nombre").focus();
                }



            } else {

                var mensaje = '<div class="alert alert-danger"><strong>Error!</strong> Ya existe una asiganatura con es nombre</div>';

                $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);

            }

        },

        error: function () {
            alert("Error");

        }

    });


    return false;
}

