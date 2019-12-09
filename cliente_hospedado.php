<?php include("template/header.php"); ?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">

                                <h4 class="page-title">Cliente</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active "><a href="#">Hospedado</a></li>
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
                                    <h4 class="m-t-0 header-title">Clientes Hospedados</h4>
                                    <br>

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
                                            $sql = "SELECT c.id,c.nombre,c.doc,c.tel,c.estado,c.hospedado,c_in.id_hab,c_in.fecha_ingreso FROM `check_in` AS c_in INNER JOIN `clientes` AS c ON c_in.id_cliente=c.id WHERE c.hospedado='1' AND c_in.pagado='0' ";
                                            $ejecutar = $conexion->query($sql);
                                            while($reg = $ejecutar->fetch_assoc()){
                                                echo "<tr>";
                                                echo "<th scope='row'>".$reg["id"]."</th>";
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
                        </div>


                    </div> <!-- container -->

                </div> <!-- content -->
                                

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