<?php
/**
 * @package   ImpressPages
 */


namespace Plugin\SubscriptionButton;


class SiteController extends \Ip\Controller
{

    public function subscribe ($widgetId)
    {
        $widget = \Ip\Internal\Content\Model::getWidgetRecord($widgetId);
        if (!$widget) {
            throw new \Ip\Exception('Missing required variable');
        }
        $widgetData = $widget['data'];


$options = array(
    'item' => 'Plan A',
    'period' => 1,
    'periodType' => 'day', //day, week, month, year
    'amount' => 9900,
    'currency' => 'USD'
);
$subscriptionUrl = ipEcommerce()->subscriptionPaymentUrl($options);

        if (!ipUser()->loggedIn()) {
            $_SESSION['User_redirectAfterLogin'] = ipRouteUrl('SubscriptionButton_subscribe', array('widgetId' => $widgetId));
            $loginUrl = ipRouteUrl('User_login');
            return new \Ip\Response\Redirect($loginUrl);
        }

        return '<a class="button" href="' . escAttr($subscriptionUrl) . '" >Subscribe</a>';

    }
}
