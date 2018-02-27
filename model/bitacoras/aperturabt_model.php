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
			case "eliminar_aperturabt";
				echo $this->eliminar_aperturabt();
				break;
			case "editar_aperturabt";
				echo $this->editar_aperturabt();
				break;
			case "update_aperturabt";
				echo $this->update_aperturabt();
				break;

		}
	}

	function prepararConsultaUsuario($opcion) 
	{
		$consultaSql = "call sp_control_aperturabt(";
		$consultaSql.="'".$opcion."','')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


	function listar_aperturabt() {
    	$this->prepararConsultaUsuario('opc_aperturabt_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 30%;">'.$row[0].'</td>					
					<td style="width: 30%;">'.$row[1].'</td>
					<td style="width: 40%;">'.$row[2].'</td>
					<td style="width: 10%; text-align: center; direction: rtl;"> 
						<a class="btn btn-danger btn-sm text-white" onclick="eliminar('.$row[3].');"><i class="fa fa-trash"></i></a> 
						<a class="btn btn-info btn-sm text-white" onclick="editar('.$row[3].');"><i class="fa fa-edit"></i></a> 
					</td>

				</tr>';
		}
	}

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

	function preparar($opcion,$id) 
	{
		$consultaSql = "call sp_control_aperturabt(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="".$id.")";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function eliminar_aperturabt() {


    	$this->preparar('opc_aperturabt_eliminar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}

	function editar_aperturabt() {

    	$this->preparar('opc_aperturabt_editar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}


	function update_aperturabt() {

    	$consultaSql = "UPDATE aperturabt set ";
		$consultaSql.="fecha = '".$this->param['param_fecha_edit']."',";
		$consultaSql.="hora = '".$this->param['param_hora_edit']."',";
		$consultaSql.="observaciones = '".$this->param['param_observaciones_edit']."'";
		$consultaSql.=" where id_aperturabt = '".$this->param['param_id_edit']."'";

		//echo $consultaSql;
		mysqli_query($this->conexion,$consultaSql);

	}




}

 ?>

