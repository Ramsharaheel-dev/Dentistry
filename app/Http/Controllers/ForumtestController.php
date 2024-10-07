<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumtestController extends Controller
{
    //
    public function Forum2()
    {
        try {


            return view('pages.forum2');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
