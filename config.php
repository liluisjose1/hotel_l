<?php include("template/header.php"); ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">

                                <h4 class="page-title">Configuración</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active "><a href="config.php">Información</a></li>
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
                               <form action="logica/save_config.php" method="post" enctype="multipart/form-data" >
                                <input name="id_hotel" type="hidden" value="<?php echo $config_hotel[0]; ?>">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Configuraciones</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Nombre del Hotel</label>
                                                                <input type="text" class="form-control" maxlength="12" name="nombre_h" id="field-1" required="" value="<?php echo $config_hotel[1]; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Telefono</label>
                                                                <input type="text" class="form-control" maxlength="12" name="tel" id="field-1" required="" value="<?php echo $config_hotel[3]; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Dirección</label>
                                                                <input type="text" class="form-control" maxlength="100" name="direccion" id="field-1" required="" value="<?php echo $config_hotel[4]; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Logo</label>
                                                                <input  name="archivo" type="file" class=" form-control" accept="image/png, image/jpeg"  required >

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="save" class="btn btn-info waves-effect waves-light">Guardar</button>
                                                </div>
                                            </form>
                                </div>
                            </div>
                        </div>


                    </div> <!-- container -->

                </div> <!-- content -->

<?php include("template/footer.php"); ?>
<!-- <script type="text/javascript">
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
        </script> -->