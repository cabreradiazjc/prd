<?php 

include_once '../../model/conexion_model.php';

class Espacios_model{

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
			case "nuevo_ac";
				echo $this->nuevo_ac();
				break;

			case "nuevo_dc";
				echo $this->nuevo_dc();
				break;

			case "listar_ac";
				echo $this->listar_ac();
				break;

			case "listar_dc";
				echo $this->listar_dc();
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


	function listar_ac() {
    	$this->prepararConsultaUsuario('opc_ac_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 20%;">'.$row[0].'</td>					
					<td style="width: 15%;">'.$row[1].'</td>
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 15%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					<td style="width: 15%;">'.$row[5].'</td>
					<td style="width: 15%;">'.$row[6].'</td>
				</tr>';
		}
	}


	function listar_dc() {
    	$this->prepararConsultaUsuario('opc_dc_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 20%;">'.$row[0].'</td>					
					<td style="width: 15%;">'.$row[1].'</td>
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 15%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					<td style="width: 15%;">'.$row[5].'</td>
					<td style="width: 15%;">'.$row[6].'</td>
				</tr>';
		}
	}


	function nuevo_ac() {
		$this->insertar_operacion();
		$consultaSql = "INSERT INTO ac_espacios(ac_fecha,ac_24,ac_31,ac_38,ac_127,ac_tedbprod,ac_tecyber) VALUES (";
		$consultaSql.="'".$this->param['param_ac_fecha']."',";
		$consultaSql.="'".$this->param['param_ac_24']."',";
		$consultaSql.="'".$this->param['param_ac_31']."',";
		$consultaSql.="'".$this->param['param_ac_38']."',";
		$consultaSql.="'".$this->param['param_ac_127']."',";
		$consultaSql.="'".$this->param['param_ac_tedbprod']."',";
		$consultaSql.="'".$this->param['param_ac_tecyber']."')";


		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function nuevo_dc() {
		$this->insertar_operacion();
		$consultaSql = "INSERT INTO dc_espacios(dc_fecha,dc_24,dc_31,dc_38,dc_127,dc_tedbprod,dc_tecyber) VALUES (";
		$consultaSql.="'".$this->param['param_dc_fecha']."',";
		$consultaSql.="'".$this->param['param_dc_24']."',";
		$consultaSql.="'".$this->param['param_dc_31']."',";
		$consultaSql.="'".$this->param['param_dc_38']."',";
		$consultaSql.="'".$this->param['param_dc_127']."',";
		$consultaSql.="'".$this->param['param_dc_tedbprod']."',";
		$consultaSql.="'".$this->param['param_dc_tecyber']."')";

		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


  

	function mostrarUsuario() {
    	$this->prepararEditarUsuario('opc_usuario_mostrar');    	
    	$row = mysqli_fetch_row($this->result);
		echo json_encode($row);
		
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

