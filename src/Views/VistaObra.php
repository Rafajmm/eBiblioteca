<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eBiblioteca · Claros del bosque</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="/assets/css/ebiblioteca.css" rel="stylesheet" />
  </head>
  <body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/src/Components/header.php');?>

    <main class="container-fluid py-4">
        <div class="row g-4 justify-content-center">
            <section class="col-12 col-lg-9">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4 p-md-5"> 
                        <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-center justify-content-md-start gap-4 mb-5 text-center text-md-start">
                            
                            <div class="contenedorPortada shadow-sm flex-shrink-0">
                                <div class="coverMagic">
                                    <div class="SRPCover">
                                        <img src="https://covers.openlibrary.org/b/olid/OL4496766M-L.jpg" class="img-fluid rounded" alt="Portada Claros del bosque">
                                    </div>
                                </div>
                            </div>

                            <div class="flex-grow-1">
                                <h1 class="display-6 mb-1 fw-bold">Claros del bosque</h1>
                                <p class="fs-4 text-secondary mb-3">por <a href="VistaPerfilAutor.php" class="text-primary text-decoration-none">María Zambrano</a></p>
                                
                                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-4">
                                    <span class="badge bg-ensayo text-dark border px-3 py-2">Ensayo</span>
                                    <span class="badge bg-light text-dark border px-3 py-2">Filosofía</span>
                                    <span class="badge bg-light text-dark border px-3 py-2">1977</span>
                                    <div class="text-warning ms-2 fs-5">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <span class="text-secondary small ms-1">(5.0)</span>
                                    </div>
                                </div>
                                
                                <div class="d-grid d-md-flex gap-3 mb-3">
                                    <button 
                                        class="btn btn-primary btn-lg px-4" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#lectorPDF"
                                        data-pdf-url="/recursosPDF/ClarosDelBosque.pdf"
                                        data-book-title="Claros del bosque">
                                        <i class="bi bi-book me-2"></i>Leer PDF
                                    </button>

                                    <button 
                                        class="btn btn-primary btn-lg px-4" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#lectorHTML"                                        
                                        data-book-title="Claros del bosque">
                                        <i class="bi bi-book me-2"></i>Leer HTML
                                    </button>                                    

                                    <button class="btn btn-light border btn-lg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasComments">
                                        <i class="bi bi-chat-left-text me-2"></i>Comentarios
                                    </button>

                                    <button class="btn btn-light border btn-lg">
                                        <i class="bi bi-bookmark me-2"></i>Añadir a lista
                                    </button>
                                </div>

                                <div class="d-flex justify-content-center justify-content-md-start gap-3 mt-4">
                                    <button class="btn btn-outline-secondary border-0 d-flex align-items-center gap-2">
                                        <i class="bi bi-download"></i> <span class="d-none d-md-inline">Descargar PDF</span>
                                    </button>
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
                                <p>
                                    <strong>"Claros del bosque"</strong> no es solo un libro, es una experiencia mística y filosófica. María Zambrano nos conduce a través de la metáfora del bosque para explorar los lugares donde la luz penetra en la oscuridad del pensamiento, permitiendo que la verdad aparezca por sí misma.
                                </p>
                                <p>
                                    Publicada originalmente en 1977, esta obra representa la culminación de su "Razón Poética". En ella, la autora malagueña nos invita a detenernos en el silencio, a escuchar aquello que no se puede decir con la lógica pura, sino con el corazón y la intuición.
                                </p>
                                <p>
                                    El lector encontrará una meditación profunda sobre la palabra, el tiempo, el alma y el exilio, escrita con una prosa que roza la poesía y que ha convertido a Zambrano en una de las figuras más importantes del pensamiento español del siglo XX.
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <div class="offcanvas offcanvas-end border-0 shadow" tabindex="-1" id="offcanvasComments" aria-labelledby="offcanvasCommentsLabel" style="z-index: 1060;">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="offcanvasCommentsLabel">Comentarios</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-light">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <textarea class="form-control border-0 bg-light mb-2" rows="3" placeholder="Comparte tu reflexión sobre el libro..."></textarea>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm px-3">Publicar</button>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column gap-3">
                <div class="bg-white p-3 rounded shadow-sm border">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold small">@sofia_filo</span>
                    </div>
                    <p class="small text-secondary mb-2">Una lectura densa pero transformadora. La metáfora del claro es simplemente perfecta.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 0.75rem;">hace 3 h</span>
                        <button class="btn btn-link p-0 text-decoration-none">
                            <i class="bi bi-hand-thumbs-up-fill text-primary"></i>
                        </button>
                    </div>
                </div>
                
                <div class="bg-white p-3 rounded shadow-sm border">
                    <div class="fw-bold small mb-1">@bibliofilo_77</div>
                    <p class="small text-secondary mb-2">Hacía tiempo que no leía algo tan poético en el ámbito del ensayo. Imprescindible.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 0.75rem;">hace 2 días</span>
                        <button class="btn btn-link p-0 text-decoration-none">
                            <i class="bi bi-hand-thumbs-up-fill text-primary"></i>
                        </button>
                    </div>
                </div>
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

    <div class="modal fade" id="lectorHTML" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content border-0">
                <div class="modal-header border-bottom py-2 px-4 bg-white sticky-top">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div>
                            <h6 class="mb-0 fw-bold">Claros del bosque</h6>
                            <small class="text-muted text-uppercase" style="font-size: 0.6rem;">Modo lectura HTML</small>
                        </div>
                    </div>                    
                </div>
                
                <div class="modal-body p-0 bg-reading" id="visorHTML">
                    <div class="container-narrow py-5 px-4 mx-auto bg-white shadow-sm" style="max-width: 750px; min-height: 100%;">
                        <article class="reader-content font-serif fs-5 text-dark">
                            <?php include($_SERVER['DOCUMENT_ROOT'].'/recursosHTML/ClarosDelBosque.html'); ?>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/ebiblioteca.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lectorPDF = document.getElementById('lectorPDF');
            
            if (lectorPDF) {
                lectorPDF.addEventListener('show.bs.modal', function (event) {            
                    const button = event.relatedTarget;
                    
                    const pdfUrl = button.getAttribute('data-pdf-url');
                    const bookTitle = button.getAttribute('data-book-title');
                    
                    const modalTitle = lectorPDF.querySelector('#readerTitle');
                    const iframe = lectorPDF.querySelector('#pdfIframe');
                    
                    if (modalTitle) modalTitle.textContent = bookTitle;
                    
                    if (iframe) {
                        const viewerUrl = '/assets/pdfjs/web/viewer.html';
                        iframe.src = `${viewerUrl}?file=${encodeURIComponent(pdfUrl)}`;
                    }
                });

                lectorPDF.addEventListener('hidden.bs.modal', function () {
                    const iframe = lectorPDF.querySelector('#pdfIframe');
                    if (iframe) iframe.src = "";
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>