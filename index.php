<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eBiblioteca · Catálogo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <link href="assets/css/ebiblioteca.css" rel="stylesheet" />
  </head>
  <body>
    <?php
      require_once('src/Components/header.php');
    ?>
    
    <main class="container-fluid py-4">
      <section class="row justify-content-center mb-5 py-5 bg-light rounded-4 shadow-sm">
  <div class="col-lg-8 text-center">
    <h1 class="display-4 fw-bold text-primary mb-4" style="font-family: 'Merriweather', serif;">Cultura libre para todos</h1>
    <p class="lead fs-4 text-dark mb-4">
      En <strong>eBiblioteca</strong>, creemos firmemente que la cultura debe estar al alcance de todo el mundo. Nuestro objetivo es fomentar la lectura distribuyendo grandes obras clásicas y contemporáneas libres de derechos de una manera visual, ordenada y sencilla.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <a href="/src/Views/VistaCatalogo.php" class="btn btn-primary btn-lg px-4">Explorar Catálogo</a>
      <a href="#novedades" class="btn btn-outline-secondary btn-lg px-4">Ver Novedades</a>
    </div>
    <p class="text-muted mt-3 small">Sin registros obligatorios. Lectura directa y gratuita.</p>
  </div>
</section>

<section class="container mb-5">
  <div class="row g-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h3 class="h5 mb-1 opacity-75">Nuestra biblioteca</h3>
            <p class="display-6 fw-bold mb-0">+1,200 libros disponibles</p>
          </div>
          <i class="bi bi-book fs-1 opacity-50"></i>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card border-0 shadow-sm overflow-hidden bg-white">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div class="text-dark">
            <h3 class="h5 mb-1 text-muted">Grandes pensadores</h3>
            <p class="display-6 fw-bold mb-0">450 autores</p>
          </div>
          <i class="bi bi-person-workspace fs-1 text-primary opacity-25"></i>
        </div>
      </div>
    </div>

    <div id="novedades" class="col-12">
      <div class="card border-primary shadow-sm bg-white" style="border-left: 5px solid !important;">
        <div class="card-body p-4">
          <div class="d-flex align-items-center mb-3">            
            <h3 class="h4 mb-0 fw-bold">Novedades de la semana</h3>
          </div>
          <div class="row row-cols-1 row-cols-md-3 g-3">
            <div class="col">
              <div class="p-3 border rounded-3 bg-light">
                <span class="badge bg-narrativa mb-2">Narrativa</span>
                <p class="fw-bold mb-0">El Quijote de la Mancha</p>
                <small class="text-muted">Miguel de Cervantes</small>
              </div>
            </div>
            <div class="col">
              <div class="p-3 border rounded-3 bg-light">
                <span class="badge bg-ensayo mb-2">Filosofía</span>
                <p class="fw-bold mb-0">Meditaciones</p>
                <small class="text-muted">Marco Aurelio</small>
              </div>
            </div>
            <div class="col">
              <div class="p-3 border rounded-3 bg-light">
                <span class="badge bg-teatro mb-2">Teatro</span>
                <p class="fw-bold mb-0">Hamlet</p>
                <small class="text-muted">William Shakespeare</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </main>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="loginTitle">Acceder</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="loginEmail" class="form-label">Email</label>
              <input id="loginEmail" type="email" class="form-control" placeholder="tu@email.com" />
            </div>
            <div class="mb-3">
              <label for="loginPass" class="form-label">Contraseña</label>
              <input id="loginPass" type="password" class="form-control" placeholder="••••••••" />
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="remember" />
              <label class="form-check-label" for="remember">Recordarme</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Entrar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="registerTitle">Registro</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="regName" class="form-label">Nombre</label>
              <input id="regName" type="text" class="form-control" placeholder="Tu nombre" />
            </div>
            <div class="mb-3">
              <label for="regEmail" class="form-label">Email</label>
              <input id="regEmail" type="email" class="form-control" placeholder="tu@email.com" />
            </div>
            <div class="mb-3">
              <label for="regPass" class="form-label">Contraseña</label>
              <input id="regPass" type="password" class="form-control" placeholder="Crea una contraseña" />
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="terms" />
              <label class="form-check-label" for="terms">Acepto las condiciones</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Crear cuenta</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/ebiblioteca.js"></script>
  </body>
</html>
