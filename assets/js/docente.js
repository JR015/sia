


$('.lugares').select2({
    placeholder: 'BUSCAR',
    minimumInputLength: 1,
    allowClear:true,
    dropdownParent: $("#modal-registrar"),

    ajax: {
        url: BASE_URL + "coordinador/filtrarMunicipios",
        data: function (params) {
            //console.log(params);
            return {
                nombre: params.term, // search term
                //page: params.id
            };
        },
        processResults: function (data) {
            return {
                results: $.map(JSON.parse(data), function (obj) {
                    return {id: obj.codigo, text: obj.nombre+" - "+obj.dpto };
                })
            };
        },
        cache: true
    }
});




function filtrarDocente() {


    var nombres = $('#filtro-docente').val();

    $.ajax({
        type: 'POST',
        url: BASE_URL+"coordinador/filtrarDocente",
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




function abrirModalEditarDocente(documento) {






    $.ajax({
        url: BASE_URL+"coordinador/consultarDocente",
        type: "POST",
        data: {documento: documento},
        success: function (resp) {

            var docente = eval(resp);




            $.each(docente, function (i, item) {

                $("#documento").val(docente[i].documento);
                $("#nombres").val(docente[i].nombres);
                $("#apellidos").val(docente[i].apellidos);

                $("#fecha-nacimiento").val(docente[i].fecha_nacimiento);
                $("#correo").val(docente[i].correo);

                $("#sexo").val(docente[i].sexo);
                $("#direccion").val(docente[i].direccion);
                $("#telefono-fijo").val(docente[i].telefono_fijo);
                $("#telefono-celular").val(docente[i].telefono_celular);
                $("#correo-institucional").val(docente[i].correo_institucional);

                $('#municipio').html('<option value="' + docente[i].municipio + '">' + docente[i].nombre_municipio+ '</option>');


                $("#municipio").val(docente[i].municipio);


                $('#documento').attr('readonly', true);







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

