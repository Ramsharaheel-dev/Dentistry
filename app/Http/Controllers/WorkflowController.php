<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    //
    public function Workflow()
    {
        try {


            return view('pages.work-flow');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
