<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignVideo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reels()
    {
        return $this->belongsToMany(Reel::class);
    }
}
