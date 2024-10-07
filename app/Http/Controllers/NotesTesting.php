<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesTesting extends Controller
{
    public function notes()
    {
        try {


            return view('pages.Notes2');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
