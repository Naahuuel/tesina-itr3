<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto</title>
  <link rel="stylesheet" href="<?= base_url('css-pagina/contacto.css'); ?>">
  <link rel="shortcut icon" href="img/tasita.png">

</head>

<body>
  <div class="contact-form">
    <div class="first-container">
      <div class="info-container">

        <div>
          <h3>Dirección</h3>
          <p>Local Oficial Av.Savio - Velez Sarsfield 440</p>
        </div>

        <div>
          <h3>Hablemos!</h3>
          <p>+54 9 3571 51-6436</p>
        </div>

        <div>
          <h3>Soporte de Ayuda</h3>
          <p>FastFood@gmail.com</p>
        </div>

        <div>
            <a href="<?= site_url(""); ?>">Inicio</a>
        </div>

      </div>
    </div>

    <div class="second-container">
      <h2>Mandanos tu Mensaje</h2>
      <form>

        <div class="form-group">
          <label for="name-input">Diganos su Nombre</label>
          <input type="text" id="name-input" placeholder="Nombre Completo" required>
          <input type="text" id="lastname-input" placeholder="Apellido" required>
        </div>

        <div class="form-group">
          <label for="email-input">Ingrese su Email</label>
          <input type="text"  id="email-input" placeholder="Ej. ejemplo@gmail.com" required>
        </div>

        <div class="form-group">
          <label for="phone-input">Ingrese su Telefono</label>
          <input type="text" id="phone-input" placeholder="Ej. +1 000-800-000" required>
        </div>

        <div class="form-group">
          <label for="message-textarea">Mensaje</label>
          <textarea id="message-textarea" placeholder="Escribenos un Mensaje"></textarea>
        </div>
        <button>Enviar Mensaje</button>
      </form>

    </div>

  </div>


</body>

</html>