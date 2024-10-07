<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AssistController as ApiAssistController;
use App\Http\Controllers\Api\BillingController as ApiBillingController;
use App\Http\Controllers\Api\MainController as ApiMainController;
use App\Http\Controllers\Api\FilterController as ApiFilterController;
use App\Http\Controllers\Api\PdfController as ApiPdfController;
use App\Http\Controllers\Api\StudentNoteController as ApiStudentNoteController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\Api\TemplateController as ApiTemplateController;
use App\Http\Controllers\Api\CommentController as ApiCommentController;
use App\Http\Controllers\Api\PostController as ApiPostController;
use App\Http\Controllers\Api\ReplyController as ApiReplyController;
use App\Http\Controllers\Api\NotificationController as ApiNotificationController;
use App\Http\Controllers\Api\VideoController as ApiVideoController;
use App\Http\Controllers\Api\AssignController as ApiAssignController;
use App\Http\Controllers\Api\SearchController as ApiSearchController;
use App\Http\Controllers\Api\StripeController as ApiStripeController;
use App\Http\Controllers\Api\WorkFlowController as ApiWorkFlowController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('login', function () {
    return response()->json([
        'status' => false,
        'message' => 'Bearer Token Not Valid'
    ], 403);
})->name('login');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Google SignUp
Route::post('auth/google', [AuthController::class, 'googleSignUp']);
// Apple SignUp
Route::post('auth/apple', [AuthController::class, 'appleSignUp']);

Route::middleware('auth:sanctum')->group(function () {
    // logout
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // Setup Profile
    Route::post('setup-profile', [ApiUserController::class, 'uploadInitialProfileData']);

    // Filterization
    Route::get('hashtag-filter', [ApiFilterController::class, 'filter']);

    // Dashboard
    Route::get('dashboard', [ApiMainController::class, 'dashboard']);
    Route::get('dashboard/{id}', [ApiMainController::class, 'dashboardVideoShow']);

    // Podcast and webinars
    Route::get('podcasts', [ApiMainController::class, 'podcast']);
    Route::get('podcast/{id}', [ApiMainController::class, 'podcastVideoShow']);

    // Business and Finance
    Route::get('business-and-finance', [ApiMainController::class, 'buildYourBusiness']);

    // Blogs
    Route::get('blogs', [ApiMainController::class, 'allBlogs']);
    Route::get('single-blog', [ApiMainController::class, 'singleBlog']);

    // Students
    Route::get('students', [ApiMainController::class, 'student']);
    Route::post('students/save_note', [ApiStudentNoteController::class, 'saveStudentNotes']);
    Route::get('students/get_save_note', [ApiStudentNoteController::class, 'getStudentNotes']);

    // Health & Welbeing
    Route::get('health-and-welbeing', [ApiMainController::class, 'healthAndWellbeing']);

    // Courses
    Route::get('courses', [ApiMainController::class, 'courses']);

    // Guidelines
    Route::get('guidelines', [ApiMainController::class, 'guidelines']);

    // Downloads
    Route::get('downloads', [ApiMainController::class, 'downloads']);

    // Manage Users
    Route::post('user/store-user', [ApiUserController::class, 'storeUser']);
    Route::get('user/get-users', [ApiUserController::class, 'manageUsers']);

    // Edit-Profile
    Route::post('user/edit-profile', [ApiUserController::class, 'updateUserProfile']);

    // Delete Profile Picture
    Route::delete('user/delete-profile-image', [ApiUserController::class, 'deleteProfileImage']);

    // Billing
    Route::get('get-billing-info', [ApiBillingController::class, 'getBillingInfo']);
    Route::get('invoice-pdf', [ApiPdfController::class, 'invoicePdf']);

    // Speech To Text
    Route::get('assist/get-speech-record', [ApiAssistController::class, 'getSpeechToTextNotes']);
    Route::post('assist/store-speech-record', [ApiAssistController::class, 'saveSpeechToText']);

    // Patient Explainer Videos
    Route::get('assist/patient-explainer-videos', [ApiAssistController::class, 'patientExplainerVideos']);

    // CPD Certificate PDF
    Route::get('certificate-pdf', [ApiPdfController::class, 'generatePdf']);

    // Email Template
    Route::get('email-template', [ApiAssistController::class, 'emailTemplate']);
    Route::post('send-email-template', [ApiAssistController::class, 'sendEmailTemplate']);
    Route::post('save-template-video', [ApiAssistController::class, 'saveEmailTemplateVideo']);

    // Notes Template
    Route::get('all-templates', [ApiTemplateController::class, 'allTemplates']);
    Route::get('notes-template/{templateId}', [ApiTemplateController::class, 'getPatientNotesTemplate']);
    Route::post('save-notes-template', [ApiTemplateController::class, 'saveNotesTemplate']);
    Route::get('saved-templates', [ApiTemplateController::class, 'savedTemplates']);
    Route::get('get-saved-templates/{templateId}', [ApiTemplateController::class, 'displaySavedPatientNotes']);

    // ******************** FORUMS START ********************* //

    // Post
    Route::post('create-post', [ApiPostController::class, 'store']);
    Route::get('get-posts', [ApiPostController::class, 'getPosts']);
    Route::delete('delete-post/{postId}', [ApiPostController::class, 'destroy']);

    // COMMENT
    Route::post('store-comment', [ApiCommentController::class, 'store']);
    Route::get('get-comments/{postId}', [ApiCommentController::class, 'getComments']);
    Route::delete('delete-comment/{commentId}', [ApiCommentController::class, 'destroy']);

    // REPLY
    Route::post('store-reply', [ApiReplyController::class, 'store']);
    Route::get('get-replies/{commentId}', [ApiReplyController::class, 'getReplies']);
    Route::delete('delete-reply/{replyId}', [ApiReplyController::class, 'destroy']);

    // ******************** FORUMS END ********************* //

    // NOTIFICATIONS
    Route::get('get-notifications', [ApiNotificationController::class, 'getNotifications']);
    Route::get('marked-read/{id}', [ApiNotificationController::class, 'markRead']);


    // ******************** ASSIGN VIDEOS START ********************* //

    Route::post('update-watch-time', [ApiVideoController::class, 'updateWatchedTime']);
    Route::post('video-completed', [ApiVideoController::class, 'handleVideoCompletion']);
    Route::post('save-survey-form', [ApiVideoController::class, 'saveSurveyForm']);
    Route::get('get-total-length', [ApiVideoController::class, 'getTotalLength']);
    Route::post('store-watch-time', [ApiVideoController::class, 'storeWatchTime']);

    Route::get('fetch-selected-items', [ApiAssignController::class, 'fetchSelectedItems']);
    Route::post('assign-videos', [ApiAssignController::class, 'assignVideos']);

    // ******************** ASSIGN VIDEOS START ********************* //

    // SEARCH BAR
    Route::get('search', [ApiSearchController::class, 'search']);

    // DELETE ACCOUNT
    Route::post('delete-account', [ApiStripeController::class, 'cancelSubscription']);

    // PRICING
    Route::get('get-plans', [ApiStripeController::class, 'subscriptionPlans']);
    Route::post('add-subscription', [ApiStripeController::class, 'addSubscription']);
    Route::post('upgrade-subscription', [ApiStripeController::class, 'upgradeSubscription']);
    Route::post('create-payment-intent', [ApiStripeController::class, 'createPaymentIntent']);

    //WorkFLows
    Route::get('get-workflows', [ApiWorkFlowController::class, 'workFlows']);

});
