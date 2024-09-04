<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'user_id',
        'appointment_id'
    ];

    public function userDetails()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function appointmentDetails()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
}
