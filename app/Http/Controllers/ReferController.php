<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferController extends Controller
{
    //
    public function Refer()
    {
        try {


            return view('pages.refer');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
