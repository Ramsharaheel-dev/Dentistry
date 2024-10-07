<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //

    public function Aboutus()
    {
        try {


            return view('pages.about-us');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
