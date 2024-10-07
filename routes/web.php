<?php

use App\Http\Controllers\HashtagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesTesting;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VimeoController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ForumProfileController;
use App\Http\Controllers\StudentNotesController;
use App\Http\Controllers\UploadImagesController;
use App\Http\Controllers\DeleteAccountController;
use App\Http\Controllers\VideoRecorderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pubmed-search', function () {
    return view('pubmed');
});
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/subscription-plans', [StripeController::class, 'subscriptionPlans'])->name('subscriptionPlans');

Route::post('/submit-subscription-plan', [StripeController::class, 'submitSubscriptionPlans'])->name('submitSubscriptionPlans');
Route::post('/free-subscription-plan', [StripeController::class, 'freeSubscription'])->name('freeSubscription');
Route::get('/mail-now', [UserController::class, 'mailNow2'])->name('mail.now');

Route::get('/upgrade-subscription', [StripeController::class, 'upgradeSubscription'])->name('upgrade-subscription');

Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');

Route::get('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

Route::post('/cancel-subscription', [App\Http\Controllers\StripeController::class, 'cancelSubscription'])->name('cancelSubscription');

Route::get('/complete-checkout', [App\Http\Controllers\StripeController::class, 'completeCheckout'])->name('complete-checkout');

Route::get('/complete-upgrade-checkout', [App\Http\Controllers\StripeController::class, 'completeUpgradeCheckout'])->name('complete-upgrade-checkout');

// Route::get('/', function () {
//     return view('pages.welcome');
//     return view('pages.home');
// });

// Route::get('/', function () {
//     // return view('welcome');
//     return view('pages.assist');
// });

Route::get('/subscribe', function () {
    $response = 'Welcome to Dian...';

    return view('subscribe', ['response' => $response]);
});

Route::post('/save-video', [VideoRecorderController::class, 'saveVideo'])->name('save-video');
// Route::get('/save-video', [VideoRecorderController::class, 'saveVideo'])->name('save-video');

Route::get('/shopify-logo-url', [App\Http\Controllers\DashboardController::class, 'shopifyLogoUrl'])->name('shopifyLogoUrl');

Route::post('/submit-subscribe', [App\Http\Controllers\DashboardController::class, 'submitSubscribe'])->name('submitSubscribe');

Route::get('/pubMed', [App\Http\Controllers\DashboardController::class, 'pubMed'])->name('pubMed');

Route::post('/submit-pubMed', [App\Http\Controllers\DashboardController::class, 'submitPubMed'])->name('submitPubMed');

Route::get('/copd', [App\Http\Controllers\DashboardController::class, 'copd'])->name('copd');

Route::post('/submitCopd', [App\Http\Controllers\DashboardController::class, 'submitcopd'])->name('submitcopd');

Route::get('/signin', [App\Http\Controllers\GoogleAuthController::class, 'signin'])->name('signin');

Route::get('/signin2', function () {
    return view('signin2');
})->name('signin2');

Route::get('/test-vimeo', function () {
    return view('testVimeo');
})->name('testVimeo');

Route::get('auth/google', [App\Http\Controllers\GoogleAuthController::class, 'redirect'])->name('google-auth');

Route::get('auth/google2', [App\Http\Controllers\GoogleAuthController::class, 'redirect2'])->name('google-auth2');

Route::get('auth/google/call-back', [App\Http\Controllers\GoogleAuthController::class, 'callBackGoogle']);

Route::get('auth/google/call-back2', [App\Http\Controllers\GoogleAuthController::class, 'callBackGoogle2']);

Route::get('/auth/apple/login', [App\Http\Controllers\GoogleAuthController::class, 'redirectToApple'])->name('apple-auth');;

Route::post('/auth/apple/call-back', [App\Http\Controllers\GoogleAuthController::class, 'handleAppleCallback']);

Route::get('/logout', [App\Http\Controllers\GoogleAuthController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'home'])->name('home');

// Route::get('/welcome', [App\Http\Controllers\DashboardController::class, 'home'])->name('welcome');

Route::get('/', [App\Http\Controllers\DashboardController::class, 'home']);

Route::get('/privacy-policy', [App\Http\Controllers\DashboardController::class, 'privacyPolicy'])->name('privacyPolicy');

Route::get('/terms-and-conditions', [App\Http\Controllers\DashboardController::class, 'termsAndConditions'])->name('termsAndConditions');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/{id}', [DashboardController::class, 'dashboardVideoShow'])->name('dashboard.show.video');
Route::get('/podcast/{id}', [DashboardController::class, 'podcastVideoShow'])->name('podcast.show.video');

// function(){
//     return view('pages.home');
// }
// )->name('dashboard');

// Route::get(
//     '/redirecttonotes/{template',
//     [App\Http\Controllers\DashboardController::class, 'dashboardRedirectNotes']
// );

Route::get('/welcome', [DashboardController::class, 'welcome'])->name('welcome');

Route::get('get-sessions', function () {
    $session = session()->all();
    dd($session);
});

Route::get('/hashtag-filter', [App\Http\Controllers\DashboardController::class, 'hashtagFilter'])->name('hashtag-filter');

Route::get('/business-finance-hashtag-filter', [App\Http\Controllers\DashboardController::class, 'businessFinanceHashtagFilter'])->name('business-finance-hashtag-filter');

Route::get('/hashtag-filter2', [App\Http\Controllers\DashboardController::class, 'hashtagFilter2'])->name('hashtag-filter2');

Route::get('/setup-profile', [App\Http\Controllers\DashboardController::class, 'setupProfile'])->name('setup-profile');

Route::post('/upload-initial-profile-data', [App\Http\Controllers\DashboardController::class, 'uploadInitialProfileData'])->name('upload-initial-profile-data');

Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
Route::get('/edit-profile', [App\Http\Controllers\DashboardController::class, 'editProfile'])->name('edit.profile');

Route::post('/update-initial-profile-data', [App\Http\Controllers\DashboardController::class, 'uploadInitialProfileData'])->name('update-initial-profile-data');

Route::post('/update-user-profile', [App\Http\Controllers\DashboardController::class, 'updateUserProfile'])->name('update-user-profile');
Route::post('/delete-image', [DashboardController::class, 'deleteProfileImage'])->name('delete.image');

Route::get('/podcast', [App\Http\Controllers\DashboardController::class, 'podcast'])->name('podcast');

// Route::get('/assist', [App\Http\Controllers\DashboardController::class, 'assist'])->name('assist');
Route::get('/assist', [App\Http\Controllers\AssistController::class, 'assist'])->name('assist');
Route::get('/speech-to-text', [App\Http\Controllers\SpeechtotextController::class, 'speechtotext'])->name('speech-to-text');
Route::get('/pricing', [App\Http\Controllers\PricingController::class, 'pricing'])->name('pricing');
Route::get('/emailsender', [App\Http\Controllers\EmailsenderController::class, 'emailsender'])->name('emailsender');
// Route::get('/templates', [App\Http\Controllers\TemplatesController::class, 'templates'])->name('templates');
Route::get('/explainervideos', [App\Http\Controllers\ExplainervideosController::class, 'explainervideos'])->name('explainervideos');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'shop'])->name('shop');
Route::get('/shopdetails', [App\Http\Controllers\ShopdetailsController::class, 'shopdetails'])->name('shopdetails');
Route::get('/podcasts-and-webinars', [App\Http\Controllers\PodcastsController::class, 'podcasts'])->name('podcasts-and-webinars');
Route::get('/blogs', [App\Http\Controllers\BlogsController::class, 'blogs'])->name('blogs');
Route::get('/blogs-details', [App\Http\Controllers\BlogsDetailsController::class, 'blogsdetails'])->name('blogs-details');
Route::get('/pubmed', [App\Http\Controllers\PubmedController::class, 'pubmed'])->name('pubmed');
Route::get('/business-and-finance', [App\Http\Controllers\BusinessandFinanceController::class, 'businessandfinance'])->name('businessandfinance');
Route::get('/download', [App\Http\Controllers\DownloadController::class, 'download'])->name('download');
Route::get('/wellbeing', [App\Http\Controllers\WellbeingController::class, 'wellbeing'])->name('wellbeing');
Route::get('/courses', [App\Http\Controllers\CoursesController::class, 'courses'])->name('courses');
Route::get('/guideline', [App\Http\Controllers\GuidelineController::class, 'guideline'])->name('guideline');
Route::get('/comprehensive-exam', [App\Http\Controllers\ComprehensiveExamController::class, 'ComprehensiveExam'])->name('comprehensive-exam');
// Route::get('/forum', [App\Http\Controllers\ForumController::class, 'Forum'])->name('forum');
Route::get('/work-flow', [App\Http\Controllers\WorkflowController::class, 'workflow'])->name('work-flow');
Route::get('/refer', [App\Http\Controllers\ReferController::class, 'refer'])->name('refer');
Route::get('/email-notification', [App\Http\Controllers\EmailNotificationController::class, 'emailnotification'])->name('email-notification');
// Route::get('/edit-profile', [App\Http\Controllers\EditProfileController::class, 'editprofile'])->name('edit-profile');
Route::get('/billing', [App\Http\Controllers\BillingController::class, 'billing'])->name('billing');
Route::get('/general', [GeneralController::class, 'general'])->name('general');
Route::get('/delete-account', [DeleteAccountController::class, 'deleteaccount'])->name('delete-account');
Route::get('/certificate', [App\Http\Controllers\CertificateController::class, 'certificate'])->name('Certificate');
Route::get('/Notes2', [NotesTesting::class, 'notes'])->name('Notes2');

Route::post('/fetch_selected_items', [AssignController::class, 'fetchSelectedItems'])->name('fetch.selected.items');
Route::post('/assign_videos', [AssignController::class, 'assignVideos'])->name('assign.videos');
Route::get('/get-video-duration', [VideoController::class, 'getVideoDuration'])->name('get.video.duration');
Route::post('/update-watch-time', [VideoController::class, 'updateWatchedTime'])->name('update.watched.time');
Route::post('/video_completed', [VideoController::class, 'handleVideoCompletion'])->name('video.completed');
Route::post('/videos_watched_duration', [VideoController::class, 'videosWatchedDuration'])->name('videos.watched.duration');
Route::post('/save_survey_form', [VideoController::class, 'saveSurveyForm'])->name('save.survey.form');
Route::post('/get_total_length', [VideoController::class, 'getTotalLength'])->name('get.total.length');
Route::post('/store_watch_time', [VideoController::class, 'storeWatchTime'])->name('store.watch.time');
Route::get('/video-reel-duration', [VideoController::class, 'updateReelsVideoDurations'])->name('update.reels.duration');
Route::get('/video-podcast-duration', [VideoController::class, 'updatePodcastVideoDurations'])->name('update.podcast.duration');
Route::get('/get_assigned_Videos', [VideoController::class, 'getAssignedVideos'])->name('getAssignedVideos');
Route::get('/test-carbon', [VideoController::class, 'carbonTest'])->name('carbon');
Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate.pdf');

Route::get('/routine_exam', [App\Http\Controllers\RoutineExamController::class, 'Routineexam'])->name('routine-exam');
Route::get('/filling-composite', [App\Http\Controllers\FillingCompositeController::class, 'FillingComposite'])->name('filling-composite');
Route::get('/manage_users', [UserController::class, 'manageUsers'])->name('manage.users');
Route::post('/save-user', [UserController::class, 'storeUser'])->name('store.user');

// Route::get('/courses', [App\Http\Controllers\DashboardController::class, 'courses'])->name('courses');

Route::get('/courses1', [App\Http\Controllers\DashboardController::class, 'courses1'])->name('courses1');

Route::get('/health-and-wellbeing', [App\Http\Controllers\DashboardController::class, 'healthAndWellbeing'])->name('healthAndWellbeing');

Route::get('/build-your-business', [App\Http\Controllers\DashboardController::class, 'buildYourBusiness'])->name('buildYourBusiness');

Route::get('/downloads1', [App\Http\Controllers\DashboardController::class, 'downloads'])->name('downloads1');

Route::get('/student1', [App\Http\Controllers\DashboardController::class, 'student'])->name('student1');

Route::get('/forums-old', [ForumController::class, 'forums'])->name('forums');
Route::get('/forum2', [App\Http\Controllers\ForumtestController::class, 'forum2'])->name('forum2');
Route::get('/forum-profile/{id}', [ForumProfileController::class, 'forumprofile'])->name('forum.profile');

Route::get('/invoice', [InvoiceController::class, 'invoiceHtml'])->name('invoice.html');
Route::get('/invoice_pdf', [InvoiceController::class, 'invoicePdf'])->name('invoice.pdf');

// Route::get('/blogs', [App\Http\Controllers\DashboardController::class, 'blogs'])->name('blogs'); // not using

Route::get('/all-blogs', [App\Http\Controllers\DashboardController::class, 'allBlogs'])->name('allBlogs');

Route::get('/work-flows', [App\Http\Controllers\DashboardController::class, 'workFlows'])->name('workFlows');

Route::get('/guidelines1', [App\Http\Controllers\DashboardController::class, 'guidelines'])->name('guidelines1');

Route::post('/single-blog', [App\Http\Controllers\DashboardController::class, 'singleBlog'])->name('single-blog');

Route::get('/refer1', [App\Http\Controllers\DashboardController::class, 'refer'])->name('refer1');

Route::get('/guidelines', [App\Http\Controllers\DashboardController::class, 'guidelines'])->name('guidelines');

Route::get('/index', [App\Http\Controllers\ForumController::class, 'index'])->name('index');

Route::get('/threads', [App\Http\Controllers\ForumController::class, 'threads'])->name('threads');

Route::get('/ask-question', [App\Http\Controllers\ForumController::class, 'askQuestion'])->name('ask-question');

Route::post('/submit-question', [App\Http\Controllers\ForumController::class, 'submitQuestion'])->name('submit-question');

Route::get('/single-category/{questionId}', [App\Http\Controllers\ForumController::class, 'singleCategory'])->name('single-category');

Route::get('/delete-forum-question/{questionId}', [App\Http\Controllers\ForumController::class, 'deleteForumQuestion'])->name('delete-forum-question');

Route::post('/submit-thread', [App\Http\Controllers\ForumController::class, 'submitThread'])->name('submit-thread');

Route::get('/shopify-home', [App\Http\Controllers\ShopifyController::class, 'shopifyHome'])->name('shopify-home');

Route::get('/about-us', [App\Http\Controllers\AboutUsController::class, 'aboutUs'])->name('aboutUs');

Route::get('/faq', [App\Http\Controllers\DashboardController::class, 'faq'])->name('faq');
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'faq'])->name('faq');

// Route::get('/contact', [App\Http\Controllers\DashboardController::class, 'contact'])->name('contact');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');

Route::get('/packageInfo', [DashboardController::class, 'packageInfo'])->name('packageInfo');

Route::get('/page1', [TemplateController::class, 'page1'])->name('page1');

Route::get('/email-template', [TemplateController::class, 'emailTemplate'])->name('emailTemplate');

Route::get('/speech-to-text-notes', [TemplateController::class, 'speechToTextNotes'])->name('speechToTextNotes');

Route::get('/all-templates', [TemplateController::class, 'allTemplates'])->name('allTemplates');

Route::post('/template-notes', [TemplateController::class, 'templateNotes'])->name('templateNotes');

Route::get('/patient-notes/{templateId}', [TemplateController::class, 'patientNotes'])->name('patientNotes');
Route::get('/patient-notes2/{templateId}', [TemplateController::class, 'patientNotes2'])->name('patientNotes2');

Route::post('/save-patient-notes', [TemplateController::class, 'savePatientNotes'])->name('savePatientNotes');

Route::post('/save-speech-to-text', [TemplateController::class, 'saveSpeechToText'])->name('saveSpeechToText');

Route::get('/saved-patient-notes/{templateId}', [TemplateController::class, 'displaySavedPatientNotes'])->name('displaySavedPatientNotes');
Route::get('/saved-patient-notes2/{templateId}', [TemplateController::class, 'displaySavedPatientNotes2'])->name('displaySavedPatientNotes2');

Route::get('/delete-patientnotes-24hours', [TemplateController::class, 'deletePatientNotes'])->name('deletePatientNotes'); // RUNS DAILY

Route::get('/assist-videos', [DashboardController::class, 'assistVideos'])->name('assistVideos');

Route::post('/send-patient-email', [TemplateController::class, 'sendPatientEmail'])->name('sendPatientEmail');

Route::get('/check-renewel-subscription-notifications', [App\Http\Controllers\StripeController::class, 'checkRenewlSubscriptionNotifications'])->name('checkRenewlSubscriptionNotifications'); // RUNS DAILY

Route::get('/admin-login', [App\Http\Controllers\AdminController::class, 'adminLogin'])->name('admin-login');

Route::post('/check-admin-login', [App\Http\Controllers\AdminController::class, 'checkAdminLogin'])->name('checkAdminLogin');

Route::post('/add-discount-coupon', [App\Http\Controllers\AdminController::class, 'addDiscountCoupon'])->name('addDiscountCoupon');

Route::post('/update-subscription-plan', [App\Http\Controllers\AdminController::class, 'updateSubscriptionPlan'])->name('updateSubscriptionPlan');

// Route::get('/speech-to-text',[App\Http\Controllers\GoogleCloudSpeechController::class,'speechToText'])->name('speechToText');

Route::get('/voice-recorder-test', [App\Http\Controllers\GoogleCloudSpeechController::class, 'voiceRecorder'])->name('voiceRecorder');

// routes/web.php
Route::post('/save-audio-test', [App\Http\Controllers\GoogleCloudSpeechController::class, 'saveAudio'])->name('saveAudio');

Route::get('/get_notifications', [GeneralController::class, 'getNotifications'])->name('get.notifications');
Route::get('/marked_read/{id}', [GeneralController::class, 'markRead'])->name('marked.read');
Route::get('/check-assigned-notifications-read-status', [GeneralController::class, 'checkAssignedNotificationsReadStatus'])->name('check.assigned.notifications.read.status');

// FOR SAVING STUDENT NOTES
Route::post('/save_student_notes',[StudentNotesController::class, 'saveStudentNotes'])->name('save.student.notes');
Route::get('/get_student_notes',[StudentNotesController::class, 'getStudentNotes'])->name('get.student.notes');

// FORUM WORK

// Forum Posts
Route::get('/forums', [PostController::class, 'index'])->name('posts');
Route::post('/posts_store', [PostController::class, 'store'])->name('posts.store');
Route::get('/single-post/{id}', [PostController::class, 'singlePost'])->name('single.post');
Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');


// Forum Comments
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}', [CommentController::class, 'getComments'])->name('comments.get');
Route::delete('/comments/delete/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

// FOrum replies
Route::post('/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::get('/replies/{id}', [ReplyController::class, 'getReplies'])->name('replies.get');
Route::get('/replies/{id}/parents', [ReplyController::class, 'getParentReplies'])->name('replies.parent.get');
Route::delete('/replies/delete/{id}', [ReplyController::class, 'destroy'])->name('replies.destroy');
Route::delete('/replies/parent/delete/{id}', [ReplyController::class, 'parentReplyDestroy'])->name('replies.parent.destroy');


// FOR CMS WORK
Route::get('/cms-login', [CmsController::class, 'cmsLogin'])->name('cms.login');

Route::post('/check-cms-login', [CmsController::class, 'checkCmsLogin'])->name('cms.check.login');

Route::get('/cms-video-upload', [VimeoController::class, 'index'])->name('vimeo-videos');
Route::post('/upload-vimeo', [VimeoController::class, 'upload'])->name('upload-vimeo');
Route::get('/hashtags/{category}', [HashtagController::class, 'getHashtags'])->name('get.hashtags');
Route::post('/save-hashtags', [HashtagController::class, 'store'])->name('save.hashtags');

Route::get('/cms-content-upload', [CmsController::class, 'contentUpload'])->name('cms.content.upload');
Route::post('/cms-content-store', [CmsController::class, 'contentUploadStore'])->name('cms.content.store');

Route::get('/cms-blog-upload', [CmsController::class, 'blogUpload'])->name('cms.blog.upload');
Route::post('/cms-blog-store', [CmsController::class, 'blogUploadStore'])->name('cms.blog.store');

Route::get('/cms-template-upload', [CmsController::class, 'templateUpload'])->name('cms.template.upload');
Route::post('/cms-template-store', [CmsController::class, 'templateUploadStore'])->name('cms.template.store');

Route::get('/cms-workflow-upload', [CmsController::class, 'workflowUpload'])->name('cms.workflow.upload');
Route::post('/cms-workflow-store', [CmsController::class, 'workflowUploadStore'])->name('cms.workflow.store');

Route::get('/cms-analytics', [CmsController::class, 'cmsAnalyticsShow'])->name('cms.analytics.show');


Route::get('/cms-logout', [CmsController::class, 'cmsLogout'])->name('cms.logout');
