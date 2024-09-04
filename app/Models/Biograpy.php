<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biograpy extends Model
{
    use HasFactory;


    public $table = 'biography';
    public $primaryKey  = 'id';

    protected $fillable = [
        'job_title',
        'organization',
        'years_of_experience',
        'nin_number',
        'languages',
        'service_type',
        'detail_bio',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
