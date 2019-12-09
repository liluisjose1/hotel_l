 <?php include("template/header.php"); ?>
<?php 
ob_start();
 ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Facturación</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item "><a href="check_in.php">Facturación</a></li>
                                    <li class="breadcrumb-item active "><a href="#">Credito Fiscal IVA</a></li>
                                </ol>

                            </div>
                        </div>
                        <div class="row" id="page" >
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
                                        <form action="./reports/factura_cfi.php" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4" class="col-form-label">Nº Factura</label>    
                                                <input type="text" id="id_factura"  required name="id_factura"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Cliente</label>    
                                                <input type="text" id="id_cliente"  required name="id_cliente"  class="form-control">
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Cliente</label>
                                                <select class="form-control  selectpicker" id='cliente' name="id_cliente"  required="" >
                                                  <option>Seleccionar Cliente </option> -->
                                                  <?php 
                                                //   $sql3 = "SELECT * FROM clientes ";
                                                //     $ejecutar3 = $conexion->query($sql3);
                                                //     while($reg3 = $ejecutar3->fetch_assoc()){
                                                //         echo "<option value=".$reg3["nombre"].">".$reg3["nombre"]." - ".$reg3["doc"]."</option>";
                                                //     }
                                                     ?>
                                                <!-- </select>
                                            </div> -->
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4" class="col-form-label">Fecha Factura</label>    
                                                <input type="date" id="fecha_factura" value="<?php echo(date("Y-m-d"));?>"  required name="fecha_factura"  class="form-control">
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputEmail4" class="col-form-label">Direccion</label>    
                                                <input type="text" id="direccion"  required name="direccion"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="col-form-label">NIT</label>    
                                                <input type="text" id="nit"  required name="nit"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4" class="col-form-label">N. Registro</label>    
                                                <input type="text" id="nreg"  required name="nreg"  class="form-control">
                                            </div>
                                        </div> 
                                        <br><br>
                                        <div class="form-row">
                                            <div class="form-group col-md-1">
                                                <label for="inputEmail4" class="col-form-label">Cantidad</label>    
                                                <input type="number" value="1" id="qty" min="1"  required name="qty"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="col-form-label">Descripción</label>    
                                                <input  value="Servicio de Hotel" type="text" id="desc"  required name="desc"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4" class="col-form-label">Total</label>    
                                                <input type="number" min="1" id="pu" step="0.01" required name="pu"  class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-success btn-lg btn-block"> <h3>Generar Factura</h3>  </button>
                                        </form>             
                                    <br>
                                </div> 
                            </div>
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

<?php include("template/footer.php"); ?>
<script type="text/javascript">
    $('#cliente').select2({});
    var id_cliente = '';
 //    var fecha = '';
	// $('#fecha_ingreso').change(function(){
 //        fecha = $(this).val();
 //    });
    $('#cliente').change(function(){
        id_cliente = $(this).val();
    });

    $(document).on('click', '.id_checkin', function(){

        var check_in = $(this).attr("id");  
        //alert("id_cliente "+id_cliente+" Fecha ingreso "+fecha);
        $.ajax({  
            url:"logica/cliente_ajax_select1.php",  
            method:"POST",  
            data:{
                id_checkin:check_in
            },
            dataType:"json",  
            success:function(data){ 
                console.log(data);
                if (data==null) {
                    alert('No se encontraron datos');
                    $("#result_users").empty();
                }
                else{
                    var total = data.p_dia*data.dias;
                $("#result_users").empty();
                $('#result_users').append('<tr>' +
                '<td >' + data.id + '</td>' + 
                '<td id="fecha_in" >' + data.fecha_ingreso + '</td>' + 
                '<td id="id_user" >' + data.id_cliente + '</td>' + 
                '<td>' + data.id_hab + '</td>' + 
                '<td >$ ' + data.p_dia + '</td>' + 
                '<td>' + data.dias + '</td>' + 
                '<td> $ ' + parseFloat(total).toFixed(2) + '</td>' + 
                '</tr>'+''+
                '<tr><th COLSPAN="5"></th><th COLSPAN="1">Total</th><th COLSPAN="1">$ '+parseFloat(total*1.0).toFixed(2)+'</th></tr>'

                );
                }
            }  
       });  
    });

    $(document).on('change', '#fecha_ingreso', function(){

        var fecha = $(this).val();
        //alert("id_cliente "+id_cliente+" Fecha ingreso "+fecha);
        $.ajax({  
            url:"logica/cliente_ajax_select.php",  
            method:"POST",  
            data:{
                id_cliente:id_cliente,
                fecha_ingreso:fecha},  
            dataType:"json",  
            success:function(data){ 
                console.log(data);
                if (data==null) {
                    alert('No se encontraron datos');
                    $("#result_users").empty();
                }
                else{
                    var total = data.p_dia*data.dias;
                $("#result_users").empty();
                $('#result_users').append('<tr>' +
                '<td >' + data.id + '</td>' + 
                '<td id="fecha_in" >' + data.fecha_ingreso + '</td>' + 
                '<td id="id_user" >' + data.id_cliente + '</td>' + 
                '<td>' + data.id_hab + '</td>' + 
                '<td >$ ' + data.p_dia + '</td>' + 
                '<td>' + data.dias + '</td>' + 
                '<td> $ ' + parseFloat(total).toFixed(2) + '</td>' + 
                '</tr>'+'<br>'+
                '<tr><th COLSPAN="5"></th><th COLSPAN="1">IVA</th><th COLSPAN="1">$ '+parseFloat(total*0.13).toFixed(2)+'</th></tr>'+
                '<tr><th COLSPAN="5"></th><th COLSPAN="1">Total+IVA</th><th COLSPAN="1">$ '+parseFloat(total*1.13).toFixed(2)+'</th></tr>'

                );
                }
            }  
       });  
    });

    $(document).on('click', '#venta_cliente', function(){
        var user_name = $("#cliente option:selected").text();
        var user_id = document.getElementById("id_user").innerHTML;  
        var fecha_i = document.getElementById("fecha_in").innerHTML;  
        swal({
                title: "Procesar Venta?",
                text: "Cliente ID : "+user_id+" Fecha de Ingreso: "+fecha_i,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-warning",
                cancelButtonClass: "btn btn-light",
                confirmButtonText: "Si, proceder!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: "logica/save_venta_hab.php",
                    type: "POST",
                    data: {
                         id_cliente1: user_id,
                         fecha_ingreso: fecha_i,
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



function imprSelec(page) {
     var contenido= document.getElementById(page).innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();
     document.body.innerHTML = contenidoOriginal;
    }
</script>