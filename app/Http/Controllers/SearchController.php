<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $term = $request->input('term');

        $reelsresults = DB::table('reels')->selectRaw('*, ? as video_type', ['reels'])->where('name', 'like', '%' . $term . '%')->take(4)->get();
        $podcastResult = DB::table('podcasts')->selectRaw('*, ? as video_type', ['podcasts'])->where('name', 'like', '%' . $term . '%')->take(4)->get();

        $results = $reelsresults->merge($podcastResult);

        return response()->json($results);
    }
}
