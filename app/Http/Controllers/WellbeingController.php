<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WellbeingController extends Controller
{
    //
    public function Wellbeing()
    {
        try {


            return view('pages.wellbeing');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
