<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    public $table = 'qualifications';
    public $primaryKey  = 'id';

    protected $fillable = [
        'degree',
        'from',
        'to',
        'user_id',
        'image',
        'phone_number',
        'cnic_no',
        'cnic_image'
    ];
}
