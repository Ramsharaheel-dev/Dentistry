<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $email = session('email');

        $activeUser = User::where('email', $email)->get()->first();

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->text = $request->text;
        $comment->user_id = $activeUser->id;
        $comment->parent_id = $request->parent_id;

        $comment->save();

        $totalComments = Comment::where('post_id', $request->post_id)->count();
        $totalReplies = Reply::where('post_id', $request->post_id)->count();
        $total = $totalComments + $totalReplies;
        $displayComments = $total;

        // Retrieve the post creator's email
        $post = Post::find($request->post_id);
        if ($post) {
            $postCreator = User::find($post->user_id);
            if ($postCreator) {

                $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $request->post_id;
                // $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $postId;
                // $url = 'https://test.dentistryinanutshell.com/lara/dev/dian/public/single-category/'.$questionId;

                $emailMessage = "Hi ". $postCreator->name .",\n\nYou have received a Comment on your post ". "\n\n ". $activeUser->name ." Commented on your Post.\n\nFor Further information please check your Post " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

                $fromEmail = 'noreply@dentistryinanutshell.com';
                $toEmail = $activeUser->email;
                // $toEmail = 'asad.cybertron@gmail.com';
                $subject = "Received a Comment On your Post!";

                $this->mailnow($emailMessage, $fromEmail, $toEmail, $subject, 'DIAN');
            }
        }

        return response()->json(['status' => true, 'comment' => $comment, 'displayComments' => $displayComments]);
    }

    public function getComments($postId)
    {
        $comments = Comment::where('post_id', $postId)->with(['replies', 'user'])->orderByDesc('id')->get();

        // Calculate time elapsed for each comment
        foreach ($comments as $comment) {
            $comment->time_elapsed = $this->calculateTimeElapsed($comment->created_at);
            $comment->replies_count = Reply::where('comment_id', $comment->id)->count();
        }

        return response()->json($comments);
    }

    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->deleteReplies()->delete();

            $comment->delete();

            $totalComments = Comment::where('post_id', $request->post_id)->count();

            $totalReplies = Reply::where('post_id', $request->post_id)->count();
            $total = $totalComments + $totalReplies;
            $displayComments = $total;

            return response()->json(['status' => true, 'post_id' => $comment->post_id, 'displayComments' => $displayComments]);
        }
        return response()->json(['status' => false], 404);
    }

    private function calculateTimeElapsed($createdAt)
    {
        // Get the current time
        $now = Carbon::now();

        // Calculate the difference in seconds
        $diffInSeconds = $now->diffInSeconds($createdAt);

        // Convert seconds to minutes
        $minutes = floor($diffInSeconds / 60);

        // Convert minutes to hours
        $hours = floor($minutes / 60);

        // Convert hours to days
        $days = floor($hours / 24);

        // Determine the appropriate unit (minutes, hours, days)
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
        $email->setfrom($fromEmail, $userName);
        $email->setSubject($subject);
        $email->addto($toEmail, 'DIAN');
        $email->addContent("text/plain", $message);

        $sendgrid = new \SendGrid($dianKey);
        $response = $sendgrid->send($email);

        // try {

        //     print $response->statusCode() . "\n";
        //     print_r($response->headers());
        //     print $response->body() . "\n";
        // } catch (\Exception $e) {
        //     echo 'Caught exception: ' . $e->getMessage() . "\n";
        // }
    }
}
