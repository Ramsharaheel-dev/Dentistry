<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssistController extends Controller
{
    //

    public function Assist()
    {
        try {
            return view('pages.assist');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
