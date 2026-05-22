import { peticion,mostrarNotificacion } from "./utilidades.js";

document.addEventListener('DOMContentLoaded', function() {
    const contLibros=document.getElementById('listaLibros');
    const modalEditar=document.getElementById('modalEditar');
    const inputNombre=document.getElementById('nombre');
    const inputDescripcion=document.getElementById('descripcion');
    const btnGuardar=document.getElementById('btnGuardar');

    let idLista=null;

    if(contLibros){
        contLibros.addEventListener('click',async function(e){
            const btnEliminar=e.target.closest('[data-action="eliminar-libro"]');
            if(!btnEliminar) return;
            
            const idObra=btnEliminar.dataset.idObra;
            const idLista=btnEliminar.dataset.idLista;

            if(!idObra || !idLista) return;

            try{
                const data=await peticion(`/lista/${idLista}/eliminar-obra`,{body:{idObra:idObra}});

                contLibros.removeChild(btnEliminar.closest('.elementoLibro'));
                
                contLibros.querySelectorAll('.contador').forEach((contador, index) => {
                    contador.textContent = index + 1;
                });

                const totalObras=document.getElementById('totalObras');
                totalObras.textContent='• '+(contLibros.querySelectorAll('.contador').length)+' títulos';

                mostrarNotificacion('Libro eliminado de la lista','success');
            }
            catch(error){
                mostrarNotificacion('No se ha podido eliminar el libro de la lista','danger');
            }
        });
    }

    if(modalEditar){
        modalEditar.addEventListener('show.bs.modal',function(e){
            const btn=e.relatedTarget;
            if(!btn) return;

            idLista=btn.dataset.idLista;
            inputNombre.value=btn.dataset.nombre;
            inputDescripcion.value=btn.dataset.descripcion;
        });
    }

    if(btnGuardar){
        btnGuardar.addEventListener('click', async function(){
            const nombre=inputNombre.value.trim();
            const descripcion=inputDescripcion.value.trim();

            if(!nombre){
                mostrarNotificacion('El nombre no puede estar vacío','warning');
                return;
            }

            btnGuardar.disabled=true;
            try{
                await peticion(`/lista/${idLista}/editar`,{body:{nombre:nombre,descripcion:descripcion}});

                const h1=document.querySelector('h1');
                if(h1) h1.textContent=nombre;

                const pDescipcion=document.querySelector('p.lead');
                if(pDescipcion) pDescipcion.textContent=descripcion;

                const modal=bootstrap.Modal.getInstance(document.getElementById('modalEditar'));
                if(modal) modal.hide();

                const btnEditar=document.getElementById('btnEditar');
                if(btnEditar){
                    btnEditar.dataset.nombre=nombre;
                    btnEditar.dataset.descripcion=descripcion;
                }

                mostrarNotificacion('Lista actualizada correctamente','success');
            }
            catch(error){
                mostrarNotificacion('No se ha podido actualizar la lista','danger');
            }
            finally{
                btnGuardar.disabled=false;
            }
        });
    }

    document.body.addEventListener('click',async function(e){
        const btnSeguir=e.target.closest('[data-action="seguir-lista"]');
        if(btnSeguir){
            const idLista=btnSeguir.dataset.idLista;
            const seguida=btnSeguir.dataset.seguida==='1';
            try{
                if(seguida){
                    await peticion(`/lista/${idLista}/dejar-seguir`,{body:{idLista}});
                    btnSeguir.dataset.seguida = '0';
                    btnSeguir.innerHTML = '<i class="bi bi-plus-lg me-1"></i> Seguir';
                    mostrarNotificacion('Has dejado de seguir la lista','success');
                }
                else{
                    await peticion(`/lista/${idLista}/seguir`,{body:{idLista}});
                    btnSeguir.dataset.seguida=1;
                    btnSeguir.innerHTML='<i class="bi bi-check-lg me-1"></i> Seguir';
                    mostrarNotificacion('Ahora sigues la lista','success');
                }
            }
            catch(error){
                mostrarNotificacion(error.message,'danger');
            }
        }

        const btnGuardar=e.target.closest('[data-action="guardar-lista"]');
        if(btnGuardar){
            const idLista=btnGuardar.dataset.idLista;
            try{
                await peticion(`/lista/${idLista}/copiar`,{body:{idLista}});
                btnGuardar.dataset.copiada=1;
                btnGuardar.innerHTML='<i class="bi bi-bookmark-fill"></i> Guardada';
                mostrarNotificacion('Lista guardada','success');
            }
            catch(error){
                mostrarNotificacion(error.message,'danger');
            }
        }
    });
});
