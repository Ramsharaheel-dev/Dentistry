<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'submit-subscribe', 'submit-category', 'submit-thread', 'update-user-profile', 'upload-initial-profile-data', 'send-patient-email',
        'delete-forum-question', 'check-admin-login', 'add-discount-coupon', 'cancel-subscription', 'template-notes',
        'save-patient-notes', 'submit-subscription-plan', 'save-audio-test', 'single-blog', 'save-speech-to-text', 'submitCopd', 'submit-pubMed', 'save-video',
        'auth/apple/call-back'
    ];
}
