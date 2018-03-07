
window.onload = function(){
	listar_tesoreria();
	listar_contabilidad();
	listar_anexos();
	listar_cyberfinancial();
	listar_creditos();
	listar_pr();
	listar_carteras3();

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

function listar_tesoreria(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_tesoreria'},
		url: '../../controller/bitacoras/postcadena_controller.php',
		success: function(respuesta){
			$('#table_tesoreria').DataTable().destroy();
			$('#body_tesoreria').html(respuesta);
			$('#table_tesoreria').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 17,
		      "lengthMenu": [[17, 34, 51, -1], [17, 34, 51, "Todos"]]

				});
			$('#modal-tesoreria').modal('hide');  

		},
		error: function(respuesta){
			$('#body_tesoreria').html(respuesta);
		}
	});	
}


function listar_contabilidad(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_contabilidad'},
		url: '../../controller/bitacoras/postcadena_controller.php',
		success: function(respuesta){
			$('#table_contabilidad').DataTable().destroy();
			$('#body_contabilidad').html(respuesta);
			$('#table_contabilidad').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'asc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 25

				});
			$('#modal-contabilidad').modal('hide');  

		},
		error: function(respuesta){
			$('#body_contabilidad').html(respuesta);
		}
	});	
}

function listar_anexos(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_anexos'},
		url: '../../controller/bitacoras/postcadena_controller.php',
		success: function(respuesta){
			$('#table_anexos').DataTable().destroy();
			$('#body_anexos').html(respuesta);
			$('#table_anexos').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'asc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 25

				});
			$('#modal-anexos').modal('hide');  

		},
		error: function(respuesta){
			$('#body_anexos').html(respuesta);
		}
	});	
}

function listar_cyberfinancial(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_cyberfinancial'},
		url: '../../controller/bitacoras/postcadena_controller.php',
		success: function(respuesta){
			$('#table_cyberfinancial').DataTable().destroy();
			$('#body_cyberfinancial').html(respuesta);
			$('#table_cyberfinancial').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'asc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 25

				});
			$('#modal-cyberfinancial').modal('hide');  

		},
		error: function(respuesta){
			$('#body_cyberfinancial').html(respuesta);
		}
	});	
}

function listar_creditos(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_creditos'},
		url: '../../controller/bitacoras/postcadena_controller.php',
		success: function(respuesta){
			$('#table_creditos').DataTable().destroy();
			$('#body_creditos').html(respuesta);
			$('#table_creditos').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'asc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 25

				});
			$('#modal-creditos').modal('hide');  

		},
		error: function(respuesta){
			$('#body_creditos').html(respuesta);
		}
	});	
}

function listar_pr(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_pr'},
		url: '../../controller/bitacoras/postcadena_controller.php',
		success: function(respuesta){
			$('#table_pr').DataTable().destroy();
			$('#body_pr').html(respuesta);
			$('#table_pr').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'asc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 25

				});
			$('#modal-pr').modal('hide');  

		},
		error: function(respuesta){
			$('#body_pr').html(respuesta);
		}
	});	
}

function listar_carteras3(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_carteras3'},
		url: '../../controller/bitacoras/postcadena_controller.php',
		success: function(respuesta){
			$('#table_carteras3').DataTable().destroy();
			$('#body_carteras3').html(respuesta);
			$('#table_carteras3').DataTable({

		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'asc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 25

				});
			$('#modal-carteras3').modal('hide');  

		},
		error: function(respuesta){
			$('#body_carteras3').html(respuesta);
		}
	});	
}




$(function() {

	var todaysDate = new Date();

	function convertDate(date) {
	  var yyyy = date.getFullYear().toString();
	  var mm = (date.getMonth()+1).toString();
	  var dd  = date.getDate().toString();

	  var mmChars = mm.split('');
	  var ddChars = dd.split('');

	  return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
	}
	//console.log(convertDate(todaysDate)); 
	// Returns: 2015-08-25


	$('#nuevo_tesoreria').on('click', function(){
		var fecha_tesoreria = $('#param_fecha_tesoreria').val();

		if (fecha_tesoreria.length == '' ) {            
            $("#mensaje_tesoreria").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_tesoreria').serialize()+'&param_opcion=nuevo_tesoreria',
		        url: '../../controller/bitacoras/postcadena_controller.php',
		        success: function(data){
		            $("#mensaje_tesoreria").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_fecha_tesoreria').val(convertDate(todaysDate));
					$('#param_balancenormativo').val("00:00:00");
					$('#param_balancecontable').val("00:00:00");
					$('#param_PBCPEMAA').val("00:00:00");
					$('#param_PBCPEMAB').val("00:00:00");
					$('#param_PBCPEMAD').val("00:00:00");
					$('#param_PBCPEMAC').val("00:00:00");
					$('#param_PBCPED4A').val("00:00:00");
					$('#param_PBCPED4B').val("00:00:00");
					$('#param_PBCPED4D').val("00:00:00");
					$('#param_PBCPED4C').val("00:00:00");
					$('#param_PBCPED5A').val("00:00:00");
					$('#param_PBCPED5B').val("00:00:00");
					$('#param_PBCPED5D').val("00:00:00");
					$('#param_PBCPED5C').val("00:00:00");
					$('#param_PBCPEE6A').val("00:00:00");
					$('#param_PBCPEE6B').val("00:00:00");
					$('#param_PBCPEE6C').val("00:00:00");

					setTimeout(listar_tesoreria(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});




	$('#nuevo_contabilidad').on('click', function(){
		var fecha_contabilidad = $('#param_fecha_contabilidad').val();

		if (fecha_contabilidad.length == '' ) {            
            $("#mensaje_contabilidad").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_contabilidad').serialize()+'&param_opcion=nuevo_contabilidad',
		        url: '../../controller/bitacoras/postcadena_controller.php',
		        success: function(data){
		            $("#mensaje_contabilidad").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_fecha_contabilidad').val(convertDate(todaysDate));
					$('#param_PBCPED1A').val("00:00:00");
					$('#param_PBCPED1B').val("00:00:00");
					$('#param_PBCPED1D').val("00:00:00");
					$('#param_PBCPED1C').val("00:00:00");
					$('#param_PBCPED7A').val("00:00:00");
					$('#param_PBCPED7B').val("00:00:00");
					$('#param_PBCPED7D').val("00:00:00");
					$('#param_PBCPED8A').val("00:00:00");
					$('#param_PBCPED8B').val("00:00:00");
					$('#param_PBCPED8D').val("00:00:00");
					$('#param_PBCPED8C').val("00:00:00");
					$('#param_PBCPED2A').val("00:00:00");
					$('#param_PBCPED2B').val("00:00:00");
					$('#param_PBCPED2D').val("00:00:00");
					$('#param_PBCPED2C').val("00:00:00");
					$('#param_PBCPEMTA').val("00:00:00");
					$('#param_PBCPEMTB').val("00:00:00");


					setTimeout(listar_contabilidad(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});





	$('#nuevo_anexos').on('click', function(){
		var fecha_anexos = $('#param_fecha_anexos').val();

		if (fecha_anexos.length == '' ) {            
            $("#mensaje_anexos").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_anexos').serialize()+'&param_opcion=nuevo_anexos',
		        url: '../../controller/bitacoras/postcadena_controller.php',
		        success: function(data){
		            $("#mensaje_anexos").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";

		            $('#param_fecha_anexos').val(convertDate(todaysDate));
					$('#param_PJNGY450').val("00:00:00");
					$('#param_PBCPEMZA').val("00:00:00");
					$('#param_PBCPEMZN').val("00:00:00");
					$('#param_PBCPEMZO').val("00:00:00");
					$('#param_PBCPEMZC').val("00:00:00");
					$('#param_PJNGY244').val("00:00:00");
					$('#param_PJNGY242').val("00:00:00");
					$('#param_PJNGY243').val("00:00:00");
					

					setTimeout(listar_anexos(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});




	$('#nuevo_cyberfinancial').on('click', function(){
		var fecha_cyberfinancial = $('#param_fecha_cyberfinancial').val();

		if (fecha_cyberfinancial.length == '' ) {            
            $("#mensaje_cyberfinancial").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_cyberfinancial').serialize()+'&param_opcion=nuevo_cyberfinancial',
		        url: '../../controller/bitacoras/postcadena_controller.php',
		        success: function(data){
		            $("#mensaje_cyberfinancial").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_fecha_cyberfinancial').val(convertDate(todaysDate));
					$('#param_PJNGY729').val("00:00:00");
					$('#param_PJNGY730').val("00:00:00");
					$('#param_PJNGY754').val("00:00:00");
					$('#param_PJNGY753').val("00:00:00");
					$('#param_PJNGY731').val("00:00:00");
					$('#param_PJNGY758').val("00:00:00");
					$('#param_PJNGY759').val("00:00:00");
					$('#param_PJNGY808').val("00:00:00");
					$('#param_PJNGY747').val("00:00:00");
					$('#param_PJNGY751').val("00:00:00");
					$('#param_PJNGY767').val("00:00:00");
					$('#param_PJNGY768').val("00:00:00");
					$('#param_PJNGY769').val("00:00:00");
					$('#param_PJNGY760').val("00:00:00");
					$('#param_PJNGY766').val("00:00:00");

					setTimeout(listar_cyberfinancial(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});



	$('#nuevo_creditos').on('click', function(){
		var fecha_creditos = $('#param_fecha_creditos').val();

		if (fecha_creditos.length == '' ) {            
            $("#mensaje_creditos").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_creditos').serialize()+'&param_opcion=nuevo_creditos',
		        url: '../../controller/bitacoras/postcadena_controller.php',
		        success: function(data){
		            $("#mensaje_creditos").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_fecha_creditos').val(convertDate(todaysDate));
					$('#param_PJNGY338').val("00:00:00");
					$('#param_PJNGY238').val("00:00:00");
					$('#param_PJNGY233').val("00:00:00");
					$('#param_PJNGY234').val("00:00:00");
					


					setTimeout(listar_creditos(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});



	$('#nuevo_pr').on('click', function(){
		var fecha_pr = $('#param_fecha_pr').val();

		if (fecha_pr.length == '' ) {            
            $("#mensaje_pr").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_pr').serialize()+'&param_opcion=nuevo_pr',
		        url: '../../controller/bitacoras/postcadena_controller.php',
		        success: function(data){
		            $("#mensaje_pr").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_fecha_pr').val(convertDate(todaysDate));
					$('#param_PJNGY526').val("00:00:00");
					$('#param_PJNGY549').val("00:00:00");
					$('#param_PJNGY579').val("00:00:00");
					$('#param_PJNGY580').val("00:00:00");
					


					setTimeout(listar_pr(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});



	$('#nuevo_carteras3').on('click', function(){
		var fecha_carteras3 = $('#param_fecha_carteras3').val();

		if (fecha_carteras3.length == '' ) {            
            $("#mensaje_carteras3").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(2000).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_carteras3').serialize()+'&param_opcion=nuevo_carteras3',
		        url: '../../controller/bitacoras/postcadena_controller.php',
		        success: function(data){
		            $("#mensaje_carteras3").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show(2000).delay(3500).hide(200);
		                        //window.location = "../index.php";
		            $('#param_fecha_carteras3').val(convertDate(todaysDate));
					$('#param_PKNGY251').val("00:00:00");
					$('#param_PKNGY252').val("00:00:00");
					$('#param_PKNGY253').val("00:00:00");
					$('#param_PJNGX516').val("00:00:00");
					$('#param_PJNGX446').val("00:00:00");
					$('#param_PJNGX423').val("00:00:00");
					$('#param_PJNGX395').val("00:00:00");
					$('#param_PJNGY269').val("00:00:00");
					$('#param_PJNGX586').val("00:00:00");
					$('#param_PJNGX582').val("00:00:00");
					$('#param_PJNGX483').val("00:00:00");
					$('#param_PJNGX613').val("00:00:00");
					$('#param_PJNGX641').val("00:00:00");
					$('#param_PJNGX632').val("00:00:00");

					setTimeout(listar_carteras3(),8000);
					

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});


	
	





});




