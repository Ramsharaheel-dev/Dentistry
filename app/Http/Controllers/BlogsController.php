<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogsController extends Controller
{
    //
    public function Blogs()
    {
        try {


            return view('pages.blogs');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
