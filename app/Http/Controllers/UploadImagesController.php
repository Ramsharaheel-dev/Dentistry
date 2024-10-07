<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImagesController extends Controller
{
    //
    public function UploadImages()
    {
        try {


            return view('pages.upload-images');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
