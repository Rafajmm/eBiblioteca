<section class="seccionFiltros p-4 mb-4 shadow-sm border rounded bg-light">
    <form class="row g-3 align-items-end" action="/autores" method="GET">
        <div class="col-12 col-md-4">
            <label class="form-label small fw-bold text-secondary">Nombre del autor</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-person-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Ej: Cervantes, Allende..." name="nombre">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label class="form-label small fw-bold text-secondary">País / Nacionalidad</label>
            <select class="form-select" name="pais">
                <option value="" <?= empty($_GET['pais']) ? ' selected' : '' ?>>Todos los países</option>
                <?php foreach ($paises as $pais): ?>
                    <option value="<?= $pais['pais'] ?>"<?= !empty($_GET['pais']) && $pais['pais'] === $_GET['pais'] ? ' selected' : '' ?>><?= $pais['pais'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-6 col-md-3">
            <label class="form-label small fw-bold text-secondary">Época</label>
            <select class="form-select" name="epoca">
                <option value="" <?= empty($_GET['epoca']) ? ' selected' : '' ?>>Cualquier época</option>
                <option value="21" <?= !empty($_GET['epoca']) && $_GET['epoca'] === '21' ? ' selected' : '' ?>>Siglo XXI</option>
                <option value="20" <?= !empty($_GET['epoca']) && $_GET['epoca'] === '20' ? ' selected' : '' ?>>Siglo XX</option>
                <option value="19" <?= !empty($_GET['epoca']) && $_GET['epoca'] === '19' ? ' selected' : '' ?>>Siglo XIX</option>
                <option value="18" <?= !empty($_GET['epoca']) && $_GET['epoca'] === '18' ? ' selected' : '' ?>>Siglo XVIII</option>
                <option value="17" <?= !empty($_GET['epoca']) && $_GET['epoca'] === '17' ? ' selected' : '' ?>>Siglo XVII</option>
                <option value="16" <?= !empty($_GET['epoca']) && $_GET['epoca'] === '16' ? ' selected' : '' ?>>Siglo XVI</option>
                <option value="15" <?= !empty($_GET['epoca']) && $_GET['epoca'] === '15' ? ' selected' : '' ?>>Siglo XV</option>
                <option value="anterior" <?= !empty($_GET['epoca']) && $_GET['epoca'] === 'anterior' ? ' selected' : '' ?>>Anterior al siglo XV</option>
            </select>
        </div>
        <?php if(isset($_GET['porPagina'])): ?>
            <input type="hidden" name="porPagina" value="<?= htmlspecialchars($_GET['porPagina']) ?>">
        <?php endif; ?>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
    </form>
</section>

<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-secondary small mb-0">Mostrando de <strong><?= 1+($porPagina*$pagina)-$porPagina ?></strong> a <strong><?= min($porPagina*$pagina,$total) ?></strong> de <strong><?= $total ?></strong> autores</p>
    <div class="d-flex align-items-center">
        <label for="selectElems" class="small fw-bold text-secondary me-2 mb-0">Mostrar:</label>
        <select class="form-select form-select-sm" id="selectElems" style="width: auto;" onchange="cambiarPorPagina(this.value)">
            <option value="12" <?= $porPagina == 12 ? 'selected' : '' ?>>12</option>
            <option value="24" <?= $porPagina == 24 ? 'selected' : '' ?>>24</option>
            <option value="36" <?= $porPagina == 36 ? 'selected' : '' ?>>36</option>
            <option value="48" <?= $porPagina == 48 ? 'selected' : '' ?>>48</option>
        </select>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mb-5">

    <?php foreach ($autores as $autor): ?>
    <div class="col">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center p-3">
                <div class="flex-shrink-0 me-3">
                    <?php $imagen=!empty($autor['ruta_foto']) ? $autor['ruta_foto'] : 'https://ui-avatars.com/api/?name='.urldecode($autor['nombre']).'&background=0D6EFD&color=fff'; ?>
                    <img src="<?= $imagen ?>" class="rounded-circle border shadow-sm" style="width: 60px; height: 60px;">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h6 class="mb-0 fw-bold"><?= $autor['nombre'] ?></h6>
                    <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i><?= $autor['pais'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-secondary-subtle text-secondary fw-normal"><?= Autor::contarObras($autor['id']) ?> Obra(s)</span>
                        <a href="/autor/<?= $autor['id'] ?>" class="btn btn-sm btn-link p-0 text-decoration-none text-primary">Perfil <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<nav aria-label="Navegación de autores" class="d-flex justify-content-center">
    <ul class="pagination pagination-sm">
        <?php
            function crearUrlPagina($numPagina){
                $parametros=$_GET;
                $parametros['pagina']=$numPagina;
                return '?' . http_build_query($parametros);
            }
        ?>

        <li class="page-item <?= $pagina<=1 ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($pagina>1) ? crearUrlPagina($pagina-1) : '#' ?>">Anterior</a>
        </li>

        <?php for($i=1;$i<=$totalPaginas;$i++): ?>
            <li class="page-item <?= ($pagina==$i) ? 'active' : '' ?>">
                <a class="page-link" href="<?= crearUrlPagina($i) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= $pagina>=$totalPaginas ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($pagina<$totalPaginas) ? crearUrlPagina($pagina+1) : '#' ?>">Siguiente</a>
        </li>
    </ul>
</nav>
