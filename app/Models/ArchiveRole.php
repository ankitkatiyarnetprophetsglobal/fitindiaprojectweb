<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveRole extends Model
{
    use HasFactory;
	protected $table = 'archive_role';
	public $timestamps = false;
    protected $fillable = ['archive_id','role_id'];
}
