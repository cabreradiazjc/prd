$(document).ready(function(){
     mostrarDatosC();
     info();
});

function info(){
    var user =  $('#user').val();
    $.ajax({
        type: 'POST',
        data:{param_opcion: 'listar_info', user: user},
        url: '../../controller/labels/information_controller.php',
        success: function(respuesta){

            $('#info').html(respuesta);

        },
        error: function(respuesta){
            $('#info').html(respuesta);
        }
    }); 
}


function mostrarDatosC() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_categoria'},
        url: '../../controller/bitacoras/categoria_controller.php',
        success: function (respuesta) {
            $('#param_categoria').empty();
            $('#param_categoria').html(respuesta);
            document.getElementById("param_categoria").selectedIndex = "2"
        },
        error: function (respuesta) {
            $('#param_categoria').html(respuesta);
        }
    });
}