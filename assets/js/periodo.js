function crearPeriodo() {

    event.preventDefault();

    $.ajax({
        url: $("#crear-periodo").attr("action"),
        type: $("#crear-periodo").attr("method"),
        data: $("#crear-periodo").serialize(),
        success: function (resp) {


            $('#mensaje').html(resp).show(200).delay(2000).hide(200);

            $("#crear-periodo")[0].reset();


        }, error: function () {


            alert("error");


        }
    });



}
