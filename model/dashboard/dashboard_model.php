<?php 

include_once '../../model/conexion_model.php';

class Dashboard_model{

	private $param = array();
	private $conexion = null;
	private $result = null;
	private $result2 = null;
	private $result3 = null;

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
		
			case "lastOpen";
				echo $this->lastOpen();
				break;

			case "espaciosChart";
				echo $this->espaciosChart();
				break;

			case "chartAperturabt";
				echo $this->chartAperturabt();
				break;

			case "incidence";
				echo $this->incidence();
				break;

			case "emergencySVT";
				echo $this->emergencySVT();
				break;
			
			case "lastApertura";
				echo $this->lastApertura();
				break;

			case "isUpdated";
				echo $this->isUpdated();
				break;

			case "users";
				echo $this->users();
				break;

			case "lastIn";
				echo $this->lastIn();
				break;

			case "pieChartSVT";
				echo $this->pieChartSVT();
				break;

			case "lastSvt";
				echo $this->lastSvt();
				break;

			case "ubaChart";
				echo $this->ubaChart();
				break;



		}
	}

	function prepararConsultaUsuario($opcion) 

	{
		$consultaSql = "call sp_control_dashboard(";
		$consultaSql.="'".$opcion."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


    function lastSvt() {
    	$a=1;
    	$row2=null;
    	$this->prepararConsultaUsuario('opc_lastSvt');    	
    	while($row = mysqli_fetch_row($this->result)){

			switch($row[2])
			{
				case 1;
					$row2="<span class='label label-success pull-right'>Atendido</span>";
					break;
				default:
					$row2="<span class='label label-warning pull-right'>En proceso</span>";
				};

			echo '


			<!-- Message -->
            <a href="#">
                <div class="mail-contnet">
                    <h5>SVT Nro. '.$row[3].'</h5> <span class="mail-desc">'.$row[1].'</span> <span class="time">'.$row[0].'</span> '.$row2.'</div>
            </a>
                ';
		}

	}

	 function lastOpen() {

    	$this->prepararConsultaUsuario('opc_lastOpen');    	
    	while($row = mysqli_fetch_row($this->result)){

			echo '
			<div class="col-lg-6 col-md-6 m-t-20"><h1 class="m-b-0 font-light">'.$row[0].'</h1><small>Última Fecha</small></div>
			<div class="col-lg-6 col-md-6 m-t-20"><h1 class="m-b-0 font-light">'.$row[1].'</h1><small>Última Hora</small></div>


                ';
		}

	}



     function pieChartSVT() {
    	//$this->prepararConsultaUsuario('opc_pieChartSVT');  

    	$jsonArray = array();
		$consultaSql = "call sp_control_dashboard('opc_pieChartSVT')";
		//echo $consultaSql;
		$this->result3 = mysqli_query($this->conexion,$consultaSql);

    	  while($row = $this->result3->fetch_assoc()) {
		    $jsonArrayItem = array();
		    $jsonArrayItem['svt_ambiente'] = $row['svt_ambiente'];
		    $jsonArrayItem['total'] = $row['total'];
		    //append the above created object into the main array.
		    array_push($jsonArray, $jsonArrayItem);
		  }

		 //set the response content type as JSON
		header('Content-type: application/json');
		//output the return value of json encode using the echo function. 
		echo json_encode($jsonArray);

	}

	function ubaChart() {

    	/*$this->prepararConsultaUsuario('opc_pieChartSVT');  

    	$jsonArray = array();
		$consultaSql = "call sp_control_dashboard('opc_pieChartSVT')";
		//echo $consultaSql;
		$this->result3 = mysqli_query($this->conexion,$consultaSql);

    	  while($row = $this->result3->fetch_assoc()) {
		    $jsonArrayItem = array();
		    $jsonArrayItem['svt_ambiente'] = $row['svt_ambiente'];
		    $jsonArrayItem['total'] = $row['total'];
		    //append the above created object into the main array.
		    array_push($jsonArray, $jsonArrayItem);
		  }

		 //set the response content type as JSON
		header('Content-type: application/json');
		//output the return value of json encode using the echo function. 
		echo json_encode($jsonArray);*/

		$conn = oci_connect("TGGAS001", "cajasur2017", "172.20.0.24:1523/cngdb"); 
		if (!$conn) {    
		  $m = oci_error();    
		  echo $m['message'], "n";    
		  exit; 
		} else {    
		    //$usuario = 'TGSAA001'
		    $fini = date('d/m/Y',mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")));
		    $ffin = date('d/m/Y');
			$sql = " SELECT DISTINCT to_char(u.z0e4gefec, 'DD/MM/YYYY') as FECHA, 
		            (select  COUNT(*) from dbprod.z0e4ge op1
		            where op1.z0e4gefec >= u.z0e4gefec and op1.z0e4gefec <= u.z0e4gefec and op1.z0e4gehor >='00:00:00' and op1.z0e4gehor <='23:59:59' and op1.z0e4gemen = 1) as OPERACIONES_1,  
		            (select count(*) from dbprod.z0e4ge re2
		            where re2.z0e4gefec >= u.z0e4gefec and re2.z0e4gefec <= u.z0e4gefec and re2.z0e4gehor >='00:00:00' and re2.z0e4gehor <='23:59:59' and re2.z0e4gemen = 1 and re2.z0e4geest<>'PC' and re2.z0e4geest<>'00') as RECHAZOS_1
		          FROM dbprod.z0e4ge u
		          where u.z0e4gefec>=to_date('$fini','dd/mm/yyyy') and u.z0e4gefec<= to_date('$ffin','dd/mm/yyyy')
		          order by to_char(u.z0e4gefec, 'DD/MM/YYYY')";
		    //echo "-----------";
		    //echo $sql;
		    //oci_bind_by_name($stmt, ':variable', $id, -1); 

		   // oci_execute($stmt, OCI_DEFAULT); 
		    $stmt = oci_parse($conn, $sql);        // Preparar la sentencia
		    $ok   = oci_execute( $stmt );              // Ejecutar la sentencia
		    if( $ok == true )
		    {
		        /* Mostrar los datos. Lo hacemos de este modo puesto que no es posible obtener el número de
		           registros sin antes haber accedido a los datos mediante las funciones 'oci_fetch_*'):
		        */
		         if( $obj = oci_fetch_object($stmt) )
		        {
		            

		             $jsonArray = array();
		              while($obj = oci_fetch_object($stmt)) {
		                 $jsonArrayItem = array();
		                $submitdate = str_replace("/","-",$obj->FECHA);
		                $jsonArrayItem['FECHA'] = date('Mj',strtotime($submitdate));
		                $jsonArrayItem['OPERACIONES'] = $obj->OPERACIONES_1;
		                 $jsonArrayItem['RECHAZOS'] = $obj->RECHAZOS_1;
		                //append the above created object into the main array.
		                array_push($jsonArray, $jsonArrayItem);

		              }
		               //set the response content type as JSON
						header('Content-type: application/json');
						//output the return value of json encode using the echo function. 
						echo json_encode($jsonArray);
		        }
		        else
		            echo "<p>No se encontraron personas</p>";
		    }
		    else
		     oci_free_statement($stmt);    // Liberar los recursos asociados a una sentencia o cursor

		} 
		 
		// Close the Oracle connection 
		oci_close($conn); 



	}





     function users() {
    	$this->prepararConsultaUsuario('opc_users');  

    	while($fila = mysqli_fetch_array($this->result)){

    		echo '
    			    <li>
                        <img src="'.$fila['picture'].'" alt="User Image">
                        <a class="users-list-name" href="#"> '.$fila['first_name'].' </a>
                        <span class="users-list-date">'.$fila['access'].'</span>
                    </li>             
    		';

    	}

	}




	function lastIn() {
    	$this->prepararConsultaUsuario('opc_lastIn');    	
    	while($row = mysqli_fetch_row($this->result)){
    		$row3=null;
    		switch($row[3])
				{
			case "Coordinador";
				$row3='<span class="profile-status online pull-right"></span>';
				break;
			case "Analista";
				$row3='<span class="profile-status away pull-right"></span>';
				break;
			default :
				$row3='<span class="profile-status busy pull-right"></span>';
			}
    		
			echo '
			<!-- Message -->
            <a href="#">
                <div class="user-img"> <img src="'.$row[4].'"> 
                '.$row3.'</div>
                <div class="mail-contnet">
                    <h5>'.$row[0].'</h5> 
                    <span class="mail-desc">'.$row[1].'</span>
                    <span class="mail-desc">'.$row[2].'</span>
                </div>
            </a>
				';
		}
	}


     function isUpdated() {

     	$limitUpdated = 7;
    	$this->prepararConsultaUsuario('opc_isUpdated');    	
    	while($row = mysqli_fetch_row($this->result)){


    		if ($row[0]==$limitUpdated) {
    			echo '1';


    		}else {
    			echo '0';
    		}
    		
			
		}
	}


    function lastApertura() {
    	$this->prepararConsultaUsuario('opc_lastApertura');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<div class="inner">
                  <h3>'.$row[0].'</h3>

                  <p>Última apertura de BT</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-unlocked-outline"></i>
                </div>
                <a href="view/bitacoras/aperturabt.php" class="small-box-footer">
                 <i class="fa fa-info-circle"></i> Después de Carteras 2 
                </a>';
		}
	}


    function incidence() {
    	$this->prepararConsultaUsuario('opc_incidence');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo ' <div class="inner" >
                                  <h3>'.$row[0].'<sup style="font-size: 20px"></sup></h3>

                                  <p>Incidencias en el '.date("Y").'</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-ios-paper-outline"></i>
                                </div>
                                <a href="view/bitacoras/incidencias.php" class="small-box-footer">
                                  Ir a Incidencias <i class="fa fa-arrow-circle-right"></i>
                                </a>';
		}
	}


	function emergencySVT() {
    	$this->prepararConsultaUsuario('opc_emergencySVT');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo $row[0];
		}
	}




	function espaciosChart() {
		//porcentaje
		$p=100;
		$limit1=0;
		$limit2=55;
		$limit3=78;

		//Espacio Total Asignado
		$e24 = 499;
		$e31 = 499;
		$e38 = 1022;
		$e127 = 247;
		$etedbprod = 2375680;
		$etecyber = 185344;

		//Color de barra

		$color24 = "";
		$color31 = "";
		$color38 = "";
		$color127 = "";
		$colortedbprod = "";
		$colortecyber = "";



    	$this->prepararConsultaUsuario('opc_espaciosChart');    




    	while($row = mysqli_fetch_row($this->result)){



    		//COLOR 24

			$p24 = $p-($p*$row[0]/$e24);
    		

			if (($p24>$limit1) and ($p24<$limit2)) {
				$color24 = "bg-success";
				$face24  = "mdi-emoticon-cool text-success";
				
			}else{
					if (($p24>$limit2) and ($p24<$limit3)) {
					$color24 = "bg-primary";
					$face24  = "mdi-emoticon-neutral text-purple";
					
				}else{
						$color24 = "bg-danger";
						$face24  = "mdi-emoticon-sad text-danger";
						
				}
			};



			//COLOR 31

			$p31 = $p-($p*$row[1]/$e31);
    		

			if (($p31>$limit1) and ($p31<$limit2)) {
				$color31 = "bg-success";
				$face31  = "mdi-emoticon-cool text-success";
				
			}else{
					if (($p31>$limit2) and ($p31<$limit3)) {
					$color31 = "bg-primary";
					$face31  = "mdi-emoticon-neutral text-purple";
					
				}else{
						$color31 = "bg-danger";
						$face31  = "mdi-emoticon-sad text-danger";
						
				}
			};



				//COLOR 38

			$p38 = $p-($p*$row[2]/$e38);
    		

			if (($p38>$limit1) and ($p38<$limit2)) {
				$color38 = "bg-success";
				$face38  = "mdi-emoticon-cool text-success";
				
			}else{
					if (($p38>$limit2) and ($p38<$limit3)) {
					$color38 = "bg-primary";
					$face38  = "mdi-emoticon-neutral text-purple";
					
				}else{
						$color38 = "bg-danger";
						$face38  = "mdi-emoticon-sad text-danger";
				}
			};


				//COLOR 127

			$p127 = $p-($p*$row[3]/$e127);
    		

			if (($p127>$limit1) and ($p127<$limit2)) {
				$color127 = "bg-success";
				$face127  = "mdi-emoticon-cool text-success";
				
			}else{
					if (($p127>$limit2) and ($p127<$limit3)) {
					$color127 = "bg-primary";
					$face127  = "mdi-emoticon-neutral text-purple";
					
				}else{
						$color127 = "bg-danger";
						$face127  = "mdi-emoticon-sad text-danger";
						
				}
			};




			//Color dbprod

    		$ptedbprod = $p-($p*$row[4]/$etedbprod);
    		

			if (($ptedbprod>$limit1) and ($ptedbprod<$limit2)) {
				$colortedbprod = "bg-success";
				$facetedbprod  = "mdi-emoticon-cool text-success";
				
			}else{
					if (($ptedbprod>$limit2) and ($ptedbprod<$limit3)) {
					$colortedbprod = "bg-primary";
					$facetedbprod  = "mdi-emoticon-neutral text-purple";
					
				}else{
						$colortedbprod = "bg-danger";
						$facetedbprod  = "mdi-emoticon-sad text-danger";
					
				}
			};


			//COLOR CYBER 

			$ptecyber = $p-($p*$row[5]/$etecyber);
    		

			if (($ptecyber>$limit1) and ($ptecyber<$limit2)) {
				$colortecyber = "bg-success";
				$facetecyber  = "mdi-emoticon-cool text-success";
				
			}else{
					if (($ptecyber>$limit2) and ($ptecyber<$limit3)) {
					$colortecyber = "bg-primary";
					$facetecyber  = "mdi-emoticon-neutral text-purple";
					
				}else{
						$colortecyber = "bg-danger";
						$facetecyber  = "mdi-emoticon-sad text-danger";
						
				}
			};








			
    		echo '

    		<tr>
	            <td style="width:90px; text-align: center; direction: rtl;"><span style="font-size: 60px;"><i class="mdi '.$face24.'"></i></span></td>
	            <td style="width:200px;">
	                <h5 class="card-title">BD PRODUCCIÓN</h5>
	                <h6 class="card-subtitle">172.20.0.24</h6>
	                <h6 class="card-subtitle">'.$row[0].'/'.$e24.' MB</h6>
	                <h6 class="card-subtitle"><b>('.number_format($p24,2).' % used)</b></h6></td>
	            <td class="vm">
	               <div class="progress">
	                    <div class="progress-bar '.$color24.'" role="progressbar" style="width: '.$p24.'%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
	            </td>
	        </tr>


	        <tr>
	            <td style="width:90px; text-align: center; direction: rtl;"><span style="font-size: 60px;"><i class="mdi '.$face31.'"></i></span></td>
	            <td style="width:200px;">
	                <h5 class="card-title">BD PRD CONTIGENCIA</h5>
	                <h6 class="card-subtitle">172.20.0.31</h6>
	                <h6 class="card-subtitle">'.$row[1].'/'.$e31.' MB</h6>
	                <h6 class="card-subtitle"><b>('.number_format($p31,2).' % used)</b></h6></td>
	            <td class="vm">
	               <div class="progress">
	                    <div class="progress-bar '.$color31.'" role="progressbar" style="width: '.$p31.'%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
	            </td>
	        </tr>


	        <tr>
	            <td style="width:90px; text-align: center; direction: rtl;"><span style="font-size: 60px;"><i class="mdi '.$face38.'"></i></span></td>
	            <td style="width:200px;">
	                <h5 class="card-title">REP. BACKUPS BT</h5>
	                <h6 class="card-subtitle">172.20.0.38</h6>
	                <h6 class="card-subtitle">'.$row[2].'/'.$e38.' MB</h6>
	                <h6 class="card-subtitle"><b>('.number_format($p38,2).' % used)</b></h6></td>
	            <td class="vm">
	               <div class="progress">
	                    <div class="progress-bar '.$color38.'" role="progressbar" style="width: '.$p38.'%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
	            </td>
	        </tr>

	        <tr>
	            <td style="width:90px; text-align: center; direction: rtl;"><span style="font-size: 60px;"><i class="mdi '.$face127.'"></i></span></td>
	            <td style="width:200px;">
	                <h5 class="card-title">BD CYBER</h5>
	                <h6 class="card-subtitle">172.20.0.127</h6>
	                <h6 class="card-subtitle">'.$row[3].'/'.$e127.' MB</h6>
	                <h6 class="card-subtitle"><b>('.number_format($p127,2).' % used)</b></h6></td>
	            <td class="vm">
	               <div class="progress">
	                    <div class="progress-bar '.$color127.'" role="progressbar" style="width: '.$p127.'%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
	            </td>
	        </tr>

	        <tr>
	            <td style="width:90px; text-align: center; direction: rtl;"><span style="font-size: 60px;"><i class="mdi '.$facetedbprod.'"></i></span></td>
	            <td style="width:200px;">
	                <h5 class="card-title">Tablespace DBPROD</h5>
	                <h6 class="card-subtitle">172.20.0.24</h6>
	                <h6 class="card-subtitle">'.$row[4].'/'.$etedbprod.' MB</h6>
	                <h6 class="card-subtitle"><b>('.number_format($ptedbprod,2).' % used)</b></h6></td>
	            <td class="vm">
	               <div class="progress">
	                    <div class="progress-bar '.$colortedbprod.'" role="progressbar" style="width: '.$ptedbprod.'%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
	            </td>
	        </tr>

	        <tr>
	            <td style="width:90px; text-align: center; direction: rtl;"><span style="font-size: 60px;"><i class="mdi '.$facetecyber.'"></i></span></td>
	            <td style="width:200px;">
	                <h5 class="card-title">Tablespace CYBER</h5>
	                <h6 class="card-subtitle">172.20.0.127</h6>
	                <h6 class="card-subtitle">'.$row[5].'/'.$etecyber.' MB</h6>
	                <h6 class="card-subtitle"><b>('.number_format($ptecyber,2).' % used)</b></h6></td>
	            <td class="vm">
	               <div class="progress">
	                    <div class="progress-bar '.$colortecyber.'" role="progressbar" style="width: '.$ptecyber.'%; height:6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
	            </td>
	        </tr>

    		';
    		
			/*echo '<tr>					
					<td style="font-size: 12px; height: 10px; width: 20%;">'.$row[0].'</td>					
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[1].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[2].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[3].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[4].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[5].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[6].'</td>
				</tr>';*/
		}
	}


	function chartAperturabt() {
		$jsonArray = array();
		$consultaSql = "call sp_control_dashboard('opc_chartAperturabt')";
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


	function nuevo_ac() {
		
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

