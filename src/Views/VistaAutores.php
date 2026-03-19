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
        <section class="seccionFiltros p-4 mb-4 shadow-sm border rounded bg-light">
            <form class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-secondary">Nombre del autor</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-person-search"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="Ej: Cervantes, Allende...">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label small fw-bold text-secondary">País / Nacionalidad</label>
                    <select class="form-select">
                        <option selected>Todos los países</option>
                        <option>España</option>
                        <option>México</option>
                        <option>Argentina</option>
                        <option>Chile</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label small fw-bold text-secondary">Época</label>
                    <select class="form-select">
                        <option selected>Cualquier época</option>
                        <option>Contemporánea</option>
                        <option>Siglo XX</option>
                        <option>Clásicos (Pre-XIX)</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Buscar</button>
                </div>
            </form>
        </section>

        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center border-bottom pb-3">
            <button class="btn btn-sm btn-outline-secondary active">Todos</button>
            <button class="btn btn-sm btn-outline-secondary">A</button>
            <button class="btn btn-sm btn-outline-secondary">B</button>
            <button class="btn btn-sm btn-outline-secondary">C</button>
            <span class="text-muted align-self-center">...</span>
            <button class="btn btn-sm btn-outline-secondary">Z</button>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mb-5">
        
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 me-3">
                            <img src="https://ui-avatars.com/api/?name=Carmen+Laforet&background=6f42c1&color=fff" class="rounded-circle border shadow-sm" style="width: 60px; height: 60px;">
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-0 fw-bold">Carmen Laforet</h6>
                            <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>España</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary-subtle text-secondary fw-normal">1 Obra</span>
                                <a href="#" class="btn btn-sm btn-link p-0 text-decoration-none text-primary">Perfil <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 me-3">
                            <img src="https://ui-avatars.com/api/?name=Maria+Zambrano&background=0d6efd&color=fff" class="rounded-circle border shadow-sm" style="width: 60px; height: 60px;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">María Zambrano</h6>
                            <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>España</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary-subtle text-secondary fw-normal">1 Obra</span>
                                <a href="VistaPerfilAutor.php" class="btn btn-sm btn-link p-0 text-decoration-none">Perfil <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 me-3">
                            <img src="https://ui-avatars.com/api/?name=JRR+Tolkien&background=198754&color=fff" class="rounded-circle border shadow-sm" style="width: 60px; height: 60px;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">J. R. R. Tolkien</h6>
                            <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>Reino Unido</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary-subtle text-secondary fw-normal">1 Obra</span>
                                <a href="#" class="btn btn-sm btn-link p-0 text-decoration-none">Perfil <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 me-3">
                            <img src="https://ui-avatars.com/api/?name=Gustavo+Adolfo+Becquer&background=dc3545&color=fff" class="rounded-circle border shadow-sm" style="width: 60px; height: 60px;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">G.A. Bécquer</h6>
                            <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>España</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary-subtle text-secondary fw-normal">1 Obra</span>
                                <a href="#" class="btn btn-sm btn-link p-0 text-decoration-none">Perfil <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 me-3">
                            <img src="https://ui-avatars.com/api/?name=George+RR+Martin&background=343a40&color=fff" class="rounded-circle border shadow-sm" style="width: 60px; height: 60px;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">George R. R. Martin</h6>
                            <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>EE.UU.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary-subtle text-secondary fw-normal">1 Obra</span>
                                <a href="#" class="btn btn-sm btn-link p-0 text-decoration-none">Perfil <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 me-3">
                            <img src="https://ui-avatars.com/api/?name=Didier+Levy&background=ffc107&color=333" class="rounded-circle border shadow-sm" style="width: 60px; height: 60px;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold text-truncate">Didier Lévy</h6>
                            <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>Francia</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary-subtle text-secondary fw-normal">1 Obra</span>
                                <a href="#" class="btn btn-sm btn-link p-0 text-decoration-none">Perfil <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <nav aria-label="Navegación de autores" class="d-flex justify-content-center">
            <ul class="pagination pagination-sm">
                <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
            </ul>
        </nav>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>