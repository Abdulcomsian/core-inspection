<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contact_infos';

    protected $fillable = [
        'user_id',
        'phone_no',
        'cnic_no',
        'cnic_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
