<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoursesController extends Controller
{
    //
    public function Courses()
    {
        try {


            return view('pages.courses');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
