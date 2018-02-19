<?php 
session_start();
include_once '../../model/labels/information_model.php';

$param = array();
$param['param_opcion']='';



if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];




$param['tarea']='';
if (isset($_POST['tarea']))
    $param['param_tarea'] = $_POST['tarea'];

$param['user']='';
if (isset($_POST['user']))
    $param['param_user'] = $_POST['user'];




//Reporte



//FIN APERTURA BT


$Operaciones = new Operaciones_model();
echo $Operaciones->gestionar($param);


 ?>