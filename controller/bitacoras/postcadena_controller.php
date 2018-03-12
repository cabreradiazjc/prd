<?php 
session_start();
include_once '../../model/bitacoras/postcadena_model.php';

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



//TESORERIA

if (isset($_POST['param_fecha_tesoreria']))
    $param['param_fecha_tesoreria'] = $_POST['param_fecha_tesoreria']; 

if (isset($_POST['param_balancenormativo']))
    $param['param_balancenormativo'] = $_POST['param_balancenormativo']; 

if (isset($_POST['param_balancecontable']))
    $param['param_balancecontable'] = $_POST['param_balancecontable']; 

if (isset($_POST['param_PBCPEMAA']))
    $param['param_PBCPEMAA'] = $_POST['param_PBCPEMAA']; 

if (isset($_POST['param_PBCPEMAB']))
    $param['param_PBCPEMAB'] = $_POST['param_PBCPEMAB']; 

if (isset($_POST['param_PBCPEMAD']))
    $param['param_PBCPEMAD'] = $_POST['param_PBCPEMAD']; 

if (isset($_POST['param_PBCPEMAC']))
    $param['param_PBCPEMAC'] = $_POST['param_PBCPEMAC']; 

if (isset($_POST['param_PBCPED4A']))
    $param['param_PBCPED4A'] = $_POST['param_PBCPED4A']; 

if (isset($_POST['param_PBCPED4B']))
    $param['param_PBCPED4B'] = $_POST['param_PBCPED4B']; 

if (isset($_POST['param_PBCPED4D']))
    $param['param_PBCPED4D'] = $_POST['param_PBCPED4D']; 

if (isset($_POST['param_PBCPED4C']))
    $param['param_PBCPED4C'] = $_POST['param_PBCPED4C']; 

if (isset($_POST['param_PBCPED5A']))
    $param['param_PBCPED5A'] = $_POST['param_PBCPED5A']; 

if (isset($_POST['param_PBCPED5B']))
    $param['param_PBCPED5B'] = $_POST['param_PBCPED5B']; 

if (isset($_POST['param_PBCPED5D']))
    $param['param_PBCPED5D'] = $_POST['param_PBCPED5D']; 

if (isset($_POST['param_PBCPED5C']))
    $param['param_PBCPED5C'] = $_POST['param_PBCPED5C']; 

if (isset($_POST['param_PBCPEE6A']))
    $param['param_PBCPEE6A'] = $_POST['param_PBCPEE6A']; 

if (isset($_POST['param_PBCPEE6B']))
    $param['param_PBCPEE6B'] = $_POST['param_PBCPEE6B']; 

if (isset($_POST['param_PBCPEE6C']))
    $param['param_PBCPEE6C'] = $_POST['param_PBCPEE6C']; 


//CONTABILIDAD


if (isset($_POST['param_fecha_contabilidad']))
    $param['param_fecha_contabilidad'] = $_POST['param_fecha_contabilidad']; 

if (isset($_POST['param_PBCPED1A']))
    $param['param_PBCPED1A'] = $_POST['param_PBCPED1A']; 

if (isset($_POST['param_PBCPED1B']))
    $param['param_PBCPED1B'] = $_POST['param_PBCPED1B']; 

if (isset($_POST['param_PBCPED1D']))
    $param['param_PBCPED1D'] = $_POST['param_PBCPED1D']; 

if (isset($_POST['param_PBCPED1C']))
    $param['param_PBCPED1C'] = $_POST['param_PBCPED1C']; 

if (isset($_POST['param_PBCPED7A']))
    $param['param_PBCPED7A'] = $_POST['param_PBCPED7A']; 

if (isset($_POST['param_PBCPED7B']))
    $param['param_PBCPED7B'] = $_POST['param_PBCPED7B']; 

if (isset($_POST['param_PBCPED7D']))
    $param['param_PBCPED7D'] = $_POST['param_PBCPED7D']; 

if (isset($_POST['param_PBCPED7C']))
    $param['param_PBCPED7C'] = $_POST['param_PBCPED7C']; 

if (isset($_POST['param_PBCPED8A']))
    $param['param_PBCPED8A'] = $_POST['param_PBCPED8A']; 

if (isset($_POST['param_PBCPED8B']))
    $param['param_PBCPED8B'] = $_POST['param_PBCPED8B']; 

if (isset($_POST['param_PBCPED8D']))
    $param['param_PBCPED8D'] = $_POST['param_PBCPED8D']; 

if (isset($_POST['param_PBCPED8C']))
    $param['param_PBCPED8C'] = $_POST['param_PBCPED8C']; 

if (isset($_POST['param_PBCPED2A']))
    $param['param_PBCPED2A'] = $_POST['param_PBCPED2A']; 

if (isset($_POST['param_PBCPED2B']))
    $param['param_PBCPED2B'] = $_POST['param_PBCPED2B']; 

if (isset($_POST['param_PBCPED2D']))
    $param['param_PBCPED2D'] = $_POST['param_PBCPED2D']; 

if (isset($_POST['param_PBCPED2C']))
    $param['param_PBCPED2C'] = $_POST['param_PBCPED2C']; 






//ANEXOS


if (isset($_POST['param_fecha_anexos']))
    $param['param_fecha_anexos'] = $_POST['param_fecha_anexos']; 

if (isset($_POST['param_PBCPEMTA']))
    $param['param_PBCPEMTA'] = $_POST['param_PBCPEMTA']; 

if (isset($_POST['param_PBCPEMTB']))
    $param['param_PBCPEMTB'] = $_POST['param_PBCPEMTB']; 


if (isset($_POST['param_PJNGY450']))
    $param['param_PJNGY450'] = $_POST['param_PJNGY450']; 


if (isset($_POST['param_PBCPEMZA']))
    $param['param_PBCPEMZA'] = $_POST['param_PBCPEMZA']; 


if (isset($_POST['param_PBCPEMZN']))
    $param['param_PBCPEMZN'] = $_POST['param_PBCPEMZN']; 


if (isset($_POST['param_PBCPEMZO']))
    $param['param_PBCPEMZO'] = $_POST['param_PBCPEMZO']; 


if (isset($_POST['param_PBCPEMZC']))
    $param['param_PBCPEMZC'] = $_POST['param_PBCPEMZC']; 


if (isset($_POST['param_PJNGY244']))
    $param['param_PJNGY244'] = $_POST['param_PJNGY244']; 


if (isset($_POST['param_PJNGY242']))
    $param['param_PJNGY242'] = $_POST['param_PJNGY242']; 


if (isset($_POST['param_PJNGY243']))
    $param['param_PJNGY243'] = $_POST['param_PJNGY243']; 

//CYBERFINANCIAL

if (isset($_POST['param_fecha_cyberfinancial']))
    $param['param_fecha_cyberfinancial'] = $_POST['param_fecha_cyberfinancial']; 

if (isset($_POST['param_PJNGY729']))
    $param['param_PJNGY729'] = $_POST['param_PJNGY729']; 

if (isset($_POST['param_PJNGY730']))
    $param['param_PJNGY730'] = $_POST['param_PJNGY730']; 

if (isset($_POST['param_PJNGY754']))
    $param['param_PJNGY754'] = $_POST['param_PJNGY754']; 

if (isset($_POST['param_PJNGY753']))
    $param['param_PJNGY753'] = $_POST['param_PJNGY753']; 

if (isset($_POST['param_PJNGY758']))
    $param['param_PJNGY758'] = $_POST['param_PJNGY758']; 

if (isset($_POST['param_PJNGY731']))
    $param['param_PJNGY731'] = $_POST['param_PJNGY731']; 

if (isset($_POST['param_PJNGY759']))
    $param['param_PJNGY759'] = $_POST['param_PJNGY759']; 

if (isset($_POST['param_PJNGY808']))
    $param['param_PJNGY808'] = $_POST['param_PJNGY808']; 

if (isset($_POST['param_PJNGY747']))
    $param['param_PJNGY747'] = $_POST['param_PJNGY747']; 

if (isset($_POST['param_PJNGY751']))
    $param['param_PJNGY751'] = $_POST['param_PJNGY751']; 

if (isset($_POST['param_PJNGY767']))
    $param['param_PJNGY767'] = $_POST['param_PJNGY767']; 

if (isset($_POST['param_PJNGY768']))
    $param['param_PJNGY768'] = $_POST['param_PJNGY768']; 

if (isset($_POST['param_PJNGY769']))
    $param['param_PJNGY769'] = $_POST['param_PJNGY769']; 

if (isset($_POST['param_PJNGY760']))
    $param['param_PJNGY760'] = $_POST['param_PJNGY760']; 

if (isset($_POST['param_PJNGY766']))
    $param['param_PJNGY766'] = $_POST['param_PJNGY766']; 



//CREDITOS

if (isset($_POST['param_fecha_creditos']))
    $param['param_fecha_creditos'] = $_POST['param_fecha_creditos']; 

if (isset($_POST['param_PJNGY338']))
    $param['param_PJNGY338'] = $_POST['param_PJNGY338']; 

if (isset($_POST['param_PJNGY238']))
    $param['param_PJNGY238'] = $_POST['param_PJNGY238']; 

if (isset($_POST['param_PJNGY233']))
    $param['param_PJNGY233'] = $_POST['param_PJNGY233']; 

if (isset($_POST['param_PJNGY234']))
    $param['param_PJNGY234'] = $_POST['param_PJNGY234']; 

//PR

if (isset($_POST['param_fecha_pr']))
    $param['param_fecha_pr'] = $_POST['param_fecha_pr'];

if (isset($_POST['param_PJNGY526']))
    $param['param_PJNGY526'] = $_POST['param_PJNGY526']; 

if (isset($_POST['param_PJNGY549']))
    $param['param_PJNGY549'] = $_POST['param_PJNGY549']; 

if (isset($_POST['param_PJNGY579']))
    $param['param_PJNGY579'] = $_POST['param_PJNGY579']; 

if (isset($_POST['param_PJNGY580']))
    $param['param_PJNGY580'] = $_POST['param_PJNGY580']; 


//CARTERAS3

if (isset($_POST['param_fecha_carteras3']))
    $param['param_fecha_carteras3'] = $_POST['param_fecha_carteras3']; 

if (isset($_POST['param_PKNGY251']))
    $param['param_PKNGY251'] = $_POST['param_PKNGY251']; 

if (isset($_POST['param_PKNGY252']))
    $param['param_PKNGY252'] = $_POST['param_PKNGY252']; 

if (isset($_POST['param_PKNGY253']))
    $param['param_PKNGY253'] = $_POST['param_PKNGY253']; 

if (isset($_POST['param_PJNGX516']))
    $param['param_PJNGX516'] = $_POST['param_PJNGX516']; 

if (isset($_POST['param_PJNGX446']))
    $param['param_PJNGX446'] = $_POST['param_PJNGX446']; 

if (isset($_POST['param_PJNGX423']))
    $param['param_PJNGX423'] = $_POST['param_PJNGX423']; 

if (isset($_POST['param_PJNGX395']))
    $param['param_PJNGX395'] = $_POST['param_PJNGX395']; 

if (isset($_POST['param_PJNGY269']))
    $param['param_PJNGY269'] = $_POST['param_PJNGY269']; 

if (isset($_POST['param_PJNGX586']))
    $param['param_PJNGX586'] = $_POST['param_PJNGX586']; 

if (isset($_POST['param_PJNGX582']))
    $param['param_PJNGX582'] = $_POST['param_PJNGX582']; 

if (isset($_POST['param_PJNGX483']))
    $param['param_PJNGX483'] = $_POST['param_PJNGX483']; 

if (isset($_POST['param_PJNGX613']))
    $param['param_PJNGX613'] = $_POST['param_PJNGX613']; 

if (isset($_POST['param_PJNGX641']))
    $param['param_PJNGX641'] = $_POST['param_PJNGX641']; 

if (isset($_POST['param_PJNGX632']))
    $param['param_PJNGX632'] = $_POST['param_PJNGX632']; 

if (isset($_POST['param_PJNGX648']))
    $param['param_PJNGX648'] = $_POST['param_PJNGX648'];


$Postcadena = new Postcadena_model();
echo $Postcadena->gestionar($param);


 ?>