<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indentity extends Model
{
    use HasFactory;

    protected $table = 'identities';

    protected $fillable = [
        'user_id',
        'national_id_number',
        'national_id_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
