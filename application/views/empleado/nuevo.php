
<div class="row">
    <h2>Agregar un nuevo empleado</h2>
    <div class="col-md-12">
        <form method="POST" action="agregar" name="grilla">
            <label for="nombre_empresa">Empresa</label>
            <select class="form-control" name="grilla[id_empresa]" required>
                <option value=""></option>
                <?php foreach($empresas as $empresa): ?>
                    <option value="<?php echo $empresa['id']; ?>"> <?php echo ucfirst($empresa['nombre']); ?> </option>
                <?php endforeach; ?>
            </select>

            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="grilla[nombre]" required>

            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" name="grilla[apellido]" required>

            <label for="edad">Edad</label>
            <input type="text" class="form-control" name="grilla[edad]" required>

            <label for="tipo">Tipo de empleado</label>
            <select class="form-control" name="grilla[tipo]" id="tipo" onchange="especificacion()" required>
                <option value=""></option>
                <?php foreach($profesiones as $profesion): ?>
                    <option value="<?php echo $profesion['id']; ?>"> <?php echo ucfirst($profesion['nombre']); ?> </option>
                <?php endforeach; ?>
            </select>

            <div id="especificacion"></div>

            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
</div>

