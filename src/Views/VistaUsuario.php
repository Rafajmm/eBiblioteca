<section class="card border-0 shadow-sm mb-5">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto text-center mb-3 mb-md-0">
                <?php
                    $rutaFoto=$usuario->getRutaFoto();
                    if($rutaFoto){
                        $rutaFoto="/".$rutaFoto;
                    }
                    else{ $rutaFoto="/assets/img/default/imgperfil.png"; }
                ?>
                <img src="<?= $rutaFoto ?>" 
                        alt="Avatar" class="rounded-circle border shadow-sm imgPerfil">
            </div>
            <div class="col-12 col-md">
                <h2 class="fw-bold mb-1" style="font-family: 'Merriweather', serif;"><?= $usuario->getNombre() ?></h2>
                <p class="text-muted mb-1">@<?= $usuario->getNombreUsuario() ?> · Miembro desde <?= date('Y', strtotime($usuario->getFechaRegistro())) ?></p>
                <p class="text-muted mb-3"><?= $usuario->getBio() ?></p>
                
                <div class="d-flex gap-4">
                    <button class="btn btn-link p-0 text-decoration-none text-primary text-center" id="btnSeguidores" aria-label="Ver <?= count($seguidores) ?> seguidores">
                        <span class="d-block h5 mb-0 fw-bold"><?= count($seguidores) ?></span>
                        <small class="text-uppercase" style="font-size: 0.7rem;">Seguidores</small>
                    </button>
                    <button class="btn btn-link p-0 text-decoration-none text-primary border-start ps-4" id="btnSeguidos" aria-label="Ver <?= count($seguidos) ?> seguidos">
                        <span class="d-block h5 mb-0 fw-bold"><?= count($seguidos) ?></span>
                        <small class="text-uppercase" style="font-size: 0.7rem;">Seguidos</small>
                    </button>
                    <div class="text-center border-start ps-4">
                        <span class="d-block h5 mb-0 fw-bold"><?= count($listas) ?></span>
                        <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Listas</small>
                    </div>
                </div>
            </div>                    
        </div>
    </div>
</section>

<div class="contenedorNavUsuario d-flex mb-5 shadow-sm">
    <button type="button" class="botonPildoraUsuario active" data-target="muro">
        <i class="bi bi-layout-text-window me-2"></i>Tablón
    </button>            
    <button type="button" class="botonPildoraUsuario" data-target="listas">
        <i class="bi bi-journal-bookmark me-2"></i>Listas
    </button>
    <?php if($esPerfilUsuario): ?>
        <button type="button" class="botonPildoraUsuario" data-target="perfil">
            <i class="bi bi-person-gear me-2"></i>Perfil
        </button>
    <?php endif; ?>
</div>

<section id="muro" class="seccion-usuario" aria-labelledby="titulo-actividad">
    <h2 id="titulo-actividad" class="h5 fw-bold mb-4"><i class="bi bi-broadcast me-2"></i>Actividad reciente</h2>
    <div class="row g-4">
        <a href=""></a>
        <?php if($tablon): ?>
            <?php foreach($tablon as $actividad): ?>
                <div class="col-12 col-lg-8">
                    <div class="bg-white p-4 rounded-4 shadow-sm border ">
                        <div class="d-flex gap-3">
                            <img src="https://ui-avatars.com/api/?name=<?= implode('+', explode('_', $actividad['actor'])) ?>" class="rounded-circle" width="40" height="40" alt="<?= htmlspecialchars($actividad['actor']) ?>">
                            <div>
                                <?php 
                                    switch($actividad['tipo']) {
                                        case 'lista':
                                            echo '<p class="mb-1"><strong>' . htmlspecialchars($actividad['actor']) . '</strong> ha creado la lista <a href="/lista/' . $actividad['id_objetivo'] . '" class="text-decoration-none"><strong>' . htmlspecialchars($actividad['objetivo']) . '</strong></a></p>';
                                            break;
                                        case 'comentario':
                                            echo '<p class="mb-1"><strong>' . htmlspecialchars($actividad['actor']) . '</strong> ha comentado en <a href="/obra/' . $actividad['id_objetivo'] . '" class="text-decoration-none"><strong>' . htmlspecialchars($actividad['objetivo']) . '</strong></a></p>';
                                            break;
                                        case 'puntuacion':
                                            echo '<p class="mb-1"><strong>' . htmlspecialchars($actividad['actor']) . '</strong> ha puntuado <a href="/obra/' . $actividad['id_objetivo'] . '" class="text-decoration-none"><strong>' . htmlspecialchars($actividad['objetivo']) . '</strong></a></p>';
                                            break;
                                        case 'seguidor':
                                            echo '<p class="mb-1"><strong>' . htmlspecialchars($actividad['actor']) . '</strong> ha seguido a <a href="/usuario/' . $actividad['id_objetivo'] . '" class="text-decoration-none"><strong>@' . htmlspecialchars($actividad['objetivo']) . '</strong></a></p>';
                                            break;
                                    }
                                ?>
                                <time class="text-muted small fecha" datetime="PT10M" data-fecha="<?= $actividad['fecha'] ?>"></time>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 col-lg-8">
                <div class="bg-white p-4 rounded-4 shadow-sm border mb-3">
                    <div class="d-flex gap-3">                        
                        <div>
                            <p class="mb-1">No hay actividad reciente.</p>
                            <time class="text-muted small" datetime="PT10M"></time>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="seguidos" class="seccion-usuario d-none">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Seguidos</h5>
        <div class="input-group input-group-sm" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Buscar entre tus seguidos...">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        </div>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <?php if(!empty($seguidos)): ?>
            <?php foreach($seguidos as $seguido): ?>
                <?php
                    $soyYo=($id_sesion!==null && $id_sesion==$seguido->getId());

                    $loSigo=false;
                    if($id_sesion && !$soyYo){
                        if($esPerfilUsuario){
                            $loSigo=true;
                        }
                        elseif(isset($actor)){
                            $loSigo=$actor->esSeguido($seguido->getId());
                        }
                    }
                ?>
                <div class="col">                    
                    <div class="d-flex align-items-center justify-content-between gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <?php $imagenSeguido = $seguido->getRutaFoto() ? "/" . $seguido->getRutaFoto() : "/assets/img/default/imgperfil.png"; ?>
                        <a class="text-decoration-none text-dark w-100" href="/usuario/<?= $seguido->getId() ?>">
                            <div class="d-flex align-items-center gap-3">
                                <img src="<?= $imagenSeguido ?>" class="rounded-circle" width="50">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="mb-0 text-truncate"><?= htmlspecialchars($seguido->getNombre()) ?></h6>
                                    <small class="text-muted">@<?= htmlspecialchars($seguido->getNombreUsuario()) ?></small>
                                </div>
                            </div>
                        </a>
                        <?php if($soyYo) : ?>
                            <span class="badge badge-secondary rounded-pill px-3">Tú</span>
                        <?php elseif(!$id_sesion) :?>
                            <button class="btn btn-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Seguir</button>
                        <?php elseif($esPerfilUsuario) : ?>
                            <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-person-x-fill"></i></button>
                        <?php else: ?>
                            <?php if($loSigo): ?>
                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3" style="font-size: 0.75rem;">Siguiendo</button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-primary rounded-pill px-3" style="font-size: 0.75rem;">Seguir</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <p>Aún no hay seguido ningún usuario</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="seguidores" class="seccion-usuario d-none">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Seguidores</h5>
        <div class="input-group input-group-sm" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Buscar entre tus seguidores...">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        </div>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <?php if(!empty($seguidores)): ?>
            <?php foreach($seguidores as $seguidor): ?>
                <?php
                    $soyYo=($id_sesion!==null && $id_sesion==$seguidor->getId());

                    $loSigo=false;
                    if($id_sesion && !$soyYo){
                        if($esPerfilUsuario){
                            $loSigo=$usuario->esSeguido($seguidor->getId());
                        }
                        elseif(isset($actor)){
                            $loSigo=$actor->esSeguido($seguidor->getId());
                        }
                    }
                ?>
                <div class="col">                    
                    <div class="d-flex align-items-center justify-content-between gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <?php
                            $imagenSeguidor = $seguidor->getRutaFoto() ? "/" . $seguidor->getRutaFoto() : "/assets/img/default/imgperfil.png";
                        ?>
                        <a class="text-decoration-none text-dark w-100" href="/usuario/<?= $seguidor->getId() ?>">
                            <div class="d-flex align-items-center gap-3">
                                <img src="<?= $imagenSeguido ?>" class="rounded-circle" width="50">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="mb-0 text-truncate"><?= htmlspecialchars($seguidor->getNombre()) ?></h6>
                                    <small class="text-muted">@<?= htmlspecialchars($seguidor->getNombreUsuario()) ?></small>
                                </div>
                            </div>
                        </a>
                        <?php if($soyYo): ?>
                            <span class="badge bg-secondary rounded-pill px-3">Tú</span>
                        <?php elseif(!$id_sesion): ?>
                            <button class="btn btn-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Seguir</button>
                        <?php elseif($esPerfilUsuario): ?>
                            <?php if($loSigo): ?>
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Siguiendo</button>
                            <?php else: ?>
                                <button class="btn btn-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Seguir</button>
                            <?php endif; ?>
                            <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-person-x-fill"></i></button>
                        
                        <?php else: ?>
                            <?php if($loSigo): ?>
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Siguiendo</button>
                            <?php else: ?>
                                <button class="btn btn-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Seguir</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>                    
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <p>Aún no hay seguidores</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="listas" class="seccion-usuario d-none">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="h4 fw-bold mb-0 fuenteSerif">Tus Listas de Lectura</h3>
        <button class="btn btn-dark rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i>Nueva Lista
        </button>
    </div>
    <div class="row g-4">
        <?php if(!empty($listas)):?>
            <?php foreach($listas as $lista): ?>
            <div class="col-12 col-md-4  col-xl-3">
                <a href="/lista/<?= $lista['id'] ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden tarjetaListaPerfil">
                        <div class="card-body">
                            <h6 class="fw-bold mb-0"><?= $lista['nombre'] ?></h6>
                            <small class="text-muted"><?= count(Lista::obtenerObrasPorId($lista['id'])) ?> títulos</small>
                            <div class="carousel slide mt-3" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php 
                                    $obrasLista = Lista::obtenerObrasPorId($lista['id']);
                                    $contador = 0;
                                    foreach($obrasLista as $obraLista):
                                        $obra = Obra::crearInstancia($obraLista['id_obra']);
                                        if(!$obra) continue;
                                        
                                        $portada = $obra->getPortada() 
                                            ? "https://covers.openlibrary.org/b/olid/" . $obra->getPortada() . "-M.jpg"
                                            : "/assets/img/default/imgportada.jpg";
                                    ?>
                                    <div class="carousel-item <?= $contador === 0 ? 'active' : '' ?>">
                                        <img src="<?= $portada ?>" 
                                            class="d-block w-100 rounded imagenPortadaLista" 
                                            alt="<?= htmlspecialchars($obra->getTitulo()) ?>">
                                    </div>
                                    <?php $contador++; endforeach; ?>
                                </div>                                                           
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <p>Aún no hay listas</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if($esPerfilUsuario): ?>
    <section id="perfil" class="seccion-usuario d-none">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_usuario" value="">

                            <h3 class="h5 fw-bold mb-4">Información Pública</h3>
                            
                            <div class="d-flex align-items-center gap-4 mb-4">
                                <img src="https://ui-avatars.com/api/?name=Nombre+Usuario" class="rounded-circle border" width="80" id="imgPrevia">
                                <div>
                                    <label class="form-label small fw-bold">Foto de perfil</label>
                                    <input type="file" class="form-control form-control-sm" name="avatar" accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold">Nombre de Usuario (Username)</label>
                                <input type="text" name="nombre" class="form-control" value="" placeholder="@usuario">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold">Biografía</label>
                                <textarea class="form-control" name="bio" rows="3" placeholder="Cuéntanos qué te gusta leer..."></textarea>
                            </div>

                            <hr class="my-4">

                            <h3 class="h5 fw-bold mb-4 text-danger">Seguridad y Cuenta</h3>
                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Correo electrónico</label>
                                <input type="email" name="email" class="form-control" value="maria@ejemplo.com">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nueva Contraseña</label>
                                    <input type="password" name="pass_nueva" class="form-control" placeholder="Dejar en blanco para no cambiar">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Repetir Contraseña</label>
                                    <input type="password" name="pass_repite" class="form-control" placeholder="Repite la nueva contraseña">
                                </div>
                            </div>

                            <div class="bg-light p-3 rounded-3 mb-4 border">
                                <label class="form-label small fw-bold text-dark">Confirmar cambios con contraseña actual</label>
                                <input type="password" name="pass_actual" class="form-control" placeholder="Introduce tu contraseña para validar" required>
                            </div>

                            <div class="d-grid d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary px-5 rounded-pill">
                                    <i class="bi bi-check2-circle me-2"></i>Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<script>        
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
});
</script>