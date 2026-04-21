<section class="row justify-content-center mb-5 py-5 bg-light rounded-4 shadow-sm">
  <div class="col-lg-8 text-center">
    <h1 class="display-4 fw-bold text-primary mb-4" style="font-family: 'Merriweather', serif;">Cultura libre para todos</h1>
    <p class="lead fs-4 text-dark mb-4">
      En <strong>eBiblioteca</strong>, creemos firmemente que la cultura debe estar al alcance de todo el mundo. Nuestro objetivo es fomentar la lectura distribuyendo grandes obras clásicas y contemporáneas libres de derechos de una manera visual, ordenada y sencilla.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <a href="/catalogo" class="btn btn-primary btn-lg px-4">Explorar Catálogo</a>
      <a href="#novedades" class="btn btn-outline-secondary btn-lg px-4">Ver Novedades</a>
    </div>
    <p class="text-muted mt-3 small">Sin registros obligatorios. Lectura directa y gratuita.</p>
  </div>
</section>

<section class="container mb-5">
  <div class="row g-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h3 class="h5 mb-1 opacity-75">Nuestra biblioteca</h3>
            <p class="display-6 fw-bold mb-0"><?php echo $totalObras; ?> libros disponibles</p>
          </div>
          <i class="bi bi-book fs-1 text-primary opacity-25"></i>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card border-0 shadow-sm overflow-hidden bg-white">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div class="text-dark">
            <h3 class="h5 mb-1 text-muted">Grandes pensadores</h3>
            <p class="display-6 fw-bold mb-0"><?php echo $totalAutores; ?> autores</p>
          </div>
          <i class="bi bi-person-workspace fs-1 text-primary opacity-25"></i>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card border-0 shadow-sm overflow-hidden bg-white">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div class="text-dark">
            <h3 class="h5 mb-1 text-muted">Colecciones</h3>
            <p class="display-6 fw-bold mb-0"><?php echo $totalColecciones; ?> colecciones</p>
          </div>
          <i class="bi bi-bookmark fs-1 text-primary opacity-25"></i>
        </div>
      </div>
    </div>

    <div id="novedades" class="col-12">
      <div class="card border-primary shadow-sm bg-white" style="border-left: 5px solid !important;">
        <div class="card-body p-4">
          <h3 class="h4 mb-4 fw-bold">Novedades</h3>
          
          <?php if(!empty($novedades)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <?php foreach($novedades as $obra): ?>
                <div class="col">
                  <a href="/obra/<?= $obra->getId(); ?>" class="text-decoration-none text-dark">
                  <div class="p-3 border rounded-3 bg-light h-100 shadow-sm-hover">
                    <div class="d-flex flex-wrap gap-1 mb-2">
                      <span class="badge bg-<?= strtolower($obra->getGenero()) ?>"><?= $obra->getGenero(); ?></span>
                      
                      <?php
                        $etiquetas = $obra->obtenerEtiquetas();
                        if(!empty($etiquetas)):
                          $mostradas = array_slice($etiquetas, 0, 2);
                          foreach($mostradas as $et): ?>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 0.7rem;">
                              <?= htmlspecialchars($et['nombre']) ?>
                            </span>
                          <?php endforeach;
                          if(count($etiquetas) > 2): ?>
                            <span class="text-muted small" style="font-size: 0.7rem; align-self: center;">
                              +<?= (count($etiquetas) - 2) ?>
                            </span>
                          <?php endif;
                        endif; ?>
                    </div>

                    <p class="fw-bold mb-1"><?= $obra->getTitulo(); ?></p>
                    
                    <?php                            
                      $autoresObra = $obra->obtenerAutores();
                      if(!empty($autoresObra)){
                          $nombresArr = array_column($autoresObra, 'nombre');
                          $txtAutores = implode(', ', $nombresArr); 
                      } else {
                          $txtAutores = 'Autor desconocido';
                      }
                    ?>
                    <small class="text-muted d-block"><?= $txtAutores; ?></small>
                  </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="text-muted text-center py-4">No hay novedades disponibles en este momento.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

