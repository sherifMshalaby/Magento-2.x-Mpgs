<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Http\Hosted;

use Appmerce\Mpgs\Gateway\Http\TransferFactory;
use Appmerce\Mpgs\Gateway\Http\Client\Rest;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;

class TransferFactoryOrder extends TransferFactory
{
    /**
     * @var string
     */
    protected $httpMethod = Rest::GET;

    /**
     * @param PaymentDataObjectInterface $payment
     * @return string
     */
    protected function getUri(PaymentDataObjectInterface $payment)
    {
        $orderId = $payment->getOrder()->getOrderIncrementId();
        return $this->getGatewayUri() . 'order/'.$orderId;
    }
}
