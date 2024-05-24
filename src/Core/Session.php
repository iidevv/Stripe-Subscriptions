<?php

namespace Iidev\StripeSubscriptions\Core;

use \XLite\Core\Config;
use \Stripe\Stripe;
use \Stripe\Checkout\Session as StripeSession;
use \Stripe\BillingPortal\Session as StripeAccountSession;

class Session
{
    protected $profile;
    protected $returnUrl;

    public function __construct(\XLite\Model\Profile $profile, string $returnUrl = '')
    {
        $this->profile = $profile;
        $this->returnUrl = $returnUrl;
    }
    protected function getApiKey()
    {
        return Config::getInstance()->Iidev->StripeSubscriptions->secret_key;
    }

    protected function setApiKey()
    {
        Stripe::setApiKey($this->getApiKey());
    }

    public function createSession()
    {
        $this->setApiKey();

        $email = $this->profile->getLogin();
        $returnUrl = $this->returnUrl;

        return StripeSession::create([
            'success_url' => $returnUrl,
            'cancel_url' => $returnUrl,
            'mode' => 'subscription',
            'line_items' => [
                [
                    'price' => 'price_1PC7iKRp9qylIqdZAFDLddbH',
                    'quantity' => 1,
                ]
            ],
            'customer_email' => $email,
        ]);
    }

    public function createAccountSession()
    {
        $this->setApiKey();

        $email = $this->profile->getLogin();
        $returnUrl = $this->returnUrl;

        return StripeAccountSession::create([
            'customer' => 'cus_QANaSBazQtuonC',
            'return_url' => $returnUrl,
        ]);
    }
}