<?php

namespace Iidev\StripeSubscriptions\View\Checkout;

use XCart\Extender\Mapping\Extender;

/**
 * Checkout payment
 * @Extender\Mixin
 */
abstract class Payment extends \XLite\View\Checkout\Payment
{
    /**
     * Register CSS files
     *
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();

        $list[] = 'modules/Iidev/StripeSubscriptions/checkout/style.css';

        return $list;
    }

}
