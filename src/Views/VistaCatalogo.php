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
    <p class="text-secondary small mb-0">Mostrando de <strong><?= 1+($porPagina*$pagina)-$porPagina ?></strong> a <strong><?= $porPagina*$pagina ?></strong> de <strong><?= $total ?></strong> obras</p>
    <div class="d-flex align-items-center">
        <label for="limitSelect" class="small fw-bold text-secondary me-2 mb-0">Mostrar:</label>
        <select class="form-select form-select-sm" id="limitSelect" style="width: auto;">
            <option value="15" selected>15</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="all">Todas</option>
        </select>
    </div>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4" id="listaObras">
    
    <?php foreach($obras as $obra) : ?>    
    <div class="col">
        <a class="text-decoration-none" href="/obra/<?= $obra['id'] ?>">
            <div class="card tarjetaLibro border-0 shadow-sm h-100">
                <div class="portadaLibroWrapper">
                    <img src="https://covers.openlibrary.org/b/olid/OL4496766M-L.jpg" alt="<?= $obra['titulo'] ?>">
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
                            $objeto=Obra::crearInstancia($obra['id']);
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
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
        </li>
        <li class="page-item active" aria-current="page">
            <a class="page-link" href="#"><?= $pagina ?></a>
        </li>
        <li class="page-item"><a class="page-link" href="#"><?= $pagina + 1 ?></a></li>
        <li class="page-item"><a class="page-link" href="#"><?= $pagina + 2 ?></a></li>
        <li class="page-item">
            <a class="page-link" href="#">Siguiente</a>
        </li>
    </ul>
</nav>