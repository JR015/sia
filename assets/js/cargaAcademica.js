var docenteDocumento;
var jornadaCodigo;
var asignatura;
var numeroGrupo;
var nombreDocente;

$(document).ready(function () {

    $("#listado-carga-academica").hide();

    $("#filtro-docente").autocomplete({
        source: BASE_URL + "/docente/autoCompletar",
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();


            $('#documento-docente').val(ui.item.value);
            $(this).prop("disabled", true);
            $(this).val(ui.item.label);


            consultarCargaAcademica();

        }
    });



    $(".select2").select2();




    $('#docente').select2({
        placeholder: 'BUSCAR EL DOCENTE',
        minimumInputLength: 1,
        ajax: {
            url: BASE_URL+"coordinador/filtrarDocente2",
            data: function (params) {
                //console.log(params);
                return {
                    q: params.term, // search term
                    //page: params.id
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(JSON.parse(data), function (obj) {
                        return {id: obj.documento, text: obj.nombres};
                    })
                };
            },
            cache: true
        }
    });



});

$('#docente').on('select2:select', function (e) {

    docenteDocumento = e.params.data.id;

    nombreDocente= e.params.data.text;



});


$('#grupos').on('select2:select', function (e) {

    var data = e.params.data;

    var programa = $("#programa").val();
    var semestre = $("#numero-semestre").val();
    var jornada = data.id;
    var numero = data.title;



    if (programa != "" && semestre != "" && jornada != "" && numero != "") {


        $.ajax({
            type: 'POST',
            url: BASE_URL + "coordinador/consultarAsignaturasPorGrupos",
            data: {programa: programa, semestre: semestre, jornada: jornada, numeroGrupo: numero},
            success: function (resp) {



                jornadaCodigo = jornada;
                numeroGrupo = numero;

                $("#asignaturas").html('<option value="">SELECCIONE: </option>');

                $.each(eval(resp), function (key, value) {

                    var option = '<option value="' + value.codigo + '">' + value.nombre + '</option>';
                    $("#asignaturas").append(option);

                }); // close each()



            }, error: function () {

                alert("error");
            }
        });


    }


});

$('#asignaturas').on('select2:select', function (e) {

    var data = e.params.data;

    asignatura = data.id;


    var x= "Jornada: "+jornadaCodigo+" Docente "+docenteDocumento+" Asignatura "+asignatura +" grupo: "+numeroGrupo;

    console.log(x);


});

function filtrarDocenteCargasAcademicas() {


    event.preventDefault();

    var nombres = $('#filtro-docente').val();

    $.ajax({
        type: 'POST',
        url: BASE_URL + "coordinador/filtrarDocenteCargasAcademicas",
        data: {nombres: nombres},
        success: function (datos) {
            $('#agrega-registros').html(datos);
        }
    });


}

function guardarCargarAcademica() {

    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: BASE_URL + "coordinador/guardarCargaAcademica",
        data: {docenteDocumento: docenteDocumento,jornadaCodigo:jornadaCodigo,asignatura:asignatura,numeroGrupo:numeroGrupo},
        success: function (resp) {


            alert("Se asignaron " +resp+" asiganturas al docente "+nombreDocente);



        }
    });



}


function seleccionarGruposPorAsignatura() {

    event.preventDefault();

    var semestre = $("#numero-semestre").val();
    var programa = $("#programa").val();


    if (semestre != "") {

        $.ajax({
            type: 'POST',
            url: BASE_URL + "coordinador/consultarGruposPorPrograma",
            data: {programa: programa, semestre: semestre},
            success: function (resp) {

                $("#grupos").html('<option value="">SELECCIONE: </option>');





                var json=eval(resp);




                $.each(json, function (key, value) {

                    var option = '<option value="'+value.jornada + '"  name="'+value.semestre+'"  title="'+value.numero+'">'+value.nombre+ '</option>';
                    $("#grupos").append(option);

                }); // close each()








            }
        });

    }

}



function VerFormularioCrearCargaAcademica() {



    $("#form-carga-academica").show();



}

function seleccionarDocenteCargarAcademica(documento,nombres) {



    docenteDocumento=documento;

    $("#datatable-asignar-carga-academica").hide();


    $("#nombre-docente").html("CARGAS ACADÉMICA - "+nombres);


    $("#listado-carga-academica").show();





    $.ajax({
        type: 'POST',
        url: BASE_URL + "coordinador/consultarCargaAcademicaPorDocente",
        data: {documento:documento},

        success: function (data) {

            var ob = JSON.parse(data);

            $('#datatable2').DataTable({
                data: ob,
                columns: [
                    {"data" : "asignatura"},
                    {"data" : "semestre"},
                    {"data" : "jornada"},
                    {"data" : "grupo"}
                ],
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });


        }
    });








}


function consultarCargaAcademica() {

    var documento = $('#documento-docente').val();


    $.ajax({
        type: 'POST',
        url: BASE_URL + "docente/consultarCargaAcademica",
        data: {documento: documento},
        success: function (resp) {


            $('#agrega-registros').html(resp);
        }
    });


    return false;
}

function qutarDocente() {


    $("#filtro-docente").prop("disabled", false);
    $("#filtro-docente").val("");
    $("#filtro-docente").focus();
    $("#documento-docente").val("");

    $('#agrega-registros').html("");

}


