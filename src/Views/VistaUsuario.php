<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Perfil de usuario en eBiblioteca. Gestiona tus listas de lectura, seguidores y actividad reciente.">
    <title>eBiblioteca · Perfil</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="/assets/css/ebiblioteca.css" rel="stylesheet" />
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/src/Components/header.php'); ?>

    <main class="container-fluid py-4 px-md-5">
        
        <section class="card border-0 shadow-sm mb-5">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-12 col-md-auto text-center mb-3 mb-md-0">
                        <img src="https://ui-avatars.com/api/?name=Usuario+Ejemplo&background=198754&color=fff&size=150" 
                             alt="Avatar" class="rounded-circle border shadow-sm">
                    </div>
                    <div class="col-12 col-md">
                        <h2 class="fw-bold mb-1" style="font-family: 'Merriweather', serif;">Nombre Usuario</h2>
                        <p class="text-muted mb-3">@nombre_usuario · Miembro desde 2024</p>
                        
                        <div class="d-flex gap-4">
                            <button class="btn btn-link p-0 text-decoration-none text-primary text-center" id="btnSeguidores" aria-label="Ver 124 seguidores">
                                <span class="d-block h5 mb-0 fw-bold">124</span>
                                <small class="text-uppercase" style="font-size: 0.7rem;">Seguidores</small>
                            </button>
                            <button class="btn btn-link p-0 text-decoration-none text-primary border-start ps-4" id="btnSeguidos" aria-label="Ver 89 seguidos">
                                <span class="d-block h5 mb-0 fw-bold">89</span>
                                <small class="text-uppercase" style="font-size: 0.7rem;">Seguidos</small>
                            </button>
                            <div class="text-center border-start ps-4">
                                <span class="d-block h5 mb-0 fw-bold">5</span>
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
            <button type="button" class="botonPildoraUsuario" data-target="perfil">
                <i class="bi bi-person-gear me-2"></i>Perfil
            </button>
        </div>

        <section id="muro" class="seccion-usuario" aria-labelledby="titulo-actividad">
            <h2 id="titulo-actividad" class="h5 fw-bold mb-3"><i class="bi bi-broadcast me-2"></i>Actividad reciente</h2>
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="bg-white p-4 rounded-4 shadow-sm border mb-3">
                        <div class="d-flex gap-3">
                            <img src="https://ui-avatars.com/api/?name=Isabel+Torres" class="rounded-circle" width="40" height="40" alt="Isabel Torres">
                            <div>
                                <p class="mb-1"><strong>Isabel Torres</strong> ha creado la lista <strong>"Misterios de Invierno"</strong></p>
                                <time class="text-muted small" datetime="PT10M">hace 10 minutos</time>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="col">
                    <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Isabel+Torres&background=random" class="rounded-circle" width="50">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-0 text-truncate">Isabel Torres</h6>
                            <small class="text-muted">@isabel_writer</small>
                        </div>
                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-person-x-fill"></i></button>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Carlos+Ruiz&background=random" class="rounded-circle" width="50">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-0 text-truncate">Carlos Ruiz</h6>
                            <small class="text-muted">@carlos_lector</small>
                        </div>
                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-person-x-fill"></i></button>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Elena+Pueyo&background=random" class="rounded-circle" width="50">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-0 text-truncate">Elena Pueyo</h6>
                            <small class="text-muted">@elena_filo</small>
                        </div>
                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-person-x-fill"></i></button>
                    </div>
                </div>                
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
                <div class="col">
                    <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Roberto+Gomez&background=random" class="rounded-circle" width="50">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-0 text-truncate">Roberto Gómez</h6>
                            <small class="text-success" style="font-size: 0.7rem;"><i class="bi bi-arrow-left-right me-1"></i> Os seguís</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger small" href="#">Bloquear</a></li>
                                <li><a class="dropdown-item small" href="#">Ver perfil</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Lucia+Martos&background=random" class="rounded-circle" width="50">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-0 text-truncate">Lucía Martos</h6>
                            <small class="text-muted">Te sigue desde enero</small>
                        </div>
                        <button class="btn btn-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Seguir</button>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded-4 shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Admin+Reader&background=random" class="rounded-circle" width="50">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-0 text-truncate">Admin Reader</h6>
                            <small class="text-muted">@admin_ebiblio</small>
                        </div>
                        <button class="btn btn-primary btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Seguir</button>
                    </div>
                </div>
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
                <div class="col-12 col-md-4">
                    <a href="VistaLista.php" class="text-decoration-none">
                        <div class="card tarjetaLibro border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="p-5 bg-primary text-white text-center">
                                <i class="bi bi-heart-fill fs-1"></i>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-0">Favoritos</h6>
                                <small class="text-muted">2 títulos</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

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

    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>