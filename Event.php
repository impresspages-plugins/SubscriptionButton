<?php
/**
 * @package   ImpressPages
 */



namespace Plugin\SubscriptionButton;

/**
 * This is an example class how to catch subscription events.
 * Usually you would putt this class to your own plugin. But you can try a quick and dirty way by just modifying this class.
 * Be careful as your changes will be lost on update.
 * Class Event
 * @package Plugin\SubscriptionButton
 */
class Event
{


    public static function ipSubscriptionSignup($info)
    {
        //mark somehow in the database that this user has subscribed to this service
        //$info['item'] - subscription plan
        //$info['userId'] - user that has purchased the subscription


    }

    public static function ipSubscriptionExpired($info)
    {
        //deny services to the user
        //$info['item'] - subscription plan
        //$info['userId'] - user that has purchased the subscription

    }


}
