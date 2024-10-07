<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuidelineController extends Controller
{
    //
    public function Guideline()
    {
        try {


            return view('pages.guideline');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
