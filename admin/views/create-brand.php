<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Crear Nueva Marca
    </h2>
    <form method="POST" action="actions/brand/create.php">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Crear marca</button>
        <a href="index.php?sec=admin-brands" class="btn btn-secondary">Cancelar</a>
    </form>
</section>
