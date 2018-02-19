<?php

include_once '../model/tree_model_pages.php';

$param = array();
$param['param_opcion']='';

$param['grupo']='';
$param['tarea']='';

/*
$param['param_usuUsuario']='';
$param['param_usuClave']='';
$param['param_usuId']='';*/

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if (isset($_POST['param_grupo']))
    $param['param_grupo'] = $_POST['param_grupo'];

if (isset($_POST['param_tarea']))
    $param['param_tarea'] = $_POST['param_tarea'];

$param['user']='';
if (isset($_POST['user']))
    $param['param_user'] = $_POST['user'];
/*

if(isset($_SESSION['usuario']))
    $param['param_usuUsuario'] = $_SESSION['usuario'];

if(isset($_SESSION['idusuario']))
    $param['param_usuId'] = $_SESSION['idusuario'];    */

$Tree = new Tree_Model();
echo $Tree->gestionar($param);
?>
