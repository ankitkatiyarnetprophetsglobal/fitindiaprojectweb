<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storeeventuserimage extends Model
{
    use HasFactory;
    protected $table = 'storeeventuserimages';

    protected $fillable = ['designation', 'email', 'fullname', 'videourl', 'title','image', 'story'];
      // Status constants
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;

    // Status labels
    public static function getStatusLabels()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_REJECTED => 'Rejected'
        ];
    }

    // Get status label
    public function getStatusLabelAttribute()
    {
        $labels = self::getStatusLabels();
        return $labels[$this->status] ?? 'Unknown';
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }
}
