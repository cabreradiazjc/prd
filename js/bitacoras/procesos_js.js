$(document).ready(function(){
    mostrarDatosP(1);
});

function mostrarDatosP(idcat) {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_procesos',idcat:idcat},
        url: '../../controller/bitacoras/procesos_controller.php',
        success: function (respuesta) {
            $('#param_procesos').select2().empty();
            $('#param_procesos').html(respuesta);
        },
        error: function (respuesta) {
            $('#param_procesos').html(respuesta);
        }
    });
}