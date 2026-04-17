<main class="container py-4">
  <h1 class="h4 mb-3">Panel de Administración</h1>

  <div class="btn-group mb-4" role="group" id="admin-nav">
    <button type="button" class="btn btn-outline-primary active" data-target="sec-catalogo">Catálogo</button>
    <button type="button" class="btn btn-outline-primary" data-target="sec-autores">Autores</button>
    <button type="button" class="btn btn-outline-primary" data-target="sec-comunidad">Comunidad</button>
  </div>

  <div class="row g-4">
    
    <section id="sec-catalogo" class="admin-section col-12">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3 border-bottom">
          <div class="fw-bold text-uppercase small text-muted">Gestión de Catálogo</div>
          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalObraNueva">
            <i class="bi bi-plus-lg"></i> Añadir obra
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>Obra</th>
                  <th>Autor</th>
                  <th>Género</th>
                  <th>Año</th>
                  <th class="text-end">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($obras)): ?>
                  <?php foreach($obras as $obra): ?>
                    <tr>
                      <td class="fw-semibold"><?= $obra['titulo'] ?></td>
                      <td><?= $obra['autor'] ?></td>
                      <td><span class="badge bg-<?= strtolower($obra['genero']) ?> rounded-pill text-bg-light border"><?= $obra['genero'] ?></span></td>
                      <td><?= $obra['anio_publicacion'] ?></td>
                      <td class="text-end">
                        <button class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#modalEditarObra" data-idObra="<?= $obra['id'] ?>"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                      </td>
                    </tr>                
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center text-muted">No hay obras registradas</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <section id="sec-autores" class="admin-section col-12 d-none">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3 border-bottom">
          <div class="fw-bold text-uppercase small text-muted">Directorio de Autores</div>
          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAutorNuevo">
            <i class="bi bi-person-plus"></i> Nuevo Autor
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>Autor</th>
                  <th>Obras</th>
                  <th>Fecha de registro</th>
                  <th class="text-end">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($autores)):?>
                  <?php foreach($autores as $autor):?>
                    <tr>
                      <td class="fw-semibold"><?= $autor['nombre'] ?></td>
                      <td><?= Autor::contarObras($autor['id']) ?></td>
                      <td><?= $autor['fecha_registro'] ?></td>
                      <td class="text-end">
                        <button class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#modalEditarAutor" data-idAutor="<?= $autor['id']; ?>">Editar</button>
                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                      </td>
                    </tr>
                  <?php endforeach;?>
                <?php else:?>
                  <tr>
                    <td colspan="4" class="text-center text-muted">No hay autores registrados</td>
                  </tr>
                <?php endif;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <section id="sec-comunidad" class="admin-section col-12 d-none">
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white fw-bold py-3">Control de Usuarios</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm align-middle">
                  <thead>
                    <tr>
                      <th>Usuario</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th class="text-end">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($usuarios)) :?>
                      <?php foreach($usuarios as $usuario) :?>
                        <tr>
                          <td><span class="fw-bold"><?= $usuario['nombre_usuario'] ?></span><br><small class="text-muted"><?= $usuario['correo'] ?></small></td>
                          <td><?= $usuario['es_admin'] ? 'Administrador' : 'Usuario' ?></td>                          
                          <td><span class="badge text-bg-success-subtle text-<?= $usuario['activo'] ? 'success' : 'danger' ?> border border-<?= $usuario['activo'] ? 'success' : 'danger' ?>-subtle"><?= $usuario['activo'] ? 'Activo' : 'Inactivo' ?></span></td>
                          <td class="text-end">
                            <button class="btn btn-link text-secondary p-0 me-2"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-link text-<?= $usuario['activo'] ? 'warning' : 'primary' ?> p-0"><i class="bi bi-<?= $usuario['activo'] ? 'slash-circle' : 'arrow-counterclockwise' ?>"></i></button>
                          </td>
                        </tr>
                      <?php endforeach;?>
                    <?php endif;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white fw-bold py-3">Moderación de Comentarios</div>
            <div class="card-body">
              <div class="d-flex flex-column gap-3">
                <?php if(!empty($comentariosReportados)) :?>
                  <?php foreach($comentariosReportados as $comentario) :?>
                    <div class="p-3 border rounded bg-light-subtle">
                      <div class="d-flex justify-content-between">
                        <span class="fw-bold">@<?= $comentario['usuario'] ?></span>
                        <small class="text-muted fecha"><?= $comentario['fecha_comentario'] ?></small>
                      </div>
                      <p class="small mb-2 mt-1">"<?= $comentario['contenido'] ?>"</p>
                      <div class="d-flex gap-2 justify-content-end">
                        <button class="btn btn-sm btn-outline-danger">Borrar</button>
                        <button class="btn btn-sm btn-primary">Mantener</button>
                      </div>
                    </div>
                  <?php endforeach;?>
                <?php elseif(!empty($comentariosUsuariosSinModerar)) :?>
                  <?php foreach($comentariosUsuariosSinModerar as $comentario) :?>
                    <div class="p-3 border rounded bg-light-subtle">
                      <div class="d-flex justify-content-between">
                        <span class="fw-bold">@<?= $comentario['usuario'] ?></span>
                        <small class="text-muted fecha" data-fecha="<?= $comentario['fecha_comentario'] ?>"></small>
                      </div>
                      <p class="small mb-2 mt-1">"<?= $comentario['contenido'] ?>"</p>
                      <div class="d-flex gap-2 justify-content-end">
                        <button class="btn btn-sm btn-outline-danger">Rechazar</button>
                        <button class="btn btn-sm btn-primary">Aprobar</button>
                      </div>
                    </div>
                  <?php endforeach;?>
                <?php else :?>
                  <p class="text-muted">No hay comentarios por moderar.</p>
                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<div class="modal fade" id="modalObraNueva" tabindex="-1" aria-labelledby="newWorkTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="newWorkTitle">Añadir nueva obra</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formNewWork">
          <div class="row g-3">
            <div class="col-md-8">
              <label class="form-label fw-semibold">Título de la obra</label>
              <input type="text" name="titulo" class="form-control" placeholder="Ej: Cien años de soledad" required />
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Año de publicación</label>
              <input type="number" name="anio" class="form-control" value="2026" />
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Autor(es)</label>
              <select name="autores[]" class="form-select" multiple size="3" required>
                <option value="1">Isabel Torres</option>
                <option value="2">Marcos Gil</option>
                <option value="3">Elena Rivas</option>
              </select>
              <div class="form-text">Mantén Ctrl (o Cmd) para seleccionar varios.</div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Género(s)</label>
              <select name="generos[]" class="form-select" multiple size="3" required>
                <option value="1">Ficción</option>
                <option value="2">Ensayo</option>
                <option value="3">Historia</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label fw-semibold">URL de la Portada (Imagen)</label>
              <input type="text" name="imagen_url" class="form-control" placeholder="assets/img/portadas/ejemplo.jpg" />
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formNewWork" class="btn btn-primary">Guardar Obra</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditarObra" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h2 class="modal-title fs-5">Editar Obra</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEditWork">
          <input type="hidden" name="obra_id" value="1"> <div class="row g-3">
            <div class="col-md-9">
              <label class="form-label fw-semibold">Título</label>
              <input type="text" name="titulo" class="form-control" value="Nada" required />
            </div>
            <div class="col-md-3">
              <label class="form-label fw-semibold">Año</label>
              <input type="number" name="anio" class="form-control" value="2026" />
            </div>
            <div class="col-12">
              <label class="form-label fw-semibold">Modificar recurso (ruta)</label>
              <input type="text" name="pdfUrl" class="form-control" value="recursosPDF/LaCiudadSilenciosa.jpg" />
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Actualizar Autores</label>
              <select name="autores[]" class="form-select" multiple size="3">
                <option value="1" selected>Isabel Torres</option>
                <option value="2">Marcos Gil</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Actualizar Géneros</label>
              <select name="generos[]" class="form-select" multiple size="3">
                <option value="1" selected>Ficción</option>
                <option value="2">Ensayo</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Descartar</button>
        <button type="submit" form="formEditWork" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAutorNuevo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5">Nuevo Autor</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formNewAuthor">
          <div class="mb-3">
            <label class="form-label fw-semibold">Nombre Completo</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del autor" required />
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">URL Foto de Perfil</label>
            <input type="text" name="foto_url" class="form-control" placeholder="assets/img/autores/perfil.jpg" />
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Biografía</label>
            <textarea name="biografia" class="form-control" rows="4" placeholder="Breve reseña del autor..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formNewAuthor" class="btn btn-primary">Crear Autor</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditarAutor" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h2 class="modal-title fs-5">Modificar Perfil de Autor</h2>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEditAuthor">
          <input type="hidden" name="autor_id" value="1">
          <div class="mb-3">
            <label class="form-label fw-semibold">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="Isabel Torres" required />
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Imagen/Foto actual (URL)</label>
            <input type="text" name="foto_url" class="form-control" value="assets/img/isabel.jpg" />
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Biografía actualizada</label>
            <textarea name="biografia" class="form-control" rows="4">Escritora madrileña especializada en novela negra y ficción contemporánea.</textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" form="formEditAuthor" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>  

<script>
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
  });
</script>