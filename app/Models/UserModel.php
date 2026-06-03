<?php

namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['nom', 'prenom', 'email', 'filiere', 'niveau'];

}