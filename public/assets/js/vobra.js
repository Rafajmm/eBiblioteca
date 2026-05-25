import {peticion,mostrarNotificacion} from './utilidades.js';
let libro=null;
let visor=null;

function aplicarFuente(rendition,escala){
    if(!rendition) return;
    rendition.themes.fontSize(escala*100+'%');
}

function aplicarTema(rendition, modo) {
    if (!rendition) return;

    const modal = document.getElementById('lectorEPUB');
    const modalContent = document.querySelector('#lectorEPUB .modal-content');
    const modalHeader = document.querySelector('#lectorEPUB .modal-header');
    const modalBody = document.querySelector('#lectorEPUB .modal-body');

    if (modo === 'dark') {
        rendition.themes.override('color', '#e9ecef');
        rendition.themes.override('background', '#121212');

        if (modal) modal.classList.add('epub-dark-mode');
        if (modalContent) modalContent.classList.add('epub-dark-mode');
        if (modalHeader) {
            modalHeader.classList.remove('bg-white');
            modalHeader.classList.add('bg-dark', 'text-white');
        }
        if (modalBody) {
            modalBody.classList.remove('bg-light');
            modalBody.classList.add('bg-dark');
        }
    } else {
        rendition.themes.override('color', '#212529');
        rendition.themes.override('background', '#F8F9FA');

        if (modal) modal.classList.remove('epub-dark-mode');
        if (modalContent) modalContent.classList.remove('epub-dark-mode');
        if (modalHeader) {
            modalHeader.classList.remove('bg-dark', 'text-white');
            modalHeader.classList.add('bg-white');
        }
        if (modalBody) {
            modalBody.classList.remove('bg-dark');
            modalBody.classList.add('bg-light');
        }
    }
}

function actualizarBotonTema(modo) {
    const btnModo = document.getElementById('theme-toggle');
    if (!btnModo) return;

    if (modo === 'dark') {
        btnModo.innerHTML = '<i class="bi bi-sun-fill"></i>';
        btnModo.title = 'Modo claro';
    } else {
        btnModo.innerHTML = '<i class="bi bi-moon-fill"></i>';
        btnModo.title = 'Modo oscuro';
    }
}

function scapeHtml(text){
    if(!text) return '';
    const div=document.createElement('div');

    div.textContent=text;
    return div.innerHTML;
}

document.addEventListener('DOMContentLoaded', function() {
    const lectorPDF = document.getElementById('lectorPDF');
    const lectorEPUB= document.getElementById('lectorEPUB');
    
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

    if (lectorEPUB) {
        lectorEPUB.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const epubUrl = button.getAttribute('data-epub-url');
            const titulo = button.getAttribute('data-book-title');

            document.getElementById('tituloLibro').textContent = titulo;

            const viewer = document.getElementById("viewer");

            if (libro) {
                libro.destroy();
                libro = null;
                visor = null;
                viewer.innerHTML = "";
            }

            libro = ePub(epubUrl);

            visor = libro.renderTo("viewer", {
                width: "100%",
                height: "100%",
                flow: "scrolled-doc",
                manager: "continuous",
                spread: "none"
            });

            visor.display().then(function() {
                const escalaGuardada = localStorage.getItem('epub_font_scale');
                const temaGuardado = localStorage.getItem('epub_theme') || 'light';

                aplicarFuente(visor, escalaGuardada ? parseFloat(escalaGuardada) : 1.0);
                aplicarTema(visor, temaGuardado);
                actualizarBotonTema(temaGuardado);

                setTimeout(() => {
                    visor.resize();
                }, 300);
            }).catch(function(error) {
                mostrarNotificacion('No se pudo cargar el libro EPUB', 'danger');
            });
        });

        lectorEPUB.addEventListener('shown.bs.modal', function() {
            if (visor) {
                visor.resize();
            }
        });

        lectorEPUB.addEventListener('hidden.bs.modal', function() {
            if (libro) {
                libro.destroy();
                libro = null;
                visor = null;
            }

            const viewer = document.getElementById("viewer");
            if (viewer) viewer.innerHTML = "";
        });

        const aumentar = document.getElementById('increase-font');
        const reducir = document.getElementById('decrease-font');
        const btnModo = document.getElementById('theme-toggle');

        if (aumentar) {
            aumentar.addEventListener('click', function() {
                if (!visor) return;

                let escala = parseFloat(localStorage.getItem('epub_font_scale') || '1.0');
                escala = Math.min(escala + 0.1, 2.5);

                localStorage.setItem('epub_font_scale', escala);
                aplicarFuente(visor, escala);
            });
        }

        if (reducir) {
            reducir.addEventListener('click', function() {
                if (!visor) return;

                let escala = parseFloat(localStorage.getItem('epub_font_scale') || '1.0');
                escala = Math.max(escala - 0.1, 0.5);

                localStorage.setItem('epub_font_scale', escala);
                aplicarFuente(visor, escala);
            });
        }

        if (btnModo) {
            btnModo.addEventListener('click', function() {
                if (!visor) return;

                const temaActual = localStorage.getItem('epub_theme') || 'light';
                const nuevoTema = temaActual === 'light' ? 'dark' : 'light';

                localStorage.setItem('epub_theme', nuevoTema);
                aplicarTema(visor, nuevoTema);
                actualizarBotonTema(nuevoTema);
            });
        }
    }    
});

// Comentar obra
document.addEventListener('DOMContentLoaded',function(){
    const formComentario=document.getElementById('formComentario');
    if(!formComentario) return;

    formComentario.addEventListener('submit',async function(e){
        e.preventDefault();
        
        const inputContenido=this.querySelector('[name="contenido"]');
        const inputObra=this.querySelector('[name="idObra"]');
        const contenido=inputContenido.value.trim();
        const obra=inputObra.value.trim();
        
        if(!contenido || !obra){
            mostrarNotificacion('Escribe algo antes de comenzar', 'warning');
            return;
        }

        const btnEnviar=this.querySelector('button[type="submit"]');
        btnEnviar.disabled=true;
        btnEnviar.innerHTML='<span class="spinner-border spinner-border-sm"></span>';

        try{
            const data=await peticion('/comentario/crear',{
                body:{contenido: contenido,idObra:obra}
            });

            const lista=document.getElementById('listaComentarios');
            if(lista){
                const vacio=lista.querySelector('.text-center.text-muted');
                if(vacio) vacio.remove();

                const nuevo=document.createElement('div');
                nuevo.className='bg-white p-3 rounded shadow-sm border';
                nuevo.innerHTML=`
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold small">@${scapeHtml(data.nombreUsuario)}</span>
                    </div>    
                    <p class="small text-secondary mb-2 w-100 pComentario">${scapeHtml(contenido)}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted fecha" data-fecha="${data.fecha}" style="font-size: 0.75rem;">${data.fecha}</span>
                        <button class="btn btn-link p-0 text-decoration-none">
                            <i class="bi bi-hand-thumbs-up-fill text-primary"></i>
                        </button>
                    </div>
                `;
                lista.prepend(nuevo);
            }

            inputContenido.value = '';
            mostrarNotificacion('Comentario publicado', 'success');
            
        } catch (error) {
            mostrarNotificacion(error.message, 'danger');
        } finally {
            btnEnviar.disabled = false;
            btnEnviar.innerHTML = 'Comentar';
        }
    });
});

// Puntuar obra
document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click',async function(e){
        const estrella=e.target.closest('[data-action="puntuar"]');
        if(!estrella) return;

        e.preventDefault();
        
        const valor=parseInt(estrella.dataset.valor);
        const idObra=estrella.closest('[data-id-obra]').dataset.idObra;
        
        try{
            const data=await peticion('/puntuacion/crear', {
                body: {valor: valor, idObra: idObra}
            });
            
            const contenedorEstrellas=estrella.closest('.estrellas');
            if(contenedorEstrellas){
                contenedorEstrellas.querySelectorAll('[data-action="puntuar"]').forEach(es=>{
                    const v = parseInt(es.dataset.valor);
                    if(v <= valor){
                        es.classList.add('bi-star-fill','text-warning'); 
                        es.classList.remove('bi-star','text-muted');
                        es.classList.remove('bi-star-half')                       
                    }else{
                        es.classList.add('bi-star','text-muted');
                        es.classList.remove('bi-star-fill','text-warning');
                        es.classList.remove('bi-star-half')
                    }
                });
            }

            const spanMedia=document.getElementById('puntuacionMedia');
            if(spanMedia){
                spanMedia.textContent=Number(data.nuevaMedia).toFixed(1)+' ('+data.totalPuntuaciones+')';
            }            

            mostrarNotificacion(`Has puntuado con ${valor} estrella${valor>1 ? 's':''}`,'success');
        }
        catch(error){
            mostrarNotificacion(error.message, 'danger');
        }
    });
});

// Añadir obra a lista
document.addEventListener('DOMContentLoaded', function() {
    const modalAgregarObra=document.getElementById('modalAgregarObra');
    const btnAbrir=document.getElementById('abrirModalAgregarObra');
    const contListas=document.getElementById('contListas');
    const buscadorListas=document.getElementById('buscadorListas');
    const sinListas=document.getElementById('sinListas');
    const sinCoincidencias=document.getElementById('sinCoincidencias');

    let idObra=null;
    let idUsuario=null;
    let listas=[];

    if(btnAbrir){
        btnAbrir.addEventListener('click',async function(){
            idObra=btnAbrir.dataset.idObra;
            idUsuario=btnAbrir.dataset.idUsuario;

            if(!idUsuario){
                mostrarNotificacion('Debes iniciar sesión para añadir obras a una lista','warning');
                return;
            }

            if(buscadorListas) buscadorListas.value='';
            if(sinCoincidencias) sinCoincidencias.classList.add('d-none');

            const modal=bootstrap.Modal.getOrCreateInstance(modalAgregarObra);
            modal.show();

            await cargarListas();
        });
    }

    async function cargarListas(){
        if(!contListas) return;

        contListas.innerHTML=`
            <div class="text-center py-4 text-muted">
                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                Cargando listas...
            </div>
        `;

        if(sinListas) sinListas.classList.add('d-none');

        try{
            const data=await peticion(`/usuario/${encodeURIComponent(idUsuario)}/listas`,{method: 'GET'});
            
            listas=data.listas || [];

            if(listas.length===0){
                contListas.innerHTML='';
                sinListas.classList.remove('d-none');
                return;
            }

            renderizarListas(listas);
        }
        catch(error){
            contListas.innerHTML=`
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    ${error.message || 'Error al cargar las listas'}
                </div>
            `;
        }
    }

    function renderizarListas(listas){
        if(listas.length === 0){
            contListas.innerHTML = '';
            sinCoincidencias.classList.remove('d-none');
            return;
        }
        
        sinCoincidencias.classList.add('d-none');
        
        const html = listas.map(lista => `
            <button type="button" 
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3"
                    data-lista-id="${lista.id}"
                    data-action="agregar-obra-modal">
                <div class="me-3 text-start">
                    <h6 class="mb-1 fw-semibold">${scapeHtml(lista.nombre)}</h6>
                    <small class="text-muted">${lista.descripcion ? scapeHtml(lista.descripcion.substring(0, 50) + '...') : 'Sin descripción'}</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle text-primary fs-5"></i>
                </div>
            </button>
        `).join('');
        
        contListas.innerHTML = html;
    }

    if(buscadorListas){
        buscadorListas.addEventListener('input',function(e){
            const termino=e.target.value.toLowerCase().trim();
            
            if(!termino){
                renderizarListas(listas);
                return;
            }

            const filtradas=listas.filter(lis=>
                lis.nombre.toLowerCase().includes(termino) ||
                (lis.descripcion && lis.descripcion.toLowerCase().includes(termino))
            );
            
            renderizarListas(filtradas);
        });
    }

    const inputNuevaLista=document.getElementById('inputNuevaLista');
    const btnCrearLista=document.getElementById('btnCrearLista');

    if(btnCrearLista){
        btnCrearLista.addEventListener('click',async function () {
            const nombreL=inputNuevaLista.value.trim();
            if(!nombreL){
                mostrarNotificacion('Debes escribir un nombre para la lista nueva','warning');
                return;
            }          
            
            btnCrearLista.disabled=true;
            try{
                await peticion('/lista/crear',{body:{nombre:nombreL,descripcion:''}});

                inputNuevaLista.value='';
                mostrarNotificacion('Lista creada','success');
                await cargarListas();
            }catch(error){
                mostrarNotificacion('Error al crear lista','error');
            }finally{
                btnCrearLista.disabled=false;
            }
        });
        if(inputNuevaLista){
            inputNuevaLista.addEventListener('keydown', function(e){
                if(e.key==='Enter'){
                    e.preventDefault();
                    btnCrearLista.click();
                }
            });
        }
    }

    if(contListas){
        contListas.addEventListener('click', async function(e){
            const btnLista=e.target.closest('[data-action="agregar-obra-modal"]');
            if(!btnLista || !idObra) return;

            const idLista=btnLista.dataset.listaId;

            btnLista.disabled=true;
            const iconoOriginal=btnLista.querySelector('.bi-plus-circle');
            if(iconoOriginal){
                iconoOriginal.classList.replace('bi-plus-circle','bi-hourglass-split');
            }

            try{
                const data=await peticion(`/lista/${idLista}/agregar-obra`,{
                    body:{idObra:idObra}
                });

                const modal=bootstrap.Modal.getInstance(modalAgregarObra);
                if(modal) modal.hide();

                mostrarNotificacion('Obra añadida correctamente', 'success');
            }
            catch(error){
                mostrarNotificacion('Error al añadir obra', 'danger');

                btnLista.disabled=false;
                if(iconoOriginal){
                    iconoOriginal.classList.replace('bi-hourglass-split','bi-plus-circle');
                }
            }
        });
    }
});

// Me gusta y reportar comentario
document.body.addEventListener('click',async function(e){
    const btnLike=e.target.closest(".btnLikeComentario");
    if(btnLike){
        e.preventDefault();
        const idComentario=btnLike.dataset.idComentario;
        const dioLike=btnLike.dataset.usuarioLike==='1';
        const icono=btnLike.querySelector('i');
        const contComentario=btnLike.closest('.contComentario');
        const contadorMG=contComentario.querySelector(".contadorMg");
        
        try{
            if(dioLike){
                await peticion(`/comentario/${idComentario}/quitar-megusta`,{body:{idComentario}});
                icono.classList.remove('bi-hand-thumbs-up-fill');
                icono.classList.add('bi-hand-thumbs-up');
                btnLike.dataset.usuarioLike='0';                
                contadorMG.innerHTML=parseInt(contadorMG.textContent)-1;
                mostrarNotificacion('Me gusta quitado','success');
            }
            else{
                await peticion(`/comentario/${idComentario}/megusta`,{body:{idComentario}});
                icono.classList.remove('bi-hand-thumbs-up');
                icono.classList.add('bi-hand-thumbs-up-fill');
                btnLike.dataset.usuarioLike='1';
                contadorMG.innerHTML=parseInt(contadorMG.textContent)+1;
                mostrarNotificacion('Me gusta añadido','success');
            }
        }
        catch(error){
            mostrarNotificacion('Error al procesar me gusta: '+error.message, 'danger');
        }
        return;
    }

    const btnReportar=e.target.closest(".btnReportarComentario");
    if(btnReportar) {
        e.preventDefault();
        const idComentario = btnReportar.dataset.idComentario;
        const yaReporto = btnReportar.dataset.usuarioReporto === '1';
        
        if(yaReporto) {
            mostrarNotificacion('Ya has reportado este comentario', 'warning');
            return;
        }
 
        try {
            await peticion(`/comentario/${idComentario}/reportar`, {method: 'POST'});
            const icono = btnReportar.querySelector('i');
            icono.classList.remove('bi-flag');
            icono.classList.add('bi-flag-fill');
            btnReportar.dataset.usuarioReporto = '1';
            mostrarNotificacion('Comentario reportado', 'success');
        } catch(error) {
            mostrarNotificacion(error.message, 'danger');
        }
    }
});