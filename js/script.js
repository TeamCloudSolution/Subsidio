/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    if ($("#frmRestablecer").length > 0) {
        $("#frmRestablecer").submit(function (event) {
            event.preventDefault();
            console.log("test");
            $.ajax({
                url: 'validaremail.php',
                type: 'post',
                dataType: 'json',
                data: $("#frmRestablecer").serializeArray()
            }).done(function (respuesta) {
                console.log(respuesta);
                $("#mensaje").html(respuesta.mensaje);
                $("#email").val('');
            });
        });
    }
});