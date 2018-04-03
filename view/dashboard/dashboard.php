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

<body class="fix-header fix-sidebar card-no-border">
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
        <input type="hidden" name="grupo" id="grupo" value="Dashboard">
        <input type="hidden" name="tarea" id="tarea" value="Dashboard 1">
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
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <button class="isUpdated btn btn-info">Status Bitácoras</button>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <img class="card-img-top" src="../../assets//images/background/profile-bg.jpg" alt="Card image cap">
                            <div class="card-body little-profile text-center">
                                <div class="pro-img"><img src="<?php echo $gpUserProfile['picture'] ?>" alt="user"/></div>
                                <h3 class="m-b-0"><?php echo $gpUserProfile['given_name'] ?></h3>
                                <p><?php echo $gpUserProfile['email'] ?></p>
                                <div id="profile">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card" >
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h3 class="card-title">Apertura de Bantotal 2017</h3>
                                        <h6 class="card-subtitle">Hora de apertura de bantotal de la última semana.</h6> 
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0">
                                            <li>
                                                <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>Hora de Apertura</h6> </li>
                                            

                                        </ul>
                                    </div>
                                    
                                </div> 
                                <div class="campaign ct-charts"></div>
                                <div class="row text-center" id="lastOpen">
                                    
                                </div> 
                            </div>
                        </div>    
                    </div>    
                </div> 
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">UNIBANCA</h3>
                                                <h6 class="card-subtitle">Operaciones vs Rechazos de la última semana</h6> </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-primary"><i class="fa fa-circle font-10 m-r-10"></i>Operaciones</h6> </li>
                                                    <li>
                                                        <h6 class="text-danger"><i class="fa fa-circle font-10 m-r-10 "></i>Rechazos</h6> </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="amp-pxl" style="height: 360px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Pases a producción</h3>
                                <h6 class="card-subtitle">Porcentaje de pases aplicados en los ambientes</h6>
                                <div id="visitor" style="height:264px; width:100%;"></div>
                            </div>
                            <div>
                                <hr class="m-t-0 m-b-0">
                            </div>
                            <div class="card-body text-center ">
                                <ul class="list-inline m-b-0">
                                    <li>
                                        <h6 style="color: #1e88e5; font-size: 12px;"><i class="fa fa-circle font-10 m-r-10 "></i>Bantotal</h6> </li>
                                    <li>
                                        <h6 style="color: gray; font-size: 12px;"><i class="fa fa-circle font-10 m-r-10"></i>Spring</h6> </li>
                                    
                                    <li>
                                        <h6 style="color: #26c6da; font-size: 12px;"><i class="fa fa-circle font-10 m-r-10 "></i>Sigretail</h6> </li>
                                    <li>
                                        <h6 style="color: #ef5350; font-size: 12px;"><i class="fa fa-circle font-10 m-r-10"></i>Sircon</h6> </li>
                                    <li>
                                        <h6 style="color: #ffce5f; font-size: 12px; "><i class="fa fa-circle font-10 m-r-10"></i>Sarco</h6> </li>
                                    <li>
                                        <h6 style="color: #4db6ac; font-size: 12px;"><i class="fa fa-circle font-10 m-r-10 "></i>Movilidad</h6> </li>
                                    <li>
                                        <h6 style="color: #111111; font-size: 12px;"><i class="fa fa-circle font-10 m-r-10"></i>Canales</h6> </li>
                                    <li>
                                        <h6 style="color: #745af2; font-size: 12px;"><i class="fa fa-circle font-10 m-r-10"></i>Cyberf.</h6> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                
               
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                         <!-- Column -->
                        <div class="card card-body">
                            <h3 class="card-title">Pases a producción</h3>
                            <h6 class="card-subtitle">Últimos SVT's aplicados</h6>
                            <div class="message-box">
                                <div class="message-widget m-t-20" id="lastSvt">
                                    

                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card" >
                            <div class="card-body bg-info">
                                <h4 class="text-white card-title">Usuarios</h4>
                                <h6 class="card-subtitle text-white m-b-0 op-5">Últimas conexiones</h6>
                            </div>
                            <div class="card-body">
                                <div class="message-box contact-box">
                                        
                                    <div class="message-widget contact-widget" id="body_lastIn">
                                    </div>

                                </div>
                            </div>    
                        </div>

                        
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Espacios en disco y tablespaces</h3>
                                <h6 class="card-subtitle">Espacio Libre/Total (% usado)</h6>
                                <div class="table-responsive">
                                    <table class="table m-b-0  m-t-30 no-border">
                                        <tbody id="espaciosChart">
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body m-b-20 m-t-10">
                                <div class="row">
                                    <div class="col-4">
                                        <h1>6</h1>
                                        <h6 class="text-muted">Espacios Monitoreados</h6></div>
                                    <div class="col-4">
                                        <h1>Antes </h1>
                                        <h6 class="text-muted">y <strong>después </strong> de la cadena de cierre.</h6></div>
                                    <div class="col-4 align-self-center text-right">
                                        <a href="../bitacoras/espacios.php"><button type="button" class="btn btn-success">Ver histórico</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>    
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
    <!-- MIS JS -->
    

    <script src="../../assets//plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/js/jquery.slimscroll.js"></script>
        <!-- Menu -->
    <script src="../../js/treemodulo.js"></script>
    <!-- Mantenedor -->
    <script src="../../js/dashboard/dashboard_js.js"></script>
    <!--Wave Effects -->
    <script src="../../assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--stickey kit -->
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="../../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="../../assets/plugins/d3/d3.min.js"></script>
    <script src="../../assets/plugins/c3-master/c3.min.js"></script>
    <!-- Vector map JavaScript -->
    <script src="../../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../../assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!--Custom JavaScript -->
    <script src="../../assets/js/custom.min.js"></script>
    <script src="../../assets/plugins/toast-master/js/jquery.toast.js"></script>
    <script src="../../assets/js/toastr.js"></script>
    <!-- Custom Theme JavaScript -->

    
</body>

</html>

 <?php } ?>