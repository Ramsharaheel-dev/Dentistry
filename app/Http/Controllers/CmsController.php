<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Hashtag;
use App\Models\WorkFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Filter;
use App\Models\Guideline;
use App\Models\Student;
use Carbon\Carbon;

class CmsController extends Controller
{
    public function cmsLogin()
    {
        return view('cms.cms-login');
    }

    public function cmsLogout()
    {
        session()->forget('cms_email');
        session()->forget('cms_login');
        return redirect('cms-login');
    }

    public function checkCmsLogin(Request $request)
    {
        $cmsEmail = $request->cmsEmail;
        $cmsPassword = $request->cmsPassword;

        $admin = DB::table('admin')->where('email', $cmsEmail)->where('password', $cmsPassword)->get()->first();
        if ($admin != '') {
            session(['cms_login' => True]);
            session(['cms_email' => $cmsEmail]);
            // return view('cms.videos_upload');
            return redirect()->route('vimeo-videos');
        } else {
            return back();
        }
    }

    public function contentUpload()
    {
        if (session()->has('cms_login')) {
            return view('cms.content_upload');
        } else {
            return redirect()->route('cms.login');
        }
    }

    public function contentUploadStore(Request $request)
    {
        $thumbnailFile = $request->file('thumbnail');
        $name = $request->input('name');
        $url = $request->input('url');
        $selectedPage = $request->input('selected_page');
        $selectedCategory = $request->input('selected_category_id');

        // Dynamically save video info to the correct table based on selected page
        switch ($selectedPage) {
            case 'students':
                $video = new Student;
                if ($selectedCategory === '23') {
                    $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
                    $thumbnailFile->move(public_path('student/images'), $uniqueName);
                    $video->name = "images";
                    $video->hashtagId = $selectedCategory;
                    $video->thumbnailName = $uniqueName;
                } else if ($selectedCategory === '34') {
                    $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
                    $thumbnailFile->move(public_path('student/past papers'), $uniqueName);
                    $video->name = "pastPapers";
                    $video->hashtagId = $selectedCategory;
                    $video->thumbnailName = $uniqueName;
                } else if ($selectedCategory === '36') {
                    $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
                    $thumbnailFile->move(public_path('student/lectures'), $uniqueName);
                    $video->name = "lectures";
                    $video->hashtagId = $selectedCategory;
                    $video->thumbnailName = $uniqueName;
                } else if ($selectedCategory === '62') {
                    $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
                    $thumbnailFile->move(public_path('student/generic-notes'), $uniqueName);
                    $video->name = "Generic Notes";
                    $video->hashtagId = $selectedCategory;
                    $video->thumbnailName = $uniqueName;
                }

                break;
            case 'guidelines':
                $video = new Guideline;
                $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
                $thumbnailFile->move(public_path('guidelines'), $uniqueName);
                $video->name = $name;
                $video->thumbnailName = $uniqueName;
                $video->hashtagId = $selectedCategory;
                break;
            case 'courses':
                $video = new Course;
                $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
                $thumbnailFile->move(public_path('courses'), $uniqueName);
                $video->thumbnail_name = $uniqueName;
                break;
            default:
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid page selected.'
                ]);
        }
        $video->url = ($selectedCategory === '23') ? '-' : $url;
        $video->save();

        return response()->json([
            'status' => true,
            'message' => 'Content uploaded successfully!',
        ]);
    }

    public function blogUpload()
    {
        if (session()->has('cms_login')) {
            return view('cms.blog_upload');
        } else {
            return redirect()->route('cms.login');
        }
    }

    public function blogUploadStore(Request $request)
    {
        // Custom error messages
        $messages = [
            'content.*.image.mimes' => 'Only PNG images are allowed for content images.',
            'content.*.image.max' => 'Each content image must not exceed 2 MB.',
        ];

        // Validate the incoming request with custom messages
        $validatedData = $request->validate([
            'title' => 'required|string',
            'shortTitle' => 'required|string',
            'publisher' => 'required|string',
            'shortDescription' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content.*.image' => 'nullable|image|mimes:png|max:2048',
            'content.*.heading' => 'nullable|string',
            'content.*.description' => 'nullable|string',
        ], $messages);

        // Handle thumbnail upload
        $thumbnailFile = $request->file('thumbnail');
        $thumbnailName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
        $thumbnailFile->move(public_path('blogs/thumbnails'), $thumbnailName);

        // Prepare the data to be stored as JSON
        $blogData = [
            'title' => $validatedData['title'],
            'shortTitle' => $validatedData['shortTitle'],
            'publisher' => $validatedData['publisher'],
            'shortDescription' => $validatedData['shortDescription'],
            'content' => []
        ];

        // Handle content blocks
        if ($request->has('content')) {
            foreach ($request->input('content') as $index => $content) {
                // Handle image upload if present
                if ($request->hasFile("content.$index.image")) {
                    $imagePath = $request->file("content.$index.image");

                    // Generate a unique name for the image without the extension
                    $imageName = uniqid(); // Generate a unique identifier
                    $imageExtension = $imagePath->getClientOriginalExtension(); // Get the extension

                    // Move the image to the desired location with the extension
                    $imagePath->move(public_path('blogs/blogImages/general'), "$imageName.$imageExtension");
                } else {
                    $imageName = null;
                }

                // Add the content block to the blog data
                $blogData['content'][] = [
                    'image' => $imageName,  // Store only the image name without extension
                    'heading' => $content['heading'] ?? '',
                    'description' => $content['description'] ?? '',
                ];
            }
        }

        // Save the blog data as JSON
        $blog = new Blog;
        $blog->data = json_encode([$blogData]);
        $blog->thumbnail = $thumbnailName;
        $blog->nameOfPublisher = $request->publisher;
        $blog->dateOfPublish = now();
        $blog->hashtagId = '48'; // This should be dynamic if needed
        $blog->save();

        return response()->json(['status' => true, 'message' => 'Blog created successfully!']);
    }

    public function templateUpload()
    {
        if (session()->has('cms_login')) {
            return view('cms.template_upload');
        } else {
            return redirect()->route('cms.login');
        }
    }


    public function templateUploadStore(Request $request)
    {
        $templateName = $request->input('template_name');
        $surveyData = $request->input('surveyData');

        // Now you can save these to your database, for example:
        $template = new Filter;
        $template->title = $templateName;
        $template->content = $surveyData; // Assuming you have a JSON column
        $template->save();

        return response()->json(['status' => 'success']);
    }


    public function workflowUpload()
    {
        if (session()->has('cms_login')) {
            return view('cms.workflow_upload');
        } else {
            return redirect()->route('cms.login');
        }
    }


    public function workfoUploadStore(Request $request)
    {
        $thumbnailFile = $request->file('thumbnail');
        $name = $request->input('name');
        $url = $request->input('url');
        $selectedPage = $request->input('selected_page');
        $selectedCategory = $request->input('selected_category_id');

        $hashtagName = Hashtag::where('id', $selectedCategory)->first();

        $video = new WorkFlow;
        $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();

        $thumbnailFile->move(public_path("workFlows/{$hashtagName}"), $uniqueName);

        $video->name = $name;
        $video->hashtagId = $selectedCategory;
        $video->thumbnailName = $uniqueName;
        $video->url = $url;
        $video->save();

        return response()->json([
            'status' => true,
            'message' => 'Content uploaded successfully!',
        ]);
    }

    public function cmsAnalyticsShow()
    {
        // Fetch all plans with their subscription counts
        $plans = DB::table('plans')
            ->where('status', 'active')
            ->leftJoin('subscriptions', 'plans.id', '=', 'subscriptions.planId')
            ->select('plans.name', 'plans.id', DB::raw('count(subscriptions.id) as total'))
            ->groupBy('plans.id', 'plans.name')
            ->orderBy('plans.id')
            ->get();

        $totalSubscriptions = $plans->sum('total');

        // Calculate percentage for each plan
        $subscriptions = $plans->map(function ($plan) use ($totalSubscriptions) {
            return [
                'name' => $plan->name,
                'total' => $plan->total,
                'percentage' => $totalSubscriptions > 0 ? round(($plan->total / $totalSubscriptions) * 100, 2) : 0,
            ];
        });

        // Group subscriptions by plan type
        $subscriptionsGrouped = $subscriptions->keyBy('name');

        // Fetch users and their subscriptions
        $usersByPlan = DB::table('subscriptions')
            ->where('subscriptions.status', 'active')
            ->join('users', 'subscriptions.userEmail', '=', 'users.email')
            ->join('plans', 'subscriptions.planId', '=', 'plans.id')
            ->select(
                'plans.name as plan_name',
                'users.firstName',
                'users.lastName',
                'users.email',
                'subscriptions.startDate' // Fetching startDate from subscriptions table
            )
            ->get()
            ->groupBy('plan_name');

        // Calculate totals for individual plans
        $totalsByPlan = [
            'starter' => $subscriptionsGrouped->get('starter')['total'] ?? 0,
            'starterYearly' => $subscriptionsGrouped->get('starterYearly')['total'] ?? 0,
            'student' => $subscriptionsGrouped->get('student')['total'] ?? 0,
            'studentYearly' => $subscriptionsGrouped->get('studentYearly')['total'] ?? 0,
            'premium' => $subscriptionsGrouped->get('premium')['total'] ?? 0,
            'premiumYearly' => $subscriptionsGrouped->get('premiumYearly')['total'] ?? 0,
            'dentistryOwner' => $subscriptionsGrouped->get('dentistryOwner')['total'] ?? 0,
            'dentistryOwnerYearly' => $subscriptionsGrouped->get('dentistryOwnerYearly')['total'] ?? 0,
        ];

        return view('cms.analytics', compact('subscriptions', 'subscriptionsGrouped', 'usersByPlan', 'totalsByPlan'));
    }
}
