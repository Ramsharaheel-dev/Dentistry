<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkFlowController extends Controller
{
    public function workFlows(Request $request)
    {
        $user = $request->user();

        if ($user->status == 'paid' && $user->privilege >= 2) {

            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'workFlows')->get();
            $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'workFlows')->first();
            $workflows = DB::table('workflows')->where('hashtagId', $firstHashtag->id)->get()->all();

            // foreach ($workflows as &$workflow) {

            //     $baseUrlThumbnail = "https://www.dentistryinanutshell.com/dian/public/workFlows/{$firstHashtag->nameOfHashtag}";
            //     $baseUrlPdf = "https://www.dentistryinanutshell.com/dian/public/workFlows/{$firstHashtag->nameOfHashtag}/PDFs";

            //     $workflow->thumbnailName = ($workflow->thumbnailName != null && $workflow->thumbnailName != '') ? "{$baseUrlThumbnail}{$workflow->thumbnailName}" : null;

            //     $workflow->url = ($workflow->url != null && $workflow->url != '') ? "{$baseUrlPdf}{$workflow->url}" : null;
            // }


            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => [
                    // 'content' => $workflows,
                    'hashtags' => $hashtags,
                    'activeMenu' => 'workFlows',
                    'contentType' => 'workFlows'
                ],
            ]);
        } else {
            $message = 'Upgrade your subscription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'data' => [
                    'user' => $user,
                    'contentType' => 'workFlows',
                    'activeMenu' => 'workFlows'
                ],
            ], 403);
        }
    }
}
