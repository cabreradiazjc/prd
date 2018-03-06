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

if (isset($_POST['param_dbprod_id_edit']))
    $param['param_dbprod_id_edit'] = $_POST['param_dbprod_id_edit'];

if (isset($_POST['param_can_id_edit']))
    $param['param_can_id_edit'] = $_POST['param_can_id_edit'];

if (isset($_POST['param_prd_id_edit']))
    $param['param_prd_id_edit'] = $_POST['param_prd_id_edit'];

if (isset($_POST['param_delquda2_id_edit']))
    $param['param_delquda2_id_edit'] = $_POST['param_delquda2_id_edit'];

if (isset($_POST['param_rcvry_id_edit']))
    $param['param_rcvry_id_edit'] = $_POST['param_rcvry_id_edit'];


//DBPROD

if (isset($_POST['param_dbprod_fecha']))
    $param['param_dbprod_fecha'] = $_POST['param_dbprod_fecha']; 

if (isset($_POST['param_dbprod_nombre']))
    $param['param_dbprod_nombre'] = $_POST['param_dbprod_nombre']; 

if (isset($_POST['param_dbprod_com']))
    $param['param_dbprod_com'] = $_POST['param_dbprod_com']; 

if (isset($_POST['param_dbprod_sincom']))
    $param['param_dbprod_sincom'] = $_POST['param_dbprod_sincom']; 



//CAN


if (isset($_POST['param_can_fecha']))
    $param['param_can_fecha'] = $_POST['param_can_fecha']; 

if (isset($_POST['param_can_nombre']))
    $param['param_can_nombre'] = $_POST['param_can_nombre']; 

if (isset($_POST['param_can_com']))
    $param['param_can_com'] = $_POST['param_can_com']; 

if (isset($_POST['param_can_sincom']))
    $param['param_can_sincom'] = $_POST['param_can_sincom']; 


//PRD

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


/////////////////////////////-----------------------/EDITAR


//DBPROD

if (isset($_POST['param_dbprod_fecha_edit']))
    $param['param_dbprod_fecha_edit'] = $_POST['param_dbprod_fecha_edit']; 

if (isset($_POST['param_dbprod_nombre_edit']))
    $param['param_dbprod_nombre_edit'] = $_POST['param_dbprod_nombre_edit']; 

if (isset($_POST['param_dbprod_com_edit']))
    $param['param_dbprod_com_edit'] = $_POST['param_dbprod_com_edit']; 

if (isset($_POST['param_dbprod_sincom_edit']))
    $param['param_dbprod_sincom_edit'] = $_POST['param_dbprod_sincom_edit']; 



//CAN


if (isset($_POST['param_can_fecha_edit']))
    $param['param_can_fecha_edit'] = $_POST['param_can_fecha_edit']; 

if (isset($_POST['param_can_nombre_edit']))
    $param['param_can_nombre_edit'] = $_POST['param_can_nombre_edit']; 

if (isset($_POST['param_can_com_edit']))
    $param['param_can_com_edit'] = $_POST['param_can_com_edit']; 

if (isset($_POST['param_can_sincom_edit']))
    $param['param_can_sincom_edit'] = $_POST['param_can_sincom_edit']; 


//PRD

if (isset($_POST['param_prd_fecha_edit']))
    $param['param_prd_fecha_edit'] = $_POST['param_prd_fecha_edit']; 

if (isset($_POST['param_prd_nombre_edit']))
    $param['param_prd_nombre_edit'] = $_POST['param_prd_nombre_edit']; 

if (isset($_POST['param_prd_com_edit']))
    $param['param_prd_com_edit'] = $_POST['param_prd_com_edit']; 

if (isset($_POST['param_prd_sincom_edit']))
    $param['param_prd_sincom_edit'] = $_POST['param_prd_sincom_edit']; 


//CYBER


if (isset($_POST['param_delquda2_fecha_edit']))
    $param['param_delquda2_fecha_edit'] = $_POST['param_delquda2_fecha_edit']; 

if (isset($_POST['param_rcvry_fecha_edit']))
    $param['param_rcvry_fecha_edit'] = $_POST['param_rcvry_fecha_edit']; 

if (isset($_POST['param_delquda2_nombre_edit']))
    $param['param_delquda2_nombre_edit'] = $_POST['param_delquda2_nombre_edit']; 

if (isset($_POST['param_delquda2_com_edit']))
    $param['param_delquda2_com_edit'] = $_POST['param_delquda2_com_edit']; 

if (isset($_POST['param_delquda2_sincom_edit']))
    $param['param_delquda2_sincom_edit'] = $_POST['param_delquda2_sincom_edit']; 

if (isset($_POST['param_rcvry_nombre_edit']))
    $param['param_rcvry_nombre_edit'] = $_POST['param_rcvry_nombre_edit']; 

if (isset($_POST['param_rcvry_com_edit']))
    $param['param_rcvry_com_edit'] = $_POST['param_rcvry_com_edit']; 

if (isset($_POST['param_rcvry_sincom_edit']))
    $param['param_rcvry_sincom_edit'] = $_POST['param_rcvry_sincom_edit']; 


$Backups = new Backups_model();
echo $Backups->gestionar($param);


 ?>