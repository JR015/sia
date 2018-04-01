

$("#documento-estudiante").blur(function () {


    var documento = $(this).val();


    $.ajax({


        type: "POST",
        url: BASE_URL + "coordinador/consultarEstudiante",
        data: {documento: documento},
        success: function (resp) {


            var estudiante = JSON.parse(resp)[0];


            if(!$.isEmptyObject(estudiante)){


                mostrarDatosEstudiante(estudiante);

            }


        },

        error: function () {
            alert("Error");

        }

    });


});


$('#otra-poblacion-especial').change(function () {


    if ($(this).is(':checked')) {

        $("#nombre-otra-poblacion-especial").prop("disabled", false);

    } else {

        $("#nombre-otra-poblacion-especial").prop("disabled", true);
        $("#nombre-otra-poblacion-especial").val();

    }

});


$('#solicita-auxilio').change(function () {


    if ($(this).is(':checked')) {

        $("#porcentaje-auxilio").prop("disabled", false);

    } else {

        $("#porcentaje-auxilio").prop("disabled", true);
        $("#porcentaje-auxilio").val();

    }

});


$('#institucion').select2({
    placeholder: 'BUSCAR INSTITUCIÓN',
    minimumInputLength: 1,
    ajax: {
        url: BASE_URL + "coordinador/filtrarInstitucion",
        data: function (params) {

            return {
                nombre: params.term, // search term
                //page: params.id
            };
        },
        processResults: function (data) {
            return {
                results: $.map(JSON.parse(data), function (obj) {
                    return {id: obj.codigo, text: obj.nombre + " - " + obj.municipio};
                })
            };
        },
        cache: true
    }
});


$(".mi-select2").select2();

$('.lugares').select2({
    placeholder: 'BUSCAR',
    minimumInputLength: 1,


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



function consultarGrupos() {

    event.preventDefault();

    var semestre = $("#numero-semestre").val();
    var programa = $("#programa").val();
    var jornada = $("#jornada").val();




    if (semestre != "") {

        $.ajax({
            type: 'POST',
            url: BASE_URL + "coordinador/consultarGruposPorPrograma",
            data: {programa: programa, semestre: semestre,jornada:jornada},
            success: function (resp) {

                $("#grupo").html('<option value="">SELECCIONE: </option>');





                var json=eval(resp);




                $.each(json, function (key, value) {

                    var option = '<option value="'+value.codigo + '"  name=""> '+value.nombre+' </option>';
                    $("#grupo").append(option);

                }); // close each()








            },error:function () {

                alert("Error");
            }

        });

    }


}

$('#otra-discapacidad').change(function () {


    if ($(this).is(':checked')) {

        $("#nombre-otra-discapacidad").prop("disabled", false);

    } else {

        $("#nombre-otra-discapacidad").prop("disabled", true);
        $("#nombre-otra-discapacidad").val("");

    }

});


function buscarGrupo() {


    var grupo = $('#grupo').val();


    if (grupo != "") {

        $.ajax({
            type: 'POST',
            url: BASE_URL + "coordinador/consultarDetallesDeGrupo",
            data: {grupo: grupo},
            success: function (resp) {


                var grupo = eval(resp);


                $.each(grupo, function (i, item) {


                    $("#programa").val(grupo[i].programa);
                    $("#jornada").val(grupo[i].jornada);
                    $("#semestre").val(grupo[i].semestre);
                    $("#numero").val(grupo[i].numero);
                    $("#codigo-programa").val(grupo[i].codigo_programa);


                    console.log(grupo);

                });

            }, error: function () {

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