<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\District;
class Newsletter extends Model
{
    use HasFactory;
    protected $table = 'newsletters';
    protected $fillable = [
        'id',
        'newsletter_title',
        'status',
        'created_at',
        'updated_at',
    ];

}
