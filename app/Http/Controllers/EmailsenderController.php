<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailsenderController extends Controller
{
    //
    public function Emailsender()
    {
        try {


            return view('pages.emailsender');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
