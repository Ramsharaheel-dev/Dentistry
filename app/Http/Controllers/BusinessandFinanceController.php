<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessandFinanceController extends Controller
{
    //
    public function BusinessandFinance()
    {
        try {


            return view('pages.business-and-finance');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
