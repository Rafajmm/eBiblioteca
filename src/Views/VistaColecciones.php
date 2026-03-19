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
      <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
          <h1 class="display-5 fw-bold fuenteSerif">Colecciones Editoriales</h1>
          <p class="text-muted">Selecciones exclusivas realizadas por nuestros bibliotecarios.</p>
        </div>
        <span class="badge bg-dark px-3 py-2 rounded-pill">12 Colecciones</span>
      </div>

      <div class="row g-4">

        <div class="col-12 col-md-6 col-lg-4 mt-5">
          <a href="VistaLista.php" class="text-decoration-none text-dark enlaceColeccion">
            <div class="card border-0 bg-transparent h-100">
              <div class="contenedorColeccion mb-4">

                <div class="elementoColeccion elemento-3">
                  <img src="https://covers.openlibrary.org/b/id/11614352-L.jpg" alt="Fenomenología del espíritu">
                </div>

                <div class="elementoColeccion elemento-2">
                  <img src="https://covers.openlibrary.org/b/id/2290835-L.jpg" alt="Así habló Zaratustra">
                </div>

                <div class="elementoColeccion elemento-1">
                  <img src="https://covers.openlibrary.org/b/id/4409878-L.jpg" alt="Claros del bosque">
                  <div class="contenedorInsigniaColeccion d-flex align-items-center justify-content-center">
                    <span class="badge bg-white text-dark shadow-sm">+15 libros</span>
                  </div>
                </div>
              </div>

              <div class="card-body p-0">
                <h3 class="h4 fw-bold mb-2">Filosofía Contemporánea</h3>
                <p class="text-muted small mb-0">Un viaje por el pensamiento contemporáneo, desde Hegel hasta Zambrano.</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-md-6 col-lg-4 mt-5">
          <a href="#" class="text-decoration-none text-dark enlaceColeccion">
            <div class="card border-0 bg-transparent h-100">
              <div class="contenedorColeccion mb-4">

                <div class="elementoColeccion elemento-3">
                  <img src="https://covers.openlibrary.org/b/id/8451871-L.jpg" alt="Luces de Bohemia - Ramón del Valle-Inclán">
                </div>

                <div class="elementoColeccion elemento-2">
                  <img src="https://covers.openlibrary.org/b/id/12733975-L.jpg" alt="Historia de una escalera - Antonio Buero Vallejo">
                </div>

                <div class="elementoColeccion elemento-1">
                  <img src="https://covers.openlibrary.org/b/id/6513455-L.jpg" alt="Bodas de Sangre - Federico García Lorca">
                  
                  <div class="contenedorInsigniaColeccion d-flex align-items-center justify-content-center">
                    <span class="badge bg-white text-dark shadow-sm">+8 libros</span>
                  </div>
                </div>
              </div>

              <div class="card-body p-0">
                <h3 class="h4 fw-bold mb-2">Teatro Español</h3>
                <p class="text-muted small mb-0">Las obras maestras de Lorca, Valle-Inclán y Buero Vallejo.</p>
              </div>
            </div>
          </a>
        </div>

      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

</html>