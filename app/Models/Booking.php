<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'guest_name',
        'guest_phone',
        'guest_email',
        'check_in_date',
        'check_out_date',
        'status',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Scope to check for date overlaps
     * Overlap exists if: (new_start < existing_end) AND (new_end > existing_start)
     */
    public function scopeOverlapping($query, $checkInDate, $checkOutDate)
    {
        return $query->where('check_in_date', '<', $checkOutDate)
                     ->where('check_out_date', '>', $checkInDate);
    }
}
