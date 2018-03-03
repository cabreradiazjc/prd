<?php 
session_start();
include_once '../../model/bitacoras/backups_model.php';

$param = array();

//OPCION = 
$param['param_opcion']='';

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

//FIN OPCION


//tarea+ user - OPERACIONES
$param['tarea']='';
if (isset($_POST['tarea']))
    $param['param_tarea'] = $_POST['tarea'];

$param['user']='';
if (isset($_POST['user']))
    $param['param_user'] = $_POST['user'];
//FIN OPeraciones

if (isset($_POST['param_id']))
    $param['param_id'] = $_POST['param_id'];


//DBPROD
$param['param_dbprod_fecha']='';
$param['param_dbprod_nombre']='';
$param['param_dbprod_com']='';
$param['param_dbprod_sincom']='';

if (isset($_POST['param_dbprod_fecha']))
    $param['param_dbprod_fecha'] = $_POST['param_dbprod_fecha']; 

if (isset($_POST['param_dbprod_nombre']))
    $param['param_dbprod_nombre'] = $_POST['param_dbprod_nombre']; 

if (isset($_POST['param_dbprod_com']))
    $param['param_dbprod_com'] = $_POST['param_dbprod_com']; 

if (isset($_POST['param_dbprod_sincom']))
    $param['param_dbprod_sincom'] = $_POST['param_dbprod_sincom']; 



//CAN
$param['param_can_fecha']='';
$param['param_can_nombre']='';
$param['param_can_com']='';
$param['param_can_sincom']='';


if (isset($_POST['param_can_fecha']))
    $param['param_can_fecha'] = $_POST['param_can_fecha']; 

if (isset($_POST['param_can_nombre']))
    $param['param_can_nombre'] = $_POST['param_can_nombre']; 

if (isset($_POST['param_can_com']))
    $param['param_can_com'] = $_POST['param_can_com']; 

if (isset($_POST['param_can_sincom']))
    $param['param_can_sincom'] = $_POST['param_can_sincom']; 


//PRD
$param['param_prd_fecha']='';
$param['param_prd_nombre']='';
$param['param_prd_com']='';
$param['param_prd_sincom']='';

if (isset($_POST['param_prd_fecha']))
    $param['param_prd_fecha'] = $_POST['param_prd_fecha']; 

if (isset($_POST['param_prd_nombre']))
    $param['param_prd_nombre'] = $_POST['param_prd_nombre']; 

if (isset($_POST['param_prd_com']))
    $param['param_prd_com'] = $_POST['param_prd_com']; 

if (isset($_POST['param_prd_sincom']))
    $param['param_prd_sincom'] = $_POST['param_prd_sincom']; 


//CYBER

$param['param_cyber_fecha']='';

if (isset($_POST['param_cyber_fecha']))
    $param['param_cyber_fecha'] = $_POST['param_cyber_fecha']; 


$param['param_delquda2_nombre']='';
$param['param_delquda2_com']='';
$param['param_delquda2_sincom']='';


if (isset($_POST['param_delquda2_nombre']))
    $param['param_delquda2_nombre'] = $_POST['param_delquda2_nombre']; 

if (isset($_POST['param_delquda2_com']))
    $param['param_delquda2_com'] = $_POST['param_delquda2_com']; 

if (isset($_POST['param_delquda2_sincom']))
    $param['param_delquda2_sincom'] = $_POST['param_delquda2_sincom']; 




$param['param_rcvry_nombre']='';
$param['param_rcvry_com']='';
$param['param_rcvry_sincom']='';


if (isset($_POST['param_rcvry_nombre']))
    $param['param_rcvry_nombre'] = $_POST['param_rcvry_nombre']; 

if (isset($_POST['param_rcvry_com']))
    $param['param_rcvry_com'] = $_POST['param_rcvry_com']; 

if (isset($_POST['param_rcvry_sincom']))
    $param['param_rcvry_sincom'] = $_POST['param_rcvry_sincom']; 


//Reporte






//FIN REPORTES


$Backups = new Backups_model();
echo $Backups->gestionar($param);


 ?>