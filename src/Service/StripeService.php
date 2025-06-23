<?php

namespace App\Service;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;

class StripeService
{
    public function __construct()
    {
        $apiKey = $_ENV['STRIPE_SECRET_KEY'];
        
        if (!$apiKey) {
            throw new \Exception('API key is missing');
        }

        Stripe::setApiKey($apiKey);
    }

    /**
     * Récupérer la liste des paiements
     *
     * @return array
     */
    public function getPaymentIntents()
    {
        try {
            $paymentIntents = PaymentIntent::all(['limit' => 10]);

            return $paymentIntents->data;
        } catch (ApiErrorException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
