<?php 

include_once '../../model/conexion_model.php';

class Listasn_model{

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
			case "nuevoln";
				echo $this->nuevoln();
				break;
			case "listar_ln";
				echo $this->listar_ln();
				break;
			case "editarln";
				echo $this->editarln();
				break;
			case "updateln";
				echo $this->updateln();
				break;
			case "eliminar_ln";
				echo $this->eliminar_ln();
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


	function prepararListasNegras($opcion,$id) 
	{
		$consultaSql = "call sp_control_ln(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'".$id."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }



    function ejecutarConsultaRespuesta() {
        $respuesta = '';
        while ($fila = mysqli_fetch_array($this->result)) {
            $respuesta = $fila['respuesta'];
        }
        return $respuesta;
    }

	function login() 
	{
        $this->prepararConsultaUsuario('opc_login_respuesta');
        $respuesta = $this->ejecutarConsultaRespuesta();
        echo $respuesta;
        if($respuesta == '1')
        {        	
        	$this->cerrarAbrir();
        	$this->prepararConsultaUsuario('opc_login_listar');        	
        	while($fila = mysqli_fetch_array($this->result))
        	{
				$_SESSION['idusuario'] = $fila['idusuarios'];
				$_SESSION['dni']   = $fila['usu_dni'];
				$_SESSION['usuario']   = $fila['usu_codigo'];
				$_SESSION['usuarioNombre'] = $fila['usu_nombre'];
				$_SESSION['usuarioApPaterno'] = $fila['usu_paterno'];
				$_SESSION['usuarioApMaterno'] = $fila['usu_materno'];
				$_SESSION['email']   = $fila['usu_email'];
				$tipo = $fila['idtipo'];
        	}
        	header("Location:../index.php");
        		
        }
        else
        {	
        	//echo "<script type=\"text/javascript\">alert(\"Usuario y/o contraseña incorrecta\");</script>";  
        	header("Location:../view/login.php");

        	
    	}
    }


	function listar_ln() {
    	$this->prepararListasNegras('opc_ln_listar','');    


    	while($row = mysqli_fetch_row($this->result)){


    	 switch($row[7])
            {
                case "1";
                    $estado = '<span class="label label-success">APLICADO</span>';
                    break;
                case "0";
                    $estado = '<span class="label label-warning">EN PROCESO</span>';
                    break;

            }
    		
			echo '<tr>					
					<td style="width: 25%;">'.$row[0].'</td>					
					<td style="width: 12%;">'.$row[1].'</td>
					<td style="width: 5%;">'.$row[2].'</td>
					<td style="width: 12%;">'.$row[3].'</td>
					<td style="width: 5%;">'.$row[4].'</td>
					<td style="width: 12%;">'.$row[5].'</td>
					<td style="width: 12%;">'.$row[6].'</td>
					<td style="width: 5%;">'. $estado.'</td>
					<td style="width: 8%; text-align: center; direction: rtl;"> 
                        <a class="btn btn-danger btn-sm text-white" onclick="eliminar('.$row[8].');"><i class="fa fa-trash"></i></a> 
                        <a class="btn btn-info btn-sm text-white" onclick="editar('.$row[8].');"><i class="fa fa-edit"></i></a> 

                    </td>
				</tr>';
		}
	}

	
	function eliminar_ln() {


        $this->prepararListasNegras('opc_ln_eliminar',$this->param['param_id']);

      
    }

	function nuevoln() {
		$this->insertar_operacion();
		$this->insertarln('opc_ln_registrar');
    }

    function insertarln($opcion) 

	{

		$consultaSql = "INSERT INTO listas_negras(ln_fecdesc,ln_nomarc,ln_tamori,ln_fecmod,ln_tammod,ln_feccar24,ln_feccarbt,ln_estado) VALUES (";
		$consultaSql.="'".$this->param['param_fdesc']."',";
		$consultaSql.="'".$this->param['param_nombre']."',";
		$consultaSql.="'".$this->param['param_tamDesc']."',";
		$consultaSql.="'".$this->param['param_fmod']."',";
		$consultaSql.="'".$this->param['param_tamMod']."',";
		$consultaSql.="'".$this->param['param_f24']."',";
		$consultaSql.="'".$this->param['param_fBT']."',";
		$consultaSql.="'".$this->param['param_estado']."')";

		//echo $estado;
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

  

	function editarln() {


    	$this->prepararListasNegras('opc_ln_editar',$this->param['param_id']);

    	while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
        	}
	}


	function updateln() {

		

    	$consultaSql = "UPDATE listas_negras set ";
    	$consultaSql.="ln_nomarc = '".$this->param['param_nombre_edit']."',";
		$consultaSql.="ln_fecdesc = '".$this->param['param_fdesc_edit']."',";
		$consultaSql.="ln_tamori = '".$this->param['param_tamDesc_edit']."',";
		$consultaSql.="ln_fecmod = '".$this->param['param_fmod_edit']."',";
		$consultaSql.="ln_tammod = '".$this->param['param_tamMod_edit']."',";
		$consultaSql.="ln_feccar24 = '".$this->param['param_f24_edit']."',";
		$consultaSql.="ln_feccarbt = '".$this->param['param_fBT_edit']."',";
		$consultaSql.="ln_estado = '".$this->param['param_estado_edit']."' ";
		$consultaSql.="where idlistas_negras = '".$this->param['param_id_edit']."'";

		//echo $consultaSql;
		mysqli_query($this->conexion,$consultaSql);

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

}

 ?>

