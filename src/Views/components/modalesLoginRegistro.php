<?php if(!isset($_SESSION['id_usuario'])): ?>

<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="loginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h2 class="modal-title fs-5" id="">Acceder</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form action="/login" method="POST">
        <div class="modal-body">
            <div class="mb-3">
            <label for="emailLogin" class="form-label">Email</label>
            <input id="emailLogin" name="email" type="email" class="form-control" placeholder="tu@email.com" required />
            </div>
            <div class="mb-3">
            <label for="passLogin" class="form-label">Contraseña</label>
            <input id="passLogin" name="password" type="password" class="form-control" placeholder="••••••••" required />
            </div>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" value="1" id="recordarme" />
            <label class="form-check-label" for="recordarme">Recordarme</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
        </form>
    </div>
    </div>
</div>

<!-- Modal Registro -->
<div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="registerTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h2 class="modal-title fs-5" id="">Registro</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form action="/registro" method="POST">
        <div class="modal-body">
            <div class="mb-3">
            <label for="nombreC" class="form-label">Nombre completo</label>
            <input id="nombreC" name="nombre" type="text" class="form-control" placeholder="Tu nombre" required />
            </div>
            <div class="mb-3">
            <label for="nombreU" class="form-label">Nombre de usuario</label>
            <input id="nombreU" name="nombre_usuario" type="text" class="form-control" placeholder="usuario123" required />
            </div>
            <div class="mb-3">
            <label for="emailReg" class="form-label">Email</label>
            <input id="emailReg" name="email" type="email" class="form-control" placeholder="tu@email.com" required />
            </div>
            <div class="mb-3">
            <label for="passReg" class="form-label">Contraseña</label>
            <input id="passReg" name="password" type="password" class="form-control" placeholder="Mínimo 8 caracteres" required />
            <small class="form-text text-muted">Debe contener mayúscula, minúscula, número y símbolo</small>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="termsReg" required />
            <label class="form-check-label" for="termsReg">Acepto las condiciones</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Crear cuenta</button>
        </div>
        </form>
    </div>
    </div>
</div>

<?php endif; ?>
