<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
</head>
<body>
<form action="<?php echo base_url('reservas'); ?>" method="post">
    <label for="mesa">Selecciona una mesa</label>
    <select name="mesa_id" id="mesa_id">
        <?php foreach ($mesasDisponibles as $mesa) : ?>
            <option value="<?php echo $mesa['id']; ?>"><?php echo $mesa['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <br>

    <label for="dia">Selecciona un día</label>
    <input type="date" name="dia" id="dia" min="<?php echo date('Y-m-d'); ?>" required>

    <br>

    <label for="hora">Selecciona una hora</label>
    <input type="time" name="hora" id="hora" required>

    <br>

    <!-- Campos para el nombre completo y número de teléfono -->
    <label for="nombre_completo">Full Name</label>
    <input type="text" name="nombre_completo" id="nombre_completo" required>

    <br>

    <label for="telefono">Phone</label>
    <input type="text" name="telefono" id="telefono" required>

    <br>
    <hr>
    <button type="submit">Reservar</button>

    <br>
    <a href="<?= site_url(''); ?>">Inicio</a>

</form>

</body>
</html>