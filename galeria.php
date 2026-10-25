<?php
include_once 'includes/header.php';

$directorio = './uploaded_files/';

// glob busca todas las rutas de imágenes con extensiones permitidas
$imagenes = glob($directorio . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
?>

<main class="container my-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark m-0">Galería de Fotografías Subidas</h2>
        <span class="badge bg-primary fs-6"><?php echo count($imagenes); ?> Fotografías</span>
    </div>

    <?php if (empty($imagenes)): ?>
        <div class="alert alert-warning text-center shadow-sm" role="alert">
            No se han subido fotografías a la carpeta del servidor todavía.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($imagenes as $img): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="<?php echo htmlspecialchars($img); ?>" 
                             class="card-img-top p-2 rounded" 
                             alt="Foto Subida" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body p-2 bg-light border-top text-center">
                            <small class="text-muted text-truncate d-block fw-monospace">
                                <?php echo basename($img); ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include_once 'includes/footer.php'; ?>