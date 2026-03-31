<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>404 - Página no encontrada · eBiblioteca</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet" />

    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="/assets/css/ebiblioteca.css" rel="stylesheet" />
  </head>
  <body>
    <?php require_once __DIR__ . '/components/header.php'; ?>
    
    <main class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="mb-4">
            <i class="bi bi-book-half text-primary" style="font-size: 8rem; opacity: 0.3;"></i>
          </div>
          <h1 class="display-1 fw-bold text-primary mb-3">404</h1>
          <h2 class="h3 mb-4">Página no encontrada</h2>
          <p class="lead text-muted mb-4">
            Lo sentimos, la página que buscas no existe o ha sido movida.
          </p>
          <div class="d-flex gap-3 justify-content-center">
            <a href="/" class="btn btn-primary btn-lg">
              <i class="bi bi-house-door me-2"></i>Volver al inicio
            </a>
            <a href="/catalogo" class="btn btn-outline-primary btn-lg">
              <i class="bi bi-book me-2"></i>Explorar catálogo
            </a>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
