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
            'item' => $widgetData['alias'],
            'period' => 1,
            'periodType' => $widgetData['period'], //day, week, month, year
            'amount' => $widgetData['price'] * 100,
            'currency' => $widgetData['currency']
        );

        if (!empty($widgetData['successUrl'])) {
            $options['successUrl'] = $widgetData['successUrl'];
        }

        $subscriptionUrl = ipEcommerce()->subscriptionPaymentUrl($options);

        return new \Ip\Response\Redirect($subscriptionUrl);

    }
}
