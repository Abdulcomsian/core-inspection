<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'user_id',
        'location',
        'status',
        'phone_number',
        'transaction_status',
        'reference_id',
        'user_id',
        'amount'
    ];
    
}
