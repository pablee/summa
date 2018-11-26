
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Empleado encontrado</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Profesion</th>
                    <th>Especialidad</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo ucfirst($empleado['id']); ?></td>
                        <td><?php echo ucfirst($empleado['nombre']); ?></td>
                        <td><?php echo ucfirst($empleado['apellido']); ?></td>
                        <td><?php echo ucfirst($empleado['edad']); ?></td>
                        <td><?php echo ucfirst($empleado['pro_nombre']); ?></td>
                        <td><?php echo ucfirst($empleado['esp_nombre']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>