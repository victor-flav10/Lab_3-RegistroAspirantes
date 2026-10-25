index.php

<?php
// Incluimos el encabezado modular
include_once 'includes/header.php';
?>

<main class="container my-5 flex-grow-1">
    <section class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4 fw-bold text-dark">Formulario de Registro de Aspirantes</h2>
                    
                    <form action="procesar.php" method="POST" enctype="multipart/form-data">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre (Requerido):</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Juan" required>
                        </div>

                        <!-- Apellido -->
                        <div class="mb-3">
                            <label for="apellido" class="form-label fw-semibold">Apellido (Requerido):</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej. Pérez" required>
                        </div>

                        <!-- Identificación -->
                        <div class="mb-3">
                            <label for="identificacion" class="form-label fw-semibold">Identificación (Requerido):</label>
                            <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Ej. 8-988-123" required>
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label fw-semibold">Fecha de Nacimiento (Requerido):</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>

                        <!-- Sexo -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Sexo (Requerido):</label>
                            <div class="btn-group w-100" role="group" aria-label="Sexo">
                                <input type="radio" class="btn-check" name="sexo" id="hombre" value="Hombre" autocomplete="off" required>
                                <label class="btn btn-outline-primary" for="hombre">Hombre</label>

                                <input type="radio" class="btn-check" name="sexo" id="mujer" value="Mujer" autocomplete="off" required>
                                <label class="btn btn-outline-primary" for="mujer">Mujer</label>
                            </div>
                        </div>

                        <!-- Fotografía -->
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold">Fotografía del Aspirante (png, jpg, jpeg, gif, webp):</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                        </div>

                        <!-- Botón Submit -->
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Registrar Aspirante</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
// Incluimos el pie de página modular
include_once 'includes/footer.php';
?>

