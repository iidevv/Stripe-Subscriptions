<?php

namespace Iidev\StripeSubscriptions\Controller\Customer;

use XCart\Extender\Mapping\Extender;

/**
 * Extends customer base controller to show a message on all customer pages
 * @Extender\Mixin
 */
class MembershipUpdateReminder extends \XLite\Controller\Customer\ACustomer
{
    public function handleRequest()
    {

        parent::handleRequest();

        if ($this->getProfile() && $this->getProfile()->isMembershipMigrationProfile() && !$this->isAJAX()) {
            $this->showMessageForPromembers();
        }

    }

    public function getSubscriptionButton()
    {
        return '
        <form action="/stripe-subscriptions" method="POST">
            <input name="return_url" type="hidden" value="' . $this->getSubscriptionReturnUrl() . '">
            <input name="success_url" type="hidden" value="' . $this->getSubscriptionSuccessUrl() . '">
            <br>
            <button class="regular-button regular-main-button" type="submit">Update and Extend</button>
        </form>';
    }
    public function showMessageForPromembers()
    {
        $message = '<b>Action Needed: </b>Update Your Pro Membership Payment!<br>';
        $description = 'This isn’t a charge—simply update your info in the new portal. No payment until renewal, plus enjoy an extra 2 months free when your current plan ends! '.$this->getSubscriptionButton().'';
        \XLite\Core\TopMessage::getInstance()->addInfo($message . ' ' . $description);
    }




}