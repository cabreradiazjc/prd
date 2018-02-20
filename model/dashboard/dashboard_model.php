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
					$row2="<span class='label label-danger pull-right'>En proceso</span>";
				};

			echo '
			<li class="item">                               
		        <div>
		            <a href="view/bitacoras/svt.php" class="product-title">'.$row[0].$row2.'
		                </a>
		            <span class="product-description">
		                '.$row[1].'
		            </span>
		        </div>
		    </li>


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
				$row3='<span class="label label-info">Coordinador</span>';
				break;
			case "Analista";
				$row3='<span class="label label-warning">Analista</span>';
				break;
			default :
				$row3='<span class="label label-danger">Invitado</span>';
			}
    		
			echo '<tr>					
					<td style="font-size: 12px; height: 10px; width: 30%;">'.$row[0].'</td>					
					<td style="font-size: 12px; height: 10px; width: 20%;">'.$row[1].'</td>
					<td style="font-size: 12px; height: 10px; width: 20%;">'.$row[2].'</td>
					<td style="font-size: 12px; height: 10px; width: 20%;">'.$row3.'</td>

				</tr>';
		}
	}


     function isUpdated() {

     	$limitUpdated = 6;
    	$this->prepararConsultaUsuario('opc_isUpdated');    	
    	while($row = mysqli_fetch_row($this->result)){


    		if ($row[0]>=$limitUpdated) {
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
		$limit2=60;
		$limit3=80;

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
				$color24 = "green";
				
			}else{
					if (($p24>$limit2) and ($p24<$limit3)) {
					$color24 = "yellow";
					
				}else{
						$color24 = "red";
						
				}
			};



			//COLOR 31

			$p31 = $p-($p*$row[1]/$e31);
    		

			if (($p31>$limit1) and ($p31<$limit2)) {
				$color31 = "green";
				
			}else{
					if (($p31>$limit2) and ($p31<$limit3)) {
					$color31 = "yellow";
					
				}else{
						$color31 = "red";
						
				}
			};



				//COLOR 38

			$p38 = $p-($p*$row[2]/$e38);
    		

			if (($p38>$limit1) and ($p38<$limit2)) {
				$color38 = "green";
				
			}else{
					if (($p38>$limit2) and ($p38<$limit3)) {
					$color38 = "yellow";
					
				}else{
						$color38 = "red";
						
				}
			};


				//COLOR 127

			$p127 = $p-($p*$row[3]/$e127);
    		

			if (($p127>$limit1) and ($p127<$limit2)) {
				$color127 = "green";
				
			}else{
					if (($p127>$limit2) and ($p127<$limit3)) {
					$color127 = "yellow";
					
				}else{
						$color127 = "red";
						
				}
			};




			//Color dbprod

    		$ptedbprod = $p-($p*$row[4]/$etedbprod);
    		

			if (($ptedbprod>$limit1) and ($ptedbprod<$limit2)) {
				$colortedbprod = "green";
				
			}else{
					if (($ptedbprod>$limit2) and ($ptedbprod<$limit3)) {
					$colortedbprod = "yellow";
					
				}else{
						$colortedbprod = "red";
					
				}
			};


			//COLOR CYBER 

			$ptecyber = $p-($p*$row[5]/$etecyber);
    		

			if (($ptecyber>$limit1) and ($ptecyber<$limit2)) {
				$colortecyber = "green";
				
			}else{
					if (($ptecyber>$limit2) and ($ptecyber<$limit3)) {
					$colortecyber = "yellow";
					
				}else{
						$colortecyber = "red";
						
				}
			};








			
    		echo '
            <p class="text-center">
                Espacio - Libre/Total <strong>(% usado) </strong>
            </p>

          <div class="progress-group">
                <span class="progress-text">BD PRODUCCION (.24)</span>
                <span class="progress-number">'.$row[0].'/'.$e24.' MB <b>('.number_format($p24,2).' % used)</b></span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-'.$color24.'" style="width: '.$p24.'%"></div>
                </div>
            </div>
            <!-- /.progress-group -->


             <div class="progress-group">
                <span class="progress-text">BD PRD CONTIGENCIA (.31)</span>
                <span class="progress-number">'.$row[1].'/'.$e31.' MB <b>('.number_format($p31,2).' % used)</b></span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-'.$color31.'" style="width: '.$p31.'%"></div>
                </div>
            </div>
            <!-- /.progress-group -->


              <div class="progress-group">
                <span class="progress-text">REP. BACKUPS BT(.38)</span>
                <span class="progress-number">'.$row[2].'/'.$e38.' MB <b>('.number_format($p38,2).' % used)</b></span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-'.$color38.'" style="width: '.$p38.'%"></div>
                </div>
            </div>
            <!-- /.progress-group -->


            <div class="progress-group">
                <span class="progress-text">BD CYBER (.127)</span>
                <span class="progress-number">'.$row[3].'/'.$e127.' MB <b>('.number_format($p127,2).' % used)</b></span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-'.$color127.'" style="width: '.$p127.'%"></div>
                </div>
            </div>
            <!-- /.progress-group -->


            <div class="progress-group">
                <span class="progress-text">Tablespace DBPROD</span>
                <span class="progress-number">'.$row[4].'/'.$etedbprod.' MB <b>('.number_format($ptedbprod,2).' % used)</b></span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-'.$colortedbprod.'" style="width: '.$ptedbprod.'%"></div>
                </div>
            </div>
            <!-- /.progress-group -->


			<div class="progress-group">
                <span class="progress-text">Tablespace CYBER</span>
                <span class="progress-number">'.$row[5].'/'.$etecyber.' MB <b>('.number_format($ptecyber,2).' % used)</b></span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-'.$colortecyber.'" style="width: '.$ptecyber.'%"></div>
                </div>
            </div>
            <!-- /.progress-group -->



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

