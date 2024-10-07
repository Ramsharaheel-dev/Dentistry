<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    //
    public function Pricing()
    {
        try {


            return view('pages.pricing');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
