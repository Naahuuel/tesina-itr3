<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="shortcut icon" href="../img/tasita.png">

    <title>Register</title>
  </head>
<body>
    <section>
      <div class="container mt-5 pt-5">
        <div class="row">
          <div class="col-12 col-sm-7 col-md-6 m-auto">
            <div class="card border-0 shadow">
              <div class="card-body">
                <svg class="mx-auto my-4 d-block" xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <h4>Register</h4><hr>
                <form action="<?= base_url('autenticacion/guardar'); ?>" method="post" autcomplete="off">
                  <?= csrf_field(); ?>
                  <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                  <?php endif ?>

                  <?php if(!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                  <?php endif ?>
                  <div class="form-group">
                    <label for="">Nombre Completo</label>
                    <input type="text" class="form-control my-1 py-2" name="fullname" placeholder="Ingrese su Nombre Completo" value="<?= set_value('fullname'); ?>">
                    <span class="text-danger"><?= isset($validation) ? $validation->getError('fullname') : '' ?></span>      
                  </div>

                  <div class="form-group">
                    <label for="">Apellido</label>
                    <input type="text" class="form-control my-1 py-2" name="lastname" placeholder="Ingrese su Apellido" value="<?= set_value('lastname'); ?>">
                    <span class="text-danger"><?= isset($validation) ? $validation->getError('lastname') : '' ?></span>      

                  </div>

                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control my-1 py-2" name="email" placeholder="Ingrese un Email" value="<?= set_value('email'); ?>">
                    <span class="text-danger"><?= isset($validation) ? $validation->getError('email') : '' ?></span>      

                  </div>

                  <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" class="form-control my-1 py-2" name="password" placeholder="Ingrese una Contraseña" value="<?= set_value('password'); ?>">
                    <span class="text-danger"><?= isset($validation) ? $validation->getError('password') : '' ?></span>      
                  </div>

                  <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" class="form-control ">Register</button>
                  </div>

                  <a href="<?= site_url('autenticacion/login'); ?>" class="nav-link py-1">Ya tengo cuenta, inicia sesión ahora</a>
                  <a href="<?= site_url(''); ?>" class="nav-link py-1">Inicio</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>

