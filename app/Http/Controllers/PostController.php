<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        if (session()->has('email')) {
            $email = session('email');
            $user = User::where('email', $email)->get()->first();
            $activeUserId = $user->id;
            $posts = Post::get()->reverse();

            foreach ($posts as $post) {
                $postUser = User::where('email', $post->user->email)->first();
                $post->postUserName = $postUser->name;
                $post->postUserDesignation = $postUser->designation;
                $post->postUserPorfilePic = $postUser->profilePic;
                $post->time_elapsed = $this->calculateTimeElapsed($post->created_at);

                $totalComments = Comment::where('post_id', $post->id)->count();

                $totalReplies = Reply::where('post_id', $post->id)->count();
                $total = $totalComments + $totalReplies;
                $post->totalComments = $total;
                $post->displayComments = ($total == 0) ? 'No comments' : $total . ' comments';
                $post->userId = $user->id;
                $post->postUserId = $postUser->id;
            }

            // return view('forum', ['user'=>$user, 'questions' => $questions,'activeMenu' => 'forums']);
            return view('pages.forum', ['activeMenu' => 'forums'], compact('posts', 'user', 'activeUserId'));
        } else {
            return view('signin');
        }
    }


    public function singlePost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        $postUser = User::where('email', $post->user->email)->first();

        $post->postUserName = $postUser->name;
        $post->postUserDesignation = $postUser->designation;
        $post->postUserProfilePic = $postUser->profilePic;
        $post->time_elapsed = $this->calculateTimeElapsed($post->created_at);
        $post->postUserId = $postUser->id;

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

        return view('pages.single-post', compact('post', 'activeUserId'));
    }


    public function store(Request $request)
    {
        if (session()->has('email')) {


            // dd($request->all());
            $email = session('email');

            $activeUser = User::where('email', $email)->get()->first();

            // Validate the request
            // $request->validate([
            //     'media' => 'file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,webm,webM', // 20MB max size
            // ]);

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

            // Create the post
            $result = Post::create($postData);

            // dd($result);

            $name = $activeUser->name;

            // $post = Post::where('');

            $postId = $result->id;

            $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $postId;
            // $url = 'https://www.dentistryinanutshell.com/dian/public/single-post/' . $postId;
            // $url = 'https://test.dentistryinanutshell.com/lara/dev/dian/public/single-category/'.$questionId;

            $emailMessage = "Hi Admin,\n\nYou have received a question from " . $name . "\n\nFor Further information please check Forums page " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

            $fromEmail = 'noreply@dentistryinanutshell.com';
            $toEmail = 'asad.cybertron@gmail.com';
            $subject = "Received a Question in Forum!";
            // $ccemails = User::where('privilege', '3')->get()->all();

            // $this->mailnow($emailMessage, $toEmail, $subject, 'Admin', $ccemails);
            // $this->mailnow($emailMessage,$fromEmail, $toEmail, $subject, $name);
            // $message, $fromEmail, $toEmail, $subject, $userName
            if ($result) {
                return [
                    'status' => true
                ];
            } else {
                return [
                    'status' => false
                ];
            }
            // return redirect('forums');
        } else {
            return view('signin');
        }
    }


    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['status' => false, 'message' => 'Post not found'], 404);
        }

        // Delete the post
        $post->delete();

        Comment::where('post_id', $id)->delete();

        Reply::where('post_id', $id)->delete();

        // // Delete replies related to the post
        // Reply::whereHas('comment', function ($query) use ($id) {
        //     $query->where('post_id', $id);
        // })->delete();

        return response()->json(['status' => true, 'message' => '']);
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

        try {
            $response = $sendgrid->send($email);

            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    // public function mailNow($message, $toEmail, $subject, $userName, $ccemails)
    // {

    //     $dianKey = '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';

    //     $email = new \SendGrid\Mail\Mail();
    //     $email->setfrom('noreply@dentistryinanutshell.com', "DIAN");
    //     $email->setSubject($subject);
    //     if ($ccemails == '-') {
    //         $email->addto($toEmail, $userName);
    //     } else {
    //         foreach ($ccemails as $ccemail) {
    //             $email->addto($ccemail->email, $userName);
    //         }
    //     }

    //     $email->addContent("text/plain", $message);

    //     $sendgrid = new \SendGrid($dianKey);

    //     try {
    //         $response = $sendgrid->send($email);

    //         print $response->statusCode() . "\n";
    //         print_r($response->headers());
    //         print $response->body() . "\n";
    //     } catch (\Exception $e) {
    //         echo 'Caught exception: ' . $e->getMessage() . "\n";
    //     }
    // }
}
