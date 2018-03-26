<?php

session_start();
include_once '../../model/bitacoras/incidencias_model.php';

$param = array();
$param['param_opcion'] = '';



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

if (isset($_POST['param_id_edit']))
    $param['param_id_edit'] = $_POST['param_id_edit'];





//FIN SVT

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];


if (isset($_POST['param_fecha_incidencia']))
    $param['param_fecha_incidencia'] = $_POST['param_fecha_incidencia'];

if (isset($_POST['param_fecha_solucion']))
    $param['param_fecha_solucion'] = $_POST['param_fecha_solucion'];

if (isset($_POST['param_procesos']))
    $param['param_procesos'] = $_POST['param_procesos'];

if (isset($_POST['param_criticidad']))
    $param['param_criticidad'] = $_POST['param_criticidad'];

if (isset($_POST['param_detalle']))
    $param['param_detalle'] = $_POST['param_detalle'];



if (isset($_POST['param_fecha_incidencia_edit']))
    $param['param_fecha_incidencia_edit'] = $_POST['param_fecha_incidencia_edit'];

if (isset($_POST['param_fecha_solucion_edit']))
    $param['param_fecha_solucion_edit'] = $_POST['param_fecha_solucion_edit'];

if (isset($_POST['param_procesos_edit']))
    $param['param_procesos_edit'] = $_POST['param_procesos_edit'];

if (isset($_POST['param_criticidad_edit']))
    $param['param_criticidad_edit'] = $_POST['param_criticidad_edit'];

if (isset($_POST['param_detalle_edit']))
    $param['param_detalle_edit'] = $_POST['param_detalle_edit'];



//FIN VARIABLES SVT

$Incidencias = new Incidencias_model();
echo $Incidencias->gestionar($param);
?>