//calcular fechas para comentarios, tablón, etc
function calcularTiempoRelativo(fechaDB){
    const fecha=new Date(fechaDB.replace(/-/g,"/"));
    const ahora=new Date();
    
    const diferenciaSegundos=Math.floor(ahora-fecha)/1000;
    if(diferenciaSegundos < 60){
        return "hace unos segundos";
    }

    const diferenciaMinutos=Math.floor(diferenciaSegundos/60);
    if(diferenciaMinutos < 60){
        return `hace ${diferenciaMinutos} ${diferenciaMinutos === 1 ? 'minuto' : 'minutos'}`;
    }

    const diferenciaHoras=Math.floor(diferenciaMinutos/60);
    if(diferenciaHoras < 24){
        return `hace ${diferenciaHoras} ${diferenciaHoras === 1 ? 'hora' : 'horas'}`;
    }

    const diferenciaDias=Math.floor(diferenciaHoras/24);
    if(diferenciaDias < 7){
        return `hace ${diferenciaDias} ${diferenciaDias === 1 ? 'día' : 'días'}`;
    }

    const opciones={year:'numeric', month:'long', day:'numeric'};
    return fecha.toLocaleDateString('es-ES', opciones);    
}
function actualizarFechas(){
    const elementosFecha=document.querySelectorAll('.fecha');
    elementosFecha.forEach(elemento => {
        const fechaBD=elemento.getAttribute('data-fecha');
        if(fechaBD){
            elemento.textContent=calcularTiempoRelativo(fechaBD);
        }
    });
}
document.addEventListener('DOMContentLoaded', ()=>{
    actualizarFechas();
    setInterval(actualizarFechas, 60000);
});

// Función reutilizable para las interacciones AJAX
async function peticion(url,opciones={}){
    const config={
        method: opciones.method || 'POST',
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded',
            'Accept': 'application/json'
        },
    };

    if(opciones.body && typeof opciones.body==='object'){
        config.body=new URLSearchParams(opciones.body).toString();
    }

    try{
        const respuesta=await fetch(url, config);
        const datos=await respuesta.json().catch(()=>null);

        if(!respuesta.ok){
            const mensaje=datos?.error || `Error HTTP ${respuesta.status}`;
            throw new Error(mensaje);
        }

        return datos;
    } catch(error){
        if(error.name==='TypeError' && error.message.includes('fetch')){
            throw new Error('Error de conexión. Verifica tu conexión a internet.');
        }
        throw error;
    }
}

// Función para notificaciones
function mostrarNotificacion(mensaje,tipo='success'){
    let contenedor=document.getElementById('notificacion');
    if(!contenedor){
        contenedor=document.createElement('div');
        contenedor.id='notificacion';
        contenedor.className='toast-container position-fixed top-0 end-0 p-3';
        contenedor.style.zIndex='1090';
        document.body.appendChild(contenedor);
    }
    
    const nHtml=`
        <div class="toast align-items-center text-bg-${tipo} border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">${mensaje}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    contenedor.insertAdjacentHTML('beforeend', nHtml);
    
    const elemento=contenedor.lastElementChild;
    const notificacion=new bootstrap.Toast(elemento,{delay:3000});
    notificacion.show();

    elemento.addEventListener('hidden.bs.toast', ()=>elemento.remove());
}

// Seguir/dejar de seguir
document.addEventListener('DOMContentLoaded',function(){
    document.body.addEventListener('click',async function(e){
        const btnSeguir=e.target.closest('[data-action="seguir"]');
        if(btnSeguir){
            e.preventDefault();
            const idUsuario=btnSeguir.dataset.idUsuario;
            
            try{
                await peticion(`/usuario/${idUsuario}/seguir`);

                btnSeguir.textContent='Siguiendo';
                btnSeguir.classList.replace('btn-primary','btn-outline-primary');
                btnSeguir.dataset.action='dejar-seguir';
                
                const contador=document.getElementById('contadorSeguidores');
                if(contador){
                    contador.textContent=parseInt(contador.textContent)+1;
                }

                mostrarNotificacion('Ahora sigues a este usuario', 'success');
            } catch(error){
                mostrarNotificacion(error.message, 'danger');
            }
            return;
        }

        const botonDejar=e.target.closest('[data-action="dejar-seguir"]');
        if(botonDejar){
            e.preventDefault();
            const idUsuario=botonDejar.dataset.idUsuario;
            
            try{
                await peticion(`/usuario/${idUsuario}/dejar-seguir`);

                botonDejar.textContent='Seguir';
                botonDejar.classList.replace('btn-outline-primary','btn-primary');
                botonDejar.dataset.action='seguir';
                
                const contador=document.getElementById('contadorSeguidores');
                if(contador){
                    contador.textContent=parseInt(contador.textContent)-1;
                }

                mostrarNotificacion('Dejaste de seguir a este usuario', 'info');
            } catch(error){
                mostrarNotificacion(error.message, 'danger');
            }
        }
    });
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
                    <p class="small text-secondary mb-2">${contenido}</p>
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