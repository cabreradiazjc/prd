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

			case "eliminar_ac";
				echo $this->eliminar_ac();
				break;

			case "eliminar_dc";
				echo $this->eliminar_dc();
				break;

			case "editar_ac";
				echo $this->editar_ac();
				break;

			case "editar_dc";
				echo $this->editar_dc();
				break;

			case "update_ac";
				echo $this->update_ac();
				break;

			case "update_dc";
				echo $this->update_dc();
				break;


		}
	}

	function prepararConsultaUsuario($opcion) 
	{
		$consultaSql = "call sp_control_espacios(";
		$consultaSql.="'".$opcion."','')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


	function listar_ac() {
    	$this->prepararConsultaUsuario('opc_ac_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 15%;">'.$row[0].'</td>					
					<td style="width: 12%; text-align: right;">'.number_format($row[1], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[2], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[3], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[4], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[5], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[6], 2, '.', ',').' MB</td>
					<td style="width: 13%; text-align: center; direction: rtl;"> 
						<a class="btn btn-danger btn-sm text-white" onclick="eliminar_ac('.$row[7].');"><i class="fa fa-trash"></i></a> 
						<a class="btn btn-info btn-sm text-white" onclick="editar_ac('.$row[7].');"><i class="fa fa-edit"></i></a> 
					</td>
				</tr>';
		}
	}


	function listar_dc() {
    	$this->prepararConsultaUsuario('opc_dc_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 15%;">'.$row[0].'</td>					
					<td style="width: 12%; text-align: right;">'.number_format($row[1], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[2], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[3], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[4], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[5], 2, '.', ',').' MB</td>
					<td style="width: 12%; text-align: right;">'.number_format($row[6], 2, '.', ',').' MB</td>
					<td style="width: 13%; text-align: center; direction: rtl;"> 
						<a class="btn btn-danger btn-sm text-white" onclick="eliminar_dc('.$row[7].');"><i class="fa fa-trash"></i></a> 
						<a class="btn btn-info btn-sm text-white" onclick="editar_dc('.$row[7].');"><i class="fa fa-edit"></i></a> 
					</td>
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

    function preparar($opcion,$id) 
	{
		$consultaSql = "call sp_control_espacios(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="".$id.")";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function eliminar_ac() {


    	$this->preparar('opc_ac_eliminar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}

	function editar_ac() {

    	$this->preparar('opc_ac_editar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}

	function eliminar_dc() {


    	$this->preparar('opc_dc_eliminar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}

	function editar_dc() {

    	$this->preparar('opc_dc_editar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}

	function update_ac() {

    	$consultaSql = "UPDATE ac_espacios set ";
		$consultaSql.="ac_fecha = '".$this->param['param_ac_fecha_edit']."',";
		$consultaSql.="ac_24 = '".$this->param['param_ac_24_edit']."',";
		$consultaSql.="ac_31 = '".$this->param['param_ac_31_edit']."',";
		$consultaSql.="ac_38 = '".$this->param['param_ac_38_edit']."',";
		$consultaSql.="ac_127 = '".$this->param['param_ac_127_edit']."',";
		$consultaSql.="ac_tedbprod = '".$this->param['param_ac_tedbprod_edit']."',";
		$consultaSql.="ac_tecyber = '".$this->param['param_ac_tecyber_edit']."'";	
		$consultaSql.=" where ac_id = '".$this->param['param_ac_id_edit']."'";

		echo $consultaSql;
		mysqli_query($this->conexion,$consultaSql);

	}

	function update_dc() {

    	$consultaSql = "UPDATE dc_espacios set ";
		$consultaSql.="dc_fecha = '".$this->param['param_dc_fecha_edit']."',";
		$consultaSql.="dc_24 = '".$this->param['param_dc_24_edit']."',";
		$consultaSql.="dc_31 = '".$this->param['param_dc_31_edit']."',";
		$consultaSql.="dc_38 = '".$this->param['param_dc_38_edit']."',";
		$consultaSql.="dc_127 = '".$this->param['param_dc_127_edit']."',";
		$consultaSql.="dc_tedbprod = '".$this->param['param_dc_tedbprod_edit']."',";
		$consultaSql.="dc_tecyber = '".$this->param['param_dc_tecyber_edit']."'";	
		$consultaSql.=" where dc_id = '".$this->param['param_dc_id_edit']."'";

		echo $consultaSql;
		mysqli_query($this->conexion,$consultaSql);

	}


}

 ?>

