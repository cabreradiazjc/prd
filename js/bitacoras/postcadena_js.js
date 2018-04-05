
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
			$('#modal-nuevo_tesoreria').modal('hide');  

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
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 16,
		      "lengthMenu": [[16, 32, 48, -1], [16, 32, 48, "Todos"]]

				});
			$('#modal-nuevo_contabilidad').modal('hide');  

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
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 10,
		      "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "Todos"]]

				});
			$('#modal-nuevo_anexos').modal('hide');  

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
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 15,
		      "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "Todos"]]

				});
			$('#modal-nuevo_cyberfinancial').modal('hide');  

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
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 18,
		      "lengthMenu": [[18, 36, 54, -1], [18, 36, 54, "Todos"]]

				});
			$('#modal-nuevo_creditos').modal('hide');  

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
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 12,
		      "lengthMenu": [[12, 36, 48, -1], [12, 36, 48, "Todos"]]

				});
			$('#modal-nuevo_pr').modal('hide');  

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
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false,
		      'pageLength'	: 15,
		      "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "Todos"]]

				});
			$('#modal-nuevo_carteras3').modal('hide');  

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

		var param_balancenormativo = $('#param_balancenormativo').val();
		var param_balancecontable = $('#param_balancecontable').val();
		var param_PBCPEMAA = $('#param_PBCPEMAA').val();
		var param_PBCPEMAB = $('#param_PBCPEMAB').val();
		var param_PBCPEMAD = $('#param_PBCPEMAD').val();
		var param_PBCPEMAC = $('#param_PBCPEMAC').val();
		var param_PBCPED4A = $('#param_PBCPED4A').val();
		var param_PBCPED4B = $('#param_PBCPED4B').val();
		var param_PBCPED4D = $('#param_PBCPED4D').val();
		var param_PBCPED4C = $('#param_PBCPED4C').val();
		var param_PBCPED5A = $('#param_PBCPED5A').val();
		var param_PBCPED5B = $('#param_PBCPED5B').val();
		var param_PBCPED5D = $('#param_PBCPED5D').val();
		var param_PBCPED5C = $('#param_PBCPED5C').val();
		var param_PBCPEE6A = $('#param_PBCPEE6A').val();
		var param_PBCPEE6B = $('#param_PBCPEE6B').val();
		var param_PBCPEE6C = $('#param_PBCPEE6C').val();
		
		if (param_balancenormativo == "00:00:00" &&  
			param_balancecontable == '00:00:00' && 
			param_PBCPEMAA == '00:00:00' &&
			param_PBCPEMAB == '00:00:00' &&
			param_PBCPEMAD == '00:00:00' &&
			param_PBCPEMAC == '00:00:00' &&
			param_PBCPED4A == '00:00:00' &&
			param_PBCPED4B == '00:00:00' &&
			param_PBCPED4D == '00:00:00' &&
			param_PBCPED4C == '00:00:00' &&
			param_PBCPED5A == '00:00:00' &&
			param_PBCPED5B == '00:00:00' &&
			param_PBCPED5D == '00:00:00' &&
			param_PBCPED5C == '00:00:00' &&
			param_PBCPEE6A == '00:00:00' &&
			param_PBCPEE6B == '00:00:00' &&
			param_PBCPEE6C == '00:00:00' ){

			swal("¿Es en serio?", "No todos los tiempos son 00:00:00. ¡Corregir!", "error"); 

		}else{

			if (fecha_tesoreria.length == '' ) {            
            	$("#mensaje_tesoreria").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);

		        } else {
		        	$.ajax({
				        type: 'POST',        
				        data: $('#frm_nuevo_tesoreria').serialize()+'&param_opcion=nuevo_tesoreria',
				        url: '../../controller/bitacoras/postcadena_controller.php',
				        success: function(data){
				            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
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

							setTimeout(listar_tesoreria(),2000);
							

				        },
				        error: function(data){
				                   
				        } 
					});
		        }

		}


		
		
	});




	$('#nuevo_contabilidad').on('click', function(){
		var fecha_contabilidad = $('#param_fecha_contabilidad').val();

		param_PBCPED1A = $('#param_PBCPED1A').val();
		param_PBCPED1B = $('#param_PBCPED1B').val();
		param_PBCPED1D = $('#param_PBCPED1D').val();
		param_PBCPED1C = $('#param_PBCPED1C').val();
		param_PBCPED7A = $('#param_PBCPED7A').val();
		param_PBCPED7B = $('#param_PBCPED7B').val();
		param_PBCPED7D = $('#param_PBCPED7D').val();
		param_PBCPED8A = $('#param_PBCPED8A').val();
		param_PBCPED8B = $('#param_PBCPED8B').val();
		param_PBCPED8D = $('#param_PBCPED8D').val();
		param_PBCPED8C = $('#param_PBCPED8C').val();
		param_PBCPED2A = $('#param_PBCPED2A').val();
		param_PBCPED2B = $('#param_PBCPED2B').val();
		param_PBCPED2D = $('#param_PBCPED2D').val();
		param_PBCPED2C = $('#param_PBCPED2C').val();


		if (
			param_PBCPED1A == "00:00:00" &&  
			param_PBCPED1B == "00:00:00" &&  
			param_PBCPED1D == "00:00:00" &&  
			param_PBCPED1C == "00:00:00" &&  
			param_PBCPED7A == "00:00:00" &&  
			param_PBCPED7B == "00:00:00" &&  
			param_PBCPED7D == "00:00:00" &&  
			param_PBCPED8A == "00:00:00" &&  
			param_PBCPED8B == "00:00:00" &&  
			param_PBCPED8D == "00:00:00" &&  
			param_PBCPED8C == "00:00:00" &&  
			param_PBCPED2A == "00:00:00" &&  
			param_PBCPED2B == "00:00:00" &&  
			param_PBCPED2D == "00:00:00" &&  
			param_PBCPED2C == "00:00:00"


			){
				swal("¿Es en serio?", "No todos los tiempos son 00:00:00. ¡Corregir!", "error");

		}else{
				if (fecha_contabilidad.length == '' ) {            
	           		$("#mensaje_contabilidad").html(
	            	'<div class="alert alert-warning alert-dismissible">'+
	            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
	            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
		        } else {
		        	$.ajax({
				        type: 'POST',        
				        data: $('#frm_nuevo_contabilidad').serialize()+'&param_opcion=nuevo_contabilidad',
				        url: '../../controller/bitacoras/postcadena_controller.php',
				        success: function(data){
				            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
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
							


							setTimeout(listar_contabilidad(),2000);
							

				        },
				        error: function(data){
				                   
				        } 
					});
		        }

		}




		
		
	});





	$('#nuevo_anexos').on('click', function(){
		var fecha_anexos = $('#param_fecha_anexos').val();


		param_PJNGY450 = $('#param_PJNGY450').val();
		param_PBCPEMZA = $('#param_PBCPEMZA').val();
		param_PBCPEMZN = $('#param_PBCPEMZN').val();
		param_PBCPEMZO = $('#param_PBCPEMZO').val();
		param_PBCPEMZC = $('#param_PBCPEMZC').val();
		param_PJNGY244 = $('#param_PJNGY244').val();
		param_PJNGY242 = $('#param_PJNGY242').val();
		param_PJNGY243 = $('#param_PJNGY243').val();
		param_PBCPEMTA = $('#param_PBCPEMTA').val();
		param_PBCPEMTB = $('#param_PBCPEMTB').val();


		if(

			param_PJNGY450  == "00:00:00" && 
			param_PBCPEMZA  == "00:00:00" && 
			param_PBCPEMZN  == "00:00:00" && 
			param_PBCPEMZO  == "00:00:00" && 
			param_PBCPEMZC  == "00:00:00" && 
			param_PJNGY244  == "00:00:00" && 
			param_PJNGY242  == "00:00:00" && 
			param_PJNGY243  == "00:00:00" && 
			param_PBCPEMTA  == "00:00:00" && 
			param_PBCPEMTB  == "00:00:00"  


			){

				swal("¿Es en serio?", "No todos los tiempos son 00:00:00. ¡Corregir!", "error");

		}else{

			if (fecha_anexos.length == '' ) {            
	            $("#mensaje_anexos").html(
	            	'<div class="alert alert-warning alert-dismissible">'+
	            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
	            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
	        } else {
	        	$.ajax({
			        type: 'POST',        
			        data: $('#frm_nuevo_anexos').serialize()+'&param_opcion=nuevo_anexos',
			        url: '../../controller/bitacoras/postcadena_controller.php',
			        success: function(data){
			            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
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
						$('#param_PBCPEMTA').val("00:00:00");
						$('#param_PBCPEMTB').val("00:00:00");

						setTimeout(listar_anexos(),2000);
						

			        },
			        error: function(data){
			                   
			        } 
				});
	        }



		}


		
		
	});




	$('#nuevo_cyberfinancial').on('click', function(){
		var fecha_cyberfinancial = $('#param_fecha_cyberfinancial').val();


		param_PJNGY729 = $('#param_PJNGY729').val();
		param_PJNGY730 = $('#param_PJNGY730').val();
		param_PJNGY754 = $('#param_PJNGY754').val();
		param_PJNGY753 = $('#param_PJNGY753').val();
		param_PJNGY731 = $('#param_PJNGY731').val();
		param_PJNGY758 = $('#param_PJNGY758').val();
		param_PJNGY759 = $('#param_PJNGY759').val();
		param_PJNGY808 = $('#param_PJNGY808').val();
		param_PJNGY747 = $('#param_PJNGY747').val();
		param_PJNGY751 = $('#param_PJNGY751').val();
		param_PJNGY767 = $('#param_PJNGY767').val();
		param_PJNGY768 = $('#param_PJNGY768').val();
		param_PJNGY769 = $('#param_PJNGY769').val();
		param_PJNGY760 = $('#param_PJNGY760').val();
		param_PJNGY766 = $('#param_PJNGY766').val();


		if(
			param_PJNGY729 == "00:00:00" && 
			param_PJNGY730 == "00:00:00" && 
			param_PJNGY754 == "00:00:00" && 
			param_PJNGY753 == "00:00:00" && 
			param_PJNGY731 == "00:00:00" && 
			param_PJNGY758 == "00:00:00" && 
			param_PJNGY759 == "00:00:00" && 
			param_PJNGY808 == "00:00:00" && 
			param_PJNGY747 == "00:00:00" && 
			param_PJNGY751 == "00:00:00" && 
			param_PJNGY767 == "00:00:00" && 
			param_PJNGY768 == "00:00:00" && 
			param_PJNGY769 == "00:00:00" && 
			param_PJNGY760 == "00:00:00" && 
			param_PJNGY766 == "00:00:00" 

			){


			swal("¿Es en serio?", "No todos los tiempos son 00:00:00. ¡Corregir!", "error");
		}else{

			if (fecha_cyberfinancial.length == '' ) {            
	            $("#mensaje_cyberfinancial").html(
	            	'<div class="alert alert-warning alert-dismissible">'+
	            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
	            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
	        } else {
	        	$.ajax({
			        type: 'POST',        
			        data: $('#frm_nuevo_cyberfinancial').serialize()+'&param_opcion=nuevo_cyberfinancial',
			        url: '../../controller/bitacoras/postcadena_controller.php',
			        success: function(data){
			            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
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

						setTimeout(listar_cyberfinancial(),2000);
						

			        },
			        error: function(data){
			                   
			        } 
				});
	        }



		}





		
		
	});



	$('#nuevo_creditos').on('click', function(){
		var fecha_creditos = $('#param_fecha_creditos').val();

		param_PJNGY238 = $('#param_PJNGY238').val();
		param_PJNGY233 = $('#param_PJNGY233').val();
		param_PJNGY234 = $('#param_PJNGY234').val();

		if(
			param_PJNGY238 == "00:00:00" &&
			param_PJNGY233 == "00:00:00" &&
			param_PJNGY234 == "00:00:00" 

			){

			swal("¿Es en serio?", "No todos los tiempos son 00:00:00. ¡Corregir!", "error");		

		}else{

			if (fecha_creditos.length == '' ) {            
	            $("#mensaje_creditos").html(
	            	'<div class="alert alert-warning alert-dismissible">'+
	            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
	            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
		        } else {
		        	$.ajax({
				        type: 'POST',        
				        data: $('#frm_nuevo_creditos').serialize()+'&param_opcion=nuevo_creditos',
				        url: '../../controller/bitacoras/postcadena_controller.php',
				        success: function(data){
				            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
				                        //window.location = "../index.php";
				            $('#param_fecha_creditos').val(convertDate(todaysDate));
							$('#param_PJNGY338').val("");
							$('#param_PJNGY238').val("00:00:00");
							$('#param_PJNGY233').val("00:00:00");
							$('#param_PJNGY234').val("00:00:00");
							


							setTimeout(listar_creditos(),2000);
							

				        },
				        error: function(data){
				                   
				        } 
					});
		        }

		}

		
		
	});



	$('#nuevo_pr').on('click', function(){
		var fecha_pr = $('#param_fecha_pr').val();


		param_PJNGY526 = $('#param_PJNGY526').val();
		param_PJNGY549 = $('#param_PJNGY549').val();
		param_PJNGY579 = $('#param_PJNGY579').val();
		param_PJNGY580 = $('#param_PJNGY580').val();


		if(
			param_PJNGY526 == "00:00:00" &&
			param_PJNGY549 == "00:00:00" &&
			param_PJNGY579 == "00:00:00" &&
			param_PJNGY580 == "00:00:00" 

			){
				swal("¿Es en serio?", "No todos los tiempos son 00:00:00. ¡Corregir!", "error");
		}else{
				if (fecha_pr.length == '' ) {            
		            $("#mensaje_pr").html(
		            	'<div class="alert alert-warning alert-dismissible">'+
		            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
		            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
		        } else {
		        	$.ajax({
				        type: 'POST',        
				        data: $('#frm_nuevo_pr').serialize()+'&param_opcion=nuevo_pr',
				        url: '../../controller/bitacoras/postcadena_controller.php',
				        success: function(data){
				            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
				                        //window.location = "../index.php";
				            $('#param_fecha_pr').val(convertDate(todaysDate));
							$('#param_PJNGY526').val("00:00:00");
							$('#param_PJNGY549').val("00:00:00");
							$('#param_PJNGY579').val("00:00:00");
							$('#param_PJNGY580').val("00:00:00");
							


							setTimeout(listar_pr(),2000);
							

				        },
				        error: function(data){
				                   
				        } 
					});
		        }
		
		}
		
	});



	$('#nuevo_carteras3').on('click', function(){
		var fecha_carteras3 = $('#param_fecha_carteras3').val();

		param_PKNGY251 = $('#param_PKNGY251').val();
		param_PKNGY252 = $('#param_PKNGY252').val();
		param_PKNGY253 = $('#param_PKNGY253').val();
		param_PJNGX516 = $('#param_PJNGX516').val();
		param_PJNGX446 = $('#param_PJNGX446').val();
		param_PJNGX423 = $('#param_PJNGX423').val();
		param_PJNGX395 = $('#param_PJNGX395').val();
		param_PJNGY269 = $('#param_PJNGY269').val();
		param_PJNGX586 = $('#param_PJNGX586').val();
		param_PJNGX582 = $('#param_PJNGX582').val();
		param_PJNGX483 = $('#param_PJNGX483').val();
		param_PJNGX613 = $('#param_PJNGX613').val();
		param_PJNGX641 = $('#param_PJNGX641').val();
		param_PJNGX632 = $('#param_PJNGX632').val();
		param_PJNGX677 = $('#param_PJNGX677').val();


		if(

			param_PKNGY251 == "00:00:00" &&
			param_PKNGY252 == "00:00:00" &&
			param_PKNGY253 == "00:00:00" &&
			param_PJNGX516 == "00:00:00" &&
			param_PJNGX446 == "00:00:00" &&
			param_PJNGX423 == "00:00:00" &&
			param_PJNGX395 == "00:00:00" &&
			param_PJNGY269 == "00:00:00" &&
			param_PJNGX586 == "00:00:00" &&
			param_PJNGX582 == "00:00:00" &&
			param_PJNGX483 == "00:00:00" &&
			param_PJNGX613 == "00:00:00" &&
			param_PJNGX641 == "00:00:00" &&
			param_PJNGX632 == "00:00:00" &&
			param_PJNGX677 == "00:00:00" 

			){

			swal("¿Es en serio?", "No todos los tiempos son 00:00:00. ¡Corregir!", "error");	

		}else{
			if (fecha_carteras3.length == '' ) {            
	            $("#mensaje_carteras3").html(
	            	'<div class="alert alert-warning alert-dismissible">'+
	            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
	            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
	        } else {
	        	$.ajax({
			        type: 'POST',        
			        data: $('#frm_nuevo_carteras3').serialize()+'&param_opcion=nuevo_carteras3',
			        url: '../../controller/bitacoras/postcadena_controller.php',
			        success: function(data){
			            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
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
						$('#param_PJNGX677').val("00:00:00");
						
						setTimeout(listar_carteras3(),2000);
						

			        },
			        error: function(data){
			                   
			        } 
				});
	        }


		}

		
		
	});



});




