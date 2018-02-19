$(document).ready(function () {
    $('#table_incidencias_pendientes').DataTable().destroy();
    $('#table_incidencias_pendientes').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'aaSorting' : [[3,'desc'] ],
        'info': true,
        'autoWidth': false

    });
    ;
    mostrarDatos();
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


function mostrarDatos() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_incidencias'},
        url: '../../controller/bitacoras/incidencias_controller.php',
        success: function (respuesta) {
            $('#table_incidencias').DataTable().destroy();
            $('#body_incidencias').html(respuesta);
            $('#table_incidencias').DataTable({

                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false

            });
        },
        error: function (respuesta) {
            $('#body_incidencias').html(respuesta);
        }
    });
}

/*$(function () {
 $('#nuevo_incidencias').on('click', function () {
 var param_nroenvio = $('#param_nroenvio').val();
 var param_ambiente = $('#param_ambiente').val();
 var param_origen = $('#param_origen').val();
 var param_motivo = $('#param_motivo').val();
 var param_recepcion_fecha = $('#param_recepcion_fecha').val();
 var param_ejecucion_fecha = $('#param_ejecucion_fecha').val();
 var param_responsable_funcional = $('#param_responsable_funcional').val();
 var param_responsable_tecnico = $('#param_responsable_tecnico').val();
 var param_emergencia = $('#param_emergencia').val();
 var param_alertas = $('#param_alertas').val();
 
 if (param_nroenvio.length == '' || param_ambiente.length == '' || param_origen.length == '' || param_motivo.length == '' || param_recepcion_fecha.length == ''|| param_ejecucion_fecha.length == ''|| param_responsable_funcional.length == ''|| param_responsable_tecnico.length == ''|| param_emergencia.length == '') {
 $("#mensaje").html(
 '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3000).hide(200);
 } else {
 $.ajax({
 type: 'POST',
 data: $('#frm_nuevo_svt').serialize() + '&param_opcion=nuevo_svt',
 url: '../../controller/bitacoras/svt_controller.php',
 success: function (data) {
 $("#mensaje").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
 $('#param_nroenvio').val();
 $('#param_ambiente').val();
 $('#param_origen').val();
 $('#param_motivo').val();
 $('#param_recepcion_fecha').val();
 $('#param_ejecucion_fecha').val();
 $('#param_responsable_funcional').val();
 $('#param_responsable_tecnico').val();
 $('#param_emergencia').val();
 $('#param_alertas').val();
 
 setTimeout("location.href='../../view/bitacoras/svt.php'", 500)
 
 },
 error: function (data) {
 
 }
 });
 }
 
 });
 });*/




