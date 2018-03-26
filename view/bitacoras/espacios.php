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
                        <h3 class="text-themecolor m-b-0 m-t-0">Espacios y Tablespaces</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Bitácoras</a></li>
                            <li class="breadcrumb-item active">Espacios</li>
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
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> ¡Importante!</h3> Ésta bitácora debe contener los datos de los espacios y tablespaces de los servidores y base de datos tanto antes de la cadena de cierre diaria como después de ésta. Mantener actualizada ésta bitácora nos dará como resultado el comportamiento de los espacios mencionados.
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#precadena" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Pre-cadena</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#postcadena" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Post-cadena</span></a> </li>
                            </ul>

                           <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="precadena" role="tabpanel">
                                    <div class="p-20">
                                        <div class="card-body bg-info">
                                        <h4 class="card-title text-white">Histórico de registros</h4>
                                        <h6 class="card-subtitle text-white">Información de los espacios y tablespaces <strong>antes</strong> de la cadena de cierre.</h6>
                                    </div>  
                                    <div class="card-body">
                                        <div class="message-box contact-box">
                                            <h2 class="add-ct-btn">
                                                <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_ac">+</button>
                                            </h2>
                                        </div>  
                                       
                                        <div class="table-responsive m-t-40">
                                            <table id="table_ac_espacios" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha Pre</th>
                                                        <th>172.20.0.24</th>
                                                        <th>172.20.0.31</th>
                                                        <th>172.20.0.38</th>
                                                        <th>172.20.0.127</th>
                                                        <th>DBPROD</th>
                                                        <th>Cyber</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Fecha Pre</th>
                                                        <th>172.20.0.24</th>
                                                        <th>172.20.0.31</th>
                                                        <th>172.20.0.38</th>
                                                        <th>172.20.0.127</th>
                                                        <th>DBPROD</th>
                                                        <th>Cyber</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody  id="body_ac_espacios">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="postcadena" role="tabpanel">
                                    <div class="p-20">
                                        <div class="card-body bg-info">
                                        <h4 class="card-title text-white">Histórico de registros</h4>
                                        <h6 class="card-subtitle text-white">Información de los espacios y tablespaces <strong>después</strong> de la cadena de cierre.</h6>
                                    </div>  
                                    <div class="card-body">
                                        <div class="message-box contact-box">
                                            <h2 class="add-ct-btn">
                                                <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevo_dc">+</button>
                                            </h2>
                                        </div>  
                                        <div class="table-responsive m-t-40">
                                            <table id="table_dc_espacios" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha Post</th>
                                                        <th>172.20.0.24</th>
                                                        <th>172.20.0.31</th>
                                                        <th>172.20.0.38</th>
                                                        <th>172.20.0.127</th>
                                                        <th>DBPROD</th>
                                                        <th>Cyber</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Fecha Post</th>
                                                        <th>172.20.0.24</th>
                                                        <th>172.20.0.31</th>
                                                        <th>172.20.0.38</th>
                                                        <th>172.20.0.127</th>
                                                        <th>DBPROD</th>
                                                        <th>Cyber</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody  id="body_dc_espacios">
                                                    
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

                <!-- ============================================================== -->
                <!-- Modal nuevo registro pre-cadena -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_ac" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                <form id="frm_nuevo_ac" name="frm_nuevo_ac">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Espacios y tablespaces pre - cadena</h3>
                                                        <hr>
                                                        <div id="mensaje_ac"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_ac_fecha" name="param_ac_fecha">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de hoy.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Espacios</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.24</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_24" name="param_ac_24" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.31</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_31" name="param_ac_31" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.38</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_38" name="param_ac_38" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradatahis</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.127</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_127" name="param_ac_127" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/export</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Tablespaces</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">PRODUCCIÓN</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_tedbprod" name="param_ac_tedbprod" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">dbprod</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">CYBERFINANCIAL</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_tecyber" name="param_ac_tecyber" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">rcvry</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de espacios precadena">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_ac">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro pre-cadena-->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Modal nuevo registro post-cadena -->
                <!-- ============================================================== -->
                <div id="modal-nuevo_dc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                <form id="frm_nuevo_dc" name="frm_nuevo_dc">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Espacios y tablespaces post - cadena</h3>
                                                        <hr>
                                                        <div id="mensaje_dc"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("-1 days")); ?>" id="param_dc_fecha" name="param_dc_fecha">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de cadena.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Espacios</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.24</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_24" name="param_dc_24" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.31</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_31" name="param_dc_31" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.38</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_38" name="param_dc_38" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradatahis</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.127</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_127" name="param_dc_127" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/export</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Tablespaces</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">PRODUCCIÓN</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_tedbprod" name="param_dc_tedbprod" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">dbprod</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">CYBERFINANCIAL</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_tecyber" name="param_dc_tecyber" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">rcvry</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de espacios postcadena">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevo_dc">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro post-cadena-->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Modal EDITAR registro pre-cadena -->
                <!-- ============================================================== -->
                <div id="modal-editar_ac" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                <form id="frm_update_ac" name="frm_update_ac">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Espacios y tablespaces pre - cadena</h3>
                                                        <hr>
                                                        <div id="mensaje_ac_edit"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("0 days")); ?>" id="param_ac_fecha_edit" name="param_ac_fecha_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de hoy.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Espacios</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.24</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_24_edit" name="param_ac_24_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.31</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_31_edit" name="param_ac_31_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.38</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_38_edit" name="param_ac_38_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradatahis</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.127</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_127_edit" name="param_ac_127_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/export</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Tablespaces</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">PRODUCCIÓN</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_tedbprod_edit" name="param_ac_tedbprod_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">dbprod</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">CYBERFINANCIAL</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_ac_tecyber_edit" name="param_ac_tecyber_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">rcvry</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                   <input type="hidden" id="param_ac_id_edit" name="param_ac_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="update_ac">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal EDITAR registro pre-cadena-->
                <!-- ============================================================== -->


                 <!-- ============================================================== -->
                <!-- Modal EDITAR registro post-cadena -->
                <!-- ============================================================== -->
                <div id="modal-editar_dc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                <form id="frm_update_dc" name="frm_update_dc">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Espacios y tablespaces post - cadena</h3>
                                                        <hr>
                                                        <div id="mensaje_dc_edit"></div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("0 days")); ?>" id="param_dc_fecha_edit" name="param_dc_fecha_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Usar fecha de hoy.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Espacios</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.24</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_24_edit" name="param_dc_24_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.31</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_31_edit" name="param_dc_31_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradata6</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.38</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_38_edit" name="param_dc_38_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/oradatahis</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">172.20.0.127</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_127_edit" name="param_dc_127_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">/export</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5>Tablespaces</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">PRODUCCIÓN</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_tedbprod_edit" name="param_dc_tedbprod_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">dbprod</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">CYBERFINANCIAL</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="param_dc_tecyber_edit" name="param_dc_tecyber_edit" placeholder="en MB">
                                                                    </div>
                                                                    <small class="form-control-feedback pull-right">rcvry</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <input type="hidden" id="param_dc_id_edit" name="param_dc_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="update_dc">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal EDITAR registro post-cadena-->
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
    <script src="../../js/bitacoras/espacios_js.js"></script>
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
    
  
    jQuery('#param_ac_fecha').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_dc_fecha').datepicker({
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