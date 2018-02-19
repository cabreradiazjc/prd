
window.onload = function(){
	listar_dbprod();
	listar_can();
	listar_prd();
	listar_cyber();	
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


function listar_dbprod(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_dbprod'},
		url: '../../controller/bitacoras/backups_controller.php',
		success: function(respuesta){
			$('#table_dbprod').DataTable().destroy();
			$('#body_dbprod').html(respuesta);
			$('#table_dbprod').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-dbprod').modal('hide');  

		},
		error: function(respuesta){
			$('#body_dbprod').html(respuesta);
		}
	});	
}


function listar_can(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_can'},
		url: '../../controller/bitacoras/backups_controller.php',
		success: function(respuesta){
			$('#table_can').DataTable().destroy();
			$('#body_can').html(respuesta);
			$('#table_can').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-can').modal('hide'); 

		},
		error: function(respuesta){
			$('#body_can').html(respuesta);
		}
	});	
}




function listar_prd(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_prd'},
		url: '../../controller/bitacoras/backups_controller.php',
		success: function(respuesta){
			$('#table_prd').DataTable().destroy();
			$('#body_prd').html(respuesta);
			$('#table_prd').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-prd').modal('hide'); 

		},
		error: function(respuesta){
			$('#body_prd').html(respuesta);
		}
	});	
}




function listar_cyber(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_cyber'},
		url: '../../controller/bitacoras/backups_controller.php',
		success: function(respuesta){
			$('#table_cyber').DataTable().destroy();
			$('#body_cyber').html(respuesta);
			$('#table_cyber').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-cyber').modal('hide'); 

		},
		error: function(respuesta){
			$('#body_cyber').html(respuesta);
		}
	});	
}



$(function() {


	$('#nuevo_dbprod').on('click', function(){
		var dbprod_fecha = $('#param_dbprod_fecha').val();
		var dbprod_nombre = $('#param_dbprod_nombre').val();
		var dbprod_com = $('#param_dbprod_com').val();
		var dbprod_sincom = $('#param_dbprod_sincom').val();



		if (dbprod_fecha.length == '' || dbprod_nombre.length == '' || dbprod_com.length == '' || dbprod_sincom.length == '' ) {            
            $("#mensaje_dbprod").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_dbprod').serialize()+'&param_opcion=nuevo_dbprod',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		            $("#mensaje_dbprod").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_dbprod_fecha').val("");
					$('#param_dbprod_nombre').val("");
					$('#param_dbprod_com').val("");
					$('#param_dbprod_sincom').val("");

					setTimeout(listar_dbprod(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

	
	$('#nuevo_can').on('click', function(){
		var can_fecha = $('#param_can_fecha').val();
		var can_nombre = $('#param_can_nombre').val();
		var can_com = $('#param_can_com').val();
		var can_sincom = $('#param_can_sincom').val();



		if (can_fecha.length == '' || can_nombre.length == '' || can_com.length == '' || can_sincom.length == '' ) {            
            $("#mensaje_can").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_can').serialize()+'&param_opcion=nuevo_can',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		            $("#mensaje_can").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_can_fecha').val("");
					$('#param_can_nombre').val("");
					$('#param_can_com').val("");
					$('#param_can_sincom').val("");

					setTimeout(listar_can(),8000);

					//setTimeout("location.href='../../view/bitacoras/backups.php'",1000)        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});
	


	$('#nuevo_prd').on('click', function(){
		var prd_fecha = $('#param_prd_fecha').val();
		var prd_nombre = $('#param_prd_nombre').val();
		var prd_com = $('#param_prd_com').val();
		var prd_sincom = $('#param_prd_sincom').val();



		if (prd_fecha.length == '' || prd_nombre.length == '' || prd_com.length == '' || prd_sincom.length == '' ) {            
            $("#mensaje_prd").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_prd').serialize()+'&param_opcion=nuevo_prd',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		            $("#mensaje_prd").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_prd_fecha').val("");
					$('#param_prd_nombre').val("");
					$('#param_prd_com').val("");
					$('#param_prd_sincom').val("");

					setTimeout(listar_prd(),8000);       

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});




	$('#nuevo_cyber').on('click', function(){
		var cyber_fecha = $('#param_cyber_fecha').val();

		var delquda2_nombre = $('#param_delquda2_nombre').val();
		var delquda2_com = $('#param_delquda2_com').val();
		var delquda2_sincom = $('#param_delquda2_sincom').val();

		var rcvry_nombre = $('#param_rcvry_nombre').val();
		var rcvry_com = $('#param_rcvry_com').val();
		var rcvry_sincom = $('#param_rcvry_sincom').val();




		if (cyber_fecha.length == '' || delquda2_nombre.length == '' || delquda2_com.length == '' || delquda2_sincom.length == '' || rcvry_nombre.length == '' || rcvry_com.length == '' || rcvry_sincom.length == '' ) {            
            $("#mensaje_cyber").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_cyber').serialize()+'&param_opcion=nuevo_cyber',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		            $("#mensaje_cyber").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_cyber_fecha').val("");
					$('#param_delquda2_nombre').val("");
					$('#param_delquda2_com').val("");
					$('#param_delquda2_sincom').val("");

					$('#param_rcvry_nombre').val("");
					$('#param_rcvry_com').val("");
					$('#param_rcvry_sincom').val("");

					setTimeout(listar_cyber(),8000);        

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




