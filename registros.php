<?php
include_once 'includes/header.php';

$archivoJson = 'registros.json';
$registros = [];

// Si el archivo existe, leemos su contenido
if (file_exists($archivoJson)) {
    $contenido = file_get_contents($archivoJson);
    $registros = json_decode($contenido, true) ?? [];
}
?>

<main class="container my-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark m-0">Aspirantes Registrados</h2>
        <a href="index.php" class="btn btn-primary btn-sm">+ Nuevo Registro</a>
    </div>

    <?php if (empty($registros)): ?>
        <div class="alert alert-info text-center shadow-sm" role="alert">
            Aún no hay registros guardados en el sistema.
        </div>
    <?php else: ?>
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3">Fotografía</th>
                                <th>Nombre Completo</th>
                                <th>Identificación</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registros as $reg): ?>
                                <tr>
                                    <td class="ps-3">
                                        <img src="<?php echo htmlspecialchars($reg['foto']); ?>" 
                                             alt="Foto Aspirante" 
                                             class="rounded border shadow-sm" 
                                             style="width: 48px; height: 48px; object-fit: cover;">
                                    </td>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($reg['nombre_completo']); ?></td>
                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($reg['identificacion']); ?></span></td>
                                    <td><?php echo htmlspecialchars($reg['edad']); ?> años</td>
                                    <td><?php echo htmlspecialchars($reg['sexo']); ?></td>
                                    <td><small class="text-muted"><?php echo htmlspecialchars($reg['fecha_registro']); ?></small></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include_once 'includes/footer.php'; ?>