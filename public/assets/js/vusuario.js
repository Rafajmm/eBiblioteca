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

    // Crear lista
    document.body.addEventListener('click',async function (e){
        const btnNL=e.target.closest('[data-action=crear-lista]');
        if(btnNL){
            const nombre = prompt('Nombre de la nueva lista:');
            if(!nombre || !nombre.trim()) return;
            try {
                await peticion('/lista/crear', {body:{nombre: nombre.trim(), descripcion: ''}});
                mostrarNotificacion('Lista creada', 'success');
                location.reload();
            } catch(error) { mostrarNotificacion(error.message, 'danger'); }
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
                const uploadResp = await fetch(`/usuario/${formData.get('id_usuario')}/subir-foto`, {
                    method: 'POST',
                    body: uploadData
                });
                const uploadResult = await uploadResp.json();
                if(uploadResult.ruta) formData.set('ruta_foto', uploadResult.ruta);
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

// Cambio de vista entre listas del usuario y listas seguidas
document.addEventListener('DOMContentLoaded', function() {
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
});