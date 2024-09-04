<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_status',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'purchase_amount',
        'service_id',
        'user_id',
        'vendor_id',
        'location',
        'status',
        'service_id',
        'user_id',
        'vendor_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
    ];

    public function serviceDetails()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function serviceProvider()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function collectionDetails()
    {
        return $this->hasOne(Collection::class, 'appointment_id');
    }
    public function disbursementDetails()
    {
        return $this->hasOne(Disbursement::class, 'appointment_id');
    }

    public function getBalanceAfterCommissionAttribute()
    {
        return $this->purchase_amount * 0.95;
    }
}
