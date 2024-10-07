<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentNote;
use App\Models\User;
use Illuminate\Http\Request;

class StudentNoteController extends Controller
{
    public function saveStudentNotes(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $userId = $user->id;

        $noteId = $request->noteId;
        $noteContent = $request->noteContent;

        $existingNote = StudentNote::where('user_id', $userId)
            ->where('note_id', $noteId)
            ->first();

        if ($existingNote) {
            $existingNote->noteContent = $noteContent;
            $existingNote->save();

            return response()->json([
                'success' => true,
                'message' => 'Successfully Updated',
                'noteContent' => $noteContent,
                'token' => $token
            ],200);
        } else {
            $note = new StudentNote();
            $note->user_id = $userId;
            $note->note_id = $noteId;
            $note->noteContent = $noteContent;
            $note->save();

            return response()->json([
                'success' => true,
                'message' => 'Successfully Saved',
                'noteContent' => $noteContent,
                'token' => $token
            ],200);
        }
    }

    public function getStudentNotes(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $userId = $user->id;
        $noteId = $request->noteId;

        $noteContent = StudentNote::where('note_id', $noteId)
            ->where('user_id', $userId)
            ->value('noteContent');

        return response()->json([
            'status' => true,
            'message' => 'success',
            'noteContent' => $noteContent,
            'token' => $token
        ]);
    }
}
