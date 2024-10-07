<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    public function allTemplates(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $userId = $user->id;

        if ($user->status == 'paid' && $user->privilege >= 2) {

            $allTemplates = DB::table('filters')->select('id', 'title')->get();

            return response()->json([
                'status' => true,
                'allTemplates' => $allTemplates,
                'token' => $token
            ], 200);
        } else {
            $message = 'Upgrade your subcription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'token' => $token
            ], 400);
        }
    }

    public function savedTemplates(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $userId = $user->id;

        if ($user->status == 'paid' && $user->privilege >= 2) {

            $savedTemplates = DB::table('patient_notes')->where('userId', $userId)->select('id', 'templateId', 'templateName')->get();

            return response()->json([
                'status' => true,
                'savedTemplates' => $savedTemplates,
                'token' => $token
            ], 200);
        } else {
            $message = 'Upgrade your subcription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'token' => $token
            ], 400);
        }
    }

    public function getPatientNotesTemplate(Request $request, $templateId)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($user->status == 'paid' && $user->privilege >= 2) {
            $template = DB::table('filters')->where('id', $templateId)->first();

            if (!$template) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Template not found',
                    'token' => $token
                ], 404);
            }

            $data = $template->content;
            $templateId = $template->id;
            $templateName = $template->title;

            return response()->json([
                'status' => 'success',
                'templateId' => $templateId,
                'templateName' => $templateName,
                'data' => json_decode($data, true),
                'token' => $token
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Upgrade your subscription to access this page',
                'token' => $token
            ], 403);
        }
    }

    public function displaySavedPatientNotes(Request $request, $templateId)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
                'token' => $token
            ], 404);
        }

        $userId = $user->id;

        if ($user->status == 'paid' && $user->privilege >= 2) {
            $template = DB::table('patient_notes')
                ->where('templateId', $templateId)
                ->where('userId', $userId)
                ->first();

            if (!$template) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Saved Template not found',
                    'token' => $token
                ], 404);
            }

            $data = $template->data;
            $templateName = $template->templateName;

            return response()->json([
                'status' => 'success',
                'templateId' => $templateId,
                'templateName' => $templateName,
                'data' => json_decode($data, true),
                'token' => $token
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Upgrade your subscription to access this page'
            ], 403);
        }
    }

    public function saveNotesTemplate(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if (!$request->has(['templateId', 'templateName', 'notesData'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing required parameters',
                'token' => $token
            ], 400);
        }

        $templateId = $request->templateId;
        $templateName = $request->templateName;
        $data = $request->notesData;

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
                'token' => $token
            ], 404);
        }

        $userId = $user->id;
        $timestamp = now();

        $patientNotes = DB::table('patient_notes')
            ->where('userId', $userId)
            ->where('templateId', $templateId)
            ->first();

        if ($patientNotes) {
            DB::table('patient_notes')
                ->where('userId', $userId)
                ->where('templateId', $templateId)
                ->update([
                    'templateName' => $templateName,
                    'data' => $data,
                    'created_at' => $timestamp
                ]);

            $message = 'Patient notes updated successfully';
        } else {
            DB::table('patient_notes')->insert([
                'userId' => $userId,
                'templateId' => $templateId,
                'templateName' => $templateName,
                'data' => $data,
                'created_at' => $timestamp,
            ]);

            $message = 'Patient notes saved successfully';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }
}
