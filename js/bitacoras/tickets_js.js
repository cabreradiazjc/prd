
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

function ticket_resumen() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'ticket_resumen'},
        url: '../../controller/bitacoras/tickets_controller.php',
        success: function (respuesta) {
           $('#ticket_resumen').html(respuesta);
        },
        error: function (respuesta) {
            $('#ticket_resumen').html(respuesta);
        }
    });
}

function mostrarDatos(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_tickets'},
		url: '../../controller/bitacoras/tickets_controller.php',
		success: function(respuesta){
			$('#table_tickets').DataTable().destroy();
			$('#body_tickets').html(respuesta);
			$('#table_tickets').DataTable({
			  dom: 'Bfrtip',
	          buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print' ],
		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting' : [[4,'desc'] ],
		      //"columnDefs": [{ className: "dt-center", "targets": [ 6 ] } ],
		      'info'        : true,
		      'autoWidth'   : false
		      

				});
			ticket_resumen();
			$('#modal-nuevo_tickets').modal('hide');
			$('#modal-editar_tickets').modal('hide');

		},
		error: function(respuesta){
			$('#body_tickets').html(respuesta);
		}
	});	
}

function eliminar(id){	
	var param_opcion = 'eliminar_tickets';

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
				url: '../../controller/bitacoras/tickets_controller.php',
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
	var param_opcion = 'editar_tickets';
	//idecito = id;
	//var id = $("#param_id").val(objeto[0]);
	$.ajax({
		type: 'POST',
		data:'param_opcion='+param_opcion+'&param_id='+id,
		url: '../../controller/bitacoras/tickets_controller.php',
		success: function(data){
			//console.log(data);
			$('#param_opcion').val('editar_tickets');	
		  	$('#modal-editar_tickets').modal({
		  		show:true,
		  		backdrop:'static',
		  	});
			objeto=JSON.parse(data);
			$('#param_ticket_nro_edit').val(objeto[0]);
			$('#param_usuario_edit').val(objeto[1]);
			$('#param_asunto_edit').val(objeto[2]);
			$('#param_descripcion_edit').val(objeto[3]);	
			$('#param_fecha_edit').val(objeto[4]);
			$('#param_tipo_edit').val(objeto[5]);
			$('#param_estado_edit').val(objeto[6]);
			$('#param_id_edit').val(objeto[7]);

		},
		error: function(data){
			
		}
	});
}

function check(id){	
	var param_opcion = 'check_tickets';
	//idecito = id;
	//var id = $("#param_id").val(objeto[0]);
	$.ajax({
		type: 'POST',
		data:'param_opcion='+param_opcion+'&param_id='+id,
		url: '../../controller/bitacoras/tickets_controller.php',
		success: function(data){
			//console.log(data);
			swal("Good job!", "El ticket fue aplicado.", "success");
		  	setTimeout(mostrarDatos(),2000);   
			

		},
		error: function(data){
			
		}
	});
}



$(function() {

	 var today = new Date();
        var todaybk = '';
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) { dd = '0'+dd } 
        if(mm<10) { mm = '0'+mm } 
        today = yyyy + '-' + mm + '-' + dd;

	$('#nuevo_tickets').on('click', function(){
		var ticket_nro = $('#param_ticket_nro').val();
		var usuario = $('#param_usuario').val();
		var asunto = $('#param_asunto').val();
		var descripcion = $('#param_descripcion').val();
		var fecha = $('#param_fecha').val();
		var tipo = $('#param_tipo').val();
		var estado = $('#param_estado').val();

		//console.log(ticket_nro);

		if (ticket_nro.length == '' || usuario.length == '' || asunto.length == '' || fecha.length == '' || tipo.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_tickets').serialize()+'&param_opcion=nuevo_tickets',
		        url: '../../controller/bitacoras/tickets_controller.php',
		        success: function(data){
		            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_ticket_nro').val('');
					$('#param_usuario').val("");
					$('#param_asunto').val("");
					$('#param_descripcion').val("");
					$('#param_fecha').val(today);
					$('#param_tipo').val('1');

					setTimeout(mostrarDatos(),2000);    
					//setTimeout(mostrarDatos(),1000);

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});


	$('#update_tickets').on('click', function(){
		var ticket_nro_edit = $('#param_ticket_nro_edit').val();
		var usuario_edit = $('#param_usuario_edit').val();
		var asunto_edit = $('#param_asunto_edit').val();
		var descripcion_edit = $('#param_descripcion_edit').val();
		var fecha_edit = $('#param_fecha_edit').val();
		var tipo_edit = $('#param_tipo_edit').val();
		var estado_edit = $('#param_estado_edit').val();
		

		if (ticket_nro_edit.length == '' || usuario_edit.length == '' || asunto_edit.length == '' ) {            
            $("#mensaje_edit").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_update_tickets').serialize()+'&param_opcion=update_tickets',
		        url: '../../controller/bitacoras/tickets_controller.php',
		        success: function(data){
		            swal("Good job!", "Se realizó la edición con éxito.", "success");
		                        //window.location = "../index.php";
		            $('#param_ticket_nro_edit').val('');
		            $('#param_usuario_edit').val('');
					$("#param_asunto_edit").val('');
					$('#param_descripcion_edit').val('');
					$('#param_fecha_edit').val(today);
					$('#param_tipo_edit').val('1');
					$('#param_estado_edit').val('');
					
					
					setTimeout(mostrarDatos(),2000);   

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

	

});




