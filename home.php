<?php include("template/header.php"); ?>
<?php 
//include("config/conexion.php");
//session_start();
//user
$sqlu = "SELECT COUNT(*) AS Total FROM usuario";
$ejecutar_consultau = $conexion->query($sqlu);
$user = mysqli_fetch_row($ejecutar_consultau);
//hab
$sqlh= "SELECT COUNT(*) AS Total FROM habitaciones WHERE ocupada='1'";
$ejecutar_consultah = $conexion->query($sqlh);
$hab = mysqli_fetch_row($ejecutar_consultah);
//huesped
$sqlhu= "SELECT COUNT(*) AS Total FROM clientes WHERE hospedado='1'";
$ejecutar_consultahu = $conexion->query($sqlhu);
$habu = mysqli_fetch_row($ejecutar_consultahu);
//ventas
$hoy = date("Y-m-d");
$sqlv= "SELECT SUM(total) AS Total FROM ventas_hab WHERE fecha='$hoy'";
$ejecutar_consultave = $conexion->query($sqlv);
$venta_dia = mysqli_fetch_row($ejecutar_consultave);

$userid=$_SESSION["usuario"];
$sqluser= "SELECT nombre FROM usuario WHERE usuario='$userid'";
$ejecutar_consultauser = $conexion->query($sqluser);
$user_name = mysqli_fetch_row($ejecutar_consultauser);

 ?>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Home</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active"><a href="home.php">Dashboard</a></li>
                                </ol>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-attach-money text-primary"></i>
                                    <h2 class="m-0 text-dark counter font-600">$ <?php 


                                    if ($venta_dia[0]=='') {
                                        # code...
                                        echo "0.00";
                                    }
                                    else{
                                        echo number_format($venta_dia[0],2);
                                        } ?></h2>
                                    <div class="text-muted m-t-5">Ventas Diarias</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-3">
                            <a href="cliente_hospedado.php"><div class="widget-panel widget-style-2 bg-white">
                                    <i class="md  md-people-outline text-pink"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?php echo $habu[0]; ?></h2>
                                    <div class="text-muted m-t-5">Huéspedes</div>
                                </div>
                            </a>    
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <a href="h_desocupadas.php"><div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-store-mall-directory text-info"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?php echo $hab[0]; ?></h2>
                                    <div class="text-muted m-t-5">Habitaciones disponibles </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <a href="users.php" ><div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-account-child text-custom"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?php echo $user[0]; ?></h2>
                                    <div class="text-muted m-t-5">Usuarios</div>
                                </div>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <center><h1>Bienvenido <span class="text-warning"><?php echo $user_name[0]; ?></span> </h1></center>
                                            <div class="text-center">
                                                
                                            <img src="<?php echo $config_hotel[2]; ?>" class="rounded-circle" alt="Cinque Terre" width="20%">
                                            <h5>Tel <?php echo $config_hotel[3].'<br> Dirección '.$config_hotel[4]  ; ?></h5>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row -->

                                </div>

                            </div>

                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
<?php include("template/footer.php"); ?>