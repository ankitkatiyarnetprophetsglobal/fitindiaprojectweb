<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conclaveregistrations extends Model
{
    use HasFactory;
    protected $table = 'conclaveregistrations';

    protected $fillable = ['name','company','designation', 'email', 'mobile'];

}
