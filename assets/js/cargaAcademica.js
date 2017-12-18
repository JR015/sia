$(document).ready(function () {


    $("#filtro-docente").autocomplete({
        source: baseUrl+"/docente/autoCompletar",
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();



            $('#documento-docente').val(ui.item.value);


            $(this).prop("disabled",true);

            $(this).val(ui.item.label);


            consultarCargaAcademica();

        }
    });





    $("#nombre-docente").autocomplete({
        source: baseUrl+"/docente/autoCompletar",
        minLength: 1,
        appendTo: "#modal-asignar-carga-academica",
        select: function(event, ui) {
            event.preventDefault();

            $('#documento-docente-modal').val(ui.item.value);
            $(this).val(ui.item.label);



        }
    });


});




function abrirModalAsigancionAcademica() {

    /*

    $("#titulo-modal").html("Registro de docente");
    $('#operacion').val("crear");
    $('#bt-operacion').val("Registrar");



    */

  // $('#modal-asignar-carga-academica')[0].reset();

    abrirModal("modal-asignar-carga-academica");
}


function consultarCargaAcademica() {

    var documento = $('#documento-docente').val();


    $.ajax({
        type: 'POST',
        url: baseUrl + "docente/consultarCargaAcademica",
        data: {documento: documento},
        success: function (resp) {



            $('#agrega-registros').html(resp);
        }
    });


    return false;
}

function qutarDocente() {


    $("#filtro-docente").prop("disabled",false);
    $("#filtro-docente").val("");
    $("#filtro-docente").focus();
    $("#documento-docente").val("");

    $('#agrega-registros').html("");

}