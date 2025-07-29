<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertRequest extends Model
{
    use HasFactory;
    protected $table = 'wp_star_rating';
    public $timestamps = false;
    protected $fillable = [
    'user_id',
    'cat_id',
    'totnoteachers',
    'noofstudents',
    'no_of_schools',
    'grade1_5_students',
    'grade6_12_students',
    'peteacherno',
    'outdoorsports',
    'indoorsports',
    'timetable_doc',
    'teacher_certification',
    'town_country_plan_doc',
    'geo_tagged_images',
    'school_initiative',
    'fit_india_participation',
    'created',
    'updated'
];

    
}
