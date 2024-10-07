<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PubmedController extends Controller
{
    //
    public function Pubmed()
    {
        try {


            return view('pages.pubmed');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
