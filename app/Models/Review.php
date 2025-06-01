<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';
    protected $fillable = ['user_id', 'status', 'laundryProviders', 'value', 'contents'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(LaundryProvider::class, 'laundryProviders', 'laundryProvider');
    }
}
