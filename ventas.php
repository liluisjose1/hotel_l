 <?php 
ob_start();
include("template/header.php");
?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Administración</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item "><a href="ventas.php">Administración</a></li>
                                    <li class="breadcrumb-item active "><a href="ventas.php">Ventas</a></li>
                                </ol>

                            </div>
                        </div>
                        <div class="row" >
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
                                        <h4 class="m-t-0 header-title">Ventas</h4>
                                    </div>

                                    <div class="pull-right">
                                        <a href="javascript:imprSelec('page')"><i class="fa fa-print"></i></a>
                                    </div>
                                    <br>
                                    <br>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputPassword4" class="col-form-label">Fecha desde</label>
                                                <input type="date" id="fecha_desde"  required name="fecha_desde"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4" class="col-form-label">Fecha hasta</label>    
                                                <input type="date" id="fecha_hasta"  required name="fecha_hasta"  class="form-control">
                                            </div>
                                        </div>              
                                </div> 

                                <div class="card-box table-responsive"  id="page" >
                                        
                                    <center><h1>Hotel <?php echo $config_hotel[1];?></h1></center>
                                    <center><h2>Ventas Desde <label id="desde" class="text-primary" ></label> Hasta <label id="hasta" class="text-primary" ></label> </h2></center>
                                    <center><h5>Tel <?php echo $config_hotel[3];?></h5></center>
                                    <center><h5>Dirección <?php echo $config_hotel[4];?></h5></center>
                                    
                                    <br><br>
                                        <div class="form-row"  >
                                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>ID Venta</th>
                                                    <th>Fecha</th>
                                                    <th>Cliente</th>
                                                    <th>ID Habitacion</th>
                                                    <th>Precio x dia</th>
                                                    <th>Dias</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                            <tbody id="result_users">
                                            </tbody>
                                            </table>
                                        </div>              
                                    <br>
                                    <div class="pull-right" >
                                        <h1>Total $ <label id="total" ></label> </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

<?php include("template/footer.php"); ?>
<script type="text/javascript">

    $(document).on('change', '#fecha_hasta', function(){
        var fecha_desde = $("#fecha_desde").val();
        var fecha_hasta = $("#fecha_hasta").val();

        document.getElementById('desde').innerHTML = fecha_desde; 
        document.getElementById('hasta').innerHTML = fecha_hasta; 

        $.ajax({  
            url:"logica/ventas_ajax_select.php",  
            method:"POST",  
            data:{
                fecha_desde:fecha_desde,
                fecha_hasta:fecha_hasta},  
            dataType:"json",  
            success:function(data){ 
                //console.log(data);
                if (data==null) {
                    alert('No se encontraron datos');
                    $("#result_users").empty();
                }
                else{
                   var totaf = 0;
                $("#result_users").empty();
                    for (var i = 0; i < data.length; i++) 
                    {
                        $('#result_users').append('<tr>' +
                        '<td >' + data[i].id + '</td>' + 
                        '<td id="fecha_in" >' + data[i].fecha + '</td>' + 
                        '<td id="id_user" >' + data[i].id_cliente + '</td>' + 
                        '<td>' + data[i].id_hab + '</td>' + 
                        '<td >$ ' + data[i].p_dia + '</td>' + 
                        '<td>' + data[i].dias + '</td>' + 
                        '<td> $ ' + parseFloat(data[i].total).toFixed(2) + '</td>' + 
                        '</tr>'

                        );

                     totaf += parseFloat(data[i].total); 
                    }
                }
                document.getElementById('total').innerHTML=totaf.toFixed(2); 
            }  
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