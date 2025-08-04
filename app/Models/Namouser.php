<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Namouser extends Model
{
    use HasFactory;
	protected $table ='namo_users_updates';

	protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'email_verified_at',
        'role',
        'rolelabel',
        'role_id',
        'password',
        'verified',
        'remember_token',
        'created_at',
        'updated_at',
        'via',
        'deviceid',
        'FCMToken',
        'authid',
        'viamedium',
        'rolewise',
        'cycle',
        'cyclothonrole',
        'participant_number',
        'pincode',
        'tshirtsize',
        'address_line_one',
        'address_line_two',
        'state',
        'district',
        'block',
        'block',
        'city',
    ];
}
