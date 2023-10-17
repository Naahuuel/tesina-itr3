<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Confirmación de Reserva</h1>
    <p><?php echo $mensajeConfirmacion; ?></p>
    
    <div>
        <ul>
            <li><a href="<?= site_url('reservas/disponibilidad'); ?>">Reserva</a></li>
            <li><a href="<?= site_url(''); ?>" class="nav-link py-1 d-block">Inicio</a></li>
        </ul>
    </div>
    
</body>
</html>