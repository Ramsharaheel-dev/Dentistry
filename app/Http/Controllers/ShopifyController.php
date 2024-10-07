<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\DB;

use Signifly\Shopify\Shopify;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// $shopify = new Shopify(
//     env('SHOPIFY_API_KEY'),
//     env('SHOPIFY_PASSWORD'),
//     env('SHOPIFY_DOMAIN'),
//     env('SHOPIFY_API_VERSION')
// );


class ShopifyController extends Controller
{
    function shopify()
    {
        $shopify = app(Shopify::class);
    }

    function shopifyHome()
    {
        return view('shopify');
    }
}
