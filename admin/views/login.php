<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Iniciar sesion administracion
    </h2>
    <div>
        <?= Alert::getAlerts(); ?>
    </div>
    <form method="POST" action="actions/auth/login.php">
        <div class="col-12 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>

        <div class="col-12 mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-success">Iniciar sesion</button>
    </form>
</section>