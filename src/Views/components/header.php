<header class="eb-navbar border-bottom bg-white sticky-top">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand eb-eb fw-bold text-primary" href="/">eBiblioteca</a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Abrir navegación">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link text-primary" href="/catalogo">Catálogo</a></li>
          <li class="nav-item"><a class="nav-link text-primary" href="/autores">Autores</a></li>
          <li class="nav-item"><a class="nav-link text-primary" href="/colecciones">Colecciones</a></li>

          <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin']): ?>
            <li class="nav-item"><a class="nav-link text-primary" href="/admin">Admin</a></li>
          <?php endif; ?>
        </ul>
        
        <?php ?>
        
        <?php if(isset($_SESSION['id_usuario'])): ?>
          <div class="d-flex flex-column flex-lg-row gap-2">
            <a href="/usuario/<?=$_SESSION['id_usuario']?>" class="btn btn-outline-primary btn-sm">
              <i class="bi bi-person"></i><?=htmlspecialchars($_SESSION['nombre_usuario'])?>
            </a>
          </div>

        <?php else: ?>
          <div class="d-flex flex-column flex-lg-row gap-2 botonesNav">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalLogin">Acceder</button>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalRegistro">Registro</button>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>