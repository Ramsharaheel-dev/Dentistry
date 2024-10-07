<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadpdfController extends Controller
{
    //
    public function downloadPdf()
    {
        $file = public_path('downloads/downloads1.pdf');

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'document.pdf', $headers);
    }
}
