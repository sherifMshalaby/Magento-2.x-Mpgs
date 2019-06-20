<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Http\ThreeDSecure;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Appmerce\Mpgs\Gateway\Http\TransferFactory;

class TransferFactoryEnrolment extends TransferFactory
{
    /**
     * @param PaymentDataObjectInterface $payment
     * @return string
     */
    protected function getUri(PaymentDataObjectInterface $payment)
    {
        $threeDSecureId = uniqid(sprintf('3DS-'));
        return $this->getGatewayUri() . '3DSecureId/' . $threeDSecureId;
    }
}
