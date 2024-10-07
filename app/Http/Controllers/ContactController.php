<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function Contact()
    {
        try {

            return view('pages.contact');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
