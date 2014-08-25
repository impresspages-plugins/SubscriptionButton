<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 6/22/14
 * Time: 11:04 PM
 */

namespace Plugin\SubscriptionButton\Widget\SubscriptionButton;


class Controller extends \Ip\WidgetController
{


    /**
     * Gets widget title
     *
     * Override this method to set the widget name displayed in widget toolbar.
     *
     * @return string Widget's title
     */
    public function getTitle()
    {
        return __('Subscription button', 'SubscriptionButton', false);
    }


    /**
     * Renders widget's HTML output
     *
     * You can extend this method when generating widget's HTML.
     *
     * @param int $revisionId Widget revision ID
     * @param int $widgetId Widget ID
     * @param int $widgetId Widget instance ID
     * @param array $data Widget data array
     * @param string $skin Skin name
     * @return string Widget's HTML code
     */

    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {

        if (!isset($data['buttonText'])) {
            $data['buttonText'] = '';
        }
        if (!isset($data['currency'])) {
            $data['currency'] = 'USD';
        }

        $data['widgetId'] = $widgetId;
        $data['checkoutUrl'] = ipRouteUrl('SubscriptionButton_subscribe', array('widgetId' => $widgetId));

        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }


}
