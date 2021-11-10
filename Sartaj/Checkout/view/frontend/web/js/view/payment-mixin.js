/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'jquery',
    'underscore',
    'uiComponent',
    'ko',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/step-navigator',
    'Magento_Checkout/js/model/payment-service',
    'Magento_Checkout/js/model/payment/method-converter',
    'Magento_Checkout/js/action/get-payment-information',
    'Magento_Checkout/js/model/checkout-data-resolver',
    'mage/translate',
    'mage/url'
], function (
    $,
    _,
    Component,
    ko,
    quote,
    stepNavigator,
    paymentService,
    methodConverter,
    getPaymentInformation,
    checkoutDataResolver,
    $t,
    url
) {
    'use strict';

    var mixin = {

        addExtraFee: function(){
            var extrafee = $('#extrafee').val();
            if(!extrafee || extrafee == null){
                return false;
            }
            var _response = false;
            $.ajax({
                url: url.build('extrafee/addfee/save'),
                data: {extrafee : extrafee},
                type: 'POST',
                showLoader: true, //use for display loader 
                async: false,
                beforeSend: function(){
                    $('body').trigger('processStart');
                },
                success: function(response){
                    console.log(response);
                    _response = response.success;
                    $('body').trigger('processStop');
                }
            });
            $('li.opc-progress-bar-item._complete span').trigger('click');
        }
    };
    
    return function (target) {
        return target.extend(mixin);
    };
});
