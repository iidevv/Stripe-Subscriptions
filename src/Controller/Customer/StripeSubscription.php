<?php

namespace Iidev\StripeSubscriptions\Controller\Customer;

use XCart\Extender\Mapping\Extender;
use \XLite\Core\Config;

/**
 * Extends customer base controller to show a message on all customer pages
 * @Extender\Mixin
 */
class StripeSubscription extends \XLite\Controller\Customer\ACustomer
{

    public function getSubscriptionSuccessUrl()
    {
        return $this->buildURL() . "subscription-activation";
    }

    public function getSubscriptionReturnUrl()
    {
        return \XLite::getController()->getURL();
    }

    public function isAuthorized()
    {
        return $this->getProfile();
    }
    public function displayScriptData()
    {
        $data = [
            "url_params" => [
                'target' => 'login',
                'widget' => '\XLite\View\Authorization',
                'fromURL' => \XLite::getController()->getURL(),
                'popup' => '1',
            ]
        ];

        echo ('<script type="text/x-cart-data">' . "\r\n" . json_encode($data) . "\r\n" . '</script>' . "\r\n");
    }

    /**
     * @return bool
     */
    public function isProMembership(): bool
    {
        if ($this->getProfile() && $this->getProfile()->getMembership()) {
            return true;
        }
        return false;
    }
    public function getImageUrl()
    {
        return Config::getInstance()->Iidev->StripeSubscriptions->image_url;
    }
}