<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id',
        'laundryProvider',
        'laundryService',
        'pickup_date',
        'status',
        'quantity',
        'total_price',
        'created_at'
    ];

    protected $casts = [
        'pickup_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(LaundryProvider::class, 'laundryProvider', 'laundryProvider');
    }

    public function service()
    {
        return $this->belongsTo(LaundryService::class, 'laundryService', 'laundryService');
    }
}
