<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fitnessquiz extends Model
{
    use HasFactory;
	protected $table ='fitness_quiz';
	public $timestamps = true;

	protected $fillable = ['ques', 'opt1', 'opt2', 'opt3', 'opt4', 'ans']; 
	
	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}	
	
	public function getUpdatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}		
}
