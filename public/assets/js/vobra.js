import {peticion,mostrarNotificacion} from './utilidades.js';

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

    if(lectorEPUB){
        let libro=null;
        let visor=null;

        lectorEPUB.addEventListener('show.bs.modal',function(event){
            const button=event.relatedTarget;
            const epubUrl=button.getAttribute('data-epub-url');
            const titulo=button.getAttribute('data-book-title');

            document.getElementById('tituloLibro').textContent=titulo;

            if(libro) {
                libro.destroy();
                document.getElementById("viewer").innerHTML = "";
            }
            
            libro=ePub(epubUrl);

            visor=libro.renderTo("viewer",{
                width:"100%",
                height:"100%",
                flow:"scrolled",
                manager:"default"
            });

            visor.display().then(function() {
                console.log("Renderizado completo");
                setTimeout(()=>{visor.resize();},500);
            });
        });

        lectorEPUB.addEventListener('shown.bs.modal', function() {
            if (visor) {
                visor.resize();
            }
        });

        document.getElementById("next").addEventListener("click",function(e){
            if(visor) visor.next();
            e.preventDefault();
        });

        document.getElementById("prev").addEventListener("click",function(e){
            if(visor) visor.prev();
            e.preventDefault();
        });

        lectorEPUB.addEventListener('hidden.bs.modal',function(){
            if(libro){
                libro.destroy();
                libro=null;
            }

            document.getElementById("viewer").innerHTML="";
        });
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
                        <span class="fw-bold small">@${data.nombreUsuario}</span>
                    </div>    
                    <p class="small text-secondary mb-2 w-100 pComentario">${contenido}</p>
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

    if(modalAgregarObra){
        modalAgregarObra.addEventListener('show.bs.modal',async function(e){
            idObra=e.relatedTarget.dataset.idObra;
            idUsuario=e.relatedTarget.dataset.idUsuario;

            if(buscadorListas) buscadorListas.value='';
            if(sinCoincidencias) sinCoincidencias.classList.add('d-none');

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
                    <h6 class="mb-1 fw-semibold">${lista.nombre}</h6>
                    <small class="text-muted">${lista.descripcion ? lista.descripcion.substring(0, 50) + '...' : 'Sin descripción'}</small>
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

    function escapeHtml(text){
        if(!text) return '';
        const div=document.createElement('div');

        div.textContent=text;
        return div.innerHTML;
    }
});