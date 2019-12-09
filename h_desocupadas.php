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
                                    <li class="breadcrumb-item active "><a href="#">Disponibles</a></li>
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
                                    <h4 class="m-t-0 header-title"></h4>
                                    <br>

                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Disponibilidad</th>
                                            <th>Tipo de Habitación</th>
                                            <th>N° Personas</th>
                                            <th>Fecha Creación</th>
                                            <th width="80" >Estado</th>
                                        </tr>
                                        </thead>


                                        <tbody>
										<?php
                                            if(!isset($conexion)){ include("config/conexion.php");}
                                            $sql = "SELECT * FROM habitaciones WHERE `ocupada`='1'";
                                            $ejecutar = $conexion->query($sql);
                                            while($reg = $ejecutar->fetch_assoc()){
                                                echo "<tr>";
                                                 echo "<th scope='row'><a href='#' id='".$reg["codigo"]."' class='view_data'>".$reg["codigo"]."</a></th>";
                                                echo "<td>".($reg["descripcion"])."</td>";
                                                if ($reg["ocupado"]==1) {
                                                    # code...
                                                    echo "<td><span class='label label-success'>No Disponible</span></td>";
                                                }
                                                else {
                                                    # code...
                                                    echo "<td><span class='label label-inverse'>Disponible</span></td>";
                                                }
                                                $sql2 = "SELECT * FROM cat_habitaciones";
                                            $ejecutar2 = $conexion->query($sql2);
                                            while($reg2 = $ejecutar2->fetch_assoc()){
                                                if ($reg2["id"]==$reg["tipo"]) {
                                                    # code...
                                                    echo "<td>".($reg2["nombre"])."</td>";
                                                }
                                            }

                                                echo "<td>".($reg["n_personas"])."</td>";
                                                echo "<td>".($reg["fecha"])."</td>";
                                                if ($reg["estado"]==1) {
                                                	# code...
                                                	echo "<td><span class='label label-success'>Activo</span></td>";
                                                }
                                                else {
                                                	# code...
                                                	echo "<td><span class='label label-inverse'>Inactivo</span></td>";
                                                }
                                                echo "</tr>";
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div> <!-- container -->

                </div> <!-- content -->
                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <form action="logica/h_save.php" method="post" >
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Nueva Habitacion</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Codigo</label>
                                                                <input type="text" class="form-control" name="cod_hab" id="field-1" required="" placeholder="codigo de habitacion">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Tipo de Habitacion</label>
                                                                <select class="form-control  selectpicker" name="tipo"  required="" >
																  <option>Seleccionar</option>
                                                                  <?php 
                                                                  $sql3 = "SELECT * FROM cat_habitaciones";
                                                                    $ejecutar3 = $conexion->query($sql3);
                                                                    while($reg3 = $ejecutar3->fetch_assoc()){
                                                                        echo "<option value=".$reg3["id"].">".$reg3["nombre"]."</option>";
                                                                    }
                                                                     ?>
																</select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Descripcion</label>
                                                                <input type="text" class="form-control" name="descripcion" id="field-2" required=""  placeholder="descripcion">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Numero de personas</label>
                                                                <input type="number" class="form-control" min="1" name="n_personas" id="field-3" required="" placeholder="numero de personas">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Estado</label>
                                                                <select class="form-control  selectpicker" name="activo"  required="" >
                                                                  <option>Seleccionar</option>
                                                                  <option value="1" >Activo</option>
                                                                  <option value="0" >Inactivo</option>
                                                                </select>

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
                                    <!-- /.modal -->  
                                    <div id="view_data_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Ver Habitación</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Codigo</label>
                                                                <input type="text" class="form-control" name="cod_hab" id="cod_hab1" required="" placeholder="codigo de habitacion">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Tipo de Habitacion</label>
                                                                <select class="form-control  selectpicker" name="tipo" id="tipo1"  required="" >
                                                                  <option>Seleccionar</option>
                                                                  <?php 
                                                                  $sql3 = "SELECT * FROM cat_habitaciones";
                                                                    $ejecutar3 = $conexion->query($sql3);
                                                                    while($reg3 = $ejecutar3->fetch_assoc()){
                                                                        echo "<option value=".$reg3["id"].">".$reg3["nombre"]."</option>";
                                                                    }
                                                                     ?>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Descripcion</label>
                                                                <input type="text" class="form-control" name="descripcion" id="descripcion1" required=""  placeholder="descripcion">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Numero de personas</label>
                                                                <input type="number" class="form-control" min="1" name="n_personas" id="n_personas1" required="" placeholder="numero de personas">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Estado</label>
                                                                <select class="form-control  selectpicker" name="activo" id="activo1"  required="" >
                                                                  <option>Seleccionar</option>
                                                                  <option value="1" >Activo</option>
                                                                  <option value="0" >Inactivo</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->  

<?php include("template/footer.php"); ?>
<script type="text/javascript">
function Confirmation() {

	if (confirm('Esta seguro de eliminar el registro?')==true) {
	    alert('El registro ha sido eliminado correctamente!!!');
	    return true;
	}else{
	    //alert('Cancelo la eliminacion');
	    return false;
	}
}
</script>
        <script type="text/javascript">
            $(document).ready(function() {

                  $(document).on('click', '.view_data', function(){  
                       var cod_hab = $(this).attr("id");  
                       $.ajax({  
                            url:"logica/h_ajax_select.php",  
                            method:"POST",  
                            data:{cod_hab:cod_hab},  
                            dataType:"json",  
                            success:function(data){ 
                                 //console.log(data); 
                                 $('#cod_hab1').val(data[1]);  
                                 $('#tipo1').val(data.tipo);  
                                 $('#activo1').val(data.estado);  
                                 $('#descripcion1').val(data.descripcion);  
                                 $('#n_personas1').val(data.n_personas);  
                                 $('#view_data_Modal').modal('show');  
                            }  
                       });  
                  });

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf','print']
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });
                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );
        </script>