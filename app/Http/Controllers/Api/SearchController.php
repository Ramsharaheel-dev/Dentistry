<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $term = $request->query('term');

        if ($term) {
            // Query for reels
            $reelsresults = DB::table('reels')
                ->select('id', 'name')
                ->where('name', 'like', '%' . $term . '%')
                ->take(4)
                ->get()
                ->map(function ($item) {
                    $item->url = 'https://dentistryinanutshell.com/dev_test/dentistry/public/api/dashboard/' . $item->id;
                    $item->video_type = 'reel';
                    return $item;
                });

            // Query for podcasts
            $podcastResult = DB::table('podcasts')
                ->select('id', 'name')
                ->where('name', 'like', '%' . $term . '%')
                ->take(4)
                ->get()
                ->map(function ($item) {
                    $item->url = 'https://dentistryinanutshell.com/dev_test/dentistry/public/api/podcast/' . $item->id;
                    $item->video_type = 'podcast';
                    return $item;
                });

            $results = $reelsresults->merge($podcastResult);

            if ($results->isEmpty()) {
                return response()->json(['message' => 'No results found.']);
            }

            return response()->json([
                'status' => true,
                'results' => $results
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please pass a "term" query parameter'
            ]);
        }
    }

}
