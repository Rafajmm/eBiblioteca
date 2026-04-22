document.addEventListener('DOMContentLoaded', function() {
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
            const titulo=button.getAttribute('data-titulo' || '');
            const anio=button.getAttribute('data-anio' || '');
            const pagina=button.getAttribute('data-paginas' || '');
            const genero=button.getAttribute('data-genero' || '');
            const sinopsis=button.getAttribute('data-sinopsis' || '');
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

            seleccionarMultiple(document.getElementById('edAutores'),autores);
            seleccionarMultiple(document.getElementById('edEtiquetas'),etiquetas);            
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
