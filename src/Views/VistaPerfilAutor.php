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

    <main class="container-fluid py-4 px-md-5">
        
        <section class="author-profile-header p-4 p-lg-5 mb-5 shadow-sm border rounded bg-white">
            <div class="row align-items-center">
                <div class="col-12 col-md-auto text-center mb-4 mb-md-0">
                    <img src="https://ui-avatars.com/api/?name=Maria+Zambrano&size=200&background=198754&color=fff" 
                        alt="Maria Zambrano" 
                        class="rounded-circle border shadow" 
                        style="width: 180px; height: 180px; object-fit: cover;">
                </div>
                <div class="col-12 col-md ps-md-5">
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-2">
                        <h1 class="display-5 fw-bold mb-0">María Zambrano</h1>
                    </div>
                    <p class="text-secondary mb-3">
                        <i class="bi bi-geo-alt-fill me-1"></i> Vélez Málaga, Málaga 
                        <span class="mx-2">|</span> 
                        <i class="bi bi-calendar3 me-1"></i> 1904 - 1991
                    </p>
                    <p class="lead text-muted" style="font-size: 1rem; max-width: 800px;">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, sequi delectus quidem temporibus repudiandae ipsa cumque odio in doloribus impedit! Est veritatis debitis adipisci mollitia eligendi eum iste itaque cum.
                    </p>
                    <div class="d-flex gap-2 mt-4">
                        <div class="text-center border-end pe-4">
                            <span class="d-block h4 fw-bold mb-0">12</span>
                            <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Obras en eBiblio</small>
                        </div>
                        <div class="text-center ps-2">
                            <span class="d-block h4 fw-bold mb-0">4</span>
                            <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Géneros</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="author-works">
            <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
                <h3 class="fw-bold mb-0">Obras disponibles</h3>
                <span class="text-muted small">Mostrando todos los títulos</span>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">

                <div class="col" href='VistaObra.php'>
                    <a class="text-decoration-none" href="VistaObra.php">
                        <div class="card tarjetaLibro border-0 shadow-sm h-100">
                            <div class="portadaLibroWrapper">
                                <img src="https://covers.openlibrary.org/b/olid/OL4496766M-L.jpg" alt="Claros del bosque">
                            </div>
                            <div class="card-body p-3">
                                <div class="mb-2 d-flex flex-wrap gap-1">
                                    <span class="badge bg-ensayo shadow-sm">Ensayo</span>
                                    <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Filosofía</span>
                                    <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Siglo XX</span>
                                </div>
                                <h5 class="card-title h6 fw-bold mb-1 text-truncate">Claros del bosque</h5>
                                <p class="card-text small text-secondary mb-1">María Zambrano</p>
                                <p class="card-text small text-muted">1977</p>
                            </div>
                        </div>
                    </a>    
                </div>                
            </div>

        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>