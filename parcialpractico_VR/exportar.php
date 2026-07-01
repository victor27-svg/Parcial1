<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/models/Inscriptor.php';
require_once __DIR__ . '/utils/Validator.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$documento = new Spreadsheet();
$documento->getProperties()->setCreator("iTECH 2026")->setTitle('Reporte Inscriptores');
$hoja = $documento->getActiveSheet();
$hoja->setTitle("Inscritos");

$encabezado = ["ID", "Identidad", "Nombre Completo", "Correo", "Temas", "Estado Auditoría"];
$hoja->fromArray($encabezado, null, 'A1');

$modelo = new Inscriptor();
$datos = $modelo->getReporte();

$fila = 2;
foreach ($datos as $reg) {
    $esValido = Validator::verificarIntegridad($reg->identidad, $reg->nombre, $reg->correo, $reg->celular, $reg->sexo, $reg->firma_integridad);
    $estado = $esValido ? 'Dato Íntegro' : 'Dato Vulnerado';

    $hoja->setCellValue('A'.$fila, $reg->id);
    $hoja->setCellValue('B'.$fila, $reg->identidad);
    $hoja->setCellValue('C'.$fila, $reg->nombre . ' ' . $reg->apellido);
    $hoja->setCellValue('D'.$fila, $reg->correo);
    $hoja->setCellValue('E'.$fila, $reg->temas_interes);
    $hoja->setCellValue('F'.$fila, $estado);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_iTECH.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($documento);
$writer->save('php://output');
exit;
?>