var config = {
    map: {
        '*': {
            'Magento_Checkout/template/payment.html': 
                'Sartaj_Checkout/template/payment.html' //override payment.html file
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/payment': {
                'Sartaj_Checkout/js/view/payment-mixin': true // Create mixin of payment.js to add custom link
            }
        }
    }
};
