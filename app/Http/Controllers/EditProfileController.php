<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    //
    public function EditProfile()
    {
        try {


            return view('pages.edit-profile');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
