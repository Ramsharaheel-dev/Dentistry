<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assignVideos()
    {
        return $this->belongsToMany(AssignVideo::class);
    }

    public function podcasts(){
        return $this->belongsTo(Podcast::class);
    }
}
