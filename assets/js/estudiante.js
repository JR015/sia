


function filtrarEstudiante() {

    event.preventDefault();


    var nombres = $('#filtro-estudiante').val();


    $.ajax({
        type: 'POST',
        url: BASE_URL + "coordinador/filtrarEstudiante",
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



function consultarMatriculas() {

    event.preventDefault();

    $.ajax({

        url: BASE_URL+'coordinador/consultarMatriculas',
        type: "POST",
        data: $('#form-consulta').serialize(),

        success: function (resp) {



            // valores = eval(resp);
            $('#consulta-por-tipo').html(resp);
            //     $('#datatable-tipos-propuesta').DataTable();



         $("#datatable-matriculas").DataTable();



        }, error: function () {

            alert("Error");

        }
    });



}


function deshablitarCamposDelFormularioDeInscripcion(estado) {


    $('#tipo-documento').attr('readonly', estado);
    $("#documento").attr('readonly', estado);
    $("#nombres").attr('readonly', estado);
    $("#fecha-nacimiento").attr('readonly', estado);
    $("#tipo-documento").attr('readonly', estado);
    $("#correo").attr('readonly', estado);
    $("#sexo").attr('readonly', estado);
    $("#direccion").attr('readonly', estado);

    $("#telefono").attr('readonly', estado);
    $("#celular").attr('readonly', estado);
    $("#btn-inscribir").attr('readonly', estado);
    $("#municipio").attr('readonly', estado);




}

function abrirModalEditarEstudiante(documento) {




    $.ajax({
        url: BASE_URL + "coordinador/consultarEstudiante",
        type: "POST",
        data: {documento: documento},
        success: function (resp) {




            var estudiante = JSON.parse(resp)[0];

            $("#documento").val(estudiante.documento);

        mostrarDatosEstudiante(estudiante);





            abrirModal("modal-registrar");


        }, error: function () {

            alert("Error");

        }
    });


}

$(".mi-select2").select2({

    dropdownParent: $("#modal-registrar"),
});

$('#institucion').select2({
    placeholder: 'BUSCAR INSTITUCIÓN',
    minimumInputLength: 1,
    dropdownParent: $("#modal-registrar"),
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


function consultarEstudiante() {

   var documento = $("#documento").val();

   console.log(documento);


   if(documento!="" && documento!=undefined){



    $.ajax({
        url: BASE_URL + "coordinador/consultarEstudiante",
        type: "POST",
        data: {documento: documento},
        success: function (resp) {

            var estudiante = eval(resp);





            $.each(estudiante, function (i, item) {

                $("#documento").val(estudiante[i].documento);
                $("#nombres").val(estudiante[i].apellidos_nombres);

                $("#fecha-nacimiento").val(estudiante[i].fecha_nacimiento);
                $("#tipo-documento").val(estudiante[i].tipo_documento);
                $("#correo").val(estudiante[i].correo);
                $("#sexo").val(estudiante[i].sexo);
                $("#direccion").val(estudiante[i].direccion);

                $("#telefono").val(estudiante[i].telefono_fijo);
                $("#celular").val(estudiante[i].telefono_celular);



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

function editarEstudiante() {

    event.preventDefault();

    $.ajax({
        type: "POST",
        url: BASE_URL+"coordinador/editarEstudiante",
        data: $('#form-editar-estudiante').serialize(),
        success: function (resp) {




                    if(resp == '2'){

                        location.reload(true);

                    }else{
                        var mensaje = '<div class="alert alert-warning"><strong>Advertencia!</strong>No se pudo editar </div>';

                        $('#mensaje').html(mensaje).show(200).delay(4000).hide(200);
                    }



        },

        error: function () {
            alert("Error");

        }

    });



}


