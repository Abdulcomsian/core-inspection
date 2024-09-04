<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;
    public $table  = "counties";
    protected $primaryKey = 'id';
    protected $fillable = ['city_id' , 'name'];

    
}
