<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'user_id',
        'location',
        'status',
        'commission_amount',
        'phone_number',
        'withdraw_amount',
        'transaction_status',
        'reference_id',
        'user_id'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
