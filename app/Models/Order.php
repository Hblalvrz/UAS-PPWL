<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'laundry_id',
        'weight',
        'total_price',
        'pickup_address',
        'delivery_address',
        'status',
        'payment_proof'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke laundry
    public function laundry()
    {
        return $this->belongsTo(Laundry::class);
    }
}
