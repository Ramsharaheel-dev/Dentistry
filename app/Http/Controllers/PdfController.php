<?php

namespace App\Http\Controllers;

use App\Models\AssignVideo;
use App\Models\User;
use Carbon\CarbonInterval;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

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

    public function generatePdf()
    {
        $email = session('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return abort(404, 'User not found');
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

        // Pass variables to the view
        $data = [
            'user' => $user,
            'gdcNumber' => $gdcNumber,
            'formattedTotalTime' => $formattedTotalTime,
            'currentDate' => \Carbon\Carbon::today()->format('d-m-Y')
        ];

        // Render the view
        $html = view('pages.print_pdf', $data)->render();

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the generated PDF to the browser
        return $dompdf->stream('certificate.pdf');
    }
}
