<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Sartaj\Checkout\Block;

class CheckoutBlock extends \Magento\Framework\View\Element\Template {

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getCustomerAccountURL() {
        return false;
    }
}