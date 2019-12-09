<?php 
ob_start();
//include("config/conexion.php");


$cod_h = $_GET["id_h"];
//$date = Date("Y-m-d");


	/* Verificamos que el nombre que se quiere crear no exista ya en la base de datos. */
	/*$consulta = "SELECT * FROM cat_habitaciones WHERE nombre='$nombre'";
	$ejecutar_consulta = $conexion->query($consulta);
	$num_regs = $ejecutar_consulta->num_rows;

	if($num_regs==0){

			$consulta = "INSERT INTO  `cat_habitaciones`(`nombre`) VALUES ('$nombre')";
			$ejecutar_consulta = $conexion->query(($consulta));
			if($ejecutar_consulta){
				header("Location: ../h_cat.php?error=no");
			}
		
	}
	else{
			header("Localtion: ../h_cat.php?error=si");
		}*/
 ?>
 <?php include("template/header.php"); ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Habitaciones</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item "><a href="check_in.php">Disponibles</a></li>
                                    <li class="breadcrumb-item active "><a href="#">Reservar</a></li>
                                </ol>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            	   <?php
                                    error_reporting(E_ALL ^ E_NOTICE);
                                    if($_GET["error"]=="no"){
                                        echo "<div class='alert alert-primary alert-dismissable'>";
                                        echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                        echo "Registro Exitoso";
                                        echo "</div>";
                                    } else if($_GET["error"]=="si"){
                                        echo "<div class='alert alert-danger alert-dismissable'>";
                                        echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                        echo "Error al registrar";
                                        echo "</div>";
                                    } 

                                    
                                ?>
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title">Confirmar Cliente</h4>
                                    <br>
                                    <form method="post" action="logica/save_reservacion.php">
                                        <input type="hidden" name="hab" value="<?php echo $cod_h; ?>" > 
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Cliente</label>
                                                <select class="form-control  selectpicker" id='cliente' name="id_cliente"  required="" >
                                                  <option>Seleccionar Cliente </option>
                                                  <?php 
                                                  $sql3 = "SELECT * FROM clientes WHERE hospedado='0' ";
                                                    $ejecutar3 = $conexion->query($sql3);
                                                    while($reg3 = $ejecutar3->fetch_assoc()){
                                                        echo "<option value=".$reg3["id"].">".$reg3["nombre"]." - ".$reg3["doc"]."</option>";
                                                    }
                                                     ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Agregar Cliente</label>
                                                <br>
                                                <a href="#"  data-toggle="modal" data-target="#con-close-modal"  class="fa fa-plus" ></a>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="col-form-label">Habitación</label>
                                                <input type="text" name="codi_habitacion" value="<?php echo $cod_h; ?>" disabled class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4" class="col-form-label">Precio x dia </label>
                                                <input type="number" placeholder="0.00" required name="pu" min="0" id="pu" value="0" step="0.01" class="form-control" onChange="calcular();" >
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label for="inputEmail4" class="col-form-label">Dias</label>    
                                                <input type="number" required name="dias" min="1" value="1" onChange="calcular();"  id="dias"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4" class="col-form-label">Fecha Ingreso</label>    
                                                <input type="date" required name="fecha_ingreso"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                        	 <div class="float-lefth"><h1>Total $<label id="total_label" >0</label></h1></div><br>
                                        </div>
                                       

                                        
                                        <br>
                                        <center><button type="submit" class="btn btn-primary">Procesar</button></center>
                                    </form>
                                    <br>
                                  <!--   <center><button type="submit" class="btn btn-primary"  onclick="calcular()" >Calcular</button></center> -->
                                </div>
                            </div>
                        </div>

                                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <form action="logica/cliente_save_modal.php" method="post" >
                                                <input type="hidden" name="hab" value="<?php echo $cod_h; ?>" > 
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Nuevo Cliente</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombre" id="field-2" required=""  placeholder="nombre">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Numero de documento</label>
                                                                <input type="number" class="form-control" name="doc" id="field-3" placeholder="numero de documento">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Teléfono</label>
                                                                <input type="number" class="form-control" name="tel" id="field-3" placeholder="numero de telefono">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->


                    </div> <!-- container -->

                </div> <!-- content -->

<?php include("template/footer.php"); ?>
<script type="text/Javascript">
	function calcular(){

		
		//var producto=document.getElementById('habitacion').value;  
		var pu=document.getElementById('pu').value;  
		var cant=document.getElementById('dias').value;

		//total = document.getElementById('spTotal').innerHTML; 

		//var cli=$("#cliente option:selected").html();
		//var cli=document.getElementById('cliente').innerHTML; 

		var total=0;
		total = pu*cant; 
		document.getElementById('total_label').innerHTML=total.toFixed(2);; 

		 
		}
</script>

<script type="text/javascript">
	$('#cliente').select2({
});
</script>