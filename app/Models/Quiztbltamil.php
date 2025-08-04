<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Quiztbltamil extends Model
{
    use HasFactory;
    protected $table = 'quiz_quesml'; 
    public $timestamps = false;
    protected $fillable = ['ques', 'opt1', 'opt2', 'opt3', 'opt4', 'ans']; 
}
