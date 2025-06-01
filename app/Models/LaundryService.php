<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    protected $table = 'laundry_services';
    protected $primaryKey = 'laundryService';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'laundryProviders',
        'service_name',
        'price_per_kg',
    ];

    protected $casts = [
        'price_per_kg' => 'decimal:2',
    ];

    public function laundryProvider()
    {
        return $this->belongsTo(LaundryProvider::class, 'laundryProviders', 'laundryProvider');
    }
}
