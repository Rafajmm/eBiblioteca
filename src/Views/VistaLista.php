<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eBiblioteca · Lectura</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <link href="/assets/css/ebiblioteca.css" rel="stylesheet" />
  </head>
  <body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/src/Components/header.php'); ?>

    <main class="container py-5">

        <header class="row g-4 align-items-center mb-5">
            
            <div class="col-12 col-md">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-primary-subtle text-primary text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Colección</span>
                    <span class="text-muted small">• 15 títulos</span>
                </div>
                <h1 class="display-5 fw-bold fuenteSerif mb-3">Filosofía Contemporánea</h1>
                <p class="lead text-secondary" style="max-width: 700px;">
                    Una cuidada selección de las obras que definieron el pensamiento contemporáneo, desde la fenomenología hasta el existencialismo.
                </p>
                <div class="d-flex align-items-center mb-3">                        
                    <span class="small">Creada por <strong>Equipo eBiblioteca</strong></span>
                </div>
                <div class="d-flex align-items-center gap-3">                    
                    <button class="btn btn-dark btn-sm rounded-pill px-3">
                        <i class="bi bi-plus-lg me-1"></i> Seguir
                    </button>
                    <button class="btn btn-dark btn-sm rounded-pill px-3">
                        <i class="bi bi-bookmark"></i> Guardar
                    </button>
                    <button class="btn btn-outline-secondary btn-sm rounded-circle" aria-label="Compartir">
                        <i class="bi bi-share"></i>
                    </button>
                </div>
            </div>
        </header>

        <hr class="mb-5 opacity-10">

        <section class="lista-libros">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card border-0 bg-transparent filaLibro transicion p-2 rounded-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="text-muted fw-bold ms-2">01</span>
                            </div>
                            <div class="col-auto">
                                <img src="https://covers.openlibrary.org/b/id/4496766-M.jpg" class="rounded shadow-sm" width="60" alt="Portada">
                            </div>
                            <div class="col">
                                <h5 class="mb-0 fw-bold">Claros del bosque</h5>
                                <p class="text-muted mb-0 small">María Zambrano</p>
                            </div>
                            <div class="col-auto d-none d-md-block text-center px-4">
                                <span class="badge bg-ensayo border px-3">Ensayo</span>
                            </div>
                            <div class="col-auto">
                                <a href="VistaObra.php" class="btn btn-sm btn-outline-primary rounded-pill">Leer</a>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>