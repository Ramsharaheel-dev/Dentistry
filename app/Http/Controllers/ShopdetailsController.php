<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopdetailsController extends Controller
{
    //
    public function Shopdetails()
    {
        try {


            return view('pages.shop-details');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
