<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprehensiveExamController extends Controller
{
    //
    public function ComprehensiveExam()
    {
        try {


            return view('pages.comprehensive-exam');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
