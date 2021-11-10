<?php
declare(strict_types=1);
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Sartaj\Checkout\Observer\Frontend\Sales;

use Magento\Customer\Model\Session;
use Psr\Log\LoggerInterface;

class OrderPlaceAfter implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Construct method
     *
     * @param Session $customerSession
     * @param LoggerInterface $logger
     */
    public function __construct(
        Session $customerSession,
        LoggerInterface $logger
    ) {
        $this->customerSession = $customerSession;
        $this->logger = $logger;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $this->logger->debug('here now.');
        $this->customerSession->unsExtraFee();
    }
}
