<?php
include("../config/conexion.php");
$id_factura = $_POST["id_factura"];
$cliente = $_POST["id_cliente"];
$fecha_factura = $_POST["fecha_factura"];
$direccion = $_POST["direccion"];
$nit = $_POST["nit"];
$nreg = $_POST["nreg"];
$qty = $_POST["qty"];
$desc = $_POST["desc"];
$total = $_POST["pu"];
$pu = round( ($total/1.13),2);
$iva = round(($pu*0.13),2);
//2019-07-19
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once ('../assets/plugins/vendor/fpdf/fpdf.php');
 
$pdf = new FPDF('P','mm',array(215.9,279.4));

$pdf->AddPage();
// Comienza con fuente regular
$pdf->SetFont('Arial','',8.5);

//fechas
$pdf->SetXY(128.92,44.31);
$pdf->Write(0, substr($fecha_factura,8,9));

$pdf->SetXY(146.1,44.31);
$pdf->Write(0, substr($fecha_factura,5,-3));

$pdf->SetXY(156.98,44.31);
$pdf->Write(0, substr($fecha_factura,0,-6));


//cliente
$pdf->SetXY(67.98,50.92);
$pdf->Write(0,$cliente);
//direccion
$pdf->SetXY(67.98,58.60);
$pdf->Write(0,$direccion);
//nit
$pdf->SetXY(67.98,64.65);
$pdf->Write(0,$nit);
//ncr
$pdf->SetXY(119.27,64.65);
$pdf->Write(0,$nreg);


//detalle
$pdf->SetXY(57.48,91.35);
$pdf->Write(0,$qty);
$pdf->SetXY(68.12,91.35);
$pdf->Write(0,$desc);
$pdf->SetXY(125.70,91.35);
$pdf->Write(0,'$'.$pu);
$pdf->SetXY(154.87,91.35);
$pdf->Write(0,'$'.$pu);


//totalizado
$pdf->SetXY(154.87,169.09);
$pdf->Write(0,'$'.$pu);
$pdf->SetXY(154.87,175.52);
$pdf->Write(0,'$'.round($pu*0.13,2));
$pdf->SetXY(154.87,180.95);
$pdf->Write(0,'$'.number_format($pu+round($pu*0.13,2),2));

$pdf->SetXY(154.87,210.48);
$pdf->Write(0,'$'.number_format($pu+round($pu*0.13,2),2));

$pdf->Output();
$consulta = "INSERT INTO `facturas`(`id_factura`, `tipo_factura`, `cliente`, `direccion`, `nit`, `n_registro`, `cantidad`, `descripcion`, `p_unitario`, `iva`, `total`, `fecha`) VALUES ('$id_factura','2','$cliente','$direccion','$nit','$nreg','$qty','$desc','$pu','$iva','$total','$fecha_factura')";
print($consulta);
$ejecutar_consulta = $conexion->query(($consulta));

?>