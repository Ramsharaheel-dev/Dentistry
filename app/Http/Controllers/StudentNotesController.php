<?php

namespace App\Http\Controllers;

use App\Models\StudentNote;
use App\Models\User;
use Illuminate\Http\Request;

class StudentNotesController extends Controller
{
    public function saveStudentNotes(Request $request)
    {
        $email = session('email');
        $loginUser = User::where('email', $email)->first();
        $userId = $loginUser->id;

        $noteId = $request->noteId;
        $noteContent = $request->noteContent;

        $existingNote = StudentNote::where('user_id', $userId)
            ->where('note_id', $noteId)
            ->first();

        if ($existingNote) {
            $existingNote->noteContent = $noteContent;
            $existingNote->save();
        } else {
            $note = new StudentNote();
            $note->user_id = $userId;
            $note->note_id = $noteId;
            $note->noteContent = $noteContent;
            $note->save();
        }

        return response()->json(['success' => true]);
    }

    public function getStudentNotes(Request $request)
    {
        $email = session('email');
        $loginUser = User::where('email', $email)->first();
        $userId = $loginUser->id;
        $noteId = $request->noteId;

        $noteContent = StudentNote::where('note_id', $noteId)
            ->where('user_id', $userId)
            ->value('noteContent');

        return response()->json(['noteContent' => $noteContent]);
    }
}
