<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'role', 'text', 'metric', 'memory_slug', 'is_public','user_id'
    ];
    /**
         * Define the relationship with the User model.
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
