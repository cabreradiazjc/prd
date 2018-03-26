
window.onload = function(){
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
		data:{param_opcion: 'listar_ln'},
		url: '../../controller/bitacoras/ln_controller.php',
		success: function(respuesta){
			$('#table_ln').DataTable().destroy();
			$('#body_ln').html(respuesta);
			$('#table_ln').DataTable({
				dom: 'Bfrtip',
	          buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print' ],
		      'paging'      : true,
		      'lengthChange': true,
		      'searching'   : true,
		      'aaSorting' : [[1,'desc'] ],
		      'info'        : true,
		      'autoWidth'   : false

				});
			$('#modal-editarln').modal('hide');  

		},
		error: function(respuesta){
			$('#body_ln').html(respuesta);
		}
	});	
}


function editar(id){	
	var param_opcion = 'editarln';
	//idecito = id;
	//var id = $("#param_id").val(objeto[0]);
	$.ajax({
		type: 'POST',
		data:'param_opcion='+param_opcion+'&param_id='+id,
		url: '../../controller/bitacoras/ln_controller.php',
		success: function(data){
			console.log(data);
			$('#param_opcion').val('editarln');	
		  	$('#modal-editarln').modal({
		  		show:true,
		  		backdrop:'static',
		  	});
			objeto=JSON.parse(data);
			$('#param_fdesc_edit').val(objeto[1]);
			$('#param_nombre_edit').val(objeto[0]);
			$('#param_tamDesc_edit').val(objeto[2]);
			$('#param_fmod_edit').val(objeto[3]);	
			$('#param_tamMod_edit').val(objeto[4]);
			$('#param_f24_edit').val(objeto[5]);
			$('#param_fBT_edit').val(objeto[6]);
			$('#param_estado_edit').val(objeto[7]);
			$('#param_id_edit').val(objeto[8]);
		},
		error: function(data){
			
		}
	});
}

$(function() {
	$('#nuevoln').on('click', function(){
		var fdesc = $('#param_fdesc').val();
		var nombre = $('#param_nombre').val();
		var tamDesc = $('#param_tamDesc').val();
		var fmod = $('#param_fmod').val();
		var tamMod = $('#param_tamMod').val();
		var f24 = $('#param_f24').val();
		var fBT = $('#param_fBT').val();
		var estado = $('#param_estado').val();
		

		if (nombre.length == '' || fdesc.length == '' || tamDesc.length == '' ) {            
            $("#mensaje").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_nuevoln').serialize()+'&param_opcion=nuevoln',
		        url: '../../controller/bitacoras/ln_controller.php',
		        success: function(data){
		            $("#mensaje").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
		                        //window.location = "../index.php";
		            $('#param_fdesc').val();
		            $('#param_opcion').val('nuevoln');
					$("#param_nombre").val('');
					$('#param_tamDesc').val();
					$('#param_fmod').val();
					$('#param_tamMod').val();
					$('#param_f24').val();
					$('#param_fBT').val();
					
					setTimeout(mostrarDatos(),1000) 
					//setTimeout("location.href='../../view/bitacoras/lnegras.php'",1000)        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

		$('#updateln').on('click', function(){
		var fdesc_edit = $('#param_fdesc_edit').val();
		var nombre_edit = $('#param_nombre_edit').val();
		var tamDesc_edit = $('#param_tamDesc_edit').val();
		var fmod_edit = $('#param_fmod_edit').val();
		var tamMod_edit = $('#param_tamMod_edit').val();
		var f24_edit = $('#param_f24_edit').val();
		var fBT_edit = $('#param_fBT_edit').val();
		var estado_edit = $('#param_estado_edit').val();
		

		if (nombre_edit.length == '' || fdesc_edit.length == '' || tamDesc_edit.length == '' ) {            
            $("#mensaje_edit").html(
            	'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
        	$.ajax({
		        type: 'POST',        
		        data: $('#frm_updateln').serialize()+'&param_opcion=updateln',
		        url: '../../controller/bitacoras/ln_controller.php',
		        success: function(data){
		            $("#mensaje_edit").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Alert!</h4>Registro exitoso.</div>').show();
		                        //window.location = "../index.php";
		            $('#param_fdesc_edit').val();
		            $('#param_opcion_edit').val('updateln');
					$("#param_nombre_edit").val('');
					$('#param_tamDesc_edit').val();
					$('#param_fmod_edit').val();
					$('#param_tamMod_edit').val();
					$('#param_f24_edit').val();
					$('#param_fBT_edit').val();
					
					setTimeout("location.href='../../view/bitacoras/lnegras.php'",1000)        

		        },
		        error: function(data){
		                   
		        } 
			});
        }
		
	});

});




