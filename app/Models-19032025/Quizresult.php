<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizresult extends Model
{
    use HasFactory;
	protected $table = 'quiz_result';
    public $timestamps = true;
    protected $fillable = ['quesoption', 'email','score'];  	
}
