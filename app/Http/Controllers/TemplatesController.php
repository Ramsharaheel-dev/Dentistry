<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplatesController extends Controller
{
    //
    public function Templates()
    {
        try {


            return view('pages.templates');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
