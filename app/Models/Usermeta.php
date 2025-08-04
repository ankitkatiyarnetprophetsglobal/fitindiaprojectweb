<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','dob','age','gender','cycle','cyclothonrole','participant_number','address_line_one','address_line_two','tshirtsize','user_join_club_id'];

    public function user()
    {
        return $this->belongsTo(App\Models\User::class, 'user_id');
    }

}
