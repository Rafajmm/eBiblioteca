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
        <section class="seccionFiltros p-4 mb-5 shadow-sm">
            <form class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label for="inputBusqueda" class="form-label small fw-bold text-secondary">Búsqueda general</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-start-0" id="inputBusqueda" placeholder="Título, autor, género...">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <label for="genreSelect" class="form-label small fw-bold text-secondary">Género</label>
                    <select class="form-select" id="genreSelect">
                        <option selected>Todos</option>
                        <option>Narrativa <span class="bg-narrativa "></span></option>
                        <option>Ensayo</option>
                        <option>Poesía</option>
                        <option>Dramática</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <label for="authorSelect" class="form-label small fw-bold text-secondary">Autor</label>
                    <select class="form-select" id="authorSelect">
                        <option selected>Todos los autores</option>
                        <option>Isabel Torres</option>
                        <option>Carlos Ruiz</option>
                        <option>Elena P. Bazán</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </form>
        </section>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-secondary small mb-0">Mostrando <strong>10</strong> de <strong>42</strong> obras</p>
            <div class="d-flex align-items-center">
                <label for="limitSelect" class="small fw-bold text-secondary me-2 mb-0">Mostrar:</label>
                <select class="form-select form-select-sm" id="limitSelect" style="width: auto;">
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="all">Todas</option>
                </select>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
            
            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/id/3332414-L.jpg" alt="Nada">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-narrativa shadow-sm">Narrativa</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Existencialismo</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Social</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">Nada</h5>
                        <p class="card-text small text-secondary mb-1">Carmen Laforet</p>
                        <p class="card-text small text-muted">1945</p>
                    </div>
                </div>
            </div>

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

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/id/10525641-L.jpg" alt="A... ami?">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-infantil shadow-sm">Infantil</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Animales</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Francés</span>
                            <span class="text-muted small" style="font-size: 0.7rem; align-self: center;">+1</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">A... ami?</h5>
                        <p class="card-text small text-secondary mb-1">Didier Lévy | Céline Guyot</p>
                        <p class="card-text small text-muted">2025</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/id/2271282-L.jpg" alt="Rimas y Leyendas">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-poesia shadow-sm">Poesía</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Lírica</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Antología</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">Rimas y Leyendas</h5>
                        <p class="card-text small text-secondary mb-1">G.A. Bécquer</p>
                        <p class="card-text small text-muted">1871</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/olid/OL47259315M-L.jpg" alt="Los intereses creados">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-teatro shadow-sm">Teatro</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Comedia</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">Los intereses creados</h5>
                        <p class="card-text small text-secondary mb-1">Jacinto Benavente</p>
                        <p class="card-text small text-muted">1907</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/id/14569501-L.jpg" alt="El Silmarillion">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-narrativa shadow-sm">Narrativa</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Fantasía</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Aventura</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">El Silmarillion</h5>
                        <p class="card-text small text-secondary mb-1"> J. R. R. Tolkien</p>
                        <p class="card-text small text-muted">2024</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/id/12547191-L.jpg" alt="The game">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-narrativa shadow-sm">Narrativa</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Ciencia Ficción</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Suspense</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">The game</h5>
                        <p class="card-text small text-secondary mb-1">Terry Schott</p>
                        <p class="card-text small text-muted">2013</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/olid/OL40812029M-L.jpg" alt="La isla del tesoro">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-infantil shadow-sm">Infantil</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Aventura</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">La isla del tesoro</h5>
                        <p class="card-text small text-secondary mb-1">Robert Louis Stevenson</p>
                        <p class="card-text small text-muted">1883</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/id/14414436-L.jpg" alt="El Arte del Siglo XXI">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-ensayo shadow-sm">Ensayo</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Arte</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">El Arte del Siglo XXI</h5>
                        <p class="card-text small text-secondary mb-1">Jorge Lozano</p>
                        <p class="card-text small text-muted">2023</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card tarjetaLibro border-0 shadow-sm h-100">
                    <div class="portadaLibroWrapper">
                        <img src="https://covers.openlibrary.org/b/id/9269962-L.jpg" alt="Juego de Tronos">
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-narrativa text-dark shadow-sm">Narrativa</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">Fantasía</span>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem">Aventura</span>
                        </div>
                        <h5 class="card-title h6 fw-bold mb-1 text-truncate">Juego de Tronos</h5>
                        <p class="card-text small text-secondary mb-1">George R. R. Martin</p>
                        <p class="card-text small text-muted">1996</p>
                    </div>
                </div>
            </div>

        </div>

        <nav aria-label="Navegación de páginas" class="d-flex justify-content-center mt-5">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                </li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/ebiblioteca.js"></script>
  </body>
</html>