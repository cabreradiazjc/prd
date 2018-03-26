<?php 

include_once '../../model/conexion_model.php';

class Tickets_model{

	private $param = array();
	private $conexion = null;
	private $result = null;

	function __construct()
	{
		$this->conexion = Conexion_Model::getConexion();

	}

	function cerrarAbrir()
	{
        mysqli_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
	}

	function gestionar($param)
	{
		$this->param = $param;		
		switch($this->param['param_opcion'])
		{
			case "nuevo_tickets";
				echo $this->nuevo_tickets();
				break;
			case "listar_tickets";
				echo $this->listar_tickets();
				break;
			case "editar_tickets";
				echo $this->editar_tickets();
				break;
			case "update_tickets";
				echo $this->update_tickets();
				break;
			case "ticket_resumen";
				echo $this->ticket_resumen();
				break;

		}
	}

	function prepararConsultaUsuario($opcion,$id) 
	{
		$consultaSql = "call sp_control_tickets(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'".$id."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


	function listar_tickets() {
    	$this->prepararConsultaUsuario('opc_tickets_listar','');  

    	while($row = mysqli_fetch_row($this->result)){
    		
    		switch($row[6])
			{
				case "APLICADO";
                    $row2 = '<span class="label label-success">' . $row[6] . '</span>';
                    break;
                case "PENDIENTE";
                    $row2 = '<span class="label label-inverse">' . $row[6] . '</span>';
                    break;
                case "RECHAZADO";
                    $row2 = '<span class="label label-danger">' . $row[6] . '</span>';
                    break;
                case "NUEVO";
                    $row2 = '<span class="label label-warning">' . $row[6] . '</span>';
                    break;
				};

			echo '<tr>					
					<td style="width: 10%;">'.$row[0].'</td>					
					<td style="width: 10%;">'.$row[1].'</td>
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="font-size: 11px; width: 30%;">'.$row[3].'</td>
					<td style="width: 10%;">'.$row[4].'</td>
					<td style="width: 10%;">'.$row[5].'</td>
					<td style="width: 10%; text-align: center; direction: rtl;">'.$row2.'</td>
					<td style="width: 10%; text-align: center; direction: rtl;"> 
                        <a class="btn btn-danger btn-sm text-white" onclick="eliminar('.$row[7].');"><i class="fa fa-trash"></i></a> 
                        <a class="btn btn-info btn-sm text-white" onclick="editar('.$row[7].');"><i class="fa fa-edit"></i></a> 

                    </td>
				</tr>';
		}
	}


	function nuevo_tickets() {
		$this->insertar_operacion();
		$this->insertar_tickets('opc_tickets_registrar');
    }

     function insertar_tickets($opcion) {
		
		

		$consultaSql = "INSERT INTO tickets(ticket_nro,usuario,asunto,descripcion,fecha,tipo,estado) VALUES (";
		$consultaSql.="'".$this->param['param_ticket_nro']."',";
		$consultaSql.="'".$this->param['param_usuario']."',";
		$consultaSql.="'".$this->param['param_asunto']."',";
		$consultaSql.="'".$this->param['param_descripcion']."',";
		$consultaSql.="'".$this->param['param_fecha']."',";
		$consultaSql.="'".$this->param['param_tipo']."',";
		$consultaSql.="'2')";

		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

  

	function mostrarUsuario() {
    	$this->prepararEditarUsuario('opc_usuario_mostrar');    	
    	$row = mysqli_fetch_row($this->result);
		echo json_encode($row);
		
	}

	function insertar_operacion() 	{
		$consultaSql = "INSERT INTO operaciones(nombreOperacion,fecha,usuario) VALUES (";
		$consultaSql.="'".$this->param['param_tarea']."',";
		$consultaSql.="now(),";
		$consultaSql.="'".$this->param['param_user']."')";

		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		mysqli_query($this->conexion,$consultaSql);
    }

    function prepararEditar($opcion,$id) 	{
		$consultaSql = "call sp_control_tickets(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'".$id."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function editar_tickets() {


    	$this->prepararEditar('opc_tickets_editar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}


	function update_tickets() {

		switch($this->param['param_estado_edit'])
		{
			case "ATENDIDO";
				$estado = 1;
				break;
			case "EN PROCESO";
				$estado = 0;
				break;

		}

    	$consultaSql = "UPDATE tickets set ";
		$consultaSql.="ticket_nro = '".$this->param['param_ticket_nro_edit']."',";
		$consultaSql.="usuario = '".$this->param['param_usuario_edit']."',";
		$consultaSql.="asunto = '".$this->param['param_asunto_edit']."',";
		$consultaSql.="descripcion = '".$this->param['param_descripcion_edit']."',";
		$consultaSql.="fecha = '".$this->param['param_fecha_edit']."',";
		$consultaSql.="tipo = '".$this->param['param_tipo_edit']."',";
		$consultaSql.="estado = '".$estado."' ";
		$consultaSql.="where ticket_id = '".$this->param['param_id_edit']."'";

		//echo $consultaSql;
		mysqli_query($this->conexion,$consultaSql);

	}

	function ticket_resumen() {

        $this->prepararConsultaUsuario('opc_ticket_resumen','');
        
        while ($row = mysqli_fetch_row($this->result)) {

            echo ' <!-- Total de Tickets-->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-inverse card-info">
                        <div class="box bg-info text-center">
                            <h1 class="font-light text-white">' . $row[0] . '</h1>
                            <h6 class="text-white">Total </h6>
                        </div>
                    </div>
                </div>

                <!-- Total de Aplicados -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-primary card-inverse">
                        <div class="box text-center">
                            <h1 class="font-light text-white">' . $row[1] . '</h1>
                            <h6 class="text-white">Aplicados</h6>
                        </div>
                    </div>
                </div>

                <!-- Total de Pendientes -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-inverse card-success">
                        <div class="box text-center">
                            <h1 class="font-light text-white">' . $row[2] . '</h1>
                            <h6 class="text-white">Pendientes</h6>
                        </div>
                    </div>
                </div>

                <!-- Total de Nuevos -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-inverse card-dark">
                        <div class="box text-center">
                            <h1 class="font-light text-white">' . $row[3] . '</h1>
                            <h6 class="text-white">Nuevos</h6>
                        </div>
                    </div>
                </div>
                ';

           
        }
    }

//REPORTES

/*
	function consultarln() {
    	$this->prepararRegistroUsuario('opc_ln_consultar');  	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="font-size: 12px; height: 10px; width: 4%;">'.$row[0].'</td>					
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[1].'</td>
					<td style="font-size: 12px; height: 10px; width: 25%;">'.$row[2].'</td>
					<td style="font-size: 12px; height: 10px; width: 10%;">'.$row[3].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[4].'</td>
					<td style="font-size: 12px; height: 10px; width: 10%;">'.$row[5].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[6].'</td>
				</tr>';
		}
	}

*/


}

 ?>

