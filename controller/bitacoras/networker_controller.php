<?php

session_start();
include_once '../../model/bitacoras/networker_model.php';

$param = array();
$param['param_opcion'] = '';

//TAREA

$param['param_tarea']='';

if (isset($_POST['param_tarea']))
    $param['param_tarea'] = $_POST['param_tarea']; 

//tarea+ user - OPERACIONES
$param['tarea']='';
if (isset($_POST['tarea']))
    $param['param_tarea'] = $_POST['tarea'];

$param['user']='';
if (isset($_POST['user']))
    $param['param_user'] = $_POST['user'];
//FIN OPeraciones

//NETWORKER


//FIN NETWORKER

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

echo $param['param_opcion'];

//VARIABLES SVT

//FIN VARIABLES SVT

$Networker = new Networker_model();
echo $Networker->gestionar($param);
?>