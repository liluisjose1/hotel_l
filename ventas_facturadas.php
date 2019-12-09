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
                                        <a href="#" onclick="printDiv('page')" ><i class="fa fa-print"></i></a>
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
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4" class="col-form-label">Tipo de Factura</label>    
                                                <select class="form-control  " name="tipo" id="tipo"  required="" >
                                                    <option value =''>Seleccionar</option>
                                                    <option value ='1'>Consumidor Final</option>
                                                    <option value ='2'>Credito Fiscal IVA</option>
                                                </select>
                                            </div>
                                        </div>              
                                </div> 

                                <div class="card-box table-responsive" style="visibility:hidden" id="page" >
                                        
                                    <center><h1>Hotel <?php echo $config_hotel[1];?></h1></center>
                                    <center><h2>Ventas Facturadas <label id="tipo_fac" ></label> <br> Desde <label id="desde" class="text-primary" ></label> Hasta <label id="hasta" class="text-primary" ></label> </h2></center>
                                    <center><h5>Tel <?php echo $config_hotel[3];?></h5></center>
                                    <center><h5>Dirección <?php echo $config_hotel[4];?></h5></center>
                                    
                                    <br><br>
                                        <div class="form-row"  >
                                            <table id="tbl_prueba" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead id = "cabecera_tbl">
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

    $(document).on('change', '#tipo', function(){
        $
        var fecha_desde = $("#fecha_desde").val();
        var fecha_hasta = $("#fecha_hasta").val();
        var tipo = $("#tipo").val();
        var tipo2 = $("#tipo option:selected").text();
        $("#page").css("visibility", "visible");

        document.getElementById('desde').innerHTML = fecha_desde; 
        document.getElementById('hasta').innerHTML = fecha_hasta; 
        document.getElementById('tipo_fac').innerHTML = tipo2; 

        $.ajax({  
            url:"logica/ventas_ajax_factura.php",  
            method:"POST",  
            data:{
                fecha_desde:fecha_desde,
                fecha_hasta:fecha_hasta,
                tipo},  
            dataType:"json",  
            success:function(data){ 
                if (data==null) {
                    alert('No se encontraron datos');
                    $("#result_users").empty();
                }
                else{
                   var totaf = 0;
                $("#result_users").empty();
                $("#cabecera_tbl").empty();
                    if (tipo=='1') {
                    $("#cabecera_tbl ").append('<tr><th>Fecha</th><th>Factura</th><th>Cliente</th><th>Cantidad</th><th>Descripcion</th><th>Precio Unitario</th><th>Total</th></tr>');
                        for (var i = 0; i < data.length; i++) 
                    {
                        $('#result_users').append('<tr>' +
                        '<td>' + data[i].fecha + '</td>' + 
                        '<td>' + data[i].id_factura + '</td>' + 
                        '<td >' + data[i].cliente + '</td>' + 
                        '<td >' + data[i].cantidad + '</td>' + 
                        '<td >' + data[i].descripcion + '</td>' + 
                        '<td >$ ' + data[i].p_unitario + '</td>' + 
                        '<td>$' + data[i].total + '</td>' + 
                        '</tr>'
                        );

                     totaf += parseFloat(data[i].total); 
                    }
                    } else {
                        $("#cabecera_tbl ").append('<tr><th>Fecha</th><th>Factura</th><th>Cliente</th><th>Dirección</th><th>NIT</th><th>Nº Registro</th><th>Cantidad</th><th>Descripcion</th><th>Precio Unitario</th><th>IVA</th><th>Total</th></tr>');

                        for (var i = 0; i < data.length; i++) 
                    {
                        $('#result_users').append('<tr>' +
                        '<td>' + data[i].fecha + '</td>' + 
                        '<td>' + data[i].id_factura + '</td>' + 
                        '<td >' + data[i].cliente + '</td>' + 
                        '<td>' + data[i].direccion + '</td>' + 
                        '<td>' + data[i].nit + '</td>' + 
                        '<td >' + data[i].n_registro + '</td>' + 
                        '<td >' + data[i].cantidad + '</td>' + 
                        '<td >' + data[i].descripcion + '</td>' + 
                        '<td >$ ' + data[i].p_unitario + '</td>' + 
                        '<td >$' + data[i].iva + '</td>' + 
                        '<td>$' + data[i].total + '</td>' + 
                        '</tr>'
                        );

                     totaf += parseFloat(data[i].total); 
                    }
                    }
                }
                document.getElementById('total').innerHTML=totaf.toFixed(2); 
            }  
       });  
    });




    function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();
     document.body.innerHTML = contenidoOriginal;
}
</script>