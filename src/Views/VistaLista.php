<section class="container py-5">

    <header class="row g-4 align-items-center mb-5">
        
        <div class="col-12 col-md">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-primary-subtle text-primary text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;"><?= $idCreador==10 ? 'Colección' : 'Lista' ?></span>
                <span class="text-muted small">• <?= $totalObras ?> títulos</span>
            </div>
            <h1 class="display-5 fw-bold fuenteSerif mb-3"><?= htmlspecialchars($lista->getNombre()) ?></h1>
            <p class="lead text-secondary" style="max-width: 700px;">
                <?= !empty($lista->getDescripcion()) ? htmlspecialchars($lista->getDescripcion()) : '' ?>
            </p>
            <div class="d-flex align-items-center mb-3">                        
                <span class="small">Creada por <strong><?= $idCreador==10 ? 'Equipo eBiblioteca' : $instanciaCreador->getNombre() ?></strong></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <?php if($esPropietario): ?>
                    <a href="/lista/<?= $lista->getId() ?>/editar" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="bi bi-pencil me-1"></i> Editar
                    </a>
                <?php else: ?>
                    <?php if($meGusta): ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-check-lg me-1"></i> Seguido
                        </button>
                    <?php else: ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i> Seguir
                        </button>
                    <?php endif; ?>
                    <?php if(!$estaCopiada): ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-bookmark"></i> Guardar
                        </button>
                    <?php else: ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-bookmark-fill"></i> Guardada
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
                <button class="btn btn-outline-secondary btn-sm rounded-circle" aria-label="Compartir">
                    <i class="bi bi-share"></i>
                </button>
            </div>
        </div>
    </header>

    <hr class="mb-5 opacity-10">

    <section class="lista-libros">
        <?php if(empty($obras)): ?>
            <div class="row g-4">
                <div class="col-12">
                    <div class="card border-0 bg-transparent filaLibro transicion p-2 rounded-3">
                        <div class="row align-items-center">
                            <div class="col-12 text-center">
                                <p class="text-muted">No hay obras en esta lista</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php $contador=0;?>
            <?php foreach($obras as $obra): ?>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card border-0 bg-transparent filaLibro transicion p-2 rounded-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-muted fw-bold ms-2"><?= $contador + 1 ?></span>
                                </div>
                                <div class="col-auto">
                                    <?php $ruta =$obra['portada'] ? 'https://covers.openlibrary.org/b/olid/'.$obra['portada'].'-L.jpg' : '/assets/img/default/imgportada.jpg'; ?>
                                    <img src="<?= $ruta ?>" class="rounded shadow-sm" width="60" alt="Portada">
                                </div>
                                <div class="col">
                                    <h5 class="mb-0 fw-bold"><?= $obra['titulo'] ?></h5>
                                    <p class="text-muted mb-0 small"><?= $obra['autor'] ?></p>
                                </div>
                                <div class="col-auto d-none d-md-block text-center px-4">
                                    <span class="badge bg-<?= strtolower($obra['genero']) ?> border px-3"><?= $obra['genero'] ?></span>
                                </div>
                                <div class="col-auto">
                                    <a href="/obra/<?= $obra['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">Leer</a>
                                </div>
                                <?php if($esPropietario): ?>
                                <div class="col-auto">
                                    <a href="/lista/<?= $lista->getId() ?>/eliminar/<?= $obra['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $contador++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</section>
