<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryProvider extends Model
{
    use HasFactory;

    protected $primaryKey = 'laundryProvider';
    protected $fillable = ['laundry_name', 'address', 'description', 'phone'];

    public function services()
    {
        return $this->hasMany(LaundryService::class, 'laundryProviders', 'laundryProvider');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'laundryProvider', 'laundryProvider');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'laundryProviders', 'laundryProvider');
    }
}
