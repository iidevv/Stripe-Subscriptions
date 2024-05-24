<?php

namespace Iidev\StripeSubscriptions\Controller\Customer;

class SubscriptionPage extends \XLite\Controller\Customer\ACustomer
{

    /**
     * Return the current page title (for the content area)
     *
     * @return string
     */
    public function getTitle()
    {
        return static::t('Pro membership');
    }

    public function isLogged()
    {
        return \XLite\Core\Auth::getInstance()->isLogged();
    }

    public function getSubscriptionReturnUrl()
    {
        return \XLite::getController()->getURL();
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
     * Common method to determine current location
     *
     * @return string
     */
    protected function getLocation()
    {
        return $this->getTitle();
    }
}