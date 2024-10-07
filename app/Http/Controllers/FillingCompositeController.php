<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FillingCompositeController extends Controller
{
    //
    public function FillingComposite()
    {
        try {


            return view('pages.filling-composite');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
