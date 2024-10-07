<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function invoicePdf(Request $request)
    {
        $email = session('email');
        $user = DB::table('users')->where('email', $email)->get()->first();

        $timestamp = $request->startDate;
        $packageName = $request->packageName;

        $date = Carbon::createFromTimestamp($timestamp);
        $startDate = $date->format('F jS, Y g:i A');

        $selectAmount = DB::table('plans')->where('name', $packageName)->get()->first();
        $amount = $selectAmount->price;

        $transactionId = str::random(10);

        $currentDate = Carbon::now()->format('F j, Y');

        $data = [
            'packageName' => $packageName,
            'startDate' => $startDate,
            'user' => $user,
            'amount' => $amount,
            'email' => $email,
            'transactionId' => $transactionId,
            'currentDate' => $currentDate,
        ];

        $html = view('pages.invoice-pdf', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('invoice.pdf');
    }

    public function InvoiceHtml(Request $request)
    {
        try {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            $timestamp = $request->startDate;
            $packageName = $request->packageName;

            $date = Carbon::createFromTimestamp($timestamp);
            $startDate = $date->format('F jS, Y g:i A');

            $selectAmount = DB::table('plans')->where('name', $packageName)->get()->first();
            $amount = $selectAmount->price;

            $transactionId = str::random(10);

            $currentDate = Carbon::now()->format('F j, Y');

            return view('pages.invoice-html', compact('startDate', 'packageName', 'user', 'amount', 'email', 'transactionId', 'currentDate'));
        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
