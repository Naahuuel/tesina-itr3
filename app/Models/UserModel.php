<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuarios';
    protected $allowedFields = ['nombre_completo', 'apellido', 'email', 'contraseña'];
}

?>