<?php
require_once '../models/Inscriptor.php';
require_once '../utils/Validator.php';

$modelo = new Inscriptor();
$registros = $modelo->getReporte();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inscritos</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container-reporte">
        <h2>Reporte Oficial de Inscritos</h2>
        <a href="../exportar.php" class="btn-excel">Exportar a Excel</a>
        <table>
            <tr>
                <th>Estado (Auditoría)</th>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Materia</th>
            </tr>
            <?php foreach ($registros as $reg): 
                $esValido = Validator::verificarIntegridad($reg->identidad, $reg->nombre, $reg->correo, $reg->celular, $reg->sexo, $reg->firma_integridad);
            ?>
            <tr>
                <td>
                    <?php if($esValido): ?>
                        <span class="badge verde">OK - Íntegro</span>
                    <?php else: ?>
                        <span class="badge rojo">ALERTA - Corrupto</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($reg->nombre . ' ' . $reg->apellido) ?></td>
                <td><?= htmlspecialchars($reg->correo) ?></td>
                <td><?= htmlspecialchars($reg->temas_interes) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>