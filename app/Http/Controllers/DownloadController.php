<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    //
    public function Download()
    {
        try {


            return view('pages.download');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

  

}
