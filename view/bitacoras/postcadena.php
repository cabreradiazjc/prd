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
                        <h3 class="text-themecolor m-b-0 m-t-0">Bitácora de Post-cadena</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Bitácoras</a></li>
                            <li class="breadcrumb-item active">Post-cadena</li>
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
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i>¡Advertencia!</h3> Los datos de ésta bitácora deben llenarse diariamente al finalizar los procesos post-cadena diarios.
                                </div>

                                <!-- Nav tabs -->
                                <div class="vtabs customvtab">
                                    <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tesoreria" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Tesorería</span> </a> </li>

                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#contabilidad" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Contabilidad</span></a> </li>

                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#anexos" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Anexos y Tasaciones</span></a> </li>


                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cyberfinancial" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Cyberfinancial</span></a> </li>

                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#creditos" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Créditos Cancelados</span></a> </li>

                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pr" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Prorrogados y Reprogramados</span></a> </li>

                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#carteras3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Carteras 3</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tesoreria" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">       
                                                    <div class="card-body bg-info">
                                                        <h4 class="card-title text-white">Histórico de registros</h4>
                                                        <h6 class="card-subtitle text-white">Información de los tiempos de ejecución de los procesos de tesorería después de la finalización correcta de la cadena de cierre.</h6>
                                                    </div> 
                                                    <div class="card-body" >
                                                        <div class="message-box contact-box">
                                                            <h2 class="add-ct-btn">
                                                                <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_tesoreria">+</button>
                                                                <button type="button" class="btn btn-circle btn-lg btn-inverse waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-editar_tesoreria"><i class="fa fa-edit"></i> </button>
                                                            </h2>
                                                            

                                                        </div>  
                                                       
                                                        <div class="table-responsive m-t-40">
                                                            <table id="table_tesoreria" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;" >
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Código</th>
                                                                        <th>Descripción</th>
                                                                        <th>Tiempo</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Código</th>
                                                                        <th>Descripción</th>
                                                                        <th>Tiempo</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody  id="body_tesoreria">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                              
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="contabilidad" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">       
                                                    <div class="card-body bg-info">
                                                        <h4 class="card-title text-white">Histórico de registros</h4>
                                                        <h6 class="card-subtitle text-white">Información de los tiempos de ejecución de los procesos de tesorería después de la finalización correcta de la cadena de cierre.</h6>
                                                    </div> 
                                                    <div class="card-body" >
                                                        <div class="message-box contact-box">
                                                            <h2 class="add-ct-btn">
                                                                <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_contabilidad">+</button>
                                                                <button type="button" class="btn btn-circle btn-lg btn-inverse waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-editar_contabilidad"><i class="fa fa-edit"></i> </button>
                                                            </h2>
                                                            

                                                        </div>  
                                                       
                                                        <div class="table-responsive m-t-40">
                                                            <table id="table_contabilidad" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;" >
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Código</th>
                                                                        <th>Descripción</th>
                                                                        <th>Tiempo</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Código</th>
                                                                        <th>Descripción</th>
                                                                        <th>Tiempo</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody  id="body_contabilidad">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                              
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="anexos" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">       
                                                        <div class="card-body bg-info">
                                                            <h4 class="card-title text-white">Histórico de registros</h4>
                                                            <h6 class="card-subtitle text-white">Información de los tiempos de ejecución de los procesos de tesorería después de la finalización correcta de la cadena de cierre.</h6>
                                                        </div> 
                                                        <div class="card-body" >
                                                            <div class="message-box contact-box">
                                                                <h2 class="add-ct-btn">
                                                                    <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_anexos">+</button>
                                                                    <button type="button" class="btn btn-circle btn-lg btn-inverse waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-editar_anexos"><i class="fa fa-edit"></i> </button>
                                                                </h2>
                                                                

                                                            </div>  
                                                           
                                                            <div class="table-responsive m-t-40">
                                                                <table id="table_anexos" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody  id="body_anexos">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                              
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="cyberfinancial" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">       
                                                        <div class="card-body bg-info">
                                                            <h4 class="card-title text-white">Histórico de registros</h4>
                                                            <h6 class="card-subtitle text-white">Información de los tiempos de ejecución de los procesos de tesorería después de la finalización correcta de la cadena de cierre.</h6>
                                                        </div> 
                                                        <div class="card-body" >
                                                            <div class="message-box contact-box">
                                                                <h2 class="add-ct-btn">
                                                                    <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_cyberfinancial">+</button>
                                                                    <button type="button" class="btn btn-circle btn-lg btn-inverse waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-editar_cyberfinancial"><i class="fa fa-edit"></i> </button>
                                                                </h2>
                                                                

                                                            </div>  
                                                           
                                                            <div class="table-responsive m-t-40">
                                                                <table id="table_cyberfinancial" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody  id="body_cyberfinancial">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                              
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="creditos" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">       
                                                        <div class="card-body bg-info">
                                                            <h4 class="card-title text-white">Histórico de registros</h4>
                                                            <h6 class="card-subtitle text-white">Información de los tiempos de ejecución de los procesos de tesorería después de la finalización correcta de la cadena de cierre.</h6>
                                                        </div> 
                                                        <div class="card-body" >
                                                            <div class="message-box contact-box">
                                                                <h2 class="add-ct-btn">
                                                                    <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_creditos">+</button>
                                                                    <button type="button" class="btn btn-circle btn-lg btn-inverse waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-editar_creditos"><i class="fa fa-edit"></i> </button>
                                                                </h2>
                                                                

                                                            </div>  
                                                           
                                                            <div class="table-responsive m-t-40">
                                                                <table id="table_creditos" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody  id="body_creditos">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                              
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="pr" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">       
                                                        <div class="card-body bg-info">
                                                            <h4 class="card-title text-white">Histórico de registros</h4>
                                                            <h6 class="card-subtitle text-white">Información de los tiempos de ejecución de los procesos de tesorería después de la finalización correcta de la cadena de cierre.</h6>
                                                        </div> 
                                                        <div class="card-body" >
                                                            <div class="message-box contact-box">
                                                                <h2 class="add-ct-btn">
                                                                    <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_pr">+</button>
                                                                    <button type="button" class="btn btn-circle btn-lg btn-inverse waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-editar_pr"><i class="fa fa-edit"></i> </button>
                                                                </h2>
                                                                

                                                            </div>  
                                                           
                                                            <div class="table-responsive m-t-40">
                                                                <table id="table_pr" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody  id="body_pr">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                              
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="carteras3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">       
                                                        <div class="card-body bg-info">
                                                            <h4 class="card-title text-white">Histórico de registros</h4>
                                                            <h6 class="card-subtitle text-white">Información de los tiempos de ejecución de los procesos de tesorería después de la finalización correcta de la cadena de cierre.</h6>
                                                        </div> 
                                                        <div class="card-body" >
                                                            <div class="message-box contact-box">
                                                                <h2 class="add-ct-btn">
                                                                    <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_carteras3">+</button>
                                                                    <button type="button" class="btn btn-circle btn-lg btn-inverse waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-editar_carteras3"><i class="fa fa-edit"></i> </button>
                                                                </h2>
                                                                

                                                            </div>  
                                                           
                                                            <div class="table-responsive m-t-40">
                                                                <table id="table_carteras3" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width: 100%;" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Código</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tiempo</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody  id="body_carteras3">
                                                                        
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
                <!-- Modal nuevo registro Tesorería -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_tesoreria" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
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
                                                <form id="frm_nuevo_tesoreria" name="frm_nuevo_tesoreria">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Tesorería</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" style="text-align: right;" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_fecha_tesoreria" name="param_fecha_tesoreria">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Balance Normativo</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_balancenormativo" name="param_balancenormativo" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Balance Contable</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_balancecontable" name="param_balancecontable"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMAA</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control pull-right" id="param_PBCPEMAA" name="param_PBCPEMAA" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMAB</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMAB" name="param_PBCPEMAB" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMAD</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMAD" name="param_PBCPEMAD" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMAC</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMAC" name="param_PBCPEMAC" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED4A</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED4A" name="param_PBCPED4A" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED4B</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED4B" name="param_PBCPED4B" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED4D</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED4D" name="param_PBCPED4D" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED4C</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED4C" name="param_PBCPED4C" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED5A</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED5A" name="param_PBCPED5A" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED5B</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED5B" name="param_PBCPED5B" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED5D</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED5D" name="param_PBCPED5D"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED5C</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED5C" name="param_PBCPED5C"  value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEE6A</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEE6A" name="param_PBCPEE6A" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEE6B</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEE6B" name="param_PBCPEE6B"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEE6C</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEE6C" name="param_PBCPEE6C" value="00:00:00" style="text-align: right;" >
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de postcadena - Tesorería">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_tesoreria">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro Tesorería-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal nuevo registro Contabilidad -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_contabilidad" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
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
                                                <form id="frm_nuevo_contabilidad" name="frm_nuevo_contabilidad">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Contabilidad</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" style="text-align: right;" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_fecha_contabilidad" name="param_fecha_contabilidad">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED1A</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control pull-right" id="param_PBCPED1A" name="param_PBCPED1A" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED1B</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED1B" name="param_PBCPED1B" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED1D</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED1D" name="param_PBCPED1D" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED1C</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED1C" name="param_PBCPED1C" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED7A</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED7A" name="param_PBCPED7A" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED7B</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED7B" name="param_PBCPED7B" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED7D</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED7D" name="param_PBCPED7D" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED7C</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED7C" name="param_PBCPED7C" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED8A</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED8A" name="param_PBCPED8A" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED8B</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED8B" name="param_PBCPED8B" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED8D</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED8D" name="param_PBCPED8D"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED8C</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED8C" name="param_PBCPED8C"  value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED2A</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED2A" name="param_PBCPED2A" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED2B</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED2B" name="param_PBCPED2B"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED2D</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED2D" name="param_PBCPED2D" value="00:00:00" style="text-align: right;" >
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPED2C</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPED2C" name="param_PBCPED2C" value="00:00:00" style="text-align: right;" >
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de postcadena - Contabilidad">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_contabilidad">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro Contabilidad-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal nuevo registro Anexos -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_anexos" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
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
                                                <form id="frm_nuevo_anexos" name="frm_nuevo_anexos">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Anexos</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" style="text-align: right;" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_fecha_anexos" name="param_fecha_anexos">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>


                                                        <h5>ANEXO 15B </h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY450</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control pull-right" id="param_PJNGY450" name="param_PJNGY450" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        <h5>ANEXO 17A DIARIO</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMTA</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMTA" name="param_PBCPEMTA" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMTB</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMTB" name="param_PBCPEMTB" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        <h5>ANEXO 7</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMZA</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMZA" name="param_PBCPEMZA" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMZN</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMZN" name="param_PBCPEMZN" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMZO</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMZO" name="param_PBCPEMZO"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PBCPEMZC</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PBCPEMZC" name="param_PBCPEMZC"  value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                         <h5>TASACIONES</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY244</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY244" name="param_PJNGY244" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY242</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY242" name="param_PJNGY242"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY243</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY243" name="param_PJNGY243" value="00:00:00" style="text-align: right;" >
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de postcadena - Anexos">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_anexos">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro Anexos-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal nuevo registro cyberfinancial -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_cyberfinancial" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
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
                                                <form id="frm_nuevo_cyberfinancial" name="frm_nuevo_cyberfinancial">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Cyberfinancial</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" style="text-align: right;" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_fecha_cyberfinancial" name="param_fecha_cyberfinancial">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <h5>Cyberfinancial 1</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY729</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control pull-right" id="param_PJNGY729" name="param_PJNGY729" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY730</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY730" name="param_PJNGY730" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY754</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY754" name="param_PJNGY754" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY753</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY753" name="param_PJNGY753" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Cyberfinancial 2</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY758</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY758" name="param_PJNGY758" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY731</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY731" name="param_PJNGY731" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY759</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY759" name="param_PJNGY759" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY808</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY808" name="param_PJNGY808" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY747</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY747" name="param_PJNGY747" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY751</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY751" name="param_PJNGY751" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h5>Cyberfinancial 3</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY767</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY767" name="param_PJNGY767" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY768</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY768" name="param_PJNGY768" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY769</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY769" name="param_PJNGY769"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY760</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY760" name="param_PJNGY760"  value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Testigo PJNGY766</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY766" name="param_PJNGY766" value="00:00:00" style="text-align: right;" >
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de postcadena - Cyberfinancial">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_cyberfinancial">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro Cyberfinancial-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal nuevo registro creditos -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_creditos" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
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
                                                <form id="frm_nuevo_creditos" name="frm_nuevo_creditos">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Créditos Cancelados</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" style="text-align: right;" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_fecha_creditos" name="param_fecha_creditos">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <h5> Cartera Semanal </h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY338</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control pull-right" id="param_PJNGY338" name="param_PJNGY338" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <h5> Clasificadora Semanal </h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY238</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY238" name="param_PJNGY238" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY233</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY233" name="param_PJNGY233" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY234</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY234" name="param_PJNGY234" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                       
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de postcadena - Créditos Cancelados">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_creditos">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro Créditos Cancelados-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal nuevo registro pr -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_pr" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
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
                                                <form id="frm_nuevo_pr" name="frm_nuevo_pr">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Prorrogados y Reprogramados</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" style="text-align: right;" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_fecha_pr" name="param_fecha_pr">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        <h5>Reprogramados</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY579</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control pull-right" id="param_PJNGY579" name="param_PJNGY579" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY580</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY580" name="param_PJNGY580" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                         <h5>Prorrogados</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY526</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY526" name="param_PJNGY526" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY549</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY549" name="param_PJNGY549" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                           
                                                        </div>

                                                    
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de postcadena - Prorrogados y Reprogramados">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_pr">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro pr-->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- Modal nuevo registro carteras3 -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_carteras3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
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
                                                <form id="frm_nuevo_carteras3" name="frm_nuevo_carteras3">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Carteras 3</h3>
                                                        <hr>
                                                        <div id="mensaje_dbprod"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" style="text-align: right;" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_fecha_carteras3" name="param_fecha_carteras3">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PKNGY251</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control pull-right" id="param_PKNGY251" name="param_PKNGY251" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PKNGY252</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PKNGY252" name="param_PKNGY252" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PKNGY253</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PKNGY253" name="param_PKNGY253" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX516</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX516" name="param_PJNGX516" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PPJNGX446</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX446" name="param_PJNGX446" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX423</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX423" name="param_PJNGX423" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX395</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX395" name="param_PJNGX395" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGY269</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGY269" name="param_PJNGY269" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX586</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX586" name="param_PJNGX586" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX582</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX582" name="param_PJNGX582" value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX483</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX483" name="param_PJNGX483"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX613</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX613" name="param_PJNGX613"  value="00:00:00"  style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX641</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX641" name="param_PJNGX641" value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">PJNGX632</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_PJNGX632" name="param_PJNGX632"  value="00:00:00" style="text-align: right;">
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de postcadena - Carteras 3">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_carteras3">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro carteras3-->
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
    <script src="../../js/bitacoras/postcadena_js.js"></script>
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
    
  
    jQuery('#param_fecha_tesoreria').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_fecha_contabilidad').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_fecha_anexos').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_fecha_cyberfinancial').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_fecha_creditos').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_fecha_pr').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_fecha_carteras3').datepicker({
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