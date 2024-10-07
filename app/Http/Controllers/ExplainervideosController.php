<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplainervideosController extends Controller
{
    //
    public function Explainervideos()
    {
        try {


            return view('pages.explainervideos');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
