<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'text', 'is_public'];

    // Relationship to link testimonials with users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
