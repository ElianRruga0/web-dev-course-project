<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'email', 'phone', 'guests'];


    public function activity()
    {
        return $this->hasOne(Activity::class, 'id', 'activity_id');
    }
}
