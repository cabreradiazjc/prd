<?php 

include_once '../../model/conexion_model.php';

class Aperturabt_model{

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
			case "nuevo_aperturabt";
				echo $this->nuevo_aperturabt();
				break;
			case "listar_aperturabt";
				echo $this->listar_aperturabt();
				break;

		}
	}

	function prepararConsultaUsuario($opcion) 
	{
		$consultaSql = "call sp_control_bitacoras(";
		$consultaSql.="'".$opcion."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


	function listar_aperturabt() {
    	$this->prepararConsultaUsuario('opc_aperturabt_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 20%;">'.$row[0].'</td>					
					<td style="width: 20%;">'.$row[1].'</td>
					<td style="width: 50%;">'.$row[2].'</td>
					<td style="width: 10%; text-align: center; direction: rtl;"> 
						<a class="btn btn-primary btn-xs" onclick="editar('.$row[0].');"><i class="fa fa-edit"></i></a> 
						<a class="btn btn-danger btn-xs" onclick="eliminar('.$row[0].');"><i class="fa fa-trash"></i></a> 
					</td>

				</tr>';
		}
	}
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

	function nuevo_aperturabt() {
		$this->insertar_aperturabt('opc_aperturabt_registrar');
    }

     function insertar_aperturabt($opcion) 

	{
		$this->insertar_operacion();
		$consultaSql = "INSERT INTO aperturabt(fecha,hora,observaciones) VALUES (";
		$consultaSql.="'".$this->param['param_fecha']."',";
		$consultaSql.="'".$this->param['param_hora']."',";
		$consultaSql.="'".$this->param['param_observaciones']."')";

		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function insertar_operacion() 

	{
		$consultaSql = "INSERT INTO operaciones(nombreOperacion,fecha,usuario) VALUES (";
		$consultaSql.="'".$this->param['param_tarea']."',";
		$consultaSql.="now(),";
		$consultaSql.="'".$this->param['param_user']."')";

		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		mysqli_query($this->conexion,$consultaSql);
    }
  

	function mostrarUsuario() {
    	$this->prepararEditarUsuario('opc_usuario_mostrar');    	
    	$row = mysqli_fetch_row($this->result);
		echo json_encode($row);
		
	}



}

 ?>

