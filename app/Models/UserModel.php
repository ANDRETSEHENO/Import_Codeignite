<?php

namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['matricule', 'nom', 'prenom', 'email', 'filiere', 'niveau'];

}