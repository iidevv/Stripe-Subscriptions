<?php

/**
 * Copyright (c) 2011-present Qualiteam software Ltd. All rights reserved.
 * See https://www.x-cart.com/license-agreement.html for license details.
 */

namespace Iidev\StripeSubscriptions\Model;

use XCart\Extender\Mapping\Extender;
use XLite\Core\Cache\ExecuteCachedTrait;
use XLite\Core\Converter;

/**
 * @Extender\Mixin
 * @Extender\Depend ("CDev\SimpleCMS")
 */
class Menu extends \CDev\SimpleCMS\Model\Menu
{
    use ExecuteCachedTrait;

    public const DEFAULT_SUBSCRIPTION_PAGE = '{pro-membership}';

    /**
     * Defines the resulting link values for the specific link values
     * for example: {home}
     *
     * @return array
     */
    protected function defineLinkURLs()
    {
        $list = parent::defineLinkURLs();

        $list[static::DEFAULT_SUBSCRIPTION_PAGE] = $this->executeCachedRuntime(static function () {
            return Converter::buildURL('subscription_page');
        }, ['subscription_page']);

        return $list;
    }

    /**
     * Defines the link controller class names for the specific link values
     * for example: {home}
     *
     * @return array
     */
    protected function defineLinkControllers()
    {
        $list = parent::defineLinkControllers();

        $list[static::DEFAULT_SUBSCRIPTION_PAGE] = '\Iidev\StripeSubscriptions\Controller\Customer\SubscriptionPage';

        return $list;
    }
}
