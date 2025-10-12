<?php

namespace App\Events\PaymentGateways\Stripe;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;

class SubscriptionFailed {
    use SerializesModels;

    public $session;
    public $webhook;

    public function __construct($session, $webhook) {
        $this->session = $session;
        $this->webhook = $webhook;
    }
}