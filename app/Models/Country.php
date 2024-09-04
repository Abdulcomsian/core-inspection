<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public $table  = "countries";
    protected $primaryKey = 'id';
    protected $fillable = ['country_code','country_name','phone_code'];

    public function cities(){
        return $this->hasMany(City::class , 'country_id' , 'id');
    }
}
