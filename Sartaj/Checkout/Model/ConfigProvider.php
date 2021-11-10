<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sartaj\Checkout\Model;

use Magento\Checkout\Model\ConfigProviderInterface;


class ConfigProvider implements ConfigProviderInterface {

    protected $checkoutBlock;

    public function __construct(
        \Sartaj\Checkout\Block\CheckoutBlock $checkoutBlock
    ) {
        $this->checkoutBlock = $checkoutBlock;
    }
    public function getConfig() {
        $config = [];
        $config['customUrl'] = $this->checkoutBlock->getCustomerAccountURL();
        return $config;
    }
}
