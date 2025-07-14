<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\District;
class PklQuiz extends Model
{
    use HasFactory;
    protected $table = 'pkl_quiz';
    protected $fillable = [
        'quesoption',
        'name',
        'mobile',
        'dob',
        'parent_name',
        'school_name',
        'state_id',
        'district_id',
        'city',
        'pincode',
        'class',
        'section',
        'lang',
        'sec',
        'score',
        'created_at'
    ];



    public function state(){
        return $this->hasOne(State::class,'id','state_id');
    }

    public function district(){
        return $this->hasOne(District::class,'id','district_id');
    }
}
