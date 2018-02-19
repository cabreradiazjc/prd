<?php 
session_start();
include_once '../../model/dashboard/dashboard_model.php';

$param = array();

//OPCION = 
$param['param_opcion']='';

if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

//FIN OPCION



//FIN REPORTES


$Dashboard = new Dashboard_model();
echo $Dashboard->gestionar($param);


 ?>