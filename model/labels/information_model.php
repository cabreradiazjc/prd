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
					<td style="width: 20%;">'.$row[0].'</td>					
					<td style="width: 20%;">'.$row[1].'</td>
					<td style="width: 60%;">'.$row[2].'</td>

				</tr>';
		}
	}


	function listar_info() {
		$user = $this->param['param_user'];
    	$this->prepararConsultaUsuario('opc_info_listar',$user);  
    	echo '
    	<ul>
		    <li>
		        <div class="drop-title">Notificaciones</div>
		    </li>
		    <li>
			    <div class="message-center">';
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

		echo '</div>
			    </li>
			    <li>
			        <a class="nav-link text-center" href="../labels/information.php"> <strong>Ver todas las operaciones</strong> <i class="fa fa-angle-right"></i> </a>
			    </li>
			</ul>';

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

