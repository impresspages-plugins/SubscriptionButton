<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 6/24/14
 * Time: 4:25 PM
 */

namespace Plugin\SubscriptionButton;


class AdminController
{

    /**
     * @ipSubmenu Orders
     * @return string
     */
    public function index()
    {
        $config = array(
            'title' => __('Orders', 'SimpleProduct', false),
            'table' => 'simple_product_order',
            'orderBy' => 'id desc',
            'allowCreate' => false
        );

        $config = ipFilter('SimpleProduct_orderGridConfig', $config);

        return ipGridController($config);
    }

    public function widgetPopupForm()
    {
        $widgetId = ipRequest()->getQuery('widgetId');

        $widgetRecord = \Ip\Internal\Content\Model::getWidgetRecord($widgetId);
        $widgetData = $widgetRecord['data'];

        $form = FormHelper::widgetEditForm($widgetData);

        $popup = ipView('view/editPopup.php', array('form' => $form))->render();
        $data = array(
            'popup' => $popup
        );
        return new \Ip\Response\Json($data);

    }


    /**
     * Update widget data
     *
     * This method is executed each time the widget data is updated.
     *
     * @param int $widgetId Widget ID
     * @param array $postData
     * @param array $currentData
     * @return array Data to be stored to the database
     */
    public function update($widgetId, $postData, $currentData)
    {
        if (is_array($currentData['images'])) {
            foreach($currentData['images'] as $image) {
                ipUnbindFile($image, 'SimpleProduct', $widgetId);
            }
        }
        if (is_array($postData['images'])) {
            foreach($postData['images'] as $image) {
                ipBindFile($image, 'SimpleProduct', $widgetId);
            }
        }
        return $postData;
    }



}
