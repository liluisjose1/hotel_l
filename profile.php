<?php include("template/header.php"); ?>
<?php 
//include("config/conexion.php");
//user
$userid=$_SESSION["usuario"];
$sqlu = "SELECT * FROM usuario WHERE usuario='$userid' ";
$ejecutar_consultau = $conexion->query($sqlu);
$user = mysqli_fetch_row($ejecutar_consultau);
 ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Profile</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>

                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="profile-detail card-box">
                                    <div>
                                        <img  style="width: 300px;height: 300px;" src="<?php echo $config_hotel[2];?>" class="rounded-circle" alt="profile-image">
                                        <div class="text-center">
                                            <h5>Hotel <?php echo $config_hotel[1]; ?></h5>
                                            <h5>Tel <?php echo $config_hotel[3].'<br> Dirección '.$config_hotel[4]  ; ?></h5>
                                        </div>

                                        <hr>
                                        <h4 class="text-uppercase font-18 font-600">Acerca de</h4>
                                        <p class="text-muted font-13 m-b-30">
                                        </p>

                                        <div class="text-center">
                                            <h1 class="text-muted "><strong>Nombre Completo:</strong> <span class="m-l-15 text-warning "><?php echo $user[1]; ?></span></h1>
                                            <h1 class="text-muted "><strong>Usuario ID:</strong> <span class="m-l-15 text-warning "><?php echo $user[0]; ?></span></h1>
                                            <h3 class="text-muted "><strong>Fecha de Creación:</strong> <span class="m-l-15 text-secondary "><?php echo $user[3]; ?></span></h3>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div> <!-- container -->

                </div> <!-- content -->
<?php include("template/footer.php"); ?>