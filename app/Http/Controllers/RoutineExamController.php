<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutineExamController extends Controller
{
    //
    public function RoutineExam()
    {
        try {


            return view('pages.routine-exam');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
