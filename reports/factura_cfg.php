<?php

include("../config/conexion.php");

$id_factura = $_POST["id_factura"];
$cliente = $_POST["id_cliente"];
$fecha_factura = $_POST["fecha_factura"];
// $direccion = $_POST["direccion"];
// $nit = $_POST["nit"];
// $nreg = $_POST["nreg"];
$qty = $_POST["qty"];
$desc = $_POST["desc"];
$pu = $_POST["pu"];
$total = round(($pu*$qty),2);



//2019-07-19
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once ('../assets/plugins/vendor/fpdf/fpdf.php');
 
$pdf = new FPDF('P','mm',array(215.9,279.4));

$pdf->AddPage();
// Comienza con fuente regular
$pdf->SetFont('Arial','',8.5);

//fechas
$pdf->SetXY(122.50,38.22);
$pdf->Write(0, substr($fecha_factura,8,9));

$pdf->SetXY(136.38,38.22);
$pdf->Write(0, substr($fecha_factura,5,-3));

$pdf->SetXY(153.50,38.22);
$pdf->Write(0, substr($fecha_factura,0,-6));


//cliente
$pdf->SetXY(75.50,45.22);
$pdf->Write(0,$cliente);
// //direccion
// $pdf->SetXY(67.98,58.60);
// $pdf->Write(0,$direccion);
// //nit
// $pdf->SetXY(67.98,64.65);
// $pdf->Write(0,$nit);
// //ncr
// $pdf->SetXY(119.27,64.65);
// $pdf->Write(0,$nreg);


//detalle
$pdf->SetXY(65.17,72.88);
$pdf->Write(0,$qty);
$pdf->SetXY(75.50,72.88);
$pdf->Write(0,$desc);
$pdf->SetXY(122.02,72.88);
$pdf->Write(0,'$'.number_format($pu,2));
$pdf->SetXY(145.87,72.88);
$pdf->Write(0,'$'.number_format($pu,2));


//totalizado
$pdf->SetXY(145.87,138.18);
$pdf->Write(0,'$'.number_format($pu,2));

$pdf->SetXY(145.87,159.13);
$pdf->Write(0,'$'.number_format(($pu),2));

$pdf->Output();

$consulta = "INSERT INTO `facturas`(`id_factura`, `tipo_factura`, `cliente`,`cantidad`, `descripcion`, `p_unitario`, `total`, `fecha`) VALUES ('$id_factura','1','$cliente','$qty','$desc','$pu','$total','$fecha_factura')";
print($consulta);
$ejecutar_consulta = $conexion->query(($consulta));
?>