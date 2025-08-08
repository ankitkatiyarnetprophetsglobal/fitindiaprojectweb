<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storeeventuserimage extends Model
{
    use HasFactory;
    protected $table = 'storeeventuserimages';

    protected $fillable = ['designation', 'email', 'fullname', 'videourl', 'title','image', 'story'];
}
