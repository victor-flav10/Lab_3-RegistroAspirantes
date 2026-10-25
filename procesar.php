
<?php
include_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = [];

    $nombre = isset($_POST['nombre']) ? htmlspecialchars(strip_tags(trim($_POST['nombre']))) : '';
    $apellido = isset($_POST['apellido']) ? htmlspecialchars(strip_tags(trim($_POST['apellido']))) : '';
    $identificacion = isset($_POST['identificacion']) ? htmlspecialchars(strip_tags(trim($_POST['identificacion']))) : '';
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';
    $sexo = isset($_POST['sexo']) ? htmlspecialchars(strip_tags(trim($_POST['sexo']))) : '';

    $nombre = ucwords(strtolower($nombre));
    $apellido = ucwords(strtolower($apellido));
    $identificacion = strtoupper($identificacion);

    if (empty($nombre) || empty($apellido) || empty($identificacion) || empty($fecha_nacimiento) || empty($sexo)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    $edad = 0;
    if (!empty($fecha_nacimiento)) {
        $fechaNac = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNac)->y;

        if ($edad < 18 || $edad > 70) {
            $errores[] = "El aspirante debe tener entre 18 y 70 años de edad. Edad calculada: {$edad} años.";
        }
    }

    $fotoRutaDestino = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmpPath = $_FILES['foto']['tmp_name'];
        $fotoNombreOriginal = $_FILES['foto']['name'];
        $fotoExtension = strtolower(pathinfo($fotoNombreOriginal, PATHINFO_EXTENSION));
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($fotoExtension, $extensionesPermitidas)) {
            $errores[] = "Formato de archivo no permitido.";
        } else {
            $nuevoNombreFoto = uniqid('foto_') . '.' . $fotoExtension;
            $directorioSubida = './uploaded_files/';

            if (!is_dir($directorioSubida)) {
                mkdir($directorioSubida, 0755, true);
            }

            $fotoRutaDestino = $directorioSubida . $nuevoNombreFoto;
            if (!move_uploaded_file($fotoTmpPath, $fotoRutaDestino)) {
                $errores[] = "Error al guardar la fotografía.";
            }
        }
    } else {
        $errores[] = "Es necesario adjuntar una fotografía válida.";
    }

    ?>
    <main class="container my-5 flex-grow-1">
        <section class="row justify-content-center">
            <div class="col-md-8">
                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger shadow-sm">
                        <h4 class="alert-heading fw-bold">Errores detectados:</h4>
                        <hr>
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="text-center mt-3">
                        <a href="index.php" class="btn btn-secondary">Regresar</a>
                    </div>
                <?php else: ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white text-center py-3">
                            <h3 class="mb-0 fw-bold">¡Registro Exitoso!</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <img src="<?php echo htmlspecialchars($fotoRutaDestino); ?>" class="img-fluid rounded border shadow-sm">
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Nombre:</strong> <?php echo $nombre . ' ' . $apellido; ?></li>
                                        <li class="list-group-item"><strong>Identificación:</strong> <?php echo $identificacion; ?></li>
                                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> <?php echo $fecha_nacimiento; ?> (<?php echo $edad; ?> años)</li>
                                        <li class="list-group-item"><strong>Sexo:</strong> <?php echo $sexo; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php
} else {
    header('Location: index.php');
    exit();
}

include_once 'includes/footer.php';
?>
<?php
// Incluimos el encabezado modular
include_once 'includes/header.php';

// Verificación de método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = [];

    // 1. Recepción y Saneamiento de datos
    $nombre = isset($_POST['nombre']) ? htmlspecialchars(strip_tags(trim($_POST['nombre']))) : '';
    $apellido = isset($_POST['apellido']) ? htmlspecialchars(strip_tags(trim($_POST['apellido']))) : '';
    $identificacion = isset($_POST['identificacion']) ? htmlspecialchars(strip_tags(trim($_POST['identificacion']))) : '';
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';
    $sexo = isset($_POST['sexo']) ? htmlspecialchars(strip_tags(trim($_POST['sexo']))) : '';

    // Normalización de texto
    $nombre = ucwords(strtolower($nombre));
    $apellido = ucwords(strtolower($apellido));
    $identificacion = strtoupper($identificacion);

    // Validar campos vacíos
    if (empty($nombre) || empty($apellido) || empty($identificacion) || empty($fecha_nacimiento) || empty($sexo)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // 2. Cálculo y Validación de Edad (Rango de 18 a 70 años)
    $edad = 0;
    if (!empty($fecha_nacimiento)) {
        $fechaNac = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNac)->y;

        if ($edad < 18 || $edad > 70) {
            $errores[] = "El aspirante debe tener entre 18 y 70 años de edad. Edad calculada: {$edad} años.";
        }
    }

    // 3. Procesamiento y Subida de Archivo (Fotografía)
    $fotoRutaDestino = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmpPath = $_FILES['foto']['tmp_name'];
        $fotoNombreOriginal = $_FILES['foto']['name'];
        $fotoExtension = strtolower(pathinfo($fotoNombreOriginal, PATHINFO_EXTENSION));

        // Extensiones permitidas
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($fotoExtension, $extensionesPermitidas)) {
            $errores[] = "Formato de archivo no permitido. Solo se aceptan: jpg, jpeg, png, gif, webp.";
        } else {
            // Generar nombre único para evitar duplicados
            $nuevoNombreFoto = uniqid('foto_') . '.' . $fotoExtension;
            $directorioSubida = './uploaded_files/';

            if (!is_dir($directorioSubida)) {
                mkdir($directorioSubida, 0755, true);
            }

            $fotoRutaDestino = $directorioSubida . $nuevoNombreFoto;

            if (!move_uploaded_file($fotoTmpPath, $fotoRutaDestino)) {
                $errores[] = "Hubo un error al guardar la fotografía en el servidor.";
            }
        }
    } else {
        $errores[] = "Es necesario adjuntar una fotografía válida.";
    }


//######################################################
  // --- GUARDAR REGISTRO EN ARCHIVO JSON ---
$nuevoRegistro = [
    'nombre_completo' => $nombre . ' ' . $apellido,
    'identificacion'  => $identificacion,
    'edad'            => $edad,
    'sexo'            => $sexo,
    'foto'            => $fotoRutaDestino,
    'fecha_registro'  => date('d/m/Y h:i A')
];

$archivoJson = 'registros.json';


// Cargar registros existentes si el archivo ya existe
$registrosExistentes = file_exists($archivoJson) 
    ? json_decode(file_get_contents($archivoJson), true) 
    : [];

// Agregar el nuevo aspirante a la lista
$registrosExistentes[] = $nuevoRegistro;

// Escribir la lista actualizada en el archivo JSON
file_put_contents($archivoJson, json_encode($registrosExistentes, JSON_PRETTY_PRINT));
//######################################################

    // 4. Renderizado de Resultados
    ?>
    <main class="container my-5 flex-grow-1">
        <section class="row justify-content-center">
            <div class="col-md-8">
                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger shadow-sm" role="alert">
                        <h4 class="alert-heading fw-bold">Se encontraron errores en el registro:</h4>
                        <hr>
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="text-center mt-3">
                        <a href="index.php" class="btn btn-secondary">Regresar al Formulario</a>
                    </div>
                <?php else: ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white text-center py-3">
                            <h3 class="mb-0 fw-bold">¡Registro de Aspirante Exitoso!</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <img src="<?php echo htmlspecialchars($fotoRutaDestino); ?>" alt="Fotografía del Aspirante" class="img-fluid rounded border shadow-sm" style="max-height: 220px; object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Nombre Completo:</strong> <?php echo $nombre . ' ' . $apellido; ?></li>
                                        <li class="list-group-item"><strong>Identificación:</strong> <?php echo $identificacion; ?></li>
                                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> <?php echo $fecha_nacimiento; ?> (<?php echo $edad; ?> años)</li>
                                        <li class="list-group-item"><strong>Sexo:</strong> <?php echo $sexo; ?></li>
                                        <li class="list-group-item"><strong>Fotografía Registrada:</strong> <?php echo basename($fotoRutaDestino); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-center py-3">
                            <a href="index.php" class="btn btn-primary">Registrar Otro Aspirante</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php
} else {
    // Si no es POST, redirigir al formulario
    header('Location: index.php');
    exit();
}

// Incluimos el pie de página modular
include_once 'includes/footer.php';
?>

