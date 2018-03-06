<?php
    
    include_once('../add/google_authentication.php');

    if (!isset($_SESSION['token'])) {
        header("Location:../login/login.php");
    } else {

    if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();
    //Initialize User class
    $user = new User();
    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider' => 'google',
        'oauth_uid' => $gpUserProfile['id'],
        'first_name' => $gpUserProfile['given_name'],
        'last_name' => $gpUserProfile['family_name'],
        'email' => $gpUserProfile['email'],
        //'gender'        => $gpUserProfile['gender'],
        'locale' => $gpUserProfile['locale'],
        'picture' => $gpUserProfile['picture']
        //'link'          => $gpUserProfile['link']
    );

    $userData = $user->checkUser($gpUserData);
    $dominio = explode("@",$userData['email']);
    if($dominio[1]<>"confianza.pe"){
        session_destroy();
        header('Location: '. "../login/logout.php");
    }

    //Storing user data into session
    $_SESSION['userData'] = $userData;
        //Render facebook profile data
        if (!empty($userData)) {
            $index  = '../../index.php';
            $logout = '../login/logout.php';
            $information   = '../labels/information.php';
        } else {
            $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../add/head.php'); ?>
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <?php include_once('../add/header.php') ?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <?php include_once('../add/left_sidebar.php'); ?>
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Monitoreo de Backups</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Bitácoras</a></li>
                            <li class="breadcrumb-item active">Backups</li>
                        </ol>
                    </div>
                   <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                <input type="hidden" name="tarea" id="tarea" value="Espacios">
                <input type="hidden" name="user" id="user" value="<?php echo $userData['email']; ?>">

                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <!--
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> ¡Importante!</h3> Ésta bitácora debe contener los datos de los espacios y tablespaces de los servidores y base de datos tanto antes de la cadena de cierre diaria como después de ésta. Mantener actualizada ésta bitácora nos dará como resultado el comportamiento de los espacios mencionados.
                            </div>
                            -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#dbprod" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">DBPROD</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#can" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">CAN</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#prd" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">PRD</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cyber" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">CYBER</span></a> </li>

                            </ul>

                           <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="dbprod" role="tabpanel">
                                    <div class="p-20">
                                        <div class="card-body bg-info">
                                        <h4 class="card-title text-white">Histórico de registros</h4>
                                        <h6 class="card-subtitle text-white">Información del tamaño de backup de las tablas principales de la base de datos de producción necesario antes de la cadena de cierre.</h6>
                                    </div>  
                                    <div class="card-body">
                                        <div class="message-box contact-box">
                                            <h2 class="add-ct-btn">
                                                <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_dbprod">+</button>
                                            </h2>
                                        </div>  
                                       
                                        <div class="table-responsive m-t-40">
                                            <table id="table_dbprod" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Nombre</th>
                                                        <th>Compreso</th>
                                                        <th>Expandido</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Nombre</th>
                                                        <th>Compreso</th>
                                                        <th>Expandido</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody  id="body_dbprod">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="can" role="tabpanel">
                                    <div class="p-20">
                                        <div class="card-body bg-info">
                                        <h4 class="card-title text-white">Histórico de registros</h4>
                                        <h6 class="card-subtitle text-white">Información de backups de las tablas de canales de la base de datos de producción, necesario antes de la cadena de cierre.</h6>
                                    </div>  
                                    <div class="card-body">
                                        <div class="message-box contact-box">
                                            <h2 class="add-ct-btn">
                                                <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_can">+</button>
                                            </h2>
                                        </div>  
                                        <div class="table-responsive m-t-40">
                                            <table id="table_can" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Nombre</th>
                                                        <th>Compreso</th>
                                                        <th>Expandido</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Nombre</th>
                                                        <th>Compreso</th>
                                                        <th>Expandido</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody  id="body_can">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="prd" role="tabpanel">
                                    <div class="p-20">
                                        <div class="card-body bg-info">
                                        <h4 class="card-title text-white">Histórico de registros</h4>
                                        <h6 class="card-subtitle text-white">Información de backups de las tablas LONG de la base de datos de producción, necesario antes de la cadena de cierre.</h6>
                                    </div>  
                                    <div class="card-body">
                                        <div class="message-box contact-box">
                                            <h2 class="add-ct-btn">
                                                <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_prd">+</button>
                                            </h2>
                                        </div>  
                                       
                                        <div class="table-responsive m-t-40">
                                            <table id="table_prd" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Nombre</th>
                                                        <th>Compreso</th>
                                                        <th>Expandido</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Nombre</th>
                                                        <th>Compreso</th>
                                                        <th>Expandido</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody  id="body_prd">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="cyber" role="tabpanel">
                                    <div class="p-20">
                                        <div class="card-body bg-info">
                                            <h4 class="card-title text-white">Histórico de registros</h4>
                                            <h6 class="card-subtitle text-white">Información de backups de las tablas diarias de la base de datos de cyberfinancial, realizado automáticamente a la medianoche.</h6>
                                        </div>  
                                        <div class="card-body">
                                            <div class="message-box contact-box">
                                                <h2 class="add-ct-btn">
                                                    <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_cyber">+</button>
                                                </h2>
                                            </div>  
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        
                                        <!-- Nav tabs -->
                                        <div class="vtabs customvtab">
                                            <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#delquda2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">delquda2</span> </a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#rcvry" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">rcvry</span></a> </li>

                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="delquda2" role="tabpanel">
                                                    <div class="card-body">
                                                        <div class="alert alert-warning">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                            <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> ¡Advertencia!</h3> Los datos de ésta bitácora deben monitorearse ya que el backup se genera automáticamente a la medianoche.
                                                        </div>
                                                        <div class="table-responsive m-t-40">
                                                            <table id="table_delquda2" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%" >
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Nombre expdp_delquda2</th>
                                                                        <th>Compreso</th>
                                                                        <th>Expandido</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                       <th>Fecha</th>
                                                                        <th>Nombre expdp_delquda2</th>
                                                                        <th>Compreso</th>
                                                                        <th>Expandido</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody  id="body_delquda2">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane  p-20" id="rcvry" role="tabpanel">
                                                   <div class="alert alert-warning">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                            <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> ¡Advertencia!</h3> Los datos de ésta bitácora deben monitorearse ya que el backup se genera automáticamente a la medianoche.
                                                        </div>
                                                    <div class="table-responsive m-t-40">
                                                        <table id="table_rcvry" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%" >
                                                            <thead>
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Nombre expdp_rcvry</th>
                                                                    <th>Compreso</th>
                                                                    <th>Expandido</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>Fecha</th>
                                                                    <th>Nombre expdp_rcvry</th>
                                                                    <th>Compreso</th>
                                                                    <th>Expandido</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </tfoot>
                                                            <tbody  id="body_rcvry">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>

                <!-- ============================================================== -->
                <!-- Modal nuevo registro DBPROD -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_dbprod" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Nuevo registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_nuevo_dbprod" name="frm_nuevo_dbprod">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup DBPROD</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_dbprod_fecha" name="param_dbprod_fecha">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                        value="DBPROD_<?php echo date('Ymd',strtotime("-1 days")); ?>_" id="param_dbprod_nombre" name="param_dbprod_nombre">
                                                                       
                                                                    </div>
                                                                    <small class="form-control-feedback"> Completar nombre.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dbprod_com" name="param_dbprod_com">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dbprod_sincom" name="param_dbprod_sincom" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de backup DBPROD">
                                                    <input type="hidden" name="user" id="user" value="<?php echo $userData['email']; ?>">
                                                    <!-- /. End Datos de Operación -->
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_dbprod">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro DBPROD-->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Modal nuevo registro nuevo_can -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_can" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Nuevo registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_nuevo_can" name="frm_nuevo_can">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup CAN</h3>
                                                        <hr>
                                                        <div id="mensaje_can"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_can_fecha" name="param_can_fecha">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                        value="CAN_<?php echo date('Ymd',strtotime("-1 days")); ?>_" id="param_can_nombre" name="param_can_nombre">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Completar nombre.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_can_com" name="param_can_com">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_can_sincom" name="param_can_sincom" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de backup CAN">
                                                    <input type="hidden" name="user" id="user" value="<?php echo $userData['email']; ?>">
                                                    <!-- /. End Datos de Operación -->
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_can">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro nuevo_can-->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Modal nuevo registro nuevo_prd -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_prd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Nuevo registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_nuevo_prd" name="frm_nuevo_prd">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup PRD</h3>
                                                        <hr>
                                                        <div id="mensaje_prd"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-2 days")); ?>" id="param_prd_fecha" name="param_prd_fecha">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                        value="PRD_<?php echo date('Ymd',strtotime("-2 days")); ?>_" id="param_prd_nombre" name="param_prd_nombre">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Completar nombre.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_prd_com" name="param_prd_com">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_prd_sincom" name="param_prd_sincom" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de backup PRD">
                                                    <input type="hidden" name="user" id="user" value="<?php echo $userData['email']; ?>">
                                                    <!-- /. End Datos de Operación -->
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_prd">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro nuevo_prd-->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Modal nuevo registro nuevo_cyber -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_cyber" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Nuevo registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_nuevo_cyber" name="frm_nuevo_cyber">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup CYBER</h3>
                                                        <hr>
                                                        <div id="mensaje_cyber"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_cyber_fecha" name="param_cyber_fecha">
                                                                       
                                                                    </div>
                                                                    <small class="form-control-feedback"> 1 día antes de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- delquda2 -->
                                                        <h5 class="card-title">delquda2</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                        value="expdp_delquda2_<?php echo date('Ymd',strtotime("0 days")); ?>_0000" id="param_delquda2_nombre" name="param_delquda2_nombre">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Nombre completado automáticamente</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_delquda2_com" name="param_delquda2_com">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_delquda2_sincom" name="param_delquda2_sincom" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- rcvry -->
                                                        <h5 class="card-title">rcvry</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                        value="expdp_backup_rcvry_<?php echo date('Ymd',strtotime("0 days")); ?>_0000" id="param_rcvry_nombre" name="param_rcvry_nombre">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Nombre completado automáticamente</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_rcvry_com" name="param_rcvry_com">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_rcvry_sincom" name="param_rcvry_sincom" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de backup cyber">
                                                    <input type="hidden" name="user" id="user" value="<?php echo $userData['email']; ?>">
                                                    <!-- /. End Datos de Operación -->
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_cyber">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro nuevo_cyber-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal editar registro DBPROD -->
                <!-- ============================================================== -->
                <div id="modal-editar_dbprod" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Editar registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_update_dbprod" name="frm_update_dbprod">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup DBPROD</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod_edit"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' id="param_dbprod_fecha_edit" name="param_dbprod_fecha_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                        id="param_dbprod_nombre_edit" name="param_dbprod_nombre_edit">
                                                                       
                                                                    </div>
                                                                    <small class="form-control-feedback"> Completar nombre.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dbprod_com_edit" name="param_dbprod_com_edit">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dbprod_sincom_edit" name="param_dbprod_sincom_edit" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <input type="hidden" id="param_dbprod_id_edit" name="param_dbprod_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="update_dbprod">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal editar registro DBPROD-->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Modal editar registro editar_can -->
                <!-- ============================================================== -->
                <div id="modal-editar_can" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Editar registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_update_can" name="frm_update_can">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup CAN</h3>
                                                        <hr>
                                                        <div id="mensaje_can"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' id="param_can_fecha_edit" name="param_can_fecha_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                         id="param_can_nombre_edit" name="param_can_nombre_edit">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Completar nombre.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_can_com_edit" name="param_can_com_edit">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_can_sincom_edit" name="param_can_sincom_edit" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <input type="hidden" id="param_can_id_edit" name="param_can_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="update_can">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal editar registro editar_can-->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Modal editar registro editar_prd -->
                <!-- ============================================================== -->
                <div id="modal-editar_prd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Editar registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_update_prd" name="frm_update_prd">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup PRD</h3>
                                                        <hr>
                                                        <div id="mensaje_prd"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' id="param_prd_fecha_edit" name="param_prd_fecha_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                        id="param_prd_nombre_edit" name="param_prd_nombre_edit">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Completar nombre.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_prd_com_edit" name="param_prd_com_edit">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_prd_sincom_edit" name="param_prd_sincom_edit" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <input type="hidden" id="param_prd_id_edit" name="param_prd_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="update_prd">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal editar registro editar_prd-->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Modal editar registro editar_delquda2 -->
                <!-- ============================================================== -->
                <div id="modal-editar_delquda2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Editar registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_update_delquda2" name="frm_update_delquda2">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup delquda2</h3>
                                                        <hr>
                                                        <div id="mensaje_delquda2"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' id="param_delquda2_fecha_edit" name="param_delquda2_fecha_edit">
                                                                       
                                                                    </div>
                                                                    <small class="form-control-feedback"> 1 día antes de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- delquda2 -->
                                                        <h5 class="card-title">delquda2</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                         id="param_delquda2_nombre_edit" name="param_delquda2_nombre_edit">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Nombre completado automáticamente</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_delquda2_com_edit" name="param_delquda2_com_edit">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_delquda2_sincom_edit" name="param_delquda2_sincom_edit" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>            
                                                    </div>
                                                    <input type="hidden" id="param_delquda2_id_edit" name="param_delquda2_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="update_delquda2">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal editar registro editar_delquda2-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal editar registro editar_rcvry -->
                <!-- ============================================================== -->
                <div id="modal-editar_rcvry" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Editar registro</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card-body p-t-20">
                                                <form id="frm_update_rcvry" name="frm_update_rcvry">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Backup rcvry</h3>
                                                        <hr>
                                                        <div id="mensaje_rcvry"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' id="param_rcvry_fecha_edit" name="param_rcvry_fecha_edit">
                                                                       
                                                                    </div>
                                                                    <small class="form-control-feedback"> 1 día antes de backup.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- rcvry -->
                                                        <h5 class="card-title">rcvry</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">    
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" 
                                                                         id="param_rcvry_nombre_edit" name="param_rcvry_nombre_edit">
                                                                        
                                                                    </div>
                                                                    <small class="form-control-feedback"> Nombre completado automáticamente</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño compreso</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_rcvry_com_edit" name="param_rcvry_com_edit">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tamaño expandido</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_rcvry_sincom_edit" name="param_rcvry_sincom_edit" >
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">Tamaño en bytes</small>
                                                                </div>
                                                            </div>
                                                        </div>        
                                                    </div>
                                                    <input type="hidden" id="param_rcvry_id_edit" name="param_rcvry_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="update_rcvry">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal editar registro editar_rcvry-->
                <!-- ============================================================== -->






                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include_once('../add/footer.php'); ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    
    <!-- MIS JS -->
    <!-- Menu -->
    <script src="../../js/treemodulo.js"></script>
    <!-- Mantenedor -->
    <script src="../../js/bitacoras/backups_js.js"></script>
     <!-- Plugin JavaScript --> 
    <script src="../../assets/plugins/moment/moment.js"></script>
    <script src="../../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="../../assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="../../assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="../../assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="../../assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="../../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../assets/js/custom.min.js"></script>
    <!-- This is data table -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../../assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
   
   

    <script>
    
  
    jQuery('#param_dbprod_fecha').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_dbprod_fecha_edit').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_can_fecha').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_can_fecha_edit').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_prd_fecha').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_prd_fecha_edit').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_cyber_fecha').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_cyber_fecha_edit').datepicker({
        autoclose: true,
        todayHighlight: true
    });





  
    
    </script>

    

   
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>



</body>

</html>

 <?php } ?>