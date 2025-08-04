<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolquiz extends Model
{
    use HasFactory;
	protected $table ='schoolquizs';
	public $timestamps = false;
}
