import {peticion,mostrarNotificacion} from './utilidades.js';

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

// Cambiar cantidad de elementos a mostrar
function cambiarPorPagina(valor) {
    const url = new URL(window.location.href);
    url.searchParams.set('porPagina', valor);
    url.searchParams.set('pagina','1');
    window.location.href = url.toString();
}

document.addEventListener('DOMContentLoaded',function(){
    const selectElems=document.getElementById('selectElems');

    if(selectElems){
        selectElems.addEventListener('change',function(e){
            const valor=e.target.value;
            cambiarPorPagina(valor);
        });
    }
});


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

// Compartir enlace actual (botón con icono bi-share)
document.addEventListener('DOMContentLoaded',function(){
    const btnCompartir=document.querySelector('.bi-share')?.closest('button');
    if(btnCompartir){
        btnCompartir.addEventListener('click', async function(){
            try{
                await navigator.clipboard.writeText(window.location.href);
                mostrarNotificacion('Enlace copiado al portapapeles','success');
            }
            catch(error){
                mostrarNotificacion('No se pudo copiar el enlace','danger');
            }
        });
    }
});

