<?php

session_start();
include_once '../../model/bitacoras/categoria_model.php';

$param = array();
$param['param_opcion'] = '';

//CATEGORIA

/*$param['param_nroenvio'] = '';
$param['param_ambiente'] = '';
$param['param_origen'] = '';
$param['param_motivo'] = '';
$param['param_recepcion_fecha'] = '';
$param['param_ejecucion_fecha'] = '';
$param['param_responsable_funcional'] = '';
$param['param_responsable_tecnico'] = '';
$param['param_emergencia'] = '';
$param['param_alertas'] = '';
*/
//FIN CATEGORIA

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

//TAREA

$param['param_tarea']='';

if (isset($_POST['param_tarea']))
    $param['param_tarea'] = $_POST['param_tarea']; 


//echo $param['param_opcion'];

//VARIABLES CATEGORIA
/*if (isset($_POST['param_nroenvio'])){
    $param['param_nroenvio'] = $_POST['param_nroenvio'];
    $param['param_opcion'] = str_pad($param['param_opcion'], 5, "0", STR_PAD_LEFT); 
}

if (isset($_POST['param_ambiente']))
    $param['param_ambiente'] = $_POST['param_ambiente'];

if (isset($_POST['param_origen']))
    $param['param_origen'] = $_POST['param_origen'];

if (isset($_POST['param_motivo']))
    $param['param_motivo'] = $_POST['param_motivo'];

if (isset($_POST['param_recepcion_fecha']))
    $param['param_recepcion_fecha'] = $_POST['param_recepcion_fecha'];

if (isset($_POST['param_ejecucion_fecha']))
    $param['param_ejecucion_fecha'] = $_POST['param_ejecucion_fecha'];

if (isset($_POST['param_responsable_funcional']))
    $param['param_responsable_funcional'] = $_POST['param_responsable_funcional'];

if (isset($_POST['param_responsable_tecnico']))
    $param['param_responsable_tecnico'] = $_POST['param_responsable_tecnico'];

if (isset($_POST['param_emergencia']))
    $param['param_emergencia'] = $_POST['param_emergencia'];

if (isset($_POST['param_alertas']))
    $param['param_alertas'] = $_POST['param_alertas'];
*/
//FIN VARIABLES CATEGORIA

$Categoria = new Categoria_model();
echo $Categoria->gestionar($param);
?>