window.onload = function () {
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


function eliminar(id){  
    var param_opcion = 'eliminar_svt';

    //Parameter
    swal({   
        title: "¿Estás seguro?",   
        text: "El proceso es irreversible.",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Sí, eliminar.",   
        cancelButtonText: "No, cancelar.",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }, function(isConfirm){   
        if (isConfirm) {     
            $.ajax({
                type: 'POST',
                data:'param_opcion='+param_opcion+'&param_id='+id,
                url: '../../controller/bitacoras/svt_controller.php',
                success: function(data){
                    //console.log(data);
                    $('#param_opcion').val(''); 
                    swal("Deleted!", "Eliminado con éxito", "success"); 
                    setTimeout(mostrarDatos(),4000);
                },
                error: function(data){
                    
                }
            });
              
        } else {     
            swal("Cancelled", "No se realizó niguna acción.", "error");   
        } 
    });

    //idecito = id;
    //var id = $("#param_id").val(objeto[0]);
    
}
function svt_resumen() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'svt_resumen'},
        url: '../../controller/bitacoras/svt_controller.php',
        success: function (respuesta) {
           $('#svt_resumen').html(respuesta);
        },
        error: function (respuesta) {
            $('#svt_resumen').html(respuesta);
        }
    });
}

function mostrarDatos() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_svt'},
        url: '../../controller/bitacoras/svt_controller.php',
        success: function (respuesta) {

            $('#table_svtprd').DataTable().destroy();
            $('#body_svtprd').html(respuesta);
            $('#table_svtprd').DataTable({
                dom: 'Bfrtip',
                buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print' ],
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'aaSorting' : [[5,'desc'] ],
                'info': true,
                'autoWidth': false

            });
            svt_resumen();
        },
        error: function (respuesta) {
            $('#body_svtprd').html(respuesta);
        }
    });
}

$(function () {

   var today = new Date();
        var todaybk = '';
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) { dd = '0'+dd } 
        if(mm<10) { mm = '0'+mm } 
        today = yyyy + '-' + mm + '-' + dd;


    $('#nuevo_svt').on('click', function () {

        var param_nroenvio = $('#param_nroenvio').val();
        var param_ambiente = $('#param_ambiente').val();
        var param_origen = $('#param_origen').val();
        var param_motivo = $('#param_motivo').val();
        var param_recepcion_fecha = $('#param_recepcion_fecha').val();
        var param_ejecucion_fecha = $('#param_ejecucion_fecha').val();
        var param_responsable_funcional = $('#param_responsable_funcional').val();
        var param_responsable_tecnico = $('#param_responsable_tecnico').val();
        var param_emergencia = $('#param_emergencia').val();

        if (param_nroenvio.length == '' || param_ambiente.length == '' || param_origen.length == '' || param_motivo.length == '' || param_recepcion_fecha.length == ''|| param_ejecucion_fecha.length == ''|| param_responsable_funcional.length == ''|| param_responsable_tecnico.length == ''|| param_emergencia.length == '') {
            $("#mensaje").html(
                '<div class="alert alert-warning alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
                'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
            $.ajax({
                type: 'POST',
                data: $('#frm_nuevo_svt').serialize() + '&param_opcion=nuevo_svt',
                url: '../../controller/bitacoras/svt_controller.php',
                success: function (data) {
                    swal("Good job!", "¡Guardado satisfactoriamente!", "success");
                    $('#param_nroenvio').val('');
                    $('#param_ambiente').val(1);
                    $('#param_origen').val(1);
                    $('#param_motivo').val('');
                    $('#param_recepcion_fecha').val(todays);
                    $('#param_ejecucion_fecha').val(todays);
                    $('#param_responsable_funcional').val('');
                    $('#param_responsable_tecnico').val('');
                    $('#param_emergencia').val('');

                    setTimeout(mostrarDatos(),2000);

                },
                error: function (data) {

                }
            });
        }

    });
});




