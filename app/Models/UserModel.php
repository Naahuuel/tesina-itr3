<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_users';
    protected $allowedFields = ['full_name', 'last_name', 'email', 'password'];
}

?>