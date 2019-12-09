<?php include("template/header.php"); ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Nuevo Cliente</button>
                                </div>

                                <h4 class="page-title">Cliente</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active "><a href="#">Registro</a></li>
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
                                    <h4 class="m-t-0 header-title">Clientes Registrados</h4>
                                    <br>

                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Telefono</th>
                                            <th width="80">Acciones</th>
                                        </tr>
                                        </thead>


                                        <tbody>
										<?php
                                            if(!isset($conexion)){ include("config/conexion.php");}
                                            $sql = "SELECT * FROM clientes";
                                            $ejecutar = $conexion->query($sql);
                                            while($reg = $ejecutar->fetch_assoc()){
                                                echo "<tr>";
                                                echo "<th scope='row'>".$reg["id"]."</th>";
                                                echo "<td>".($reg["nombre"])."</td>";

                                                echo "<td>".($reg["doc"])."</td>";
                                                echo "<td>".($reg["tel"])."</td>";
                                                echo "<td> "?> <a  name="edit" value="Delete" id="<?php echo $reg["id"]; ?>" class="btn btn-danger btn-sm delete_data" /><i class='md md-close'></i><a/>
                                                </td>
                                                <?php 
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
                                            <form action="logica/cliente_save.php" method="post" >
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
                    url: "logica/cliente_delete.php",
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