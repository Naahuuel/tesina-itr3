<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
</head>
<body>
    <div class="container">
        <div class="row" style="margin: top 40px;">
            <div class="cold-md-4 cold-md-offset-4">
            <h4><?= $title; ?></h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= ucfirst($userInfo['full_name']); ?></td>
                        <td><?= $userInfo['email'] ?></td>
                        <td><a href="<?= site_url('autenticacion/logout'); ?>">Logout</a></td>
                        <td><a href="<?= site_url('inicio'); ?>">Inicio</a></td>
                </tbody> 
            </table>
            </div>
        </div>
    </div>
</body>
</html>