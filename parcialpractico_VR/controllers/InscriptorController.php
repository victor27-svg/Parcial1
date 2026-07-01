<?php
require_once '../utils/Validator.php';
require_once '../models/Inscriptor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitización y validación
    $identidad = Validator::cleanData($_POST['identidad']);
    $nombre = Validator::toTitleCase($_POST['nombre']);
    $apellido = Validator::toTitleCase($_POST['apellido']);
    $edad = (int)$_POST['edad'];
    $sexo = Validator::cleanData($_POST['sexo']);
    $pais_id = (int)$_POST['pais_residencia'];
    $nacionalidad_id = (int)$_POST['nacionalidad'];
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $celular = Validator::cleanData($_POST['celular']);
    $observaciones = Validator::cleanData($_POST['observaciones']);
    $temas = isset($_POST['temas']) ? $_POST['temas'] : [];

    // 2. Firma OpenSSL para Auditoría
    $firma = Validator::firmarDatos($identidad, $nombre, $correo, $celular, $sexo);

    // 3. Guardar usando el Modelo
    $modelo = new Inscriptor();
    if ($modelo->guardar($identidad, $nombre, $apellido, $edad, $sexo, $pais_id, $nacionalidad_id, $correo, $celular, $observaciones, $firma, $temas)) {
        header("Location: ../views/reporte.php?msg=exito");
    } else {
        header("Location: ../views/formulario.php?msg=error");
    }
}
?>