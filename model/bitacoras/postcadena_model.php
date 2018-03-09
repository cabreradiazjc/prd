<?php 

include_once '../../model/conexion_model.php';

class Postcadena_model{

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
			case "listar_tesoreria";
				echo $this->listar_tesoreria();
				break;

			case "listar_contabilidad";
				echo $this->listar_contabilidad();
				break;

			case "listar_anexos";
				echo $this->listar_anexos();
				break;

			case "listar_cyberfinancial";
				echo $this->listar_cyberfinancial();
				break;

			case "listar_creditos";
				echo $this->listar_creditos();
				break;

			case "listar_pr";
				echo $this->listar_pr();
				break;

			case "listar_carteras3";
				echo $this->listar_carteras3();
				break;

			case "nuevo_tesoreria";
				echo $this->nuevo_tesoreria();
				break;

			case "nuevo_contabilidad";
				echo $this->nuevo_contabilidad();
				break;	

			case "nuevo_anexos";
				echo $this->nuevo_anexos();
				break;	

			case "nuevo_cyberfinancial";
				echo $this->nuevo_cyberfinancial();
				break;	

			case "nuevo_creditos";
				echo $this->nuevo_creditos();
				break;	

			case "nuevo_pr";
				echo $this->nuevo_pr();
				break;	

			case "nuevo_carteras3";
				echo $this->nuevo_carteras3();
				break;	

						


		}
	}

	function prepararConsultaUsuario($opcion) 
	{
		$consultaSql = "call sp_control_postcadena(";
		$consultaSql.="'".$opcion."')";
		echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


	function listar_tesoreria() {
    	$this->prepararConsultaUsuario('opc_tesoreria_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>
					<td style="width: 15%;">'.$row[1].'</td>			
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 55%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					

				</tr>';
		}
	}


	function listar_contabilidad() {
    	$this->prepararConsultaUsuario('opc_contabilidad_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>
					<td style="width: 15%;">'.$row[1].'</td>			
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 55%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					

				</tr>';
		}
	}

	function listar_anexos() {
    	$this->prepararConsultaUsuario('opc_anexos_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>
					<td style="width: 15%;">'.$row[1].'</td>			
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 55%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					

				</tr>';
		}
	}

	function listar_cyberfinancial() {
    	$this->prepararConsultaUsuario('opc_cyberfinancial_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>
					<td style="width: 15%;">'.$row[1].'</td>			
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 55%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					

				</tr>';
		}
	}

	function listar_creditos() {
    	$this->prepararConsultaUsuario('opc_creditos_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>
					<td style="width: 15%;">'.$row[1].'</td>			
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 55%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					

				</tr>';
		}
	}

	function listar_pr() {
    	$this->prepararConsultaUsuario('opc_pr_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>
					<td style="width: 15%;">'.$row[1].'</td>			
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 55%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					

				</tr>';
		}
	}

	function listar_carteras3() {
    	$this->prepararConsultaUsuario('opc_carteras3_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    	
    		echo '<tr>
					<td style="width: 15%;">'.$row[1].'</td>			
					<td style="width: 15%;">'.$row[2].'</td>
					<td style="width: 55%;">'.$row[3].'</td>
					<td style="width: 15%;">'.$row[4].'</td>
					

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



	function nuevo_tesoreria() {
		
		if ($this->param['param_balancenormativo'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'143',";
		$consultaSql.="'".$this->param['param_balancenormativo']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}

		if ($this->param['param_balancecontable'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'144',";
		$consultaSql.="'".$this->param['param_balancecontable']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}

		if ($this->param['param_PBCPEMAA'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'145',";
		$consultaSql.="'".$this->param['param_PBCPEMAA']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}

		if ($this->param['param_PBCPEMAB'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'146',";
		$consultaSql.="'".$this->param['param_PBCPEMAB']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}	

		if ($this->param['param_PBCPEMAD'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'147',";
		$consultaSql.="'".$this->param['param_PBCPEMAD']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}

		if ($this->param['param_PBCPEMAC'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'148',";
		$consultaSql.="'".$this->param['param_PBCPEMAC']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}

		if ($this->param['param_PBCPED4A'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'149',";
		$consultaSql.="'".$this->param['param_PBCPED4A']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}

		if ($this->param['param_PBCPED4B'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'150',";
		$consultaSql.="'".$this->param['param_PBCPED4B']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}

		if ($this->param['param_PBCPED4D'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'151',";
		$consultaSql.="'".$this->param['param_PBCPED4D']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED4C'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'152',";
		$consultaSql.="'".$this->param['param_PBCPED4C']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED5A'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'153',";
		$consultaSql.="'".$this->param['param_PBCPED5A']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED5B'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'154',";
		$consultaSql.="'".$this->param['param_PBCPED5B']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED5D'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'155',";
		$consultaSql.="'".$this->param['param_PBCPED5D']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED5C'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'156',";
		$consultaSql.="'".$this->param['param_PBCPED5C']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEE6A'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'157',";
		$consultaSql.="'".$this->param['param_PBCPEE6A']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEE6B'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'158',";
		$consultaSql.="'".$this->param['param_PBCPEE6B']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEE6C'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_tesoreria']."',";
		$consultaSql.="'9',";
		$consultaSql.="'159',";
		$consultaSql.="'".$this->param['param_PBCPEE6C']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}
    }


    function nuevo_contabilidad() {
		
		if ($this->param['param_PBCPED1A'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'160',";
		$consultaSql.="'".$this->param['param_PBCPED1A']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED1B'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'161',";
		$consultaSql.="'".$this->param['param_PBCPED1B']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED1D'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'162',";
		$consultaSql.="'".$this->param['param_PBCPED1D']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED1C'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'163',";
		$consultaSql.="'".$this->param['param_PBCPED1C']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED7A'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'164',";
		$consultaSql.="'".$this->param['param_PBCPED7A']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED7B'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'165',";
		$consultaSql.="'".$this->param['param_PBCPED7B']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED7D'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'166',";
		$consultaSql.="'".$this->param['param_PBCPED7D']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED7C'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'167',";
		$consultaSql.="'".$this->param['param_PBCPED7C']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED8A'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'168',";
		$consultaSql.="'".$this->param['param_PBCPED8A']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED8B'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'169',";
		$consultaSql.="'".$this->param['param_PBCPED8B']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED8D'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'170',";
		$consultaSql.="'".$this->param['param_PBCPED8D']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED8C'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'171',";
		$consultaSql.="'".$this->param['param_PBCPED8C']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED2A'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'172',";
		$consultaSql.="'".$this->param['param_PBCPED2A']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED2B'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'173',";
		$consultaSql.="'".$this->param['param_PBCPED2B']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED2D'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'174',";
		$consultaSql.="'".$this->param['param_PBCPED2D']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPED2C'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'10',";
		$consultaSql.="'175',";
		$consultaSql.="'".$this->param['param_PBCPED2C']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEMTA'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'11',";
		$consultaSql.="'176',";
		$consultaSql.="'".$this->param['param_PBCPEMTA']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEMTB'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_contabilidad']."',";
		$consultaSql.="'11',";
		$consultaSql.="'177',";
		$consultaSql.="'".$this->param['param_PBCPEMTB']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}
    }


    function nuevo_anexos() {
		if ($this->param['param_PJNGY450'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'12',";
		$consultaSql.="'178',";
		$consultaSql.="'".$this->param['param_PJNGY450']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEMZA'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'13',";
		$consultaSql.="'179',";
		$consultaSql.="'".$this->param['param_PBCPEMZA']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEMZN'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'13',";
		$consultaSql.="'180',";
		$consultaSql.="'".$this->param['param_PBCPEMZN']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEMZO'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'13',";
		$consultaSql.="'181',";
		$consultaSql.="'".$this->param['param_PBCPEMZO']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PBCPEMZC'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'13',";
		$consultaSql.="'182',";
		$consultaSql.="'".$this->param['param_PBCPEMZC']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY244'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'14',";
		$consultaSql.="'183',";
		$consultaSql.="'".$this->param['param_PJNGY244']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY242'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'14',";
		$consultaSql.="'184',";
		$consultaSql.="'".$this->param['param_PJNGY242']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY243'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_anexos']."',";
		$consultaSql.="'14',";
		$consultaSql.="'185',";
		$consultaSql.="'".$this->param['param_PJNGY243']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}
    }


    function nuevo_cyberfinancial() {
		if ($this->param['param_PJNGY729'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'6',";
		$consultaSql.="'186',";
		$consultaSql.="'".$this->param['param_PJNGY729']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY730'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'6',";
		$consultaSql.="'187',";
		$consultaSql.="'".$this->param['param_PJNGY730']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY754'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'6',";
		$consultaSql.="'188',";
		$consultaSql.="'".$this->param['param_PJNGY754']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY753'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'6',";
		$consultaSql.="'189',";
		$consultaSql.="'".$this->param['param_PJNGY753']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY758'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'7',";
		$consultaSql.="'190',";
		$consultaSql.="'".$this->param['param_PJNGY758']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY731'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'7',";
		$consultaSql.="'191',";
		$consultaSql.="'".$this->param['param_PJNGY731']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY759'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'7',";
		$consultaSql.="'192',";
		$consultaSql.="'".$this->param['param_PJNGY759']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY808'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'7',";
		$consultaSql.="'193',";
		$consultaSql.="'".$this->param['param_PJNGY808']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY747'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'7',";
		$consultaSql.="'194',";
		$consultaSql.="'".$this->param['param_PJNGY747']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY751'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'7',";
		$consultaSql.="'195',";
		$consultaSql.="'".$this->param['param_PJNGY751']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY767'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'8',";
		$consultaSql.="'196',";
		$consultaSql.="'".$this->param['param_PJNGY767']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY768'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'8',";
		$consultaSql.="'197',";
		$consultaSql.="'".$this->param['param_PJNGY768']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY769'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'8',";
		$consultaSql.="'198',";
		$consultaSql.="'".$this->param['param_PJNGY769']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY760'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'8',";
		$consultaSql.="'199',";
		$consultaSql.="'".$this->param['param_PJNGY760']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY766'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_cyberfinancial']."',";
		$consultaSql.="'8',";
		$consultaSql.="'200',";
		$consultaSql.="'".$this->param['param_PJNGY766']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}
	}


	function nuevo_creditos() {
		if ($this->param['param_PJNGY338'] != ''){	
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_creditos']."',";
		$consultaSql.="'18',";
		$consultaSql.="'201',";
		$consultaSql.="'".$this->param['param_PJNGY338']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY238'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_creditos']."',";
		$consultaSql.="'19',";
		$consultaSql.="'202',";
		$consultaSql.="'".$this->param['param_PJNGY238']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY233'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_creditos']."',";
		$consultaSql.="'19',";
		$consultaSql.="'203',";
		$consultaSql.="'".$this->param['param_PJNGY233']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY234'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_creditos']."',";
		$consultaSql.="'19',";
		$consultaSql.="'204',";
		$consultaSql.="'".$this->param['param_PJNGY234']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}
    }


    function nuevo_pr() {
		if ($this->param['param_PJNGY526'] != ''){	
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_pr']."',";
		$consultaSql.="'16',";
		$consultaSql.="'207',";
		$consultaSql.="'".$this->param['param_PJNGY526']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY549'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_pr']."',";
		$consultaSql.="'16',";
		$consultaSql.="'208',";
		$consultaSql.="'".$this->param['param_PJNGY549']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY579'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_pr']."',";
		$consultaSql.="'15',";
		$consultaSql.="'205',";
		$consultaSql.="'".$this->param['param_PJNGY579']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY580'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_pr']."',";
		$consultaSql.="'15',";
		$consultaSql.="'206',";
		$consultaSql.="'".$this->param['param_PJNGY580']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}
    }


    function nuevo_carteras3() {
		if ($this->param['param_PKNGY251'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'209',";
		$consultaSql.="'".$this->param['param_PKNGY251']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PKNGY252'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'210',";
		$consultaSql.="'".$this->param['param_PKNGY252']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PKNGY253'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'211',";
		$consultaSql.="'".$this->param['param_PKNGY253']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX516'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'212',";
		$consultaSql.="'".$this->param['param_PJNGX516']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX446'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'213',";
		$consultaSql.="'".$this->param['param_PJNGX446']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX423'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'214',";
		$consultaSql.="'".$this->param['param_PJNGX423']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX395'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'215',";
		$consultaSql.="'".$this->param['param_PJNGX395']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGY269'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'216',";
		$consultaSql.="'".$this->param['param_PJNGY269']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX586'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'217',";
		$consultaSql.="'".$this->param['param_PJNGX586']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX582'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'218',";
		$consultaSql.="'".$this->param['param_PJNGX582']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX483'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'219',";
		$consultaSql.="'".$this->param['param_PJNGX483']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX613'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'220',";
		$consultaSql.="'".$this->param['param_PJNGX613']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX641'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'221',";
		$consultaSql.="'".$this->param['param_PJNGX641']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}if ($this->param['param_PJNGX632'] != ''){
		$consultaSql = "INSERT INTO postcadena(fecha,idcategoria,idprocesos,tiempo) VALUES (";
		$consultaSql.="'".$this->param['param_fecha_carteras3']."',";
		$consultaSql.="'17',";
		$consultaSql.="'222',";
		$consultaSql.="'".$this->param['param_PJNGX632']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
		$consultaSql = "";
		}
	}


}

 ?>

