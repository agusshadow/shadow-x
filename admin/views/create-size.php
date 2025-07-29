<section class="container">
  <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">Crear nuevo talle</h2>
  <form method="POST" action="actions/size/create.php">
    <div class="mb-3">
      <label for="size" class="form-label">Talle</label>
      <input type="number" class="form-control" id="size" name="size" required>
    </div>
    <div class="mb-3">
      <label for="gender" class="form-label">Género</label>
      <select class="form-select" id="gender" name="gender" required>
        <option value="Men">Masculino</option>
        <option value="Women">Femenino</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Crear talle</button>
  </form>
</section>
