<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
       return  $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

     // Recursive function to delete replies
     public function deleteWithReplies()
     {
         foreach ($this->replies as $reply) {
             $reply->deleteWithReplies();
         }
         $this->delete();
     }
}
