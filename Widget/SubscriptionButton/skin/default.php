<?php if (!empty($price)) { ?>
    <a href="<?php echo escAttr($checkoutUrl) ?>"><span data-widgetid="<?php echo (int) $widgetId ?>" class="_button button"><?php echo esc($buttonText) ?></span></a>
<?php } elseif(ipAdminId()) { ?>
    <p><?php echo __('WARNING: please set subscription price and name', 'SubscriptionButton') ?></p>
<?php } ?>

