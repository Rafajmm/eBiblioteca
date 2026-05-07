<section class="seccionFiltros p-4 mb-5 shadow-sm">
    <form class="row g-3 align-items-end" action="/catalogo" method="GET">
        <div class="col-12 col-md-3">
            <label for="inputBusqueda" class="form-label small fw-bold text-secondary">Búsqueda general</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0" id="inputBusqueda" placeholder="Título, autor, género..." name="parametro" value="<?=htmlspecialchars($_GET['parametro'] ?? '')?>">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="genero" class="form-label small fw-bold text-secondary">Género</label>
            <select class="form-select" id="genero" name="genero">
                <option value="" <?= empty($_GET['genero']) ? 'selected' : '' ?>>Todos</option>
                <option value="Narrativa" <?= !empty($_GET['genero']) && $_GET['genero'] === 'Narrativa' ? 'selected' : '' ?>>Narrativa</option>
                <option value="Ensayo" <?= !empty($_GET['genero']) && $_GET['genero'] === 'Ensayo' ? 'selected' : '' ?>>Ensayo</option>
                <option value="Poesía" <?= !empty($_GET['genero']) && $_GET['genero'] === 'Poesía' ? 'selected' : '' ?>>Poesía</option>
                <option value="Teatro" <?= !empty($_GET['genero']) && $_GET['genero'] === 'Teatro' ? 'selected' : '' ?>>Teatro</option>
                <option value="Infantil" <?= !empty($_GET['genero']) && $_GET['genero'] === 'Infantil' ? 'selected' : '' ?>>Infantil</option>
            </select>
        </div>
        <div class="col-6 col-md-3">
            <label for="authorSelect" class="form-label small fw-bold text-secondary">Autor</label>
            <select class="form-select" id="selectAutor" name="autor">
                <option value="" <?= empty($_GET['autor']) ? 'selected' : '' ?>>Todos los autores</option>
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor['nombre'] ?>" <?= !empty($_GET['autor']) && $_GET['autor'] === $autor['nombre'] ? 'selected' : '' ?>><?= $autor['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 col-md-2">
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
        <div class="col-12 col-md-1">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>
</section>

<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-secondary small mb-0">Mostrando de <strong><?= 1+($porPagina*$pagina)-$porPagina ?></strong> a <strong><?= min($porPagina*$pagina,$total) ?></strong> de <strong><?= $total ?></strong> obras</p>
    <div class="d-flex align-items-center">
        <label for="selectElems" class="small fw-bold text-secondary me-2 mb-0">Mostrar:</label>
        <select class="form-select form-select-sm" id="selectElems" style="width: auto;" onchange="cambiarPorPagina(this.value)">
            <option value="10" <?= $porPagina == 10 ? 'selected' : '' ?>>10</option>
            <option value="15" <?= $porPagina == 15 ? 'selected' : '' ?>>15</option>
            <option value="25" <?= $porPagina == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= $porPagina == 50 ? 'selected' : '' ?>>50</option>
        </select>
    </div>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4" id="listaObras">
    
    <?php foreach($obras as $obra) : ?>    
    <div class="col">
        <a class="text-decoration-none" href="/obra/<?= $obra['id'] ?>">
            <div class="card tarjetaLibro border-0 shadow-sm h-100">
                <div class="portadaLibroWrapper">
                    <?php                         
                        if($obra['portada']){
                            echo '<img src="https://covers.openlibrary.org/b/olid/' . $obra['portada'] . '-L.jpg" alt="' . $obra['titulo'] . '">';
                        }else{
                            echo '<img src="/assets/img/default/imgportada.jpg" alt="' . $obra['titulo'] . '">';
                        }
                    ?>
                </div>
                <div class="card-body p-3">
                    <div class="mb-2 d-flex flex-wrap gap-1">
                        <span class="badge bg-<?= strtolower($obra['genero']) ?> shadow-sm"><?= $obra['genero'] ?></span>
                        <?php 
                            $objeto=Obra::crearInstancia($obra['id']);
                            if(!empty($objeto)){
                                $etiquetas=$objeto->obtenerEtiquetas();
                                for($i=0;$i<2;$i++){
                                    if(isset($etiquetas[$i])){
                                        echo '<span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">' . $etiquetas[$i]['nombre'] . '</span>';
                                    }
                                }
                                if(count($etiquetas) > 2){
                                    echo '<span class="text-muted small" style="font-size: 0.7rem; align-self: center;">+' . (count($etiquetas) - 2) . '</span>';
                                }
                            }
                        ?>
                        
                    </div>
                    <h5 class="card-title h6 fw-bold mb-1 text-truncate"><?= $obra['titulo'] ?></h5>
                    <p class="card-text small text-secondary mb-1">
                        <?php
                            if(!empty($objeto)){
                                $autores=$objeto->obtenerAutores();
                                if(!empty($autores)){
                                    $nombres="";
                                    for($i=0;$i<count($autores);$i++){
                                        $nombres.=$autores[$i]['nombre'] . ' ';
                                    }
                                    echo rtrim($nombres, ' ');
                                }
                                else{
                                    echo 'Autor desconocido';
                                }
                            }
                        ?>
                    </p>
                    <p class="card-text small text-muted"><?= $obra['anio_publicacion'] ? $obra['anio_publicacion'] : 'N/A' ?></p>
                </div>
            </div>
        </a>    
    </div>
    <?php endforeach; ?>
</div>

<nav aria-label="Navegación de páginas" class="d-flex justify-content-center mt-5">
    <ul class="pagination">
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