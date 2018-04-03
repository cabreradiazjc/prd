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
                        <h3 class="text-themecolor m-b-0 m-t-0">LISTAS NEGRAS</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Bitácoras</a></li>
                            <li class="breadcrumb-item active">Listas Negras</li>
                        </ol>
                    </div>
                   <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <button class="btn btn-info" alt="default" data-toggle="modal" data-target="#modal-nuevoln">Nuevo registro</button>
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
                <input type="hidden" name="tarea" id="tarea" value="Listas Negras">
                <input type="hidden" name="user" id="user" value="<?php echo $userData['email']; ?>">

              
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body bg-info">
                                <h4 class="card-title text-white">Listas Negras</h4>
                                <h6 class="card-subtitle text-white">Listas negras cargadas semanalmente.</h6>
                            </div>  

                            <div class="card-body">
                                <div class="message-box contact-box">
                                    <h2 class="add-ct-btn">
                                        <button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"  alt="default" data-toggle="modal" data-target="#modal-nuevoln">+</button>
                                    </h2>
                                </div>  
                                <br>
                               
                                
                                <div class="table-responsive m-t-40">

                                   <table id="table_ln" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">

                                        <thead>
                                            <tr style="font-size: 14px;">
                                                <th>Nombre</th>
                                                <th>Fecha Desc.</th>
                                                <th>Tamaño</th>
                                                <th>Fecha Mod.</th>
                                                <th>Tam. Mod.</th>
                                                <th>Carga 24</th>
                                                <th>Carga BT</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody id="body_ln">

                                        </tbody>
                                        
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- ============================================================== -->
                <!-- Modal nuevo registro -->
                <!-- ============================================================== -->
                <div id="modal-nuevoln" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                            <div class="card-body">
                                                <form id="frm_nuevoln" name="frm_nuevoln">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Listas Negras</h3>
                                                        <hr>
                                                        <div id="mensaje"></div>
                                                         <div class="row">
                                                            
                                                             <div class="col-md-12">
                                                                <div class="form-group ">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_nombre" name="param_nombre" value="WorldCompliance_<?php echo date('Y-m-d',strtotime("0 days")); ?>">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha de descarga</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("0 days")); ?>" id="param_fdesc" name="param_fdesc">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Fecha de sábado.</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Tamaño</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_tamDesc" name="param_tamDesc">  
                                                                    </div>
                                                                    <small class="form-control-feedback"> Tamaño en kb.</small>
                                                                </div>
                                                            </div>

                                                        </div>

                                                      
                                                           

                                                         <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-danger">
                                                                    <label class="control-label">Fecha de Mod</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd'  id="param_fmod" name="param_fmod">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Fecha de archivo.</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-danger">
                                                                    <label class="control-label">Tamaño de Mod.</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_tamMod" name="param_tamMod">  
                                                                    </div>
                                                                     <small class="form-control-feedback"> Tamaño en kb.</small>
                                                                </div>
                                                            </div>

                                                        </div>



                                                         <div class="row">
                                                           
                                                           
                                                             <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Fecha de carga en BD</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("0 days")); ?>" id="param_f24" name="param_f24">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>

                                                             <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Fecha de carga en BT</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d',strtotime("0 days")); ?>" id="param_fBT" name="param_fBT">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>

                                                        </div>
                                                       
                                                        <div class="row">
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Estado</label>
                                                                    <div>
                                                                        <select class="form-control" style="width: 100%" id="param_estado" name="param_estado">
                                                                            <option value="0" selected="true">EN PROCESO</option>
                                                                            <option value="1">APLICADO</option>
                                                                                                                                                     
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Datos de Operación -->
                                                    <input type="hidden" name="grupo" id="grupo" value="Bitácoras">
                                                    <input type="hidden" name="tarea" id="tarea" value="Bitácora de Listas Negras">
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
                                <button type="button" class="btn btn-info waves-effect waves-light" id="nuevoln">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal nuevo registro -->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Modal editar -->
                <!-- ============================================================== -->
                 <div id="modal-editarln" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                            <div class="card-body">
                                                <form id="frm_updateln" name="frm_updateln">
                                                    <div class="form-body">
                                                        <h3 class="card-title">Listas Negras</h3>
                                                        <hr>
                                                        <div id="mensaje_edit"></div>
                                                         <div class="row">
                                                            
                                                             <div class="col-md-12">
                                                                <div class="form-group ">
                                                                    <label class="control-label">Nombre</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_nombre_edit" name="param_nombre_edit" >  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Fecha de descarga</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' id="param_fdesc_edit" name="param_fdesc_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Fecha de sábado.</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">Tamaño</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_tamDesc_edit" name="param_tamDesc_edit">  
                                                                    </div>
                                                                    <small class="form-control-feedback"> Tamaño en kb.</small>
                                                                </div>
                                                            </div>

                                                        </div>

                                                      
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-danger">
                                                                    <label class="control-label">Fecha de Mod</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd'  id="param_fmod_edit" name="param_fmod_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    <small class="form-control-feedback"> Fecha de archivo.</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-danger">
                                                                    <label class="control-label">Tamaño de Mod.</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="param_tamMod_edit" name="param_tamMod_edit">  
                                                                    </div>
                                                                     <small class="form-control-feedback"> Tamaño en kb.</small>
                                                                </div>
                                                            </div>

                                                        </div>


                                                         <div class="row">
                                                           
                                                           
                                                             <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Fecha de carga en BD</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd'  id="param_f24_edit" name="param_f24_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>

                                                             <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Fecha de carga en BT</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd'  id="param_fBT_edit" name="param_fBT_edit">
                                                                        <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>

                                                        </div>    

                                                        <div class="row">
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Estado</label>
                                                                    <div>
                                                                        <select class="form-control" style="width: 100%" id="param_estado_edit" name="param_estado_edit">
                                                                            <option value="0" selected="true">EN PROCESO</option>
                                                                            <option value="1">APLICADO</option>
                                                                                                                                                     
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                 

                                                    </div>
                                                   <input type="hidden" id="param_id_edit" name="param_id_edit">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-info waves-effect waves-light" id="updateln">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Modal editar -->
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
    <script src="../../js/bitacoras/ln_js.js"></script>
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
    
  
    jQuery('#param_fdesc').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#param_fmod').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#param_f24').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#param_fBT').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#param_fdesc_edit').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#param_fmod_edit').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#param_f24_edit').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#param_fBT_edit').datepicker({
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