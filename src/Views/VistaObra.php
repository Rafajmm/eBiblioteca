<div class="row g-4 justify-content-center">
    <section class="col-12 col-lg-9">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4 p-md-5"> 
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-center justify-content-md-start gap-4 mb-5 text-center text-md-start">
                    
                    <div class="contenedorPortada shadow-sm flex-shrink-0">
                        <div class="coverMagic">
                            <div class="SRPCover">
                                <?php if($portada) :?>                                    
                                    <img id="portada" src="https://covers.openlibrary.org/b/olid/<?= $obra->getPortada() ?>-L.jpg" class="img-fluid rounded" alt="Portada <?= $obra->getTitulo() ?>">
                                <?php else : ?>
                                    <img id="portada" src="/assets/img/default/imgportada.jpg" class="img-fluid rounded" alt="Portada <?= $obra->getTitulo() ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow-1">
                        <h1 class="display-6 mb-1 fw-bold"><?= $obra->getTitulo() ?></h1>
                        
                        <?php if(!empty($autores)): ?>
                            <?php foreach($autores as $autor): ?>
                                <p class="fs-4 text-secondary mb-3">por <a href="/autor/<?= $autor['id'] ?>" class="text-primary text-decoration-none"><?= $autor['nombre'] ?></a></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="fs-4 text-secondary mb-3">por Autor desconocido</p>
                        <?php endif; ?>
                        
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-4 flex-wrap">
                            <span class="badge bg-<?= strtolower($obra->getGenero()) ?> border px-3 py-2"><?= $obra->getGenero() ?></span>
                            <?php if(!empty($etiquetas)): ?>
                                <?php foreach($etiquetas as $etiqueta): ?>
                                    <span class="badge bg-light text-dark border px-3 py-2"><?= $etiqueta['nombre'] ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="text-warning ms-2 fs-5 estrellas" data-id-obra="<?= $obra->getId() ?>">
                                <?php
                                    $puntuacion = 0;
                                    if (isset($_SESSION['id_usuario'])) {
                                        $puntuacion = $puntuacionUsuario ?: ($puntuacionMedia ?: 0);
                                    } else {
                                        $puntuacion = $puntuacionMedia ?: 0;
                                    }

                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($puntuacion >= $i) {
                                            echo '<i class="bi bi-star-fill text-warning" data-action="puntuar" data-valor="' . $i . '"></i>';
                                        } elseif ($puntuacion > ($i - 1) && $puntuacion < $i) {
                                            echo '<i class="bi bi-star-half text-warning" data-action="puntuar" data-valor="' . $i . '"></i>';
                                        } else {
                                            echo '<i class="bi bi-star text-muted" data-action="puntuar" data-valor="' . $i . '"></i>';
                                        }
                                    }

                                    echo '<span class="text-secondary small ms-1 " id="puntuacionMedia">' . number_format($puntuacionMedia ?: 0, 1) . ' (' . $totalPuntuaciones . ')</span>';
                                ?>
                            </div>
                        </div>
                        
                        <div class="d-grid d-md-flex gap-3 mb-3">
                            <button 
                                class="btn btn-primary btn-lg px-4" 
                                data-bs-toggle="modal" 
                                data-bs-target="#lectorPDF"
                                data-pdf-url="/<?= $obra->getRutaPdf() ?>"
                                data-book-title="Claros del bosque">
                                <i class="bi bi-book me-2"></i>Leer PDF
                            </button>

                            <button 
                                class="btn btn-primary btn-lg px-4" 
                                data-bs-toggle="modal" 
                                data-bs-target="#lectorEPUB"
                                data-epub-url="/<?= $obra->getRutaEpub() ?>"                                        
                                data-book-title="Claros del bosque">
                                <i class="bi bi-book me-2"></i>Leer EPUB
                            </button>                                    

                            <button class="btn btn-light border btn-lg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasComments">
                                <i class="bi bi-chat-left-text me-2"></i>Comentarios
                            </button>

                            <button class="btn btn-light border btn-lg"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAgregarObra"
                            data-id-obra="<?= $obra->getId() ?>"
                            data-id-usuario="<?= $_SESSION['id_usuario'] ?? '' ?>"
                            id="abrirModalAgregarObra">
                                <i class="bi bi-bookmark me-2"></i>Añadir a lista
                            </button>
                        </div>

                        <div class="d-flex justify-content-center justify-content-md-start gap-3 mt-4">
                            <a href="/obra/<?= $obra->getId() ?>/descargar/pdf" class="btn btn-outline-secondary border-0 d-flex align-items-center gap-2">
                                <i class="bi bi-download"></i> <span class="d-none d-md-inline">Descargar PDF</span>
                            </a>
                            <a href="/obra/<?= $obra->getId() ?>/descargar/epub" class="btn btn-outline-secondary border-0 d-flex align-items-center gap-2">
                                <i class="bi bi-download"></i> <span class="d-none d-md-inline">Descargar EPUB</span>
                            </a>
                            <button class="btn btn-outline-secondary border-0 d-flex align-items-center gap-2">
                                <i class="bi bi-share"></i> <span class="d-none d-md-inline">Compartir</span>
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                <article class="eb-leer px-md-5">
                    <h2 class="h4 fw-bold mb-4 text-uppercase ls-wide small text-muted">Sinopsis</h2>
                    <div class="lead font-serif fs-5 text-dark">
                        <p><?= $obra->getSinopsis() ?></p>
                    </div>
                </article>
            </div>
        </div>
    </section>
</div>

<div class="offcanvas offcanvas-end border-0 shadow" tabindex="-1" id="offcanvasComments" aria-labelledby="offcanvasCommentsLabel" style="z-index: 1060;">
<div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title fw-bold" id="offcanvasCommentsLabel">Comentarios</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body bg-light">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="" id="formComentario">
                <input type="hidden" name="idObra" value="<?= $obra->getId() ?>">
                <textarea class="form-control border-0 bg-light mb-2" name="contenido" rows="3" placeholder="Comparte tu reflexión sobre el libro..."></textarea>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm px-3">Publicar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex flex-column gap-3" id="listaComentarios">
        <?php if($comentarios) : ?>
        <?php foreach ($comentarios as $comentario): ?>
            <?php
                $usuarioDioMg=false;
                $usuarioReporto=false;
                if(isset($_SESSION['id_usuario'])){
                    $usuarioDioMg=Comentario::usuarioDioMg($_SESSION['id_usuario'], $comentario['id']);
                    $usuarioReporto=Comentario::usuarioReporto($_SESSION['id_usuario'], $comentario['id']);
                }
            ?>
            <div class="bg-white p-3 rounded shadow-sm border">
                <div class="d-flex justify-content-between align-items-center mb-1">                    
                    <a href="/usuario/<?= htmlspecialchars($comentario['id_usuario']) ?>" class="fw-bold small text-decoration-none">@<?= htmlspecialchars($comentario['usuario']) ?></a>
                </div>
                <p class="small text-secondary mb-2 w-100 pComentario"><?= nl2br(htmlspecialchars($comentario['contenido'])) ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted fecha" data-fecha="<?= $comentario['fecha_comentario'] ?>" style="font-size: 0.75rem;"></span>
                    <div>                        
                        <button class="btn btn-link p-0 text-decoration-none" id="btnReportarComentario"
                        data-id-comentario="<?= $comentario['id'] ?>"
                        data-usuario-reporto="<?= $usuarioReporto ? '1' : '0' ?>">
                            <i class="bi bi-flag<?= $usuarioReporto ? '-fill' : '' ?> text-danger"></i>
                        </button>

                        <button class="btn btn-link p-0 text-decoration-none" id="btnLikeComentario"
                        data-id-comentario="<?= $comentario['id'] ?>"
                        data-usuario-like="<?= $usuarioDioMg ? '1' : '0' ?>">
                            <i class="bi bi-hand-thumbs-up<?= $usuarioDioMg ? '-fill' : '' ?> text-primary"></i>
                        </button>
                        <span class="text-muted small"><?= "(" . (Comentario::crearInstancia($comentario['id'])->totalMeGusta()>0 ? Comentario::crearInstancia($comentario['id'])->totalMeGusta() : '0') . ")" ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center text-muted py-4">
                <i class="bi bi-chat-left-text fs-1"></i>
                <p class="mt-2">No hay comentarios aún. Sé el primero en comentar.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>


<div class="modal fade" id="lectorPDF" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-fullscreen">
    <div class="modal-content bg-dark border-0">
        <div class="modal-header border-0 py-2 px-4 bg-dark text-white shadow-sm">
            <div class="d-flex align-items-center">
                <button type="button" class="btn-close btn-close-white me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="overflow-hidden">
                    <h6 class="mb-0 fw-bold text-truncate" id="readerTitle">Claros del bosque</h6>
                    <small class="opacity-75">Visualizador eBiblioteca</small>
                </div>
            </div>
            <div class="ms-auto d-flex align-items-center gap-2">
                <span class="badge bg-primary d-none d-sm-inline">Modo Lectura</span>
            </div>
        </div>
        
        <div class="modal-body p-0 m-0 overflow-hidden bg-secondary">
            <div id="pdfViewerContainer" style="width: 100%; height: 100%;">
                <iframe 
                    id="pdfIframe"
                    src="" 
                    width="100%" 
                    height="100%" 
                    style="border: none;">
                </iframe>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="lectorEPUB" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-fullscreen">
    <div class="modal-content border-0">
        <div class="modal-header border-bottom py-2 px-4 bg-white sticky-top d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div>
                    <h6 class="mb-0 fw-bold" id="tituloLibro">Cargando...</h6>
                    <small class="text-muted text-uppercase" style="font-size: 0.6rem;">Lector ePub</small>
                </div>
            </div>
            <div class="navigation-controls">
                <button class="btn btn-outline-primary btn-sm" id="prev">⬅️ Anterior</button>
                <button class="btn btn-outline-primary btn-sm" id="next">Siguiente ➡️</button>
            </div>
        </div>
        
        <div class="modal-body p-0 bg-light">
            <div id="viewer" style="min-height: 85vh; width: 100%; background: white;"></div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modalAgregarObra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold">Añadir a lista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 bg-light" id="buscadorListas" placeholder="Buscar lista..." autocomplete="off">
                    </div>
                </div>
                <div id="contListas" class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                    <div class="text-center py-4 text-muted">
                        <div class="spinner-border spinner-border-sm" role="status"></div>
                        Cargando tus listas...
                    </div>
                </div>

                <div id="sinListas" class="text-center py-4 d-none">
                    <i class="bi bi-inbox fs-1 text-muted mb-2"></i>
                    <p class="text-muted mb-3">No tienes listas creadas</p>
                    <a href="/usuario/<?= $_SESSION['id_usuario'] ?? '' ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i>Crear lista
                    </a>
                </div>

                <div id="sinCoincidencias" class="text-center py-3 d-none">
                    <small class="text-muted">No se encontraron coincidencias</small>
                </div>
            </div>
            <div class="modal-footer border-top-0 bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <div class="input-group ms-auto" style="max-width: 280px;">
                    <input type="text" class="form-control form-control-sm" id="inputNuevaLista" placeholder="Nueva lista...">
                    <button type="button" class="btn btn-primary btn-sm" id="btnCrearLista">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/jszip.min.js"></script>
<script src="/assets/js/epub.min.js"></script>
<script type="module" src="/assets/js/vobra.js"></script>