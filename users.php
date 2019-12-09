<?php include("template/header.php"); ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Nuevo Usuario</button>
                                </div>

                                <h4 class="page-title">Administracion</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active "><a href="#">Usuarios</a></li>
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
                                    }else if($_GET["error"]=="no_d"){
                                        echo "<div class='alert alert-danger alert-dismissable'>";
                                        echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                        echo "Registro eliminado con exito";
                                        echo "</div>";
                                    }
                                    else if($_GET["error"]=="no_up"){
                                        echo "<div class='alert alert-primary alert-dismissable'>";
                                        echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                        echo "Actualizado con exito";
                                        echo "</div>";
                                    } 

                                    
                                ?>
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title">Usuarios Registrados</h4>
                                    <br>

                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Nombres</th>
                                            <th>Fecha de Creación</th>
                                            <th width="80" >Estado</th>
                                            <th width="80">Acciones</th>
                                        </tr>
                                        </thead>


                                        <tbody>
										<?php
                                            if(!isset($conexion)){ include("config/conexion.php");}
                                            $sql = "SELECT * FROM usuario";
                                            $ejecutar = $conexion->query($sql);
                                            $cont=0;
                                            while($reg = $ejecutar->fetch_assoc()){
                                                $cont=$cont+1;
                                                echo "<tr>";
                                                echo "<th scope='row'>".$cont."</th>";
                                                echo "<td>".($reg["usuario"])."</td>";
                                                echo "<td><a href='#' id='".$reg["usuario"]."' class='view' >".($reg["nombre"])."</a></td>";
                                                echo "<td>".($reg["fecha"])."</td>";
                                                if ($reg["activo"]==1) {
                                                	# code...
                                                	echo "<td><span class='label label-success'>Activo</span></td>";
                                                }
                                                else {
                                                	# code...
                                                	echo "<td><span class='label label-inverse'>Inactivo</span></td>";
                                                }
                                                ?>
                                                <td><a  name="edit" value="Edit" id="<?php echo $reg["usuario"]; ?>" class="btn btn-warning btn-sm edit_data" /><i class='md md-mode-edit'></i><a/>
                                                <a  name="edit" value="Delete" id="<?php echo $reg["usuario"]; ?>" class="btn btn-danger btn-sm delete_data" /><i class='md md-close'></i><a/></td>
                                                </tr>
                                           <?php  }
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
                                            <form action="logica/user_save.php" method="post" >
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Nuevo Usuario</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Usuario</label>
                                                                <input type="text" class="form-control" name="user" id="field-1" required="" placeholder="usuario">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Estado</label>
                                                                <select class="form-control  selectpicker" name="activo"  required="" >
                                                                  <option>Seleccione</option>
                                                                  <option value="1" >Activo</option>
                                                                  <option value="0" >Inactivo</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombre1" id="field-2" required=""  placeholder="nombre">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Contraseña</label>
                                                                <input type="password" class="form-control" name="contra" id="field-3" required="" placeholder="contraseña">
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
                                    <div id="add_data_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <form action="logica/user_update.php" method="post" >
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editar Usuario</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Usuario</label>
                                                                <input type="text" id="user" class="form-control" name="user" id="field-1" required="" placeholder="usuario">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Estado</label>
                                                                <select id="estado" class="form-control  selectpicker" name="activo"  required="" >
                                                                  <option>Seleccione</option>
                                                                  <option value="1" >Activo</option>
                                                                  <option value="0" >Inactivo</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombre1" id="nombre" required=""  placeholder="nombre">
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
                                                    <h4 class="modal-title">Ver Usuario</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Usuario</label>
                                                                <input type="text" id="user1" class="form-control text-danger" name="user" id="field-1" required="" placeholder="usuario">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Estado</label>
                                                                <select id="estado1" class="form-control  selectpicker" name="activo"  required="" >
																  <option>Seleccione</option>
																  <option value="1" >Activo</option>
																  <option  value="0" >Inactivo</option>
																</select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Nombre</label>
                                                                <input type="text" class="form-control text-danger" name="nombre1" id="nombre1" required=""  placeholder="nombre">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->  

<?php include("template/footer.php"); ?>
<script type="text/javascript">
    $(document).on('click', '.delete_data', function(){
    var user_id = $(this).attr("id");    
        swal({
                title: "Estas seguro?",
                text: "Estas seguro que deseas eliminar registro "+user_id,
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn btn-light",
                confirmButtonText: "Si, Borrar!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: "logica/user_delete.php",
                    type: "POST",
                    data: {
                         id_user: user_id
                    },
                    dataType: "html",
                    success: function () {
                        swal("Listo!", "Borrado con exito!", "success");
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error al borrar!", "Intente de nuevo", "error");
                    }
                });
            });
 });
</script>
        <script type="text/javascript">
            $(document).ready(function() {


                $(document).on('click', '.edit_data', function(){  
                       var user_id = $(this).attr("id");  
                       $.ajax({  
                            url:"logica/user_ajax_select.php",  
                            method:"POST",  
                            data:{user_id:user_id},  
                            dataType:"json",  
                            success:function(data){ 
                                 //console.log(data); 
                                 $('#user').val(data[0]);  
                                 $('#estado').val(data.activo);  
                                 $('#nombre').val(data.nombre);  
                                 $('#add_data_Modal').modal('show');  
                            }  
                       });  
                  });  

                $(document).on('click', '.view', function(){  
                       var user_id = $(this).attr("id");  
                       $.ajax({  
                            url:"logica/user_ajax_select.php",  
                            method:"POST",  
                            data:{user_id:user_id},  
                            dataType:"json",  
                            success:function(data){ 
                                 //console.log(data); 
                                 $('#user1').val(data[0]);  
                                 $('#estado1').val(data.activo);  
                                 $('#nombre1').val(data.nombre);  
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