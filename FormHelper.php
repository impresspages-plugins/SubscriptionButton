<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 14.7.19
 * Time: 19.44
 */

namespace Plugin\SubscriptionButton;


class FormHelper
{
    public static function widgetEditForm($widgetData)
    {
        $form = new \Ip\Form();

        $form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);


        $form->addField(new \Ip\Form\Field\Text(
                array(
                    'name' => 'buttonText',
                    'label' => __( 'Button text', 'SimpleProduct', false ),
                    'value' => empty($widgetData['title']) ? __( 'Subscribe', 'SimpleProduct', false ) : $widgetData['title']
                )
            )
        );

        $form->addField(new \Ip\Form\Field\Text(
                array(
                    'name' => 'alias',
                    'label' => __( 'Alias (unique identificator)', 'SimpleProduct', false ),
                    'value' => empty($widgetData['alias']) ? null : $widgetData['alias']
                )
            )
        );

        $form->addField(new \Ip\Form\Field\Currency(
                array(
                    'name' => 'price',
                    'label' => __( 'Price', 'SimpleProduct', false ),
                    'value' => empty($widgetData['price']) ? null : $widgetData['price'],
                    'validators' => array('Required', array('Regex', '/^[A-Z][A-Z][A-Z]$/'))
                )
            )
        );

        $form->addField(new \Ip\Form\Field\Text(
                array(
                    'name' => 'currency',
                    'label' => __( 'Currency', 'SimpleProduct', false ),
                    'value' => empty($widgetData['currency']) ? null : $widgetData['currency'],
                    'hint' => __('Three uppercase letter code. Eg. USD', 'SimpleProduct', false)
                )
            )
        );

        $form->addField(new \Ip\Form\Field\Select(
                array(
                    'name' => 'period',
                    'label' => __( 'Subscription period', 'SimpleProduct', false ),
                    'value' => empty($widgetData['period']) ? 'month' : $widgetData['period'],
                    'values' => array(array('day', 'Day'), array('week', 'Week'), array('month', 'Month'), array('year', 'Year')),
                    'note' => __('Payment will be automatically taken from the account in intervals defined in this field. Change of this field doesn\'t change already existing subscriptons.', 'SimpleProduct', false)
                )
            )
        );



        $form->addField(new \Ip\Form\Field\Url(
                array(
                    'name' => 'successUrl',
                    'label' => __( 'Page after successful payment', 'SimpleProduct', false ),
                    'value' => empty($widgetData['successUrl']) ? null : $widgetData['successUrl'],
                    'note' => __( 'Leave empty for default', 'SimpleProduct', false ),
                )
            )
        );

        return $form;
    }

}
