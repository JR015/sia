
function cerrarModal(id) {

    $('#' + id + '').modal('hide');

}


function abrirModal(id){


    $('#'+id+'').modal({
        show: true,
        backdrop: 'static'
    });


}


