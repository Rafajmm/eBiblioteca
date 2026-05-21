import { peticion, mostrarNotificacion } from './utilidades.js';

function paginar(contenedorID,itemsPorPagina){
    const contenedor=document.getElementById(contenedorID);
    if(!contenedor) return;
    
    const esTabla=contenedor.tagName==='TBODY' || contenedor.tagName==='TABLE';
    const todosElementos=esTabla
    ? Array.from(contenedor.querySelectorAll('tr')) 
    : Array.from(contenedor.children).filter(elem=> elem.classList.contains('comentario'));

    let elementos=[...todosElementos];
    let paginaActual=1;

    const nav=document.createElement('nav');
    nav.setAttribute('aria-label','Paginación');
    const ul=document.createElement('ul');
    ul.className='pagination pagination-sm justify-content-center mb-0 mt-3';
    nav.appendChild(ul);

    if(esTabla){
        const hermano=contenedor.closest('.table-responsive');
        hermano.parentNode.insertBefore(nav,hermano.nextSibling);
    }
    else{
        contenedor.appendChild(nav);
    }

    function calcularTotalPaginas(){
        return Math.ceil(elementos.length/itemsPorPagina);
    }

    function renderizarPagina(pagina){
        paginaActual=pagina;
        const inicio=(pagina-1)*itemsPorPagina;
        const fin=inicio+itemsPorPagina;

        todosElementos.forEach(el=> el.style.display='none');

        elementos.forEach((elemento,i)=>{
            elemento.style.display=(i>=inicio && i<fin) ? '' : 'none';
        });

        renderizarControles();
    }

    function renderizarControles(){
        const totalPaginas=calcularTotalPaginas();
        ul.innerHTML='';
        
        const liAnt=document.createElement('li');
        liAnt.className='page-item'+(paginaActual<=1 ? ' disabled' : '');
        const aAnt=document.createElement('a');
        aAnt.className='page-link';
        aAnt.href='#';
        aAnt.textContent='Anterior';
        aAnt.addEventListener('click',e=>{
            e.preventDefault();
            if(paginaActual>1){
                renderizarPagina(paginaActual-1);
            }
        });
        liAnt.appendChild(aAnt);
        ul.appendChild(liAnt);

        for (let i = 1; i <= totalPaginas; i++) {
            const li = document.createElement('li');
            li.className = 'page-item' + (i === paginaActual ? ' active' : '');
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.textContent = i;
            a.addEventListener('click', e => {
                e.preventDefault();
                renderizarPagina(i);
            });
            li.appendChild(a);
            ul.appendChild(li);
        }

        const liSig = document.createElement('li');
        liSig.className = 'page-item' + (paginaActual >= totalPaginas ? ' disabled' : '');
        const aSig = document.createElement('a');
        aSig.className = 'page-link';
        aSig.href = '#';
        aSig.textContent = 'Siguiente';
        aSig.addEventListener('click', e => {
            e.preventDefault();
            if (paginaActual < totalPaginas) renderizarPagina(paginaActual + 1);
        });
        liSig.appendChild(aSig);
        ul.appendChild(liSig);
    }

    function filtrar(termino){
        termino=termino.toLowerCase().trim();
        
        if(!termino){
            elementos=[...todosElementos];
        }
        else{
            elementos=todosElementos.filter(el=>{
                return el.textContent.toLowerCase().includes(termino);
            });
        }

        if(elementos.length===0){
            todosElementos.forEach(el=> el.style.display = 'none');
            ul.innerHTML='<li class="page-item disabled"><span class="page-link">Sin resultados</span></li>';
            return;
        }
        renderizarPagina(1);
    }
 
    renderizarPagina(1);

    return {filtrar};
}

document.addEventListener('DOMContentLoaded', function() {
    const pagObras=paginar('tablaObras', 15);
    const pagAutores=paginar('tablaAutores',15);
    const pagUsuarios=paginar('tablaUsuarios', 15);
    paginar('contenedorReportados', 5);
    paginar('contenedorSinModerar', 5);

    const inputObras=document.getElementById('buscarObras');
    const inputAutores=document.getElementById('buscarAutores');
    const inputUsuarios=document.getElementById('buscarUsuarios');

    if(inputObras && pagObras){
        inputObras.addEventListener('input', function(){
            pagObras.filtrar(this.value);
        });
    }
    if(inputAutores && pagAutores){
        inputAutores.addEventListener('input', function(){
            pagAutores.filtrar(this.value);
        });
    }
    if(inputUsuarios && pagUsuarios){
        inputUsuarios.addEventListener('input', function(){
            pagUsuarios.filtrar(this.value);
        });
    }

    const botones = document.querySelectorAll('#admin-nav button');
    const secciones = document.querySelectorAll('.admin-section');

    botones.forEach(btn => {
      btn.addEventListener('click', function() {
        botones.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        secciones.forEach(s => s.classList.add('d-none'));
        const targetId = this.getAttribute('data-target');
        document.getElementById(targetId).classList.remove('d-none');
      });
    });

    const seleccionarMultiple=(select,ids)=>{
        if(!select) return;
        const idsNorm=(ids || []).map(String);
        Array.from(select.options).forEach(opt=>{
            opt.selected=idsNorm.includes(String(opt.value));
        });
    };

    const leerJSON=(valor)=>{
        try{
            return JSON.parse(valor || '[]');
        }catch(e){
            return [];
        }
    };

    const modalEditarObra=document.getElementById('modalEditarObra');
    if(modalEditarObra){
        modalEditarObra.addEventListener('show.bs.modal',function(event){
            const button=event.relatedTarget;
            if(!button) return;

            const id=button.getAttribute('data-id-obra') || '';
            const titulo=button.getAttribute('data-titulo') || '';
            const anio=button.getAttribute('data-anio') || '';
            const pagina=button.getAttribute('data-paginas') || '';
            const genero=button.getAttribute('data-genero') || '';
            const sinopsis=button.getAttribute('data-sinopsis') || '';
            const autores=button.getAttribute('data-autores');
            const etiquetas=button.getAttribute('data-etiquetas');

            const formEdObra=document.getElementById('formEdObra');
            formEdObra.action='/admin/obra/'+id+'/editar';

            document.getElementById('edIdObra').value=id;

            const campoTitulo=document.getElementById('edTitulo');
            campoTitulo.placeholder=titulo;

            const campoAnio=document.getElementById('edAnio');
            campoAnio.placeholder=anio;

            const campoPagina=document.getElementById('edPagina');
            campoPagina.placeholder=pagina;

            document.getElementById('edGenero').value=genero;

            const campoSinopsis=document.getElementById('edSinopsis');
            campoSinopsis.placeholder=sinopsis;

            seleccionarMultiple(document.getElementById('edAutores'),leerJSON(autores));
            seleccionarMultiple(document.getElementById('edEtiquetas'),leerJSON(etiquetas));            
        });        
    }

    const modalEditarAutor=document.getElementById('modalEditarAutor');
    if(modalEditarAutor){
        modalEditarAutor.addEventListener('show.bs.modal',function(event){
            const button=event.relatedTarget;
            if(!button) return;

            const id=button.getAttribute('data-id-autor');
            const nombre=button.getAttribute('data-nombre');
            const pais=button.getAttribute('data-pais');
            const fechaNacimiento=button.getAttribute('data-fecha-nacimiento');
            const biografia=button.getAttribute('data-biografia');
            
            document.getElementById('edIdAutor').value=id;
            
            const campoNombreAutor=document.getElementById('edNombreAutor');
            campoNombreAutor.placeholder=nombre;
            
            const campoPais=document.getElementById('edPais');
            campoPais.placeholder=pais;
            
            const campoFechaNacimiento=document.getElementById('edFechaNacimiento');
            campoFechaNacimiento.placeholder=fechaNacimiento;
            
            const campoBiografia=document.getElementById('edBiografia');
            campoBiografia.placeholder=biografia;
        });
    }

    const modalEditarUsuario = document.getElementById('modalEditarUsuario');
    if (modalEditarUsuario) {
        modalEditarUsuario.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const id = button.getAttribute('data-id-usuario') || '';
            const nombre = button.getAttribute('data-nombre') || '';
            const nombreUsuario = button.getAttribute('data-nombre-usuario') || '';
            const correo = button.getAttribute('data-correo') || '';
            const bio = button.getAttribute('data-bio') || '';
            const rutaFoto = button.getAttribute('data-ruta-foto') || '';

            document.getElementById('edIdUsuario').value = id;

            const campoNombre=document.getElementById('edNombre');
            campoNombre.placeholder=nombre;
            
            const campoNombreUsuario=document.getElementById('edNombreUsuario');
            campoNombreUsuario.placeholder=nombreUsuario;

            const campoCorreo=document.getElementById('edCorreo');
            campoCorreo.placeholder=correo;

            const campoBio=document.getElementById('edBio');
            campoBio.placeholder=bio;

            document.getElementById('edPass').value = '';
        });
    }

});

// CRUD panel admin
document.addEventListener('DOMContentLoaded', function() {
    // OBRAS
    // Enviar formulario de nueva obra
    const fObraNueva = document.getElementById('formObraNueva');
    if (fObraNueva) {
        fObraNueva.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const autores = formData.getAll('autores[]');
            const etiquetas = formData.getAll('etiquetas[]');
            formData.delete('autores[]');
            formData.delete('etiquetas[]');
            formData.append('autores', JSON.stringify(autores));
            formData.append('etiquetas', JSON.stringify(etiquetas));

            const btn = this.querySelector('button[type="submit"]') || document.querySelector('button[form="formObraNueva"]');
            btn.disabled = true;
            btn.innerHTML = 'Creando...';
            
            try {
                const resp = await peticion('/admin/obra/crear', { body: formData });
                
                const modal = bootstrap.Modal.getInstance(
                    document.getElementById('modalObraNueva')
                );
                if (modal) modal.hide();
                
                mostrarNotificacion('Obra creada correctamente', 'success');
                
                setTimeout(() => location.reload(), 1000);
                
            } catch (error) {
                mostrarNotificacion(error.message, 'danger');
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Crear Obra';
            }
        });
    }

    //Editar obra existente
    const fEdObra=document.getElementById('formEdObra');
    if(fEdObra){
        fEdObra.addEventListener('submit',async function(e){
            e.preventDefault();

            const formData=new FormData(this);
            
            // Manejar arrays de autores y etiquetas
            const autores = formData.getAll('autores_actualizar[]');
            const etiquetas = formData.getAll('etiquetas_actualizar[]');
            
            formData.delete('autores_actualizar[]');
            formData.delete('etiquetas_actualizar[]');
            
            formData.append('autores_actualizar', JSON.stringify(autores));
            formData.append('etiquetas_actualizar', JSON.stringify(etiquetas));

            try{
                const idObra = formData.get('idObra');
                await peticion(`/admin/obra/${idObra}/editar`,{body:formData});

                const modal=bootstrap.Modal.getInstance(
                    document.getElementById('modalEditarObra')
                );
                if (modal) modal.hide();
                
                mostrarNotificacion('Obra editada correctamente', 'success');
                
                setTimeout(() => location.reload(), 1000);
            } catch (error) {
                mostrarNotificacion(error.message, 'danger');
            }
        });
    }

    // Eliminar obra
    document.body.addEventListener('click', async function(e) {
        const btn = e.target.closest('[data-action="eliminar-obra"]');
        if (!btn) return;
        
        e.preventDefault();
        
        const idObra = btn.dataset.idObra;
        
        try {
            await peticion(`/admin/obra/${idObra}/eliminar`, {
                body: { idObra: idObra }
            });
            
            // Eliminar la fila de la tabla
            btn.classList.replace('btn-outline-danger', 'btn-outline-success');
            const icono = btn.querySelector('i');
            icono.className = 'bi bi-arrow-counterclockwise';
            btn.dataset.action = 'activar-obra';
            
            mostrarNotificacion('Obra eliminada', 'success');
        } catch (error) {
            mostrarNotificacion(error.message, 'danger');
        }
    });

    //Activar obra
    document.body.addEventListener('click', async function(e) {
        const btn = e.target.closest('[data-action="activar-obra"]');
        if (!btn) return;
        
        e.preventDefault();
        
        const idObra = btn.dataset.idObra;
        
        try {
            await peticion(`/admin/obra/${idObra}/activar`, {
                body: { idObra: idObra }
            });
            
            // Eliminar la fila de la tabla
            btn.classList.replace('btn-outline-success', 'btn-outline-danger');
            const icono = btn.querySelector('i');
            icono.className = 'bi bi-trash';
            btn.dataset.action = 'eliminar-obra';
            
            mostrarNotificacion('Obra activada', 'success');
        } catch (error) {
            mostrarNotificacion(error.message, 'danger');
        }
    });

    // AUTORES
    // Autor nuevo
    const fAutorNuevo=document.getElementById('formAutorNuevo');
    if(fAutorNuevo){
        fAutorNuevo.addEventListener('submit', async function(e){
            e.preventDefault();
            const formData=new FormData(this);
            const datos=Object.fromEntries(formData);
            const btn = this.querySelector('button[type="submit"]') || document.querySelector('button[form="formAutorNuevo"]');
            btn.disabled = true;
            btn.innerHTML = 'Creando...';

            try{
                const resp=await peticion('/admin/autor/crear',{body:datos});
                if(!resp || !resp.id || isNaN(parseInt(resp.id))) {
                    throw new Error(resp?.error || 'No se pudo crear el autor');
                }

                const modal=bootstrap.Modal.getInstance(document.getElementById('modalAutorNuevo'));
                modal.hide();
                mostrarNotificacion('Autor creado correctamente','success');
                setTimeout(()=> location.reload(),1000)
            } catch (error) {
                mostrarNotificacion(error.message, 'danger');
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Crear Autor';
            }
        });
    }

    // Editar autor
    const fEdAutor=document.getElementById('formEdAutor');
    if(fEdAutor){
        fEdAutor.addEventListener('submit',async function(e){
            e.preventDefault();
            const datos=Object.fromEntries(new FormData(this).entries());
            const id=datos.edIdAutor;
            const nombre=datos.edNombreAutor;
            
            const fila = document.querySelector(`tr[data-id-autorT="${id}"]`);
            if (fila) {
                const celda = fila.querySelector('.edNombre');
                if (celda) celda.textContent = nombre;
            }

            try{
                await peticion(`/admin/autor/${id}/editar`,{body:datos});
                const modal=bootstrap.Modal.getInstance(document.getElementById('modalEditarAutor'));
                modal.hide();
                                
                mostrarNotificacion('Autor editado correctamente','success');
                setTimeout(()=>location.reload(),1000);
            } catch (error) {
                mostrarNotificacion(error.message, 'danger');
            }
        });
    }

    // Eliminar autor
    document.body.addEventListener('click',async function(e){
        const btn=e.target.closest('[data-action="eliminar-autor"]');
        if(!btn) return;
        e.preventDefault();

        const idAutor=btn.dataset.idAutor;
        try{
            await peticion(`/admin/autor/${idAutor}/eliminar`, {body:{idAutor}});
            
            btn.classList.replace('btn-outline-danger', 'btn-outline-success');
            const icono = btn.querySelector('i');
            icono.className = 'bi bi-arrow-counterclockwise';
            btn.dataset.action = 'activar-autor';
            
            mostrarNotificacion('Autor eliminado correctamente','success');
        } catch (error) {
            mostrarNotificacion(error.message, 'danger');
        }
    })

    // Activar autor
    document.body.addEventListener('click',async function(e){
        const btn=e.target.closest('[data-action="activar-autor"]');
        if(!btn) return;
        e.preventDefault();

        const idAutor=btn.dataset.idAutor;
        try{
            await peticion(`/admin/autor/${idAutor}/activar`,{body:{idAutor}});
            
            btn.classList.replace('btn-outline-success', 'btn-outline-danger');
            const icono = btn.querySelector('i');
            icono.className = 'bi bi-trash';
            btn.dataset.action = 'eliminar-autor';
            
            mostrarNotificacion('Autor activado correctamente','success');
        } catch (error) {
            mostrarNotificacion(error.message, 'danger');
        }
    });

    // USUARIOS
    // Banear/Activar usuario
    document.body.addEventListener('click', async function(e) {
        const btn = e.target.closest('[data-action="cambiar-estado-usuario"]');
        if (!btn) return;

        e.preventDefault();

        const idUsuario = btn.dataset.usuarioId;
        const activo = btn.dataset.activo === '1';

        const accion = activo ? 'banear' : 'activar';

        try {
            await peticion(`/admin/usuario/${idUsuario}/${accion}`, {
                body: { idUsuario }
            });

            const nuevoActivo = !activo;

            btn.dataset.activo = nuevoActivo ? '1' : '0';

            btn.classList.remove(
                'text-warning',
                'text-success',
                'text-danger',
                'text-secondary'
            );

            btn.classList.add(nuevoActivo ? 'text-warning' : 'text-success');

            const icono = btn.querySelector('i');
            if (icono) {
                icono.className = 'bi bi-' + (nuevoActivo ? 'slash-circle' : 'arrow-counterclockwise');
            }

            const fila = btn.closest('tr');
            const badge = fila?.querySelector('.badge');

            if (badge) {
                badge.textContent = nuevoActivo ? 'Activo' : 'Inactivo';

                badge.className = nuevoActivo
                    ? 'badge text-bg-success-subtle text-success border border-success-subtle'
                    : 'badge text-bg-danger-subtle text-danger border border-danger-subtle';
            }

            mostrarNotificacion(
                nuevoActivo ? 'Usuario activado' : 'Usuario baneado',
                'success'
            );

        } catch (error) {
            mostrarNotificacion(error.message, 'danger');
        }
    });

    // Editar usuario
    const fEdUsuario=document.getElementById('formEdUsuario');
    if(fEdUsuario){
        fEdUsuario.addEventListener('submit',async function(e){
            e.preventDefault();
            const datos=Object.fromEntries(new FormData(this).entries());
            const id=datos.edIdUsuario;
            const datosFiltrados=Object.fromEntries(Object.entries(datos).filter(([_,v]) => v !== ''));            

            const fila = document.querySelector(`tr[data-id-usuarioT="${id}"]`);
            if (fila && datos.edNombreUsuario) {
                const celda = fila.querySelector('[data-nombre-usuarioT]');
                if (celda) celda.textContent = datos.edNombreUsuario;
            }

            try{
                await peticion(`/admin/usuario/${id}/editar`,{body:datos});
                const modal=bootstrap.Modal.getInstance(document.getElementById('modalEditarUsuario'));
                if(modal) modal.hide();
                mostrarNotificacion('Usuario editado correctamente','success');
                
            }catch(error){
                mostrarNotificacion(error.message,'danger');
            }
        });
    }

    // COMENTARIOS
    // Eliminar comentario (reportado)
    document.body.addEventListener('click',async function(e){
        const btn=e.target.closest('[data-action="eliminar-comentario"]');
        if(!btn) return;

        const idComentario=btn.dataset.idComentario;
        
        try{
            const respuesta=await peticion(`/admin/comentario/${idComentario}/eliminar`,{body:{idComentario}});
            const comentario=btn.closest('.comentario');
            comentario.remove();
            
            if(respuesta.recomendar_baneo){
                mostrarNotificacion('Comentario eliminado. Se recomienda baneo por acumular 3 comentarios borrados','warning');
            }
            else{
                mostrarNotificacion('Comentario eliminado correctamente','success');
            }
        }catch(error){
            mostrarNotificacion(error.message,'danger');
        }
    });

    // Revisar comentario (reportado)
    document.body.addEventListener('click', async function(e){
        const btn=e.target.closest('[data-action="revisar-comentario"]');
        if(!btn) return;

        const idComentario=btn.dataset.idComentario;

        try{
            await peticion(`/admin/comentario/${idComentario}/revisar`,{body:{idComentario}});
            const comentario=btn.closest('.comentario');
            comentario.remove();
            mostrarNotificacion('Comentario revisado correctamente','success');
        }catch(error){
            mostrarNotificacion(error.message,'danger');
        }
    });

    //Aprobar comentario (usuario sin moderar)
    document.body.addEventListener('click',async function(e){
        const btn=e.target.closest('[data-action="aprobar-comentario"]');

        if(!btn) return;

        const idComentario=btn.dataset.idComentario;

        try{
            await peticion(`/admin/comentario/${idComentario}/aprobar`,{body:{idComentario}});
            const tarjeta=btn.closest('.comentario');
            if(tarjeta) tarjeta.remove();
            mostrarNotificacion('Comentario aprobado correctamente: usuario marcado como fiable','success');
        }catch(error){
            mostrarNotificacion(error.message,'danger');
        }
    });

    //Rechazar comentario (usuario sin moderar)
    document.body.addEventListener('click', async function(e) {
        const btn = e.target.closest('[data-action="rechazar-comentario"]');
        if (!btn) return;
        const idComentario = btn.dataset.idComentario;
        try {
            await peticion(`/admin/comentario/${idComentario}/eliminar`, { body: { idComentario } });
            const tarjeta = btn.closest('.comentario');
            if (tarjeta) tarjeta.remove();
            mostrarNotificacion('Comentario rechazado', 'success');
        } catch (error) {
            mostrarNotificacion(error.message, 'danger');
        }
    });
});