<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    protected $primaryKey = 'laundryService';
    protected $fillable = [
        'service_name',
        'price_per_kg',
        'image_path',   // gunakan nama kolom yang benar di migration
    ];
}
