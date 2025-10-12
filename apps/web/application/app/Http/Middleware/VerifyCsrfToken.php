<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware {
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'install',
        'login',
        'webform',
        'webform/submit/*',
        'webform/fileupload',
        'api/stripe/webhooks',
        'api/mollie/webhooks',
        'api/paypal/ipn',
        'api/paystack/webhooks',
        'payments/thankyou',
        'payments/thankyou/razorpay',
        'modules/*/api/*',
        'modules/*/webhooks/*',


        //[MT]
        'app-admin/webhooks/*',
        'app/settings/account/thankyou',
    ];
}
