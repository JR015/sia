
$(document).ready(function () {



    $('#municipio').select2({


        templateResult: format,
        allowClear:true,
        placeholder: 'Escribir',
        maximumSelectionLength: 1,
        minimumInputLength: 1,
        dropdownParent: $("#modal-registrar"),

        ajax: {
            url: baseUrl+"/coordinador/consultarMunicipios/",
            dataType: 'json',
            data: function (params) {
                var query = {
                    term: params.term,
                    codigo: "123"
                }
                return query;
            },
            delay: 200,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    function format (result) {
        var $state = $(

            '<span><strong>'+' '+result.text +' - '+ result.dpto+'</strong></span>'

        );
        return $state;
    };


});
