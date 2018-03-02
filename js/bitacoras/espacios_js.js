
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
			  dom: 'Bfrtip',
		      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-nuevo_ac').modal('hide');
			$('#modal-editar_ac').modal('hide');

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
			  dom: 'Bfrtip',
		      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting'	: [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-nuevo_dc').modal('hide');
			$('#modal-editar_dc').modal('hide');

		},
		error: function(respuesta){
			$('#body_dc_espacios').html(respuesta);
		}
	});	
}

function eliminar_ac(id){	
	var param_opcion = 'eliminar_ac';

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
				url: '../../controller/bitacoras/espacios_controller.php',
				success: function(data){
					//console.log(data);
					$('#param_opcion').val('');	
					swal("Deleted!", "Eliminado con éxito", "success"); 
					setTimeout(antesCadena(),4000);
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

function editar_ac(id){	
	var param_opcion = 'editar_ac';
	//idecito = id;
	//var id = $("#param_id").val(objeto[0]);
	$.ajax({
		type: 'POST',
		data:'param_opcion='+param_opcion+'&param_id='+id,
		url: '../../controller/bitacoras/espacios_controller.php',
		success: function(data){
			//console.log(data);
			$('#param_opcion').val('');	
		  	$('#modal-editar_ac').modal({
		  		show:true,
		  		backdrop:'static',
		  	});
			objeto=JSON.parse(data);
			$('#param_ac_fecha_edit').val(objeto[0]);
			$('#param_ac_24_edit').val(objeto[1]);
			$('#param_ac_31_edit').val(objeto[2]);
			$('#param_ac_38_edit').val(objeto[3]);
			$('#param_ac_127_edit').val(objeto[4]);
			$('#param_ac_tedbprod_edit').val(objeto[5]);
			$('#param_ac_tecyber_edit').val(objeto[6]);
			$('#param_ac_id_edit').val(objeto[7]);

		},
		error: function(data){
			
		}
	});
}

function eliminar_dc(id){	
	var param_opcion = 'eliminar_dc';

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
				url: '../../controller/bitacoras/espacios_controller.php',
				success: function(data){
					//console.log(data);
					$('#param_opcion').val('');	
					swal("Deleted!", "Eliminado con éxito", "success"); 
					setTimeout(despuesCadena(),4000);
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

function editar_dc(id){	
	var param_opcion = 'editar_dc';
	//idecito = id;
	//var id = $("#param_id").val(objeto[0]);
	$.ajax({
		type: 'POST',
		data:'param_opcion='+param_opcion+'&param_id='+id,
		url: '../../controller/bitacoras/espacios_controller.php',
		success: function(data){
			//console.log(data);
			$('#param_opcion').val('');	
		  	$('#modal-editar_dc').modal({
		  		show:true,
		  		backdrop:'static',
		  	});
			objeto=JSON.parse(data);
			$('#param_dc_fecha_edit').val(objeto[0]);
			$('#param_dc_24_edit').val(objeto[1]);
			$('#param_dc_31_edit').val(objeto[2]);
			$('#param_dc_38_edit').val(objeto[3]);
			$('#param_dc_127_edit').val(objeto[4]);
			$('#param_dc_tedbprod_edit').val(objeto[5]);
			$('#param_dc_tecyber_edit').val(objeto[6]);
			$('#param_dc_id_edit').val(objeto[7]);

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
		if(dd<10) { dd = '0'+dd } 
		if(mm<10) { mm = '0'+mm	} 
		today = yyyy + '-' + mm + '-' + dd;
		//document.write(today);
		//end fecha

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
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_ac').serialize()+'&param_opcion=nuevo_ac',
		        url: '../../controller/bitacoras/espacios_controller.php',
		        success: function(data){
		            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_ac_fecha').val(today);
					$('#param_ac_24').val('');
					$('#param_ac_31').val('');
					$('#param_ac_38').val('');
					$('#param_ac_127').val();
					$('#param_ac_tedbprod').val('');
					$('#param_ac_tecyber').val('');

					setTimeout(antesCadena(),2000);      

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

	$('#nuevo_dc').on('click', function(){
		var dc_fecha = $('#param_dc_fecha').val();
		var dc_24 = $('#param_dc_24').val();
		var dc_31 = $('#param_dc_31').val();
		var dc_38 = $('#param_dc_38').val();
		var dc_127 = $('#param_dc_127').val();
		var dc_tedbprod = $('#param_dc_tedbprod').val();
		var dc_tecyber = $('#param_dc_tecyber').val();


		if (dc_fecha.length == '' || dc_24.length == '' || dc_31.length == '' || dc_38.length == '' || dc_127.length == '' || dc_tedbprod.length == '' || dc_tecyber.length == '' ) {            
            $("#mensaje_dc").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_dc').serialize()+'&param_opcion=nuevo_dc',
		        url: '../../controller/bitacoras/espacios_controller.php',
		        success: function(data){
		            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_dc_fecha').val(today);
					$('#param_dc_24').val();
					$('#param_dc_31').val();
					$('#param_dc_38').val();
					$('#param_dc_127').val();
					$('#param_dc_tedbprod').val();
					$('#param_dc_tecyber').val();

					setTimeout(despuesCadena(),2000);             

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

	$('#update_ac').on('click', function(){

		var ac_fecha_edit = $('#param_ac_fecha_edit').val();
		var ac_24_edit = $('#param_ac_24_edit').val();
		var ac_31_edit = $('#param_ac_31_edit').val();
		var ac_38_edit = $('#param_ac_38_edit').val();
		var ac_127_edit = $('#param_ac_127_edit').val();
		var ac_tedbprod_edit = $('#param_ac_tedbprod_edit').val();
		var ac_tecyber_edit = $('#param_ac_tecyber_edit').val();
		

		if (ac_fecha_edit.length == '' || ac_24_edit.length == '' || ac_31_edit.length == '' || ac_38_edit.length == '' || ac_127_edit.length == '' || ac_tedbprod_edit.length == '' || ac_tecyber_edit.length == ''  ) {            
            $("#mensaje").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_update_ac').serialize()+'&param_opcion=update_ac',
		        url: '../../controller/bitacoras/espacios_controller.php',
		        success: function(data){
		            swal("Good job!", "Se realizó la edición con éxito.", "success");
		                        //window.location = "../index.php";
		            
		            $('#param_opcion_edit').val('');
		            $('#param_ac_fecha_edit').val(today);
					$('#param_ac_24_edit').val('');
					$('#param_ac_31_edit').val('');
					$('#param_ac_38_edit').val('');
					$('#param_ac_127_edit').val();
					$('#param_ac_tedbprod_edit').val('');
					$('#param_ac_tecyber_edit').val('');

					
					setTimeout(antesCadena(),2000);        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

	$('#update_dc').on('click', function(){

		var dc_fecha_edit = $('#param_dc_fecha_edit').val();
		var dc_24_edit = $('#param_dc_24_edit').val();
		var dc_31_edit = $('#param_dc_31_edit').val();
		var dc_38_edit = $('#param_dc_38_edit').val();
		var dc_127_edit = $('#param_dc_127_edit').val();
		var dc_tedbprod_edit = $('#param_dc_tedbprod_edit').val();
		var dc_tecyber_edit = $('#param_dc_tecyber_edit').val();
		

		if (dc_fecha_edit.length == '' || dc_24_edit.length == '' || dc_31_edit.length == '' || dc_38_edit.length == '' || dc_127_edit.length == '' || dc_tedbprod_edit.length == '' || dc_tecyber_edit.length == ''  ) {            
            $("#mensaje").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_update_dc').serialize()+'&param_opcion=update_dc',
		        url: '../../controller/bitacoras/espacios_controller.php',
		        success: function(data){
		            swal("Good job!", "Se realizó la edición con éxito.", "success");
		                        //window.location = "../index.php";
		            
		            $('#param_opcion_edit').val('');
		            $('#param_dc_fecha_edit').val(today);
					$('#param_dc_24_edit').val('');
					$('#param_dc_31_edit').val('');
					$('#param_dc_38_edit').val('');
					$('#param_dc_127_edit').val();
					$('#param_dc_tedbprod_edit').val('');
					$('#param_dc_tecyber_edit').val('');

					
					setTimeout(despuesCadena(),2000);        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});


});




