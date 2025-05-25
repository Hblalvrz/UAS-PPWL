<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles;


    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke laundry yang dimiliki (jika user adalah pemilik laundry)
    public function laundries()
    {
        return $this->hasMany(Laundry::class);
    }

    // Relasi ke laundry yang dikelola (jika user adalah pihak laundry)
    public function managedLaundries()
    {
        return $this->belongsToMany(Laundry::class, 'laundry_managers');
    }

    // Relasi ke order yang dibuat oleh user
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
