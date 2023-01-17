<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'startTime', 'endTime', 'minGuests', 'maxGuests', 'currentGuests'];


    public function destination()
    {
        return $this->hasOne(Destination::class, 'id', 'destination_id');
    }

    public function activity_type()
    {
        return $this->hasOne(ActivityType::class, 'id', 'activity_id');
    }
}
