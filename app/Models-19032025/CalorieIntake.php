<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalorieIntake extends Model
{
    use HasFactory;
	protected $table="calorie_intakes";
	public $timestamps = false;
}
