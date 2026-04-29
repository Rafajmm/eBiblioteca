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
                      <td><span class="badge bg-<?= strtolower($obra['genero']) ?> rounded-pill border"><?= $obra['genero'] ?></span></td>
                      <td><?= $obra['anio_publicacion'] ?></td>
                      <td class="text-end">
                        <?php
                          $instancia=Obra::crearInstancia($obra['id']);
                          $autoresObra=$instancia ? $instancia->obtenerAutores() : [];
                          $etiquetasObra=$instancia ? $instancia->obtenerEtiquetas() : [];

                          $idsAutores=!empty($autoresObra) ? array_map(fn($a)=>(int)$a['id'],$autoresObra) : [];
                          $idEtiquetas=!empty($etiquetasObra) ? array_map(fn($e)=>(int)$e['id'],$etiquetasObra) : [];
                        ?> 
                        <button type="button" 
                          class="btn btn-sm btn-light border" 
                          data-bs-toggle="modal" 
                          data-bs-target="#modalEditarObra" 
                          data-id-obra="<?= (int)$obra['id'] ?>"
                          data-titulo="<?= $obra['titulo'] ?>"
                          data-anio="<?= $obra['anio_publicacion'] ?>"
                          data-paginas="<?= $obra['paginas'] ?>"
                          data-genero="<?= $obra['genero'] ?>"
                          data-sinopsis="<?= $obra['sinopsis'] ?>"
                          data-autores="<?= json_encode($idsAutores) ?>"
                          data-etiquetas="<?= json_encode($idEtiquetas) ?>"
                          >
                          <i class="bi bi-pencil"></i>
                        </button>
                        <?php if(!$obra['fecha_borrado']): ?>
                        <button class="btn btn-sm btn-outline-danger"
                          data-action="eliminar-obra"
                          data-id-obra="<?= (int)$obra['id'] ?>"
                        ><i class="bi bi-trash"></i></button>
                        <?php else: ?>
                          <button class="btn btn-sm btn-outline-success"
                          data-action="activar-obra"
                          data-id-obra="<?= (int)$obra['id'] ?>"
                          ><i class="bi bi-arrow-counterclockwise"></i></button>
                        <?php endif; ?>
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
                    <tr data-id-autorT="<?= $autor['id'] ?>">
                      <td class="fw-semibold edNombre"
                      data-nombre-autorT="<?= $autor['nombre'] ?>"><?= $autor['nombre'] ?></td>
                      <td><?= Autor::contarObras($autor['id']) ?></td>
                      <td><?= $autor['fecha_registro'] ?></td>
                      <td class="text-end">
                        <button type="button" 
                          class="btn btn-sm btn-light border" 
                          data-bs-toggle="modal" 
                          data-bs-target="#modalEditarAutor" 
                          data-id-autor="<?= $autor['id'] ?>"
                          data-nombre="<?= $autor['nombre'] ?>"
                          data-pais="<?= $autor['pais'] ?>"
                          data-fecha-nacimiento="<?= $autor['fecha_nacimiento'] ?>"
                          data-biografia="<?= $autor['biografia'] ?>"
                          >
                          <i class="bi bi-pencil"></i>
                        </button>
                        <?php if(!$autor['fecha_borrado']): ?>
                          <button type="button" class="btn btn-sm btn-outline-danger"
                          data-action="eliminar-autor"
                          data-id-autor="<?= $autor['id'] ?>"><i class="bi bi-trash"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-sm btn-outline-success"
                          data-action="activar-autor"
                          data-id-autor="<?= $autor['id'] ?>"><i class="bi bi-arrow-counterclockwise"></i></button>
                        <?php endif; ?>
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
                        <tr data-id-usuarioT="<?= $usuario['id'] ?>">
                          <td data-nombre-usuarioT="<?= $usuario['nombre_usuario'] ?>"><span class="fw-bold"><?= $usuario['nombre_usuario'] ?></span><br><small class="text-muted"><?= $usuario['correo'] ?></small></td>
                          <td><?= $usuario['es_admin'] ? 'Administrador' : 'Usuario' ?></td>                          
                          <td><span class="badge text-bg-success-subtle text-<?= $usuario['activo'] ? 'success' : 'danger' ?> border border-<?= $usuario['activo'] ? 'success' : 'danger' ?>-subtle"><?= $usuario['activo'] ? 'Activo' : 'Inactivo' ?></span></td>
                          <td class="text-end">
                            <button
                              type="button"
                              class="btn btn-link text-secondary p-0 me-2"
                              data-bs-toggle="modal"
                              data-bs-target="#modalEditarUsuario"
                              data-id-usuario="<?= (int)$usuario['id'] ?>"
                              data-nombre="<?= htmlspecialchars($usuario['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                              data-nombre-usuario="<?= htmlspecialchars($usuario['nombre_usuario'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                              data-correo="<?= htmlspecialchars($usuario['correo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                              data-bio="<?= htmlspecialchars($usuario['bio'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                              data-ruta-foto="<?= htmlspecialchars($usuario['ruta_foto'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                              title="Editar usuario"
                            >
                              <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-link text-<?= $usuario['activo'] ? 'warning' : 'success' ?> p-0"
                              data-action="cambiar-estado-usuario"
                              data-usuario-id="<?= (int)$usuario['id'] ?>"
                              data-activo="<?= $usuario['activo'] ? '1' : '0' ?>"
                            ><i class="bi bi-<?= $usuario['activo'] ? 'slash-circle' : 'arrow-counterclockwise' ?>"></i></button>
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
                    <div class="p-3 border rounded bg-light-subtle comentario">
                      <div class="d-flex justify-content-between">
                        <span class="fw-bold">@<?= $comentario['usuario'] ?></span>
                        <small class="text-muted fecha"><?= $comentario['fecha_comentario'] ?></small>
                      </div>
                      <p class="small mb-2 mt-1">"<?= $comentario['contenido'] ?>"</p>
                      <div class="d-flex gap-2 justify-content-end">
                        <button class="btn btn-sm btn-outline-danger"
                        data-action="eliminar-comentario"
                        data-id-comentario="<?= $comentario['id'] ?>">Borrar</button>
                        <button class="btn btn-sm btn-primary"
                        data-action="revisar-comentario"
                        data-id-comentario="<?= $comentario['id'] ?>">Mantener</button>
                      </div>
                    </div>
                  <?php endforeach;?>
                <?php endif;?>
                <?php if(!empty($comentariosUsuariosSinModerar)) :?>
                  <?php foreach($comentariosUsuariosSinModerar as $comentario) :?>
                    <div class="p-3 border rounded bg-light-subtle comentario">
                      <div class="d-flex justify-content-between">
                        <span class="fw-bold">@<?= $comentario['usuario'] ?></span>
                        <small class="text-muted fecha" data-fecha="<?= $comentario['fecha_comentario'] ?>"></small>
                      </div>
                      <p class="small mb-2 mt-1">"<?= $comentario['contenido'] ?>"</p>
                      <div class="d-flex gap-2 justify-content-end">
                        <button class="btn btn-sm btn-outline-danger"
                        data-action="rechazar-comentario"
                        data-id-comentario="<?= $comentario['id'] ?>">Rechazar</button>
                        <button class="btn btn-sm btn-primary"
                        data-action="aprobar-comentario"
                        data-id-comentario="<?= $comentario['id'] ?>">Aprobar</button>
                      </div>
                    </div>
                  <?php endforeach;?>
                <?php endif;?>
                <?php if(empty($comentariosReportados) && empty($comentariosUsuariosSinModerar)) :?>
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

<div class="modal fade" id="modalObraNueva" tabindex="-1" aria-labelledby="obraNuevaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="obraNuevaLabel">Añadir nueva obra</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formObraNueva" action="/admin/obra/crear" method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            
            <div class="col-md-8">
              <label class="form-label fw-semibold">Título de la obra</label>
              <input type="text" name="titulo" class="form-control" placeholder="Ej: Don Quijote" required />
            </div>

            <div class="col-md-4">
              <label class="form-label fw-semibold">Año de publicación</label>
              <input type="number" name="anio" class="form-control" value="2026" required/>
            </div>

            <div class="col-md-4">
              <label class="form-label fw-semibold">Páginas</label>
              <input type="number" name="pagina" class="form-control" placeholder="350" required/>
            </div>

            <div class="col-md-8">
              <label class="form-label fw-semibold">Género principal</label>
              <select name="genero" class="form-select" required>
                <option value="" selected disabled>Selecciona...</option>
                <option value="Narrativa">Narrativa</option>
                <option value="Ensayo">Ensayo</option>
                <option value="Poesía">Poesía</option>
                <option value="Teatro">Teatro</option>
                <option value="Infantil">Infantil</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Autor(es)</label>
              <select name="autores[]" class="form-select" multiple size="6">
                <?php foreach($autores as $autor):?>
                  <option value="<?=$autor['id']?>"><?=$autor['nombre']?></option>
                <?php endforeach;?>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Etiquetas</label>
              <select name="etiquetas[]" class="form-select" multiple size="6">
                <?php foreach($etiquetas as $etiqueta):?>
                  <option value="<?=$etiqueta->getId()?>"><?=$etiqueta->getNombre()?></option>
                <?php endforeach;?>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label fw-semibold">Sinopsis</label>
              <textarea name="sinopsis" class="form-control" rows="6"></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Archivo PDF</label>
              <input type="file" name="archivo_pdf" class="form-control" accept=".pdf" />
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Archivo ePub</label>
              <input type="file" name="archivo_epub" class="form-control" accept=".epub" />
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formObraNueva" class="btn btn-primary">Guardar Obra</button>
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
        <form id="formEdObra" action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="idObra" id="edIdObra" value=""> 
          
          <div class="row g-3">
            <div class="col-md-9">
              <label class="form-label fw-semibold">Título</label>
              <input type="text" name="titulo" id="edTitulo" class="form-control" placeholder=""/>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-semibold">Año</label>
              <input type="number" name="anio" id="edAnio" class="form-control" />
            </div>

            <div class="col-md-4">
              <label class="form-label fw-semibold">Páginas</label>
              <input type="number" name="pagina" id="edPagina" class="form-control" />
            </div>

            <div class="col-md-8">
              <label class="form-label fw-semibold">Género principal</label>
              <select name="genero" id="edGenero" class="form-select">
                <option value="Narrativa">Narrativa</option>
                <option value="Ensayo">Ensayo</option>
                <option value="Poesía">Poesía</option>
                <option value="Teatro">Teatro</option>
                <option value="Infantil">Infantil</option>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label fw-semibold">Sinopsis</label>
              <textarea name="sinopsis" id="edSinopsis" class="form-control" rows="6"></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Actualizar PDF (Opcional)</label>
              <input type="file" name="archivo_pdf" class="form-control" accept=".pdf" />
              <small class="text-muted">Solo si desea sustituir el actual</small>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Actualizar ePub (Opcional)</label>
              <input type="file" name="archivo_epub" class="form-control" accept=".epub" />
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Autores</label>
              <select name="autores_actualizar[]" id="edAutores" class="form-select" multiple size="6">
                <?php foreach($autores as $autor): ?>
                  <option value="<?= $autor['id'] ?>"><?= $autor['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="form-text small text-primary">Se sustituirán los autores actuales por los seleccionados.</div>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Etiquetas</label>
              <select name="etiquetas_actualizar[]" id="edEtiquetas" class="form-select" multiple size="6">
                <?php foreach($etiquetas as $etiqueta): ?>
                  <option value="<?= $etiqueta->getId() ?>"><?= $etiqueta->getNombre() ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Descartar</button>
        <button type="submit" form="formEdObra" class="btn btn-primary">Guardar Cambios</button>
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
        <form id="formAutorNuevo">
          <div class="mb-3">
            <label class="form-label fw-semibold">Nombre Completo</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del autor" required />
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">País</label>
            <input type="text" name="pais" class="form-control" placeholder="País de origen" required/>
          </div>
          <div class="mb-3">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fechaNacimiento" class="form-control" required/>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Biografía</label>
            <textarea name="biografia" class="form-control" rows="4" placeholder="Breve reseña del autor..." required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formAutorNuevo" class="btn btn-primary">Crear Autor</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditarAutor" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-light">
        <h2 class="modal-title fs-5">Editar autor</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEdAutor" action="" method="POST">
          <input type="hidden" name="edIdAutor" id="edIdAutor">

          <div class="mb-3">
            <label class="form-label fw-semibold">Nombre</label>
            <input type="text" name="edNombreAutor" id="edNombreAutor" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">País</label>
            <input type="text" name="edPais" id="edPais" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Fecha de nacimiento</label>
            <input type="date" name="edFechaNacimiento" id="edFechaNacimiento" class="form-control">
          </div>          

          <div class="mb-3">
            <label class="form-label fw-semibold">Biografía</label>
            <textarea name="edBiografia" id="edBiografia" class="form-control" rows="4"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formEdAutor" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-light">
        <h2 class="modal-title fs-5">Editar usuario</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEdUsuario" action="/usuarios/editar" method="POST">
          <input type="hidden" name="edIdUsuario" id="edIdUsuario">

          <div class="mb-3">
            <label class="form-label fw-semibold">Nombre</label>
            <input type="text" name="edNombre" id="edNombre" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Nombre de usuario</label>
            <input type="text" name="edNombreUsuario" id="edNombreUsuario" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Correo</label>
            <input type="email" name="edCorreo" id="edCorreo" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Bio</label>
            <textarea name="edBio" id="edBio" class="form-control" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Ruta foto</label>
            <input type="text" name="edRutaFoto" id="edRutaFoto" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Nueva contraseña</label>
            <input type="password" name="edPass" id="edPass" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formEditUser" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<script type="module" src="/assets/js/admin.js"></script>