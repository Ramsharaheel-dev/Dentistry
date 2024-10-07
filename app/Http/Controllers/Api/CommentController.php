<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $activeUser = $request->user();
        $token = $request->bearerToken();

        if ($request->has('post_id') && $request->has('text')) {

            $comment = new Comment;
            $comment->post_id = $request->post_id;
            $comment->text = $request->text;
            $comment->user_id = $activeUser->id;
            $comment->parent_id = $request->parent_id;
            $comment->save();

            $totalComments = Comment::where('post_id', $request->post_id)->count();
            $totalReplies = Reply::where('post_id', $request->post_id)->count();
            $displayComments = $totalComments + $totalReplies;

            $post = Post::find($request->post_id);
            if ($post) {
                $postCreator = User::find($post->user_id);
                if ($postCreator) {
                    $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $request->post_id;
                    $emailMessage = "Hi " . $postCreator->name . ",\n\nYou have received a Comment on your post.\n\n" . $activeUser->name . " Commented on your Post.\n\nFor Further information please check your Post " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

                    $fromEmail = 'noreply@dentistryinanutshell.com';
                    $toEmail = $postCreator->email;
                    $subject = "Received a Comment On your Post!";

                    $this->mailNow($emailMessage, $fromEmail, $toEmail, $subject, 'DIAN');
                }
            }
            return response()->json([
                'status' => true,
                'comment' => $comment,
                'displayComments' => $displayComments
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please provide all required parameters',
                'token' => $token
            ], 400);
        }
    }

    public function getComments($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with(['replies', 'user:id,name,email,designation'])
            ->orderByDesc('id')
            ->get();

        foreach ($comments as $comment) {
            $comment->time_elapsed = $this->calculateTimeElapsed($comment->created_at);
            $comment->replies_count = $comment->replies->count();

            $comment->user->makeHidden(['created_at', 'updated_at']);

            $comment->makeHidden(['created_at', 'updated_at']);
        }

        if ($comments->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'comments' => $comments
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Comments Not Found!'
            ], 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->replies()->delete();
            $comment->delete();

            $totalComments = Comment::where('post_id', $request->post_id)->count();
            $totalReplies = Reply::where('post_id', $request->post_id)->count();
            $displayComments = $totalComments + $totalReplies;

            return response()->json([
                'status' => true,
                'message' => "Comment Deleted Successfully",
                'post_id' => $comment->post_id,
                'displayComments' => $displayComments
            ], 200);
        }
        return response()->json(['status' => false, 'message' => "Comment Not Found"], 404);
    }

    private function calculateTimeElapsed($createdAt)
    {
        $now = Carbon::now();
        $diffInSeconds = $now->diffInSeconds($createdAt);
        $minutes = floor($diffInSeconds / 60);
        $hours = floor($minutes / 60);
        $days = floor($hours / 24);

        if ($days > 0) {
            return $days . 'd';
        } elseif ($hours > 0) {
            return $hours . 'h';
        } else {
            return $minutes . 'm';
        }
    }

    public function mailNow($message, $fromEmail, $toEmail, $subject, $userName)
    {
        $dianKey = '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';

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($fromEmail, $userName);
        $email->setSubject($subject);
        $email->addTo($toEmail, 'DIAN');
        $email->addContent("text/plain", $message);

        $sendgrid = new \SendGrid($dianKey);
        try {
            $response = $sendgrid->send($email);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Email could not be sent.'], 500);
        }
    }
}
