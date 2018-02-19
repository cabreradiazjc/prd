<?php 
session_start();
include_once '../../model/reports/ubareports_model.php';

$param = array();

//OPCION = 
$param['param_opcion']='';

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

$param['param_fecha1']='';

if (isset($_POST['param_fecha1']))
    $param['param_fecha1'] = $_POST['param_fecha1'];

$param['param_fecha2']='';

if (isset($_POST['param_fecha2']))
    $param['param_fecha2'] = $_POST['param_fecha2'];

//FIN OPCION



//FIN REPORTES


$Ubareports = new Ubareports_model();
echo $Ubareports->gestionar($param);


 ?>