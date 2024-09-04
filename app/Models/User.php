<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\{Address, Qualification, Biograpy, ServiceCategory, AppointmentSchdeule};

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'type',
        'identifier',
        'status',
        'email',
        'gender',
        'password',
        'avatar',
        'remember_token',
        'is_approved',
        'profile_approved_status',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function serviceReviews()
    {
        return $this->hasMany(ServiceReview::class, 'user_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id', 'id');
    }

    public function identity()
    {
        return $this->hasOne(IdentityModel::class, 'user_id', 'id');
    }

    public function qualification()
    {
        return $this->hasMany(Qualification::class, 'user_id', 'id');
    }

    public function biography()
    {
        return $this->hasOne(Biograpy::class, 'user_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'user_id', 'id');
    }

    public function serviceCategories()
    {
        return $this->hasManyThrough(ServiceCategory::class, Service::class, 'user_id', 'id', 'id', 'service_category_id');
    }

    public function serviceCategory()
    {
        return $this->hasMany(ServiceCategory::class, 'user_id', 'id');
    }

    public function appointmentSchedule()
    {
        return $this->hasOne(AppointmentSchedule::class, 'user_id', 'id');
    }
}
