<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $table = 'address';
    public $primaryKey  = 'id';

    protected $fillable = [
        'country_id',
        'city_id',
        'town_id',
        'user_id'
    ];


    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id' , 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class , 'city_id' , 'id');
    }

    public function town()
    {
        return $this->belongsTo(County::class , 'town_id' , 'id');
    }
}
