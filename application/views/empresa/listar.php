
<div class="row">
    <h2>Elija una empresa para ver sus empleados</h2>
    <div class="col-md-12">
        <form method="POST" action="buscar_empleados" >
            <label for="nombre_empresa">Empresa</label>
            <select class="form-control" name="id_empresa" required>
                <option value=""></option>
                <?php foreach($empresas as $empresa): ?>
                    <option value="<?php echo $empresa['id']; ?>"> <?php echo ucfirst($empresa['nombre']); ?> </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn btn-primary">Listar</button>
        </form>
    </div>
</div>
