<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function Shop()
    {
        try {


            return view('pages.shop');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
