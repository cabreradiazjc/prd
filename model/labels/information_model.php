<?php 

include_once '../../model/conexion_model.php';

class Operaciones_model{

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
			case "listar_info";
				echo $this->listar_info();
				break;
			case "listar_operaciones";
				echo $this->listar_operaciones();
				break;
			case "profile";
				echo $this->profile();
				break;


		}
	}

	function prepararConsultaUsuario($opcion,$user) 
	{
		$consultaSql = "call sp_control_labels(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'".$user."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


	function listar_operaciones() {
		$user = $this->param['param_user'];
    	$this->prepararConsultaUsuario('opc_operaciones_listar',$user);    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="width: 40%;">'.$row[0].'</td>					
					<td style="width: 20%;">'.$row[1].'</td>
					<td style="width: 40%;">'.$row[2].'</td>

				</tr>';
		}
	}


	function listar_info() {
		$user = $this->param['param_user'];
    	$this->prepararConsultaUsuario('opc_info_listar',$user);  

    	while($row = mysqli_fetch_row($this->result)){
    		
			echo ' 
		            <!-- Message -->
		            <a href="#">
		                <div class="user-img"> 
		                <img src='.$row[3].' alt="user" class="img-circle"> 
		                <span class="profile-status offline pull-right"></span> 
		                </div>
		                <div class="mail-contnet">
		                    <h5>'.$row[4].'</h5> <span class="mail-desc">'.$row[0].'</span> <span class="time">'.$row[1].'</span> </div>
		            </a>
                    <!-- end message -->';
		}


	}


	function profile() {
    	$user = $this->param['param_user'];
    	$this->prepararConsultaUsuario('opc_profile',$user);    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<a href="javascript:void(0)" class="m-t-10 waves-effect waves-dark btn btn-primary btn-md btn-rounded">'.$row[1].'</a>
					<div class="row text-center m-t-20">
					    <div class="col-lg-6 col-md-6 m-t-20"><h3 class="m-b-0 font-light">'.$row[2].'</h3><small>Contribuciones</small></div>
					    <div class="col-lg-6 col-md-6 m-t-20"><h3 class="m-b-0 font-light">'.$row[0].'</h3><small>Desde</small></div>
					</div>';
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

	



}

 ?>

