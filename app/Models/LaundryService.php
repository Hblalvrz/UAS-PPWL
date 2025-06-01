<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    // Jika primary key nama selain 'id', misalnya: 
    // protected $primaryKey = 'laundryService';

    protected $fillable = [
        'service_name',
        'price_per_kg',
        'image_path',
    ];

    // (jika butuh relasi provider, tambahkan di sini, tapi untuk minimal CRUD services tidak wajib)
}
