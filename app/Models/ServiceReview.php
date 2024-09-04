<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'ratings','description','appointment_id','service_id','user_id'
    ];

    public function userDetails()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
