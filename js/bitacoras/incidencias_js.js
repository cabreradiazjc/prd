window.onload = function(){
    mostrarDatos(); 
    info();
}

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


function mostrarDatos() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_incidencias'},
        url: '../../controller/bitacoras/incidencias_controller.php',
        success: function (respuesta) {
            $('#table_incidencias').DataTable().destroy();
            $('#body_incidencias').html(respuesta);
            $('#table_incidencias').DataTable({

            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'aaSorting' : [[3,'desc'] ],
            'info'        : true,
            'autoWidth'   : false

            });
        },
        error: function (respuesta) {
            $('#body_incidencias').html(respuesta);
        }
    });
}



