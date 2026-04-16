<section class="container py-5">
  <div class="d-flex justify-content-between align-items-end mb-5">
    <div>
      <h1 class="display-5 fw-bold fuenteSerif">Colecciones Editoriales</h1>
      <p class="text-muted">Selecciones exclusivas realizadas por nuestros bibliotecarios.</p>
    </div>
    <span class="badge bg-dark px-3 py-2 rounded-pill"><?= $total ?> Colecciones</span>
  </div>

  <div class="row g-4">  
    <?php foreach ($colecciones as $coleccion): ?>
      <div class="col-12 col-md-6 col-lg-4 mt-5">
        <a href="/lista/<?= $coleccion['id'] ?>" class="text-decoration-none text-dark enlaceColeccion">
          <div class="card border-0 bg-transparent h-100">
            <div class="contenedorColeccion mb-4">

              <?php if($datosColecciones[$coleccion['id']]['total'] > 1): ?>
                <?php for($i=1; $i<=$datosColecciones[$coleccion['id']]['total']; $i++): ?>
                  <div class="elementoColeccion elemento-<?= $i+1 ?>">
                    <?php $rutaPortada =$datosColecciones[$coleccion['id']]['obras'][$i]['portada'] ? "https://covers.openlibrary.org/b/olid/" . $datosColecciones[$coleccion['id']]['obras'][$i]['portada'] . "-L.jpg" : "/assets/img/default/imgportada.jpg"; ?>
                    <img src="<?= $rutaPortada ?>" alt="<?= $coleccion['nombre'] ?>">
                  </div>
                <?php endfor; ?>
              <?php endif; ?>

              <div class="elementoColeccion elemento-1">
                <?php $rutaPortada = $datosColecciones[$coleccion['id']]['obras'][0]['portada'] ? "https://covers.openlibrary.org/b/olid/" . $datosColecciones[$coleccion['id']]['obras'][0]['portada'] . "-L.jpg" : "/assets/img/default/imgportada.jpg"; ?>
                <img src="<?= $rutaPortada ?>" alt="<?= $coleccion['nombre'] ?>">
                <div class="contenedorInsigniaColeccion d-flex align-items-center justify-content-center">
                  <span class="badge bg-white text-dark shadow-sm"><?= $datosColecciones[$coleccion['id']]['total'] ?> libros</span>
                </div>
              </div>
            </div>

            <div class="card-body p-0">
              <h3 class="h4 fw-bold mb-2"><?= $coleccion['nombre'] ?></h3>
              <p class="text-muted small mb-0"><?= $coleccion['descripcion'] ?></p>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>
