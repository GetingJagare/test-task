<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_info';

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public $timestamps = false; 

    public function avatar() {
        return $this->hasOne(UserAvatar::class, 'id', 'avatar_id');
    }
}
