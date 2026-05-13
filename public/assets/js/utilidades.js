// Función reutilizable para las interacciones AJAX
export async function peticion(url,opciones={}){
    const config={
        method: opciones.method || 'POST',
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded',
            'Accept': 'application/json'
        },
    };

    if(opciones.body && typeof opciones.body==='object'){
        // Si es FormData, enviarlo directamente (para archivos)
        if(opciones.body instanceof FormData){
            config.body=opciones.body;
            // No establecer Content-Type, el navegador lo hará automáticamente con boundary
            delete config.headers['Content-Type'];
        } else {
            // Para objetos normales, convertir a URLSearchParams
            config.body=new URLSearchParams(opciones.body).toString();
        }
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
export function mostrarNotificacion(mensaje,tipo='success'){
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