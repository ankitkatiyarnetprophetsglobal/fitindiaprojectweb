<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userevent extends Model
{
    use HasFactory;
    protected $table ='userevents';

    protected $fillable = [
        'id',
        'role',
        'name',
        'email',
        'phone',
        'pincode',
        'state',
        'district',
        'block',
        'city',
        'created_at',
        'updated_at'
    ];
}
