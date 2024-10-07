<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Storage;
use File;
use Carbon\Carbon; 
use GeneaLabs\LaravelSocialiter\Facades\Socialiter;
use Laravel\Socialite\Facades\Socialite;


if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class AppleSignInController extends Controller
{
    
    public function redirectToApple()
    {
        return Socialite::driver('sign-in-with-apple')->scopes(["name", "email"])->redirect();
    }

    public function handleAppleCallback()
    {   
        $user = Socialite::driver('sign-in-with-apple')->stateless()->user();
        // {"id":"000625.a463b774906449598b4ac34d3e2aac1e.1649","nickname":null,"name":null,"email":"admin@ultraproventures.com","avatar":null,"user":{"iss":"https:\/\/appleid.apple.com","aud":"apple.signin.dian","exp":1697649761,"iat":1697563361,"sub":"000625.a463b774906449598b4ac34d3e2aac1e.1649","at_hash":"g0mmouq54rGVWwQJpdk_1w","email":"admin@ultraproventures.com","email_verified":"true","auth_time":1697563360,"nonce_supported":true},"attributes":{"id":"000625.a463b774906449598b4ac34d3e2aac1e.1649","name":null,"email":"admin@ultraproventures.com"},"token":"eyJraWQiOiJmaDZCczhDIiwiYWxnIjoiUlMyNTYifQ.eyJpc3MiOiJodHRwczovL2FwcGxlaWQuYXBwbGUuY29tIiwiYXVkIjoiYXBwbGUuc2lnbmluLmRpYW4iLCJleHAiOjE2OTc2NDk3NjEsImlhdCI6MTY5NzU2MzM2MSwic3ViIjoiMDAwNjI1LmE0NjNiNzc0OTA2NDQ5NTk4YjRhYzM0ZDNlMmFhYzFlLjE2NDkiLCJhdF9oYXNoIjoiZzBtbW91cTU0ckdWV3dRSnBka18xdyIsImVtYWlsIjoiYWRtaW5AdWx0cmFwcm92ZW50dXJlcy5jb20iLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJhdXRoX3RpbWUiOjE2OTc1NjMzNjAsIm5vbmNlX3N1cHBvcnRlZCI6dHJ1ZX0.kXS9B-Ky7Ta3vevIwBfRTndBkeXYWAT38WZ_AfsFjztXJ76g3Y0sjuSJMSYTR_yrM2_1Auu8YAWpdLuGiMEGWvQzBE5ohMaxRbaDkyDW0qM6jVdj9mMGLwXupVbob64bDHZi5pkNFCc6w0O6ed_c_J2LiWZGhqDzLoyP8Gma52f1BFIK7r25b2uib5YrKtFtnKK8Mdu9ooExoaiX-p6TFe0rnQxAPiHNQnOIcS8wvHXz-qVWWAqf2Pt3-t6eimNIwv9g1lyPS6HaF1M6Leu5yoEbzms1NkKwcYLoLtNkCiQ1URmYjbS4-C5WLVpnUqoQNSk7FHZ1eW9vWH4VqJ6QFw","refreshToken":"r04f67624d39e4c56a279682c388651e4.0.swsv.JuX8lXt2RI5LkDokgRz1FQ","expiresIn":3600,"approvedScopes":null}
        return response()->json($user);
    }
}