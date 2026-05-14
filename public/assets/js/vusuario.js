import {peticion, mostrarNotificacion} from './utilidades.js';

document.addEventListener('DOMContentLoaded', function() {       
    const botones= document.querySelectorAll('.botonPildoraUsuario');    
    const secciones= document.querySelectorAll('.seccion-usuario');
    const btnSeguidores= document.getElementById('btnSeguidores');
    const btnSeguidos= document.getElementById('btnSeguidos')

    function cambiarSeccion(targetId){
        botones.forEach(b => b.classList.remove('active'));
        const botonActual=document.querySelector(`.botonPildoraUsuario[data-target="${targetId}"]`);
        if(botonActual) botonActual.classList.add('active');

        secciones.forEach(s => s.classList.add('d-none'));
        document.getElementById(targetId).classList.remove('d-none');
    }

    botones.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            cambiarSeccion(targetId);
        });
    });

    btnSeguidores.addEventListener('click', function(){
        cambiarSeccion('seguidores');
    });

    btnSeguidos.addEventListener('click', function(){
        cambiarSeccion('seguidos');
    });

    // Buscar entre seguidos/seguidores
    const inputSeguidos=document.getElementById('buscarSeguidos');
    const inputSeguidores=document.getElementById('buscarSeguidores')
    if(inputSeguidos){
        inputSeguidos.addEventListener('input',function(){
            const filtro=this.value.toLowerCase().trim();
            const tarjetas=this.closest('section').querySelectorAll('.col');
            tarjetas.forEach(tarjeta=>{
                const nombre=tarjeta.querySelector('h6').textContent.toLowerCase();
                const nombreUsuario=tarjeta.querySelector('small').textContent.toLowerCase().replace('@', '');
                tarjeta.classList.toggle('d-none', !(!filtro || nombre.includes(filtro) || nombreUsuario.includes(filtro)));
            })
        });
    }
    if(inputSeguidores){
        inputSeguidores.addEventListener('input',function(){
            const filtro=this.value.toLowerCase().trim();
            const tarjetas=this.closest('section').querySelectorAll('.col');
            tarjetas.forEach(tarjeta=>{
                const nombre=tarjeta.querySelector('h6').textContent.toLowerCase();
                const nombreUsuario=tarjeta.querySelector('small').textContent.toLowerCase().replace('@', '');
                tarjeta.classList.toggle('d-none', !(!filtro || nombre.includes(filtro) || nombreUsuario.includes(filtro)));
            })
        });
    }

    // Cambio de vista entre listas del usuario y listas seguidas
    const dropdownItems = document.querySelectorAll('[data-view]');
    const contenedorPropias = document.getElementById('listasPropias');
    const contenedorSeguidas = document.getElementById('listasSeguidas');
    const tituloView = document.getElementById('tituloListasView');

    if (!dropdownItems.length) return;

    function cambiarVistaListas(view) {
        if (view === 'propias') {
            contenedorPropias.classList.remove('d-none');
            contenedorSeguidas.classList.add('d-none');
            if (tituloView) tituloView.textContent = 'Tus listas';
        } else if (view === 'seguidas') {
            contenedorPropias.classList.add('d-none');
            contenedorSeguidas.classList.remove('d-none');
            if (tituloView) tituloView.textContent = 'Listas seguidas';
        }
    }

    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const view = this.dataset.view;
            cambiarVistaListas(view);
        });
    });

    // Crear lista
    const modalCrearLista = document.getElementById('modalCrearLista');
    if(modalCrearLista){
        const inputNombre = document.getElementById('nombreNuevaLista');
        const inputDesc = document.getElementById('descNuevaLista');
        const btnCrear = document.getElementById('btnCrearLista');

        modalCrearLista.addEventListener('show.bs.modal', function(){
            inputNombre.value = '';
            inputDesc.value = '';
        });

        btnCrear.addEventListener('click', async function(){
            const nombre = inputNombre.value.trim();
            if(!nombre){
                mostrarNotificacion('El nombre es obligatorio', 'warning');
                return;
            }
            btnCrear.disabled = true;
            try {
                await peticion('/lista/crear', {body:{nombre, descripcion: inputDesc.value.trim()}});
                mostrarNotificacion('Lista creada', 'success');
                bootstrap.Modal.getInstance(modalCrearLista).hide();
                location.reload();
            } catch(error) { mostrarNotificacion(error.message, 'danger'); }
            finally { btnCrear.disabled = false; }
        });
    }

    // Eliminar lista
    document.body.addEventListener('click',async function(e){
        const btnEliminarLista=e.target.closest('[data-action="eliminar-lista"]');
        if(!btnEliminarLista) return;
        e.preventDefault();
        e.stopPropagation();

        if(!confirm('¿Estás seguro de que quieres eliminar esta lista?')) return;

        const idLista=btnEliminarLista.dataset.idLista;

        try{
            await peticion(`/lista/${idLista}/eliminar`,{body:{idLista}});
            const tarjeta=btnEliminarLista.closest('.col-12');
            if(tarjeta) tarjeta.remove();

            mostrarNotificacion('Lista eliminada','success');
        }
        catch(error){
            mostrarNotificacion(error.message,'danger');
        }
    });

    // Editar perfil
    const formPerfil = document.querySelector('#formPerfil');
    if(formPerfil){
        formPerfil.addEventListener('submit', async function(e){
            e.preventDefault();
            const formData = new FormData(this);
            
            const fileInput = this.querySelector('[name="avatar"]');
            if(fileInput.files.length > 0){
                const uploadData = new FormData();
                uploadData.append('avatar', fileInput.files[0]);
                try{
                    const uploadResp = await peticion(`/usuario/${formData.get('id_usuario')}/subir-foto`, { body: uploadData });
                    if(uploadResp.ruta) formData.set('ruta_foto', uploadResp.ruta);
                } catch(error) {
                    mostrarNotificacion(error.message, 'danger');
                    return;
                }
            }
            
            const correoCambiado = formData.get('correo')?.trim() !== '';
            const passCambiado = formData.get('pass_nueva')?.trim() !== '';
            if((correoCambiado || passCambiado) && !formData.get('pass_confirmacion')?.trim()){
                mostrarNotificacion('Debes introducir tu contraseña actual para cambios de seguridad', 'warning');
                return;
            }
            
            const datos = Object.fromEntries(formData.entries());
            try {
                await peticion(`/usuario/${datos.id_usuario}/editar`, {body: datos});
                mostrarNotificacion('Perfil actualizado', 'success');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            } catch(error) { mostrarNotificacion(error.message, 'danger'); }
        });
    }
});