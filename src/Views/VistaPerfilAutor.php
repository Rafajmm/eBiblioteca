<section class="author-profile-header p-4 p-lg-5 mb-5 shadow-sm border rounded bg-white">
    <div class="row align-items-center">
        <div class="col-12 col-md-auto text-center mb-4 mb-md-0">
            <?php if($autor->getRutaFoto()): ?>
                <img src="<?= $autor->getRutaFoto() ?>" 
                    alt="<?= $autor->getNombre() ?>" 
                    class="rounded-circle border shadow" 
                    style="width: 180px; height: 180px; object-fit: cover;">
            <?php else: ?>
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($autor->getNombre()) ?>&size=200&background=198754&color=fff" 
                    alt="<?= $autor->getNombre() ?>" 
                    class="rounded-circle border shadow" 
                    style="width: 180px; height: 180px; object-fit: cover;">
            <?php endif; ?>
        </div>
        <div class="col-12 col-md ps-md-5">
            <div class="d-flex flex-wrap align-items-center gap-3 mb-2">
                <h1 class="display-5 fw-bold mb-0"><?= $autor->getNombre(); ?></h1>
            </div>
            <p class="text-secondary mb-3">
                <i class="bi bi-geo-alt-fill me-1"></i> <?= $autor->getPais(); ?> 
                <span class="mx-2">|</span> 
                <i class="bi bi-calendar3 me-1"></i> <span class="fecha" data-fecha="<?=$autor->getFechaNacimiento() ?>"></span>
            </p>
            <p class="lead text-muted" style="font-size: 1rem; max-width: 800px;">
                <?= $autor->getBiografia() ?>
            </p>
            <div class="d-flex gap-2 mt-4">
                <div class="text-center border-end pe-4">
                    <span class="d-block h4 fw-bold mb-0"><?= $totalObras ?></span>
                    <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Obras en eBiblio</small>
                </div>
                <div class="text-center ps-2">
                    <span class="d-block h4 fw-bold mb-0"><?= $totalGeneros ?></span>
                    <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Géneros</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="author-works">
    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
        <h3 class="fw-bold mb-0">Obras disponibles</h3>
        <span class="text-muted small">Mostrando todos los títulos</span>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
        <?php if(!empty($obras)):?>
            <?php foreach($obras as $obra):?>
                <div class="col" >
                    <a class="text-decoration-none" href="/obra/<?= $obra['id'] ?>">
                        <div class="card tarjetaLibro border-0 shadow-sm h-100">
                            <div class="portadaLibroWrapper">
                                <?php $rutaFoto=$obra['portada']!==null ? $obra['portada'] : '/assets/img/default/imgportada.jpg';?> 
                                <img src="https://covers.openlibrary.org/b/olid/<?= $rutaFoto ?>-L.jpg" alt="<?= $obra['titulo'] ?>">
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
                                <h5 class="card-title h6 fw-bold mb-1 text-truncate"><?=$obra['titulo']?></h5>
                                <p class="card-text small text-muted"><?=$obra['anio_publicacion']?></p>
                            </div>
                        </div>
                    </a>    
                </div>
            <?php endforeach;?>
        <?php else:?>
            <div class="col-12">
                <p class="text-muted">No hay obras disponibles para este autor.</p>
            </div>
        <?php endif;?>
    </div>
</section>