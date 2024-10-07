<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogsDetailsController extends Controller
{
    //
    public function BlogsDetails()
    {
        try {


            return view('pages.blogs-details');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
