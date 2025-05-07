<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['memory_id', 'file_path'];

    public function memory()
    {
        return $this->belongsTo(Memory::class);
    }
}

