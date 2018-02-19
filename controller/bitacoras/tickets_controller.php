<?php 
session_start();
include_once '../../model/bitacoras/tickets_model.php';

$param = array();

//OPCION = 
$param['param_opcion']='';

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

//FIN OPCION

//TAREA

$param['param_tarea']='';

if (isset($_POST['param_tarea']))
    $param['param_tarea'] = $_POST['param_tarea']; 


//TICKETS MANTENEDOR

$param['param_ticket_nro']='';
$param['param_usuario']='';
$param['param_asunto']='';
$param['param_descripcion']='';
$param['param_fecha']='';
$param['param_tipo']='';
$param['param_estado']='';

//tarea+ user - OPERACIONES
$param['tarea']='';
if (isset($_POST['tarea']))
    $param['param_tarea'] = $_POST['tarea'];

$param['user']='';
if (isset($_POST['user']))
    $param['param_user'] = $_POST['user'];
//FIN OPeraciones


if (isset($_POST['param_ticket_nro']))
    $param['param_ticket_nro'] = $_POST['param_ticket_nro']; 

if (isset($_POST['param_usuario']))
    $param['param_usuario'] = $_POST['param_usuario']; 

if (isset($_POST['param_asunto']))
    $param['param_asunto'] = $_POST['param_asunto']; 

if (isset($_POST['param_descripcion']))
    $param['param_descripcion'] = $_POST['param_descripcion']; 

if (isset($_POST['param_fecha']))
    $param['param_fecha'] = $_POST['param_fecha']; 

if (isset($_POST['param_tipo']))
    $param['param_tipo'] = $_POST['param_tipo']; 

if (isset($_POST['param_estado']))
    $param['param_estado'] = $_POST['param_estado']; 



if (isset($_POST['param_ticket_nro_edit']))
    $param['param_ticket_nro_edit'] = $_POST['param_ticket_nro_edit']; 

if (isset($_POST['param_usuario_edit']))
    $param['param_usuario_edit'] = $_POST['param_usuario_edit']; 

if (isset($_POST['param_asunto_edit']))
    $param['param_asunto_edit'] = $_POST['param_asunto_edit']; 

if (isset($_POST['param_descripcion_edit']))
    $param['param_descripcion_edit'] = $_POST['param_descripcion_edit']; 

if (isset($_POST['param_fecha_edit']))
    $param['param_fecha_edit'] = $_POST['param_fecha_edit']; 

if (isset($_POST['param_tipo_edit']))
    $param['param_tipo_edit'] = $_POST['param_tipo_edit']; 

if (isset($_POST['param_estado_edit']))
    $param['param_estado_edit'] = $_POST['param_estado_edit']; 


$param['param_id']='';

if (isset($_POST['param_id']))
    $param['param_id'] = $_POST['param_id'];



//editar
$param['param_id_edit']='';

if (isset($_POST['param_id_edit']))
    $param['param_id_edit'] = $_POST['param_id_edit'];

//Reporte






//FIN REPORTES


$Tickets = new Tickets_model();
echo $Tickets->gestionar($param);


 ?>