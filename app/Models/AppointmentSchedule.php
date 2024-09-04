<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSchedule extends Model
{
    use HasFactory;

    public $table = 'appointment_schedules';
    public $primaryKey  = 'id';

    protected $fillable = [
        'days',
        'from',
        'to',
        'user_id'
    ];

}
