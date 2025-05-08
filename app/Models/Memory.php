<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;

     protected $fillable = ['title', 'description', 'location_name', 'latitude', 'longitude', 'rating', 'user_id'];

        public function photos()
        {
            return $this->hasMany(Photo::class);
        }

    /**
     * Define the relationship with the User model.
     */
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
