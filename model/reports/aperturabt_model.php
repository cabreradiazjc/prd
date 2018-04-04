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
			case "mostrartablayear";
				echo $this->mostrartablayear();
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

	function prepararConsultaUsuario($opcion) 
	{
		$consultaSql = "call sp_control_r_aperturabt(";
		$consultaSql.="'".$opcion."','".$this->param['param_year']."','','')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


    function convertTime($dec)
	{
	    // start by converting to seconds
	    $seconds = ($dec * 3600);
	    // we're given hours, so let's get those the easy way
	    $hours = floor($dec);
	    // since we've "calculated" hours, let's remove them from the seconds variable
	    $seconds -= $hours * 3600;
	    // calculate minutes left
	    $minutes = floor($seconds / 60);
	    // remove those from seconds as well
	    $seconds -= $minutes * 60;
	    // return the time formatted HH:MM:SS
	    return $this->lz($hours).":".$this->lz($minutes); //.":".$this->lz($seconds);
	}

	// lz = leading zero
	function lz($num)
	{
		return str_pad($num, 2, 0, STR_PAD_LEFT);
	    //return (strlen($num) < 2) ? "0{$num}" : $num;
	}


	function mostrartablayear() {
		$i=1;
    	$this->prepararConsultaUsuario('opc_chartAperturabt');    	
    	while($row = mysqli_fetch_row($this->result)){

			$hora = $this->convertTime($row[1]);


			echo '<tr>		
					<td style="width: 10%;">'.$i.'</td>		
					<td style="width: 50%;">'.$row[0].'</td>					
					<td style="width: 40%;">'.$hora.'</td>
					

				</tr>';

				$i++;
		}
	}


}

 ?>

