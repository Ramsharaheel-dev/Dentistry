<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    //
    public function Faq()
    {
        try {


            return view('pages.faq');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
