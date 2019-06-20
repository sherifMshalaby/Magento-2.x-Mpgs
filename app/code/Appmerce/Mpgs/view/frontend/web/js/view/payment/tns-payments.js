/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'tns_direct',
                component: 'Appmerce_Mpgs/js/view/payment/method-renderer/tns-direct'
            },
            {
                type: 'tns_hosted',
                component: 'Appmerce_Mpgs/js/view/payment/method-renderer/tns-hosted'
            },
            {
                type: 'tns_hpf',
                component: 'Appmerce_Mpgs/js/view/payment/method-renderer/tns-hpf'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);
