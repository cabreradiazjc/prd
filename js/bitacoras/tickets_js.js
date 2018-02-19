
window.onload = function(){
	$("#overlay").show();
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
			  'fnInitComplete' : function() { $("#overlay").hide(); },
		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting' : [[4,'desc'] ],
		      //"columnDefs": [{ className: "dt-center", "targets": [ 6 ] } ],
		      'info'        : true,
		      'autoWidth'   : false
		      

				});
			$('#modal-nuevotickets').modal('hide');
			$('#modal-editar_tickets').modal('hide');

		},
		error: function(respuesta){
			$('#body_tickets').html(respuesta);
		}
	});	
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
			console.log(data);
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

$(function() {
	$('#nuevo_tickets').on('click', function(){
		var ticket_nro = $('#param_ticket_nro').val();
		var usuario = $('#param_usuario').val();
		var asunto = $('#param_asunto').val();
		var descripcion = $('#param_descripcion').val();
		var fecha = $('#param_fecha').val();
		var tipo = $('#param_tipo').val();
		var estado = $('#param_estado').val();

		console.log(ticket_nro);

		if (ticket_nro.length == '' || usuario.length == '' || asunto.length == '' || fecha.length == '' || tipo.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_tickets').serialize()+'&param_opcion=nuevo_tickets',
		        url: '../../controller/bitacoras/tickets_controller.php',
		        success: function(data){
		            $("#mensaje").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(200).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_ticket_nro').val("");
					$('#param_usuario').val("");
					$('#param_asunto').val("");
					$('#param_descripcion').val("");
					$('#param_fecha').val("");
					$('#param_tipo').val("");
					$('#param_estado').val("");

					setTimeout("location.href='../../view/bitacoras/tickets.php'",1000)  
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
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_update_tickets').serialize()+'&param_opcion=update_tickets',
		        url: '../../controller/bitacoras/tickets_controller.php',
		        success: function(data){
		            $("#mensaje_edit").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
		                        //window.location = "../index.php";
		            $('#param_ticket_nro_edit').val();
		            $('#param_usuario_edit').val('');
					$("#param_asunto_edit").val('');
					$('#param_descripcion_edit').val();
					$('#param_fecha_edit').val();
					$('#param_tipo_edit').val();
					$('#param_estado_edit').val();
					
					
					setTimeout(mostrarDatos(),10000);   

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




