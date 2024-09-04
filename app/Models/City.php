<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{County};

class City extends Model
{
    use HasFactory;
    public $table  = "cities";
    protected $primaryKey = 'id';
    protected $fillable = ['country_id' , 'name'];

    public function counties(){
        return $this->hasMany(County::class , 'county_id' , 'id');
    }
}
