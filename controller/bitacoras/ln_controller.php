<?php 
session_start();
include_once '../../model/bitacoras/ln_model.php';

$param = array();
$param['param_opcion']='';

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

//LISTAS NEGRAS

$param['param_fdesc']='';
$param['param_nombre']='';
$param['param_tamDesc']='';
$param['param_fmod']='';
$param['param_tamMod'] = '';
$param['param_f24'] = '';
$param['param_fBT'] = '';
$param['param_estado'] = '';

//FIN LN


if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];


//LISTAS NEGRAS Guardar

if (isset($_POST['param_fdesc']))
    $param['param_fdesc'] = $_POST['param_fdesc']; 

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


//LISTAS NEGRAS Actualizar

if (isset($_POST['param_fdesc_edit']))
    $param['param_fdesc_edit'] = $_POST['param_fdesc_edit']; 

if (isset($_POST['param_nombre_edit']))
    $param['param_nombre_edit'] = $_POST['param_nombre_edit']; 

if (isset($_POST['param_tamDesc_edit']))
    $param['param_tamDesc_edit'] = $_POST['param_tamDesc_edit']; 

if (isset($_POST['param_fmod_edit']))
    $param['param_fmod_edit'] = $_POST['param_fmod_edit']; 

if (isset($_POST['param_tamMod_edit']))
    $param['param_tamMod_edit'] = $_POST['param_tamMod_edit']; 

if (isset($_POST['param_f24_edit']))
    $param['param_f24_edit'] = $_POST['param_f24_edit']; 

if (isset($_POST['param_fBT_edit']))
    $param['param_fBT_edit'] = $_POST['param_fBT_edit']; 

if (isset($_POST['param_estado_edit']))
    $param['param_estado_edit'] = $_POST['param_estado_edit']; 


if (isset($_POST['param_id_edit']))
    $param['param_id_edit'] = $_POST['param_id_edit'];


if (isset($_POST['param_id']))
    $param['param_id'] = $_POST['param_id'];



//FIN LN


$Listasn = new Listasn_model();
echo $Listasn->gestionar($param);


 ?>