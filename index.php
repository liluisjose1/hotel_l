<?php 

include("config/conexion.php");
$sqlc = "SELECT * FROM configuracion";
$ejecutar_consulta_cofig = $conexion->query($sqlc);
$config_hotel = mysqli_fetch_row($ejecutar_consulta_cofig);
if ($config_hotel == null) {
    # code...
    $config_hotel = array(
        '0' =>'1' ,
        '1' =>'Default' ,
        '2' =>'assets/images/default.jpg' ,
     );
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SI administrativo hotel">
        <meta name="author" content="liluisjose1">

        <link rel="shortcut icon" href="<?php echo $config_hotel[2]; ?>">

        <title>Hotel <?php echo $config_hotel[1]; ?></title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="card-box">
                <div class="panel-heading">
                    <h4 class="text-center"> Iniciar Sesión</h4>
                </div>


                <div class="p-20">
                                <?php
                                    error_reporting(E_ALL ^ E_NOTICE);
                                    if($_GET["error"]=="si"){
                                        echo "<div class='alert alert-danger alert-dismissable'>";
                                        echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                        echo "Instroduzca credenciales validas";
                                        echo "</div>";
                                    }
                                    if($_GET["error"]=="a"){
                                        echo "<div class='alert alert-danger alert-dismissable'>";
                                        echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                        echo "Su usuario esta temporalmente invalidado o no existe";
                                        echo "</div>";
                                    }


                                ?>
                    <form class="form-horizontal m-t-20" action="logica/control.php" method="post">
                        <div class="form-group ">
                            <center>
                                <img src="<?php echo $config_hotel[2]; ?>" class="rounded-circle" alt="Cinque Terre" width="50%" >
                            </center>
                        </div>
                        <div class="form-group ">
                            <div class="col-12">
                                <input class="form-control" type="text" required="" placeholder="Username" name="user_txt" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password_txt" >
                            </div>
                        </div>


                        <div class="form-group text-center m-t-40">
                            <div class="col-12">
                                <button class="btn btn-inverse btn-block text-uppercase waves-effect waves-light"
                                        type="submit">Iniciar
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            
        </div>
        
        

        
      <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
  
  </body>
</html>