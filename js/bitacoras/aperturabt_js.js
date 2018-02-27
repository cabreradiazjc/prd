
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
			  dom: 'Bfrtip',
		      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting' : [[0,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-nuevo_aperturabt').modal('hide');
			$('#modal-editar_aperturabt').modal('hide');
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

function eliminar(id){	
	var param_opcion = 'eliminar_aperturabt';

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
				url: '../../controller/bitacoras/aperturabt_controller.php',
				success: function(data){
					//console.log(data);
					$('#param_opcion').val('');	
					swal("Deleted!", "Eliminado con éxito", "success"); 
					setTimeout(mostrarDatos(),4000);
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
	var param_opcion = 'editar_aperturabt';
	//idecito = id;
	//var id = $("#param_id").val(objeto[0]);
	$.ajax({
		type: 'POST',
		data:'param_opcion='+param_opcion+'&param_id='+id,
		url: '../../controller/bitacoras/aperturabt_controller.php',
		success: function(data){
			//console.log(data);
			$('#param_opcion').val('editar_aperturabt');	
		  	$('#modal-editar_aperturabt').modal({
		  		show:true,
		  		backdrop:'static',
		  	});
			objeto=JSON.parse(data);
			$('#param_fecha_edit').val(objeto[0]);
			$('#param_hora_edit').val(objeto[1]);
			$('#param_observaciones_edit').val(objeto[2]);
			$('#param_id_edit').val(objeto[3]);
		},
		error: function(data){
			
		}
	});
}

$(function() {

	

	$('#nuevo_aperturabt').on('click', function(){

		//Fecha
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd = '0'+dd
		} 

		if(mm<10) {
		    mm = '0'+mm
		} 

		today = yyyy + '-' + mm + '-' + dd;
		//document.write(today);
		//end fecha


		var fecha = $('#param_fecha').val();
		var hora = $('#param_hora').val();
		var observaciones = $('#param_observaciones').val();
  		var tarea =  $('#tarea').val();
  		var user = $('#user').val();
		

		if (fecha.length == '' || hora.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevo_aperturabt').serialize()+'&param_opcion=nuevo_aperturabt',
		        url: '../../controller/bitacoras/aperturabt_controller.php',
		        success: function(data){
		            swal("Good job!", "¡Guardado satisfactoriamente!", "success");
		                        //window.location = "../index.php";
		            $('#param_fecha').val(today);
		            $('#param_opcion').val('nuevo_aperturabt');
					$("#param_hora").val('');
					$("#param_observaciones").val('');
					
					setTimeout(mostrarDatos(),2000);

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

		

	$('#update_aperturabt').on('click', function(){

		var fecha_edit = $('#param_fecha_edit').val();
		var hora_edit = $('#param_hora_edit').val();
		var observaciones_edit = $('#param_observaciones_edit').val();
		

		if (fecha_edit.length == '' || hora_edit.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-warning alert-dismissible">'+
            	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            	'<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
            	'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_update_aperturabt').serialize()+'&param_opcion=update_aperturabt',
		        url: '../../controller/bitacoras/aperturabt_controller.php',
		        success: function(data){
		            swal("Good job!", "Se realizó la edición con éxito.", "success");
		                        //window.location = "../index.php";
		            
		            $('#param_opcion_edit').val('update_aperturabt');
		            $('#param_fecha_edit').val('');
					$("#param_hora_edit").val('');
					$('#param_observaciones_edit').val('');
					$('#param_id_edit').val('');

					
					setTimeout(mostrarDatos(),2000);        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

});




