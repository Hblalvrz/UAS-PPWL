<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    protected $primaryKey = 'laundryService';
    protected $fillable = ['laundryProviders', 'service_name', 'price_per_kg'];

    public function provider()
    {
        return $this->belongsTo(LaundryProvider::class, 'laundryProviders', 'laundryProvider');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'laundryService', 'laundryService');
    }
}
