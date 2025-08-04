<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','dob','age','gender','cycle'];
    
    public function user()
    {
        return $this->belongsTo(App\Models\User::class, 'user_id');
    }
    
}
