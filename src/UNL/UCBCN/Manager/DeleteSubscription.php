<?php
namespace UNL\UCBCN\Manager;

use UNL\UCBCN\Calendar;
use UNL\UCBCN\Permission;
use UNL\UCBCN\Calendar\Subscription;
use UNL\UCBCN\Calendar\SubscriptionHasCalendar;

class DeleteSubscription extends PostHandler
{
    public $options = array();
    public $calendar;
    public $subscription;

    public function __construct($options = array()) 
    {
        $this->options = $options + $this->options;
        $this->calendar = Calendar::getByShortname($this->options['calendar_shortname']);

        if ($this->calendar === FALSE) {
            throw new \Exception("That calendar could not be found.", 404);
        }

        $user = Auth::getCurrentUser();
        if (!$user->hasPermission(Permission::CALENDAR_EDIT_SUBSCRIPTIONS_ID, $this->calendar->id)) {
            throw new \Exception("You do not have permission to edit subscriptions on this calendar.", 403);
        }

        $this->subscription = Subscription::getByID($this->options['subscription_id']);

        if ($this->subscription === FALSE) {
            throw new \Exception("That subscription could not be found.", 404);
        }
    }

    public function handlePost(array $get, array $post, array $files)
    {
        if (!isset($post['subscription_id'])) {
            throw new \Exception("The subscription_id must be set in the post data", 400);
        }

        if ($post['subscription_id'] != $this->subscription->id) {
            throw new \Exception("The subscription_id in the post data must match the subscriptions_id in the URL", 400);
        }

        foreach($this->subscription->getSubscribedCalendars() as $calendar) {
            $record = SubscriptionHasCalendar::get($this->subscription->id, $calendar->id);
            $record->delete();
        }

        $this->subscription->delete();
        
        $this->flashNotice(parent::NOTICE_LEVEL_SUCCESS, 'Subscription Deleted', 'The subscription "' . $this->subscription->name . '" has been deleted.');
        //redirect
        return $this->calendar->getSubscriptionsURL();
    }
}