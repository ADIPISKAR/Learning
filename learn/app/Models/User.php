<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'birth_date',
        'phone',
        'email',
        'login',
        'password',
        'photo',
    ];
}
