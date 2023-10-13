<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['fname','lname','role','email', 'password','avatar'];

    // Dates
    protected $useTimestamps = false;
    

    // Validation
    
}
