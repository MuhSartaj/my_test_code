<?php
declare(strict_types=1);
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Sartaj\Checkout\Controller\Addfee;

use Magento\Customer\Model\Session as CustomerSession;

class Save extends \Magento\Framework\App\Action\Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CustomerSession $customerSession
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
    	$this->customerSession->setExtraFee($this->getRequest()->getParam('extrafee'));
        echo json_encode(['success' => true]);
    }
}
