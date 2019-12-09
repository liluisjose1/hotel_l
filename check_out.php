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
                                <h4 class="page-title">Recepcion</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item "><a href="check_in.php">Recepcion</a></li>
                                    <li class="breadcrumb-item active "><a href="#">Check Out</a></li>
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
                                    <div class="pull-left">
                                        <h4 class="m-t-0 header-title">Cliente</h4>
                                    </div>

                                    <div class="pull-right">
                                        <a href="javascript:imprSelec('page')"><i class="fa fa-print"></i></a>
                                    </div>
                                    <br>
                                    <br>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Cliente</label>
                                                <select class="form-control  selectpicker" id='cliente' name="id_cliente"  required="" >
                                                  <option>Seleccionar Cliente </option>
                                                  <?php 
                                                  $sql3 = "SELECT * FROM clientes WHERE hospedado='1'";
                                                    $ejecutar3 = $conexion->query($sql3);
                                                    while($reg3 = $ejecutar3->fetch_assoc()){
                                                        echo "<option value=".$reg3["id"].">".$reg3["nombre"]." - ".$reg3["doc"]."</option>";
                                                    }
                                                     ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4" class="col-form-label">Fecha Ingreso</label>    
                                                <input type="date" id="fecha_ingreso"  required name="fecha_ingreso"  class="form-control">
                                            </div><!-- 
                                            <div class="form-group col-md-1">
                                                <label for="inputEmail4" class="col-form-label"><br></label>    
                                                <button type="submit" id="ver_factura" class="btn btn-primary form-control">Procesar</button>
                                            </div> -->
                                        </div>              
                                    <br>
                                  <!--   <center><button type="submit" class="btn btn-primary"  onclick="calcular()" >Calcular</button></center> -->
                                
                                        <center><h1>Clientes Hospedados</h1></center>
                                    <div class="row">
                                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Codigo de Habitación</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Telefono</th>
                                            
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php
                                            if(!isset($conexion)){ include("config/conexion.php");}
                                            $sql = "SELECT c_in.id,c.nombre,c.doc,c.tel,c.estado,c.hospedado,c_in.id_hab,c_in.fecha_ingreso FROM `check_in` AS c_in INNER JOIN `clientes` AS c ON c_in.id_cliente=c.id WHERE c.hospedado='1' AND c_in.pagado='0' ";
                                            $ejecutar = $conexion->query($sql);
                                            while($reg = $ejecutar->fetch_assoc()){
                                                echo "<tr>";
                                                ?>
                                                <th scope='row'><a id='<?php echo $reg["id"]; ?>' class='id_checkin'  href="javascript:void(0)"><?php echo $reg["id"]; ?></a></th>
                                                <?php 
                                                echo "<td>".($reg["id_hab"])."</td>";
                                                echo "<td>".($reg["fecha_ingreso"])."</td>";
                                                echo "<td>".($reg["nombre"])."</td>";

                                                echo "<td>".($reg["doc"])."</td>";
                                                echo "<td>".($reg["tel"])."</td>";
                                                echo "</tr>";
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                    </div>
                                </div> 

                                <div class="card-box table-responsive" >

                                    <div class="pull-left">
                                        <h4 class="m-t-0 header-title">Resultado de Busqueda</h4>
                                    </div>
                                        
                                    
                                    <br><br>
                                        <div class="form-row"  >
                                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>ID Checkin</th>
                                                    <th>Fecha Ingreso</th>
                                                    <th>ID Cliente</th>
                                                    <th>Codigo de Habitacion</th>
                                                    <th>Precio</th>
                                                    <th>Dias</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                                </thead>
                                            <tbody id="result_users">
                                            </tbody>
                                            </table>
                                        </div>              
                                    <br>
                                    <center><a  name="edit" value="Edit" id="venta_cliente" class="btn btn-success btn-sm edit_data">Procesar</a></center>
                                    <!-- a href="reports/prueba.php?mi_name=Luis Iraheta" >DOMPDF</a> -->
                                  <!--   <center><button type="submit" class="btn btn-primary"  onclick="calcular()" >Calcular</button></center> -->
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