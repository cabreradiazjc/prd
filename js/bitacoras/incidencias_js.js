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
            'aaSorting' : [[2,'desc'] ],
            'info'        : true,
            'autoWidth'   : false

            });
            mostrarDatosP(); 
            mostrarDatosP_edit();
            $('#modal-nuevo_incidencias').modal('hide');
            $('#modal-editar_incidencias').modal('hide');
        },
        error: function (respuesta) {
            $('#body_incidencias').html(respuesta);
        }
    });
}

function mostrarDatosP() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_procesos'},
        url: '../../controller/bitacoras/incidencias_controller.php',
        success: function (respuesta) {
           
            $('#param_procesos').html(respuesta);
        },
        error: function (respuesta) {
            $('#param_procesos').html(respuesta);
        }
    });

}

function mostrarDatosP_edit() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_procesos'},
        url: '../../controller/bitacoras/incidencias_controller.php',
        success: function (respuesta) {
           
            $('#param_procesos_edit').html(respuesta);
        },
        error: function (respuesta) {
            $('#param_procesos_edit').html(respuesta);
        }
    });

}


function eliminar(id){  
    var param_opcion = 'eliminar_incidencias';

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
                url: '../../controller/bitacoras/incidencias_controller.php',
                success: function(data){
                    //console.log(data);
                    $('#param_opcion').val(''); 
                    swal("Deleted!", "Eliminado con éxito", "success"); 
                    setTimeout(mostrarDatos(),2000);
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

function editar(id){    
    var param_opcion = 'editar_incidencias';
    //idecito = id;
    //var id = $("#param_id").val(objeto[0]);
    $.ajax({
        type: 'POST',
        data:'param_opcion='+param_opcion+'&param_id='+id,
        url: '../../controller/bitacoras/incidencias_controller.php',
        success: function(data){
            //console.log(data);
            $('#param_opcion').val('editar_incidencias');    
            $('#modal-editar_incidencias').modal({
                show:true,
                backdrop:'static',
            });
            objeto=JSON.parse(data);
            $('#param_fecha_incidencia_edit').val(objeto[0]);
            $('#param_fecha_solucion_edit').val(objeto[1]);
            $('#param_procesos_edit').val(objeto[2]).trigger('change');
            $('#param_criticidad_edit').val(objeto[3]);
            $('#param_detalle_edit').val(objeto[4]);
            $('#param_id_edit').val(objeto[5]);

        },
        error: function(data){
            
        }
    });
}

$(function() {

     //Fecha
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd = '0'+dd
        } 

        if(mm<10) {
            mm = '0'+mm
        } 

        today = yyyy + '-' + mm + '-' + dd;
        //document.write(today);
        //end fecha

    $('#nuevo_incidencias').on('click', function(){

       


        var fechai = $('#param_fecha_incidencia').val();
        var fechas = $('#param_fecha_solucion').val();
        var proceso = $('#param_procesos').val();
        var criticidad = $('#param_criticidad').val();
        var detalle =  $('#param_detalle').val();
       

        if (fechai.length == '' || fechas.length == '' || proceso.length == '' || criticidad.length == '' || detalle.length == '') {            
            $("#mensaje").html(
                '<div class="alert alert-warning alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
                'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
            $.ajax({
                type: 'POST',        
                data: $('#frm_nuevo_incidencias').serialize()+'&param_opcion=nuevo_incidencias',
                url: '../../controller/bitacoras/incidencias_controller.php',
                success: function(data){
                    swal("Good job!", "¡Guardado satisfactoriamente!", "success");
                                //window.location = "../index.php";
                    $('#param_fecha_incidencia').val(today);
                    $('#param_fecha_solucion').val(today);
                    $("#param_procesos").val('');
                    $("#param_criticidad").val('BAJO');
                    $("#param_detalle").val('');
                    
                    setTimeout(mostrarDatos(),2000);

                },
                error: function(data){
                           
                } 
            });
        }
        
    });

        

    $('#update_incidencias').on('click', function(){

        var fechai = $('#param_fecha_incidencia_edit').val();
        var fechas = $('#param_fecha_solucion_edit').val();
        var proceso = $('#param_procesos_edit').val();
        var criticidad = $('#param_criticidad_edit').val();
        var detalle =  $('#param_detalle_edit').val();
        

         if (fechai.length == '' || fechas.length == '' || proceso.length == '' || criticidad.length == '' || detalle.length == '') {                        
            $("#mensaje").html(
                '<div class="alert alert-warning alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
                'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
            $.ajax({
                type: 'POST',        
                data: $('#frm_update_incidencias').serialize()+'&param_opcion=update_incidencias',
                url: '../../controller/bitacoras/incidencias_controller.php',
                success: function(data){
                    swal("Good job!", "Se realizó la edición con éxito.", "success");
                                //window.location = "../index.php";
                    
                    $('#param_opcion').val('');
                    $('#param_fecha_incidencia_edit').val(today);
                    $("#param_fecha_solucion_edit").val(today);
                    $('#param_procesos_edit').val('');
                    $('#param_criticidad_edit').val('');
                    $("#param_detalle_edit").val('');
                    
                    setTimeout(mostrarDatos(),2000);        

                },
                error: function(data){
                           
                } 
            });
        }
        
    });

});
