<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    //
    public function deleteAccount()
    {
        try {


            return view('pages.delete-account');

        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
