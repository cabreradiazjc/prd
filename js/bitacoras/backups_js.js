
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
				$('#modal-nuevo_dbprod').modal('hide');  
				$('#modal-editar_dbprod').modal('hide');

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
				$('#modal-nuevo_can').modal('hide'); 
				$('#modal-editar_can').modal('hide');

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
				$('#modal-nuevo_prd').modal('hide'); 
				$('#modal-editar_prd').modal('hide'); 

			},
			error: function(respuesta){
				$('#body_prd').html(respuesta);
			}
		});	
	}


	function listar_delquda2(){
		$.ajax({
			type: 'POST',
			data:{param_opcion: 'listar_delquda2'},
			url: '../../controller/bitacoras/backups_controller.php',
			success: function(respuesta){
				$('#table_delquda2').DataTable().destroy();
				$('#body_delquda2').html(respuesta);
				$('#table_delquda2').DataTable({

			      'paging'      : true,
			      'lengthChange': true,
			      'searching'   : true,
			      'aaSorting'	: [[0,'desc'] ],
			      'info'        : true,
			      'autoWidth'   : false

					});
				$('#modal-nuevo_cyber').modal('hide'); 
				$('#modal-editar_cyber').modal('hide'); 

			},
			error: function(respuesta){
				$('#body_delquda2').html(respuesta);
			}
		});	
	}


	function listar_rcvry(){
		$.ajax({
			type: 'POST',
			data:{param_opcion: 'listar_rcvry'},
			url: '../../controller/bitacoras/backups_controller.php',
			success: function(respuesta){
				$('#table_rcvry').DataTable().destroy();
				$('#body_rcvry').html(respuesta);
				$('#table_rcvry').DataTable({

			      'paging'      : true,
			      'lengthChange': true,
			      'searching'   : true,
			      'aaSorting'	: [[0,'desc'] ],
			      'info'        : true,
			      'autoWidth'   : false

					});
				$('#modal-nuevo_cyber').modal('hide'); 
				$('#modal-editar_cyber').modal('hide');

			},
			error: function(respuesta){
				$('#body_rcvry').html(respuesta);
			}
		});	
	}

	function listar_cyber(){
		listar_delquda2();
		listar_rcvry();

	}

	function eliminar_dbprod(id){	
		var param_opcion = 'eliminar_dbprod';

		//Parameter
	    swal({   
	        title: "¿Estás seguro?",   
	        text: "Estás eliminando todo registro del backup correspondiente a la fecha. El proceso es irreversible.",   
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
					url: '../../controller/bitacoras/backups_controller.php',
					success: function(data){
						//console.log(data);
						$('#param_opcion').val('');	
						swal("Deleted!", "Eliminado con éxito", "success"); 
						setTimeout(listar_dbprod(),2000);
					},
					error: function(data){
						
					}
				});
	              
	        } else {     
	            swal("Cancelled", "No se realizó niguna acción.", "error");   
	        } 
    	});
	
	}


	function eliminar_can(id){	
		var param_opcion = 'eliminar_can';

		//Parameter
	    swal({   
	        title: "¿Estás seguro?",   
	        text: "Estás eliminando todo registro del backup correspondiente a la fecha. El proceso es irreversible.",   
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
					url: '../../controller/bitacoras/backups_controller.php',
					success: function(data){
						//console.log(data);
						$('#param_opcion').val('');	
						swal("Deleted!", "Eliminado con éxito", "success"); 
						setTimeout(listar_can(),2000);
					},
					error: function(data){
						
					}
				});
	              
	        } else {     
	            swal("Cancelled", "No se realizó niguna acción.", "error");   
	        } 
    	});
	
	}


	function eliminar_prd(id){	
		var param_opcion = 'eliminar_prd';

		//Parameter
	    swal({   
	        title: "¿Estás seguro?",   
	        text: "Estás eliminando todo registro del backup correspondiente a la fecha. El proceso es irreversible.",   
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
					url: '../../controller/bitacoras/backups_controller.php',
					success: function(data){
						//console.log(data);
						$('#param_opcion').val('');	
						swal("Deleted!", "Eliminado con éxito", "success"); 
						setTimeout(listar_prd(),2000);
					},
					error: function(data){
						
					}
				});
	              
	        } else {     
	            swal("Cancelled", "No se realizó niguna acción.", "error");   
	        } 
    	});
	
	}


	function eliminar_cyber(id){	
		var param_opcion = 'eliminar_cyber';

		//Parameter
	    swal({   
	        title: "¿Estás seguro?",   
	        text: "Estás eliminando todo registro del backup correspondiente a la fecha Incluye delquda2 y rcvry. El proceso es irreversible.",   
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
					url: '../../controller/bitacoras/backups_controller.php',
					success: function(data){
						//console.log(data);
						$('#param_opcion').val('');	
						swal("Deleted!", "Eliminado con éxito", "success"); 
						setTimeout(listar_cyber(),2000);
					},
					error: function(data){
						
					}
				});
	              
	        } else {     
	            swal("Cancelled", "No se realizó niguna acción.", "error");   
	        } 
    	});
	
	}

$(function() {

	//Fecha
		var today = new Date();
		var todaybk = '';
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		if(dd<10) { dd = '0'+dd } 
		if(mm<10) { mm = '0'+mm	} 
		today = yyyy + '-' + mm + '-' + dd;
		todaybk = yyyy+mm+dd;
		//document.write(today);
		//end fecha


	$('#nuevo_dbprod').on('click', function(){
		var dbprod_fecha = $('#param_dbprod_fecha').val();
		var dbprod_nombre = $('#param_dbprod_nombre').val();
		var dbprod_com = $('#param_dbprod_com').val();
		var dbprod_sincom = $('#param_dbprod_sincom').val();



		if (dbprod_fecha.length == '' || dbprod_nombre.length == '' || dbprod_com.length == '' || dbprod_sincom.length == '' ) {            
            $("#mensaje_dbprod").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_dbprod').serialize()+'&param_opcion=nuevo_dbprod',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		           swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_dbprod_fecha').val(today);
					$('#param_dbprod_nombre').val('DBPROD_'+todaybk+'_');
					$('#param_dbprod_com').val("");
					$('#param_dbprod_sincom').val("");

					setTimeout(listar_dbprod(),2000);

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
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_can').serialize()+'&param_opcion=nuevo_can',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_can_fecha').val(today);
					$('#param_can_nombre').val('CAN_'+todaybk+'_');
					$('#param_can_com').val("");
					$('#param_can_sincom').val("");

					setTimeout(listar_can(),2000);

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
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_prd').serialize()+'&param_opcion=nuevo_prd',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_prd_fecha').val(today);
					$('#param_prd_nombre').val('PRD_'+todaybk+'_');
					$('#param_prd_com').val("");
					$('#param_prd_sincom').val("");

					setTimeout(listar_prd(),2000);       

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
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_cyber').serialize()+'&param_opcion=nuevo_cyber',
		        url: '../../controller/bitacoras/backups_controller.php',
		        success: function(data){
		            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_cyber_fecha').val(today);
					$('#param_delquda2_nombre').val('expdp_delquda2_'+todaybk+'_0000');
					$('#param_delquda2_com').val("");
					$('#param_delquda2_sincom').val("");

					$('#param_rcvry_nombre').val('expdp_backup_rcvry_'+todaybk+'_0000');
					$('#param_rcvry_com').val('');
					$('#param_rcvry_sincom').val("");

					setTimeout(listar_cyber(),2000);        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});




});




