<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssignVideo;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PdfController extends Controller
{
    public function secondsToHMS($seconds)
    {
        $interval = CarbonInterval::seconds($seconds);

        return $interval->cascade()->format('%H:%I:%S');
    }

    public function hmsToSeconds($hms)
    {
        $interval = CarbonInterval::createFromFormat('H:i:s', $hms);

        return $interval->hours * 3600 + $interval->minutes * 60 + $interval->seconds;
    }

    public function generatePdf(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $assignedVideos = AssignVideo::where('assigned_uid', $user->id)
            ->whereNotNull('watched_time')
            ->pluck('watched_time');

        $totalWatchedTimeInSeconds = 0;

        foreach ($assignedVideos as $watchedTime) {
            $totalWatchedTimeInSeconds += $this->hmsToSeconds($watchedTime);
        }

        $formattedTotalTime = $this->secondsToHMS($totalWatchedTimeInSeconds);

        $gdcNumber = $user->gdc_number ?? '';

        $data = [
            'user' => $user,
            'gdcNumber' => $gdcNumber,
            'formattedTotalTime' => $formattedTotalTime,
            'currentDate' => Carbon::today()->format('d-m-Y')
        ];

        $html = view('pages.print_pdf', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)->header('Content-Type', 'application/pdf');
    }

    public function invoicePdf(Request $request)
    {
        $user = $request->user();
        $email = $user->email;

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

        return response($dompdf->output(), 200)->header('Content-Type', 'application/pdf');
    }
}
