<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasApiTokens,Notifiable,HasRoles;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'price_per_kg',
        'operational_hours',
        'description',
        'status'
    ];

    // Relasi ke user (pemilik laundry)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke user (pihak laundry yang mengelola, jika ada tabel pivot)
    public function managers()
    {
        return $this->belongsToMany(User::class, 'laundry_managers');
    }

    // Relasi ke order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
