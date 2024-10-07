<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ForumProfileController extends Controller
{
    //
    public function forumprofile($id)
    {
        $user = User::find($id);
        // $user = User::where('id', $id)->get()->first();
        // dd($user);

        return view('pages.forum-profile', compact('user'));
    }
}
