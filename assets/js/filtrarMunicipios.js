
$(document).ready(function () {



    $('#municipio').select2({


        templateResult: format,
        allowClear:true,
        placeholder: 'BUSCAR MUNICIPIO',

        ajax: {
            url: BASE_URL+"/coordinador/consultarMunicipios/",
            dataType: 'json',
            data: function (params) {
                var query = {
                    term: params.term
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
