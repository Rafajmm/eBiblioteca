<header class="eb-navbar border-bottom bg-white sticky-top">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand eb-eb fw-bold text-primary" href="/index.php">eBiblioteca</a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Abrir navegación">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link text-primary" href="/src/Views/VistaCatalogo.php">Catálogo</a></li>
          <li class="nav-item"><a class="nav-link text-primary" href="/src/Views/VistaAutores.php">Autores</a></li>
          <li class="nav-item"><a class="nav-link text-primary" href="/src/Views/VistaColecciones.php">Colecciones</a></li>
        </ul>
        
        <div class="d-flex flex-column flex-lg-row gap-2 botonesNav">
          <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Acceder</button>
          <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Registro</button>
        </div>
      </div>
    </div>
  </nav>
</header>