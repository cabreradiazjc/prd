
window.onload = function(){
	mostrarDatos();	
	info();
}

function mostrarDatos(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_aperturabt'},
		url: '../../controller/bitacoras/aperturabt_controller.php',
		success: function(respuesta){
			$('#table_aperturabt').DataTable().destroy();
			$('#body_aperturabt').html(respuesta);
			$('#table_aperturabt').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting' : [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});

		},
		error: function(respuesta){
			$('#body_aperturabt').html(respuesta);
		}
	});	
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



$(function() {

	

	$('#nuevo_aperturabt').on('click', function(){
		var fecha = $('#param_fecha').val();
		var hora = $('#param_hora').val();
		var observaciones = $('#param_observaciones').val();
  		var tarea =  $('#tarea').val();
  		var user = $('#user').val();
		

		if (fecha.length == '' || hora.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_aperturabt').serialize()+'&param_opcion=nuevo_aperturabt',
		        url: '../../controller/bitacoras/aperturabt_controller.php',
		        success: function(data){
		            $("#mensaje").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
		                        //window.location = "../index.php";
		            $('#param_fecha').val();
		            $('#param_opcion').val('nuevo_aperturabt');
					$("#param_hora").val('');
					$("#param_observaciones").val('');
					
					setTimeout("location.href='../../view/bitacoras/aperturabt.php'",1000)        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

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
		
	});

});




