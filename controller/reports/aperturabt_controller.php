<?php 
session_start();
include_once '../../model/reports/aperturabt_model.php';

$param = array();
$param['param_opcion']='';

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion']; 

//REPORTES

if (isset($_POST['param_year']))
    $param['param_year'] = $_POST['param_year']; 

if (isset($_POST['param_fecha_inicio']))
    $param['param_fecha_inicio'] = $_POST['param_fecha_inicio']; 

if (isset($_POST['param_fecha_fin']))
    $param['param_fecha_fin'] = $_POST['param_fecha_fin']; 





$Aperturabt = new Aperturabt_model();
echo $Aperturabt->gestionar($param);


 ?>