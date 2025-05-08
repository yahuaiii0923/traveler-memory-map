<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['memory_id', 'file_path'];

    public function memory()
    {
        return $this->belongsTo(Memory::class);
    }
}
