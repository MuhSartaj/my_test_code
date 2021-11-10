<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sartaj\Checkout\Model\Total;

use Magento\Customer\Model\Session as CustomerSession;


class Fee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
   /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     * @return CustomerSession $customerSession
     */
    protected $quoteValidator = null; 

    protected $extra_fee = 0;

    public function __construct(
        \Magento\Quote\Model\QuoteValidator $quoteValidator,
        CustomerSession $customerSession
    )
    {
        $this->quoteValidator = $quoteValidator;
        $this->customerSession = $customerSession;
        $this->extra_fee = $this->customerSession->getExtraFee();
    }
  public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        if($this->extra_fee == 0){
            return false;
        }
        $exist_amount = 0; //$quote->getFee(); 
        $fee = $this->extra_fee; //Excellence_Fee_Model_Fee::getFee();
        $balance = $fee - $exist_amount;

        $total->setTotalAmount('fee', $balance);
        $total->setBaseTotalAmount('fee', $balance);

        $total->setFee($balance);
        $total->setBaseFee($balance);

        $total->setGrandTotal($total->getGrandTotal());
        $total->setBaseGrandTotal($total->getBaseGrandTotal());

        /*$this->customerSession->unsExtraFee();*/
        return $this;
    } 

    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }
    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array|null
     */
    /**
     * Assign subtotal amount and label to address object
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        return [
            'code' => 'fee',
            'title' => 'Extra',
            'value' => $this->extra_fee
        ];
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Extra');
    }
}
