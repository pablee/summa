
<div class="row">
    <h2>Elija una empresa para ver el promedio de edad de sus empleados</h2>
    <div class="col-md-12">
        <label for="nombre_empresa">Empresa</label>
        <select class="form-control" name="id_empresa" id="id_empresa" onchange="calcular_promedio()" required>
            <option value=""></option>
            <?php foreach($empresas as $empresa): ?>
                <option value="<?php echo $empresa['id']; ?>"> <?php echo ucfirst($empresa['nombre']); ?> </option>
            <?php endforeach; ?>
        </select>

        <div id="promedio"></div>
    </div>
</div>