<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $activeUser = $request->user();
        $token = $request->bearerToken();

        if ($request->has('post_id') && $request->has('text') && $request->has('comment_id')) {

            $reply = new Reply;
            $reply->comment_id = $request->comment_id;
            $reply->post_id = $request->post_id;
            $reply->text = $request->text;
            $reply->user_id = $activeUser->id;
            $reply->parent_id = $request->parent_id;
            $reply->save();

            $totalComments = Comment::where('post_id', $request->post_id)->count();
            $totalReplies = Reply::where('post_id', $request->post_id)->count();
            $total = $totalComments + $totalReplies;
            $displayComments = $total;

            $replies_count = Reply::where('comment_id', $request->comment_id)->count();
            $comment_replies_count = Reply::where('parent_id', $request->parent_id)->count();

            // Retrieve the post creator's email
            $post = Post::find($request->post_id);
            if ($post) {
                $postCreator = User::find($post->user_id);
                if ($postCreator) {
                    // $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $request->post_id;
                    $url = 'https://www.dentistryinanutshell.com/dev_test/public/single-post/' . $request->post_id;
                    $emailMessage = "Hi " . $postCreator->name . ",\n\nYou have received a Comment on your post " . "\n\n " . $activeUser->name . " Commented on your Post.\n\nFor Further information please check your Post " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

                    $fromEmail = 'noreply@dentistryinanutshell.com';
                    $toEmail = $postCreator->email;
                    $name = $postCreator->name;
                    $subject = "Received a Comment on Your Post!";

                    // $this->mailNow($emailMessage, $fromEmail, $toEmail, $subject, $name);
                }
            }

            // Retrieve emails of users who have commented on the same post
            $commenters = Comment::where('post_id', $request->post_id)->where('user_id', '!=', $activeUser->id)->distinct()->get(['user_id']);
            foreach ($commenters as $commenter) {
                $commenterUser = User::find($commenter->user_id);
                if ($commenterUser) {
                    $url = 'https://www.dentistryinanutshell.com/dev_test/public/single-post/' . $request->post_id;
                    // $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $request->post_id;
                    $emailMessage = "Hi " . $commenterUser->name . ",\n\nThere is a new reply on a post you commented on by " . $activeUser->name . ".\n\nFor further information, please check the post: " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

                    $fromEmail = 'noreply@dentistryinanutshell.com';
                    $toEmail = $commenterUser->email;
                    $name = $commenterUser->name;
                    $subject = "New Reply on a Post You Commented On!";

                    // $this->mailNow($emailMessage, $fromEmail, $toEmail, $subject, $name);
                }
            }

            // Retrieve emails of users who have replied to the same comment
            $repliers = Reply::where('comment_id', $request->comment_id)->where('user_id', '!=', $activeUser->id)->distinct()->get(['user_id']);
            foreach ($repliers as $replier) {
                $replierUser = User::find($replier->user_id);
                if ($replierUser) {
                    $url = 'https://www.dentistryinanutshell.com/dev_test/public/single-post/' . $request->post_id;
                    // $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $request->post_id;
                    $emailMessage = "Hi " . $replierUser->name . ",\n\nThere is a new reply to a comment you replied to by " . $activeUser->name . ".\n\nFor further information, please check the post: " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

                    $fromEmail = 'noreply@dentistryinanutshell.com';
                    $toEmail = $replierUser->email;
                    $name = $replierUser->name;
                    $subject = "New Reply to a Comment You Replied To!";

                    // $this->mailNow($emailMessage, $fromEmail, $toEmail, $subject, $name);
                }
            }

            return response()->json(['status' => true, 'reply' => $reply, 'replies_count' => $replies_count, 'comment_replies_count' => $comment_replies_count, 'displayComments' => $displayComments, 'token' => $token]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please provide all required parameters || Parameters Are(comment_id, post_id, text)',
                'token' => $token
            ], 400);
        }
    }


    public function getReplies($commentId)
    {
        $replies = Reply::where('comment_id', $commentId)
            ->whereNull('parent_id')
            ->with(['user:id,name,email,designation'])
            ->get();

        foreach ($replies as $reply) {
            $reply->time_elapsed = $this->calculateTimeElapsed($reply->created_at);
            // foreach ($reply->replies as $nestedReply) {
            //     $nestedReply->time_elapsed = $this->calculateTimeElapsed($nestedReply->created_at);
            // }
            $reply->user->makeHidden(['created_at', 'updated_at']);

            $reply->makeHidden(['created_at', 'updated_at']);
        }

        if ($replies->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'replies' => $replies
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Replies Not Found!'
            ], 404);
        }
    }


    public function getParentReplies($replyId)
    {
        $replies = Reply::where('parent_id', $replyId)->whereNotNull('parent_id')->with('user')->get();

        foreach ($replies as $reply) {
            $reply->time_elapsed = $this->calculateTimeElapsed($reply->created_at);
        }

        return response()->json($replies);
    }

    public function destroy(Request $request, $id)
    {
        $reply = Reply::find($id);
        if ($reply) {
            $commentId = $reply->comment_id;
            $reply->deleteWithReplies();

            $totalComments = Comment::where('post_id', $request->post_id)->count();

            $totalReplies = Reply::where('post_id', $request->post_id)->count();
            $total = $totalComments + $totalReplies;
            $displayComments = $total;

            $replies_count = Reply::where('comment_id', $request->comment_id)->count();

            return response()->json(['status' => true, 'comment_id' => $commentId, 'displayComments' => $displayComments, 'replies_count' => $replies_count]);
        }
        return response()->json(['status' => false,'message' => 'Reply Not Found'], 404);
    }

    public function parentReplyDestroy(Request $request, $id)
    {
        $reply = Reply::find($id);
        if ($reply && $reply->parent_id == $request->parent_id) {
            $commentId = $reply->comment_id;
            $replyId = $reply->parent_id;

            $reply->delete();

            $totalComments = Comment::where('post_id', $request->post_id)->count();

            $totalReplies = Reply::where('post_id', $request->post_id)->count();
            $total = $totalComments + $totalReplies;
            $displayComments = $total;

            $replies_count = Reply::where('comment_id', $request->comment_id)->count();
            // $comment_replies_count = Reply::where('parent_id', $replyId)->count();
            $comment_replies_count = Reply::where('parent_id', $replyId)->count();

            return response()->json(['status' => true, 'comment_id' => $commentId, 'displayComments' => $displayComments, 'replies_count' => $replies_count, 'comment_replies_count' => $comment_replies_count, 'reply_id' => $replyId]);
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
        //     $response = $sendgrid->send($email);

        //     print $response->statusCode() . "\n";
        //     print_r($response->headers());
        //     print $response->body() . "\n";
        // } catch (\Exception $e) {
        //     echo 'Caught exception: ' . $e->getMessage() . "\n";
        // }
    }
}
