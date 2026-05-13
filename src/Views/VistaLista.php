<section class="container py-5">

    <header class="row g-4 align-items-center mb-5">
        
        <div class="col-12 col-md">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-primary-subtle text-primary text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;"><?= $idCreador==10 ? 'Colección' : 'Lista' ?></span>
                <span class="text-muted small" id="totalObras">• <?= $totalObras ?> títulos</span>
            </div>
            <h1 class="display-5 fw-bold fuenteSerif mb-3"><?= htmlspecialchars($lista->getNombre()) ?></h1>
            <p class="lead text-secondary" style="max-width: 700px;">
                <?= !empty($lista->getDescripcion()) ? htmlspecialchars($lista->getDescripcion()) : '' ?>
            </p>
            <div class="d-flex align-items-center mb-3">
                <?php if($idCreador==10) : ?>                        
                    <span class="small fw-bold">Creada por Equipo eBiblioteca</strong></span>
                <?php else: ?>
                    <span class="small fw-bold">Creada por <a href="/usuario/<?=$instanciaCreador->getId()?>" class="text-decoration-none">@<?=$instanciaCreador->getNombreUsuario()?></a></span>
                <?php endif ?>
            </div>
            <div class="d-flex align-items-center gap-3">
                <?php if($esPropietario): ?>
                    <button class="btn btn-primary btn-sm rounded-pill px-3"
                    id="btnEditar"
                    data-bs-toggle="modal" data-bs-target="#modalEditar"
                    data-id-lista="<?= $lista->getId() ?>"
                    data-id-usuario="<?= $idUsuario ?>"
                    data-nombre="<?= htmlspecialchars($lista->getNombre()) ?>"
                    data-descripcion="<?= !empty($lista->getDescripcion()) ? htmlspecialchars($lista->getDescripcion()) : '' ?>">
                        <i class="bi bi-pencil me-1"></i> Editar
                    </button>
                <?php else: ?>
                    <?php if($meGusta): ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-3"
                        data-action="seguir-lista"
                        data-id-lista="<?= $lista->getId()?>"
                        data-seguida="1">
                            <i class="bi bi-check-lg me-1"></i> Seguido
                        </button>
                    <?php else: ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-3"
                        data-action="seguir-lista"
                        data-id-lista="<?= $lista->getId() ?>"
                        data-seguida="0">
                            <i class="bi bi-plus-lg me-1"></i> Seguir
                        </button>
                    <?php endif; ?>
                    <?php if(!$estaCopiada): ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-3"
                        data-action="guardar-lista"
                        data-id-lista="<?= $lista->getId() ?>"
                        data-copiada="0">
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

    <section class="lista-libros" id="listaLibros">
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
                <div class="row g-4 elementoLibro">
                    <div class="col-12">
                        <div class="card border-0 bg-transparent filaLibro transicion p-2 rounded-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-muted fw-bold ms-2 contador"><?= $contador + 1 ?></span>
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
                                    <button class="btn btn-sm btn-outline-danger rounded-pill"
                                    data-action="eliminar-libro"
                                    data-id-obra="<?= $obra['id'] ?>"
                                    data-id-lista="<?= $lista->getId() ?>"
                                    >Eliminar</button>
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

    <!-- Modal editar lista -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Editar lista</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="module" src="/assets/js/vlista.js"></script>
