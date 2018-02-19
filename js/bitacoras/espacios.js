
window.onload = function(){
	antesCadena();	
	despuesCadena();
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


function antesCadena(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_ac_espacios'},
		url: '../../controller/bitacoras/espacios_controller.php',
		success: function(respuesta){
			$('#table_ac_espacios').DataTable().destroy();
			$('#body_ac_espacios').html(respuesta);
			$('#table_ac_espacios').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'ordering'    : true,
		      'info'        : true,
		      'autoWidth'   : false

				});

		},
		error: function(respuesta){
			$('#body_ac_espacios').html(respuesta);
		}
	});	
}

function despuesCadena(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_dc_espacios'},
		url: '../../controller/bitacoras/espacios_controller.php',
		success: function(respuesta){
			$('#table_dc_espacios').DataTable().destroy();
			$('#body_dc_espacios').html(respuesta);
			$('#table_dc_espacios').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'ordering'    : true,
		      'info'        : true,
		      'autoWidth'   : false

				});

		},
		error: function(respuesta){
			$('#body_dc_espacios').html(respuesta);
		}
	});	
}



$(function() {
	$('#nuevo_tickets').on('click', function(){
		var ticket_id = $('#param_ticket_id').val();
		var usuario = $('#param_usuario').val();
		var asunto = $('#param_asunto').val();
		var descripcion = $('#param_descripcion').val();
		var fecha = $('#param_fecha').val();
		var tipo = $('#param_tipo').val();
		var estado = $('#param_estado').val();

		if (ticket_id.length == '' || usuario.length == '' || asunto.length == '' || fecha.length == '' || tipo.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_tickets').serialize()+'&param_opcion=nuevo_tickets',
		        url: '../../controller/bitacoras/tickets_controller.php',
		        success: function(data){
		            $("#mensaje").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
		                        //window.location = "../index.php";
		            $('#param_ticket_id').val();
					$('#param_usuario').val();
					$('#param_asunto').val();
					$('#param_descripcion').val();
					$('#param_fecha').val();
					$('#param_tipo').val();
					$('#param_estado').val();

					setTimeout("location.href='../../view/bitacoras/tickets.php'",1000)        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});


	 /*PARA REPORTE

		$('#consultarln').on('click', function(){
		var fi = $('#param_fi').val();
		var ff = $('#param_ff').val();
		

		if (fi.length == '' || ff.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_consultarln').serialize()+'&param_opcion=consultarln',
		        url: '../../controller/ln_controller.php',
		        success: function(reportln){
		           	$('#table_ln').DataTable().destroy();
					$('#body_ln').html(reportln);
					$('#table_ln').DataTable({

				      'paging'      : true,
				      'lengthChange': true,
				      'searching'   : true,
				      'ordering'    : true,
				      'info'        : true,
				      'autoWidth'   : false

						});     

		        },
		        error: function(data){
		              $('#body_ln').html(resportln);
		        } 
			});
        }
		
	});*/

});




