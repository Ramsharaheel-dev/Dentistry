<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HashtagController extends Controller
{
    public function getHashtags($category)
    {
        // Fetch categories based on the selected category
        $categories = Hashtag::where('nameOfContentSection', $category)->get(); // Adjust query as needed

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'hashtags' => 'required|array',
        //     'page' => 'required|string',
        // ]);

        $hashtag = $request->input('hashtag');
        $page = $request->input('page');

        // Save hashtags to the database
        // You might need to create a model and a migration for hashtags

        // Save each hashtag to the database
        // Assuming you have a Hashtag model
        $newHashtag = Hashtag::create([
            'nameOfHashtag' => $hashtag,
            'nameOfContentSection' => $page,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Hashtags saved successfully.',
            'id' => $newHashtag->id
        ]);
    }
}
