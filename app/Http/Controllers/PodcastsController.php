<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PodcastsController extends Controller
{
    //
    public function Podcasts()
    {
        try {


            return view('pages.podcasts-and-webinars');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
