<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationawellnessconclaves extends Model
{
    use HasFactory;
    protected $table = 'nationawellnessconclaves';

    protected $fillable = ['name','company','designation', 'email', 'mobile'];

}
