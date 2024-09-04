<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type',
        'transaction_status',
        'amount',
        'service_id',
        'status',
        'mtn_number',
        'user_id',
        'reference_id',
        'transaction_id'
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
}
