<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
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

    public function getPosts(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $activeUserId = $user->id;
        $baseUrl = url('/');

        $posts = Post::get()->reverse();

        foreach ($posts as $post) {
            $postUser = $post->user;
            $post->postUserName = $postUser->name;
            $post->postUserDesignation = $postUser->designation;
            $post->postUserProfilePic = $postUser->profilePic;
            $post->time_elapsed = $this->calculateTimeElapsed($post->created_at);

            $totalComments = Comment::where('post_id', $post->id)->count();
            $totalReplies = Reply::where('post_id', $post->id)->count();
            $total = $totalComments + $totalReplies;

            $post->totalComments = $total;
            $post->displayComments = ($total == 0) ? 'No comments' : $total . ' comments';
            $post->userId = $user->id;
            $post->postUserId = $postUser->id;

            if ($post->media_url) {
                $post->media_url = $baseUrl . '/storage/uploads/' . basename($post->media_url);
            }

            unset($post->user);
        }

        return response()->json([
            'status' => true,
            'posts' => $posts,
            'activeUserId' => $activeUserId,
            'token' => $token
        ], 200);
    }

    public function singlePost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->load(['user:id,name,designation,profilePic']);
        $post->postUserName = $post->user->name;
        $post->postUserDesignation = $post->user->designation;
        $post->postUserProfilePic = $post->user->profilePic;
        $post->time_elapsed = $this->calculateTimeElapsed($post->created_at);
        $post->postUserId = $post->user->id;

        $totalComments = Comment::where('post_id', $post->id)->count();
        $totalReplies = Reply::where('post_id', $post->id)->count();
        $total = $totalComments + $totalReplies;

        $post->totalComments = $total;
        $post->displayComments = ($total == 0) ? 'No comments' : $total . ' comments';

        $activeUserId = null;
        if (session()->has('email')) {
            $email = session('email');
            $user = User::where('email', $email)->first();
            if ($user) {
                $activeUserId = $user->id;
                $post->userId = $user->id;
            }
        }

        return response()->json([
            'status' => true,
            'post' => $post,
            'activeUserId' => $activeUserId
        ], 200);
    }

    public function store(Request $request)
    {
        $activeUser = $request->user();
        $email = $activeUser->email;
        $token = $request->bearerToken();

        $postData = [
            'content' => $request->content,
            'user_id' => $activeUser->id,
            'email' => $email,
        ];

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileName = time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $fileName);
            $postData['media_url'] = Storage::url('app/public/uploads/' . $fileName);
        }

        $result = Post::create($postData);

        // $name = $activeUser->name;
        // $postId = $result->id;
        // $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $postId;
        // $emailMessage = "Hi Admin,\n\nYou have received a question from " . $name . "\n\nFor Further information please check Forums page " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

        // $fromEmail = 'noreply@dentistryinanutshell.com';
        // $toEmail = $email;
        // $subject = "Received a Question in Forum!";

        // $this->mailNow($emailMessage, $fromEmail, $toEmail, $subject, $name);

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => "Post Created Successfully!",
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Something Went Wrong!",
                'token' => $token
            ], 403);
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
            ], 403);
        }

        $post->delete();
        Comment::where('post_id', $id)->delete();
        Reply::where('post_id', $id)->delete();

        return response()->json(['status' => true, 'message' => 'Post deleted successfully']);
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
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}
