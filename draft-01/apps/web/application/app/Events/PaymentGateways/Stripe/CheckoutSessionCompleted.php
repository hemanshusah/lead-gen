<?php

namespace App\Events\PaymentGateways\Stripe;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckoutSessionCompleted {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $session;
    public $webhook;

    /**
     * Create a new event instance.
     */
    public function __construct($session, $webhook) {
        $this->session = $session;
        $this->webhook = $webhook;
    }
}