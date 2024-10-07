<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailNotificationController extends Controller
{
    //
    public function EmailNotification()
    {
        try {


            return view('pages.email-notification');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
