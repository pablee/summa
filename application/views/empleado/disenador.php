
<label for="nombre">Tipo de dise&ntilde;ador</label>
<select class="form-control" name="grilla[especialidad]" required>
    <option value=""></option>
    <?php foreach($especialidades as $especialidad): ?>
        <option value="<?php echo $especialidad['id']; ?>"> <?php echo ucfirst($especialidad['nombre']); ?> </option>
    <?php endforeach; ?>
</select>