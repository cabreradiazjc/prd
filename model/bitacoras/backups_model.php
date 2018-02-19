<?php 

include_once '../../model/conexion_model.php';

class Backups_model{

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
			case "listar_dbprod";
				echo $this->listar_dbprod();
				break;

			case "nuevo_dbprod";
				echo $this->nuevo_dbprod();
				break;

			case "listar_can";
				echo $this->listar_can();
				break;

			case "nuevo_can";
				echo $this->nuevo_can();
				break;

			case "listar_prd";
				echo $this->listar_prd();
				break;

			case "nuevo_prd";
				echo $this->nuevo_prd();
				break;

			case "listar_cyber";
				echo $this->listar_cyber();
				break;

			case "nuevo_cyber";
				echo $this->nuevo_cyber();
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


	function listar_dbprod() {
    	$this->prepararConsultaUsuario('opc_dbprod_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 20%;">'.$row[0].'</td>					
					<td style="width: 40%;">'.$row[1].'</td>
					<td style="width: 20%;">'.number_format($row[2], 2, '.', ',').'</td>
					<td style="width: 20%;">'.number_format($row[3], 2, '.', ',').'</td>

				</tr>';
		}
	}


	function listar_can() {
    	$this->prepararConsultaUsuario('opc_can_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 20%;">'.$row[0].'</td>					
					<td style="width: 40%;">'.$row[1].'</td>
					<td style="width: 20%;">'.number_format($row[2], 2, '.', ',').'</td>
					<td style="width: 20%;">'.number_format($row[3], 2, '.', ',').'</td>

				</tr>';
		}
	}



	function listar_prd() {
    	$this->prepararConsultaUsuario('opc_prd_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 20%;">'.$row[0].'</td>					
					<td style="width: 40%;">'.$row[1].'</td>
					<td style="width: 20%;">'.number_format($row[2], 2, '.', ',').'</td>
					<td style="width: 20%;">'.number_format($row[3], 2, '.', ',').'</td>

				</tr>';
		}
	}



	function listar_cyber() {
    	$this->prepararConsultaUsuario('opc_cyber_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>
					<td style="width: 10%;">'.$row[0].'</td>
					<td style="width: 25%;">'.$row[1].'</td>					
					<td style="width: 10%;">'.number_format($row[2], 2, '.', ',').'</td>
					<td style="width: 10%;">'.number_format($row[3], 2, '.', ',').'</td>
					<td style="width: 25%;">'.$row[4].'</td>
					<td style="width: 10%;">'.number_format($row[5], 2, '.', ',').'</td>					
					<td style="width: 10%;">'.number_format($row[6], 2, '.', ',').'</td>


				</tr>';
		}
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



	function nuevo_dbprod() {
		
		$this->insertar_operacion();
		$consultaSql = "INSERT INTO backup_dbprod(dbprod_fecha,dbprod_nombre,dbprod_com,dbprod_sincom) VALUES (";
		$consultaSql.="'".$this->param['param_dbprod_fecha']."',";
		$consultaSql.="'".$this->param['param_dbprod_nombre']."',";
		$consultaSql.="'".$this->param['param_dbprod_com']."',";
		$consultaSql.="'".$this->param['param_dbprod_sincom']."')";


		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


function nuevo_can() {
		$this->insertar_operacion();
		$consultaSql = "INSERT INTO backup_can(can_fecha,can_nombre,can_com,can_sincom) VALUES (";
		$consultaSql.="'".$this->param['param_can_fecha']."',";
		$consultaSql.="'".$this->param['param_can_nombre']."',";
		$consultaSql.="'".$this->param['param_can_com']."',";
		$consultaSql.="'".$this->param['param_can_sincom']."')";


		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }



function nuevo_prd() {
		$this->insertar_operacion();
		$consultaSql = "INSERT INTO backup_prd(prd_fecha,prd_nombre,prd_com,prd_sincom) VALUES (";
		$consultaSql.="'".$this->param['param_prd_fecha']."',";
		$consultaSql.="'".$this->param['param_prd_nombre']."',";
		$consultaSql.="'".$this->param['param_prd_com']."',";
		$consultaSql.="'".$this->param['param_prd_sincom']."')";


		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }



function nuevo_cyber() {
		$this->insertar_operacion();
		$consultaSql = "INSERT INTO backup_cyber(cyber_fecha,delquda2_nombre,delquda2_com,delquda2_sincom,rcvry_nombre,rcvry_com,rcvry_sincom) VALUES (";
		$consultaSql.="'".$this->param['param_cyber_fecha']."',";
		$consultaSql.="'".$this->param['param_delquda2_nombre']."',";
		$consultaSql.="'".$this->param['param_delquda2_com']."',";
		$consultaSql.="'".$this->param['param_delquda2_sincom']."',";
		$consultaSql.="'".$this->param['param_rcvry_nombre']."',";
		$consultaSql.="'".$this->param['param_rcvry_com']."',";
		$consultaSql.="'".$this->param['param_rcvry_sincom']."')";


		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }






  

	function mostrarUsuario() {
    	$this->prepararEditarUsuario('opc_usuario_mostrar');    	
    	$row = mysqli_fetch_row($this->result);
		echo json_encode($row);
		
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

