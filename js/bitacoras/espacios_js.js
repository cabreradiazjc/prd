
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
		data:{param_opcion: 'listar_ac'},
		url: '../../controller/bitacoras/espacios_controller.php',
		success: function(respuesta){
			$('#table_ac_espacios').DataTable().destroy();
			$('#body_ac_espacios').html(respuesta);
			$('#table_ac_espacios').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
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
		data:{param_opcion: 'listar_dc'},
		url: '../../controller/bitacoras/espacios_controller.php',
		success: function(respuesta){
			$('#table_dc_espacios').DataTable().destroy();
			$('#body_dc_espacios').html(respuesta);
			$('#table_dc_espacios').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
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


	$('#nuevo_ac').on('click', function(){
		var ac_fecha = $('#param_ac_fecha').val();
		var ac_24 = $('#param_ac_24').val();
		var ac_31 = $('#param_ac_31').val();
		var ac_38 = $('#param_ac_38').val();
		var ac_127 = $('#param_ac_127').val();
		var ac_tedbprod = $('#param_ac_tedbprod').val();
		var ac_tecyber = $('#param_ac_tecyber').val();


		if (ac_fecha.length == '' || ac_24.length == '' || ac_31.length == '' || ac_38.length == '' || ac_127.length == '' || ac_tedbprod.length == '' || ac_tecyber.length == '' ) {            
            $("#mensaje_ac").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_ac').serialize()+'&param_opcion=nuevo_ac',
		        url: '../../controller/bitacoras/espacios_controller.php',
		        success: function(data){
		            $("#mensaje_ac").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
		                        //window.location = "../index.php";
		            $('#param_ac_fecha').val();
					$('#param_ac_24').val();
					$('#param_ac_31').val();
					$('#param_ac_38').val();
					$('#param_ac_127').val();
					$('#param_ac_tedbprod').val();
					$('#param_ac_tecyber').val();

					setTimeout("location.href='../../view/bitacoras/espacios.php'",1000)        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

	$('#nuevo_dc').on('click', function(){
		var ac_fecha = $('#param_dc_fecha').val();
		var ac_24 = $('#param_dc_24').val();
		var ac_31 = $('#param_dc_31').val();
		var ac_38 = $('#param_dc_38').val();
		var ac_127 = $('#param_dc_127').val();
		var ac_tedbprod = $('#param_dc_tedbprod').val();
		var ac_tecyber = $('#param_dc_tecyber').val();


		if (ac_fecha.length == '' || ac_24.length == '' || ac_31.length == '' || ac_38.length == '' || ac_127.length == '' || ac_tedbprod.length == '' || ac_tecyber.length == '' ) {            
            $("#mensaje_dc").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_dc').serialize()+'&param_opcion=nuevo_dc',
		        url: '../../controller/bitacoras/espacios_controller.php',
		        success: function(data){
		            $("#mensaje_dc").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
		                        //window.location = "../index.php";
		            $('#param_dc_fecha').val();
					$('#param_dc_24').val();
					$('#param_dc_31').val();
					$('#param_dc_38').val();
					$('#param_dc_127').val();
					$('#param_dc_tedbprod').val();
					$('#param_dc_tecyber').val();

					setTimeout("location.href='../../view/bitacoras/espacios.php'",1000)        

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




