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
			case "listar_year";
				echo $this->listar_year();
				break;
			case "r_aperturabt_year";
				echo $this->r_aperturabt_year();
				break;

		}
	}

	function prepararConsulta($opcion,$id) 
	{
		$consultaSql = "call sp_control_aperturabt(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'".$id."')";

		echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


	 function listar_year() {

        $this->prepararConsulta('opc_listar_year','');
        while ($row = mysqli_fetch_row($this->result)) {
             echo '<option value="'.$row[0].'">'.$row[0].'</option>';
        }
    }

    function r_aperturabt_year() {
		$jsonArray = array();
		$consultaSql = "call sp_control_r_aperturabt('opc_chartAperturabt','".$this->param['param_year']."','','')";
		//echo $consultaSql;
		$this->result2 = mysqli_query($this->conexion,$consultaSql);

    	  while($row = $this->result2->fetch_assoc()) {
		    $jsonArrayItem = array();
		    $jsonArrayItem['fecha'] = $row['fecha'];
		    $jsonArrayItem['hora'] = $row['hora'];
		    //append the above created object into the main array.
		    array_push($jsonArray, $jsonArrayItem);
		  }

		 //set the response content type as JSON
		header('Content-type: application/json');
		//output the return value of json encode using the echo function. 
		echo json_encode($jsonArray);
	}


}

 ?>

