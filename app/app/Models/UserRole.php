<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    public $timestamps = false; 
}
