<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro iTECH</title>
    <link rel="stylesheet" href="../assets/style.css?v=2">
</head>
<body>
    <main class="container">
        <h1>Registro iTECH</h1>
        <p class="intro">Completa tus datos para registrarte y generar el reporte de inscripciones.</p>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert <?= $_GET['msg'] === 'exito' ? 'alert-success' : 'alert-error' ?>">
                <?= $_GET['msg'] === 'exito' ? 'Registro completado correctamente.' : 'No se pudo completar el registro. Revisa los datos e intenta de nuevo.' ?>
            </div>
        <?php endif; ?>

        <form class="form-grid" action="../controllers/InscriptorController.php" method="POST">
            <div class="field-group">
                <label for="identidad">Documento de Identidad</label>
                <input type="text" id="identidad" name="identidad" placeholder="Ej. 123456789" required>
            </div>

            <div class="field-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
            </div>

            <div class="field-group">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
            </div>

            <div class="field-group">
                <label for="edad">Edad</label>
                <input type="number" id="edad" name="edad" placeholder="Edad" min="1" required>
            </div>

            <div class="field-group">
                <label for="sexo">Sexo</label>
                <select id="sexo" name="sexo" required>
                    <option value="">Seleccione...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <div class="field-group">
                <label for="pais_residencia">País de residencia</label>
                <select id="pais_residencia" name="pais_residencia" required>
                    <option value="">Seleccione...</option>
                    <option value="1">Panamá</option>
                    <option value="2">Colombia</option>
                    <option value="3">Costa Rica</option>
                    <option value="4">Ecuador</option>
                    <option value="5">México</option>
                </select>
            </div>

            <div class="field-group">
                <label for="nacionalidad">Nacionalidad</label>
                <select id="nacionalidad" name="nacionalidad" required>
                    <option value="">Seleccione...</option>
                    <option value="1">Panamá</option>
                    <option value="2">Colombia</option>
                    <option value="3">Costa Rica</option>
                    <option value="4">Ecuador</option>
                    <option value="5">México</option>
                </select>
            </div>

            <div class="field-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
            </div>

            <div class="field-group">
                <label for="celular">Celular</label>
                <input type="text" id="celular" name="celular" placeholder="Teléfono" required>
            </div>

            <div class="field-group full-width interests-group">
                <label>Temas Tecnológicos</label>
                <div class="chip-group" role="group" aria-label="Temas de interés">
                    <label class="chip">
                        <input type="checkbox" name="temas[]" value="1">
                        <span>Desarrollo Móvil</span>
                    </label>
                    <label class="chip">
                        <input type="checkbox" name="temas[]" value="2">
                        <span>Inteligencia Artificial</span>
                    </label>
                    <label class="chip">
                        <input type="checkbox" name="temas[]" value="3">
                        <span>Ciberseguridad</span>
                    </label>
                    <label class="chip">
                        <input type="checkbox" name="temas[]" value="4">
                        <span>Big Data</span>
                    </label>
                    <label class="chip">
                        <input type="checkbox" name="temas[]" value="5">
                        <span>Cloud Computing</span>
                    </label>
                </div>
            </div>

            <div class="field-group full-width">
                <label for="observaciones">Observaciones o consultas</label>
                <textarea id="observaciones" name="observaciones" placeholder="Escribe aquí tus comentarios..."></textarea>
            </div>

            <div class="button-row full-width">
                <button type="submit">Registrar</button>
            </div>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 iTECH. All rights reserved. Victor Rivas</p>
    </footer>
</body>
</html>