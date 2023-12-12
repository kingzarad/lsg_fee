<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Students extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'students';
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'id_number',
        'year_level',
        'sex',
        'course_id',
        'email',
        'password',
    ];



}
