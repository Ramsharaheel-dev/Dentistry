<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpeechtotextController extends Controller
{
    //

    public function Speechtotext()
    {
        try {


            return view('pages.speech-to-text');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
