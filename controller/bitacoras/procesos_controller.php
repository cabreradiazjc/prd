<?php 
session_start();
include_once '../../model/bitacoras/procesos_model.php';

$param = array();
$param['param_opcion']='';

//TAREA

$param['param_tarea']='';

if (isset($_POST['param_tarea']))
    $param['param_tarea'] = $_POST['param_tarea']; 


//LISTAS NEGRAS

$param['idcat']='';
/*
$param['param_nombre']='';
$param['param_tamDesc']='';
$param['param_fmod']='';
$param['param_tamMod'] = '';
$param['param_f24'] = '';
$param['param_fBT'] = '';
$param['param_estado'] = '';
*/
//FIN LN
//tarea+ user - OPERACIONES
$param['tarea']='';
if (isset($_POST['tarea']))
    $param['param_tarea'] = $_POST['tarea'];

$param['user']='';
if (isset($_POST['user']))
    $param['param_user'] = $_POST['user'];
//FIN OPeraciones



if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];


//LISTAS NEGRAS

if (isset($_POST['idcat']))
    $param['idcat'] = $_POST['idcat']; 

/*
if (isset($_POST['param_nombre']))
    $param['param_nombre'] = $_POST['param_nombre']; 

if (isset($_POST['param_tamDesc']))
    $param['param_tamDesc'] = $_POST['param_tamDesc']; 

if (isset($_POST['param_fmod']))
    $param['param_fmod'] = $_POST['param_fmod']; 

if (isset($_POST['param_tamMod']))
    $param['param_tamMod'] = $_POST['param_tamMod']; 

if (isset($_POST['param_f24']))
    $param['param_f24'] = $_POST['param_f24']; 

if (isset($_POST['param_fBT']))
    $param['param_fBT'] = $_POST['param_fBT']; 

if (isset($_POST['param_estado']))
    $param['param_estado'] = $_POST['param_estado']; 

*/


//Reporte

/*
if (isset($_POST['param_fi']))
    $param['param_fi'] = $_POST['param_fi']; 

if (isset($_POST['param_ff']))
$param['param_ff'] = $_POST['param_ff']; 

*/

//FIN LN


$Procesos = new Procesos_model();
echo $Procesos->gestionar($param);


 ?>