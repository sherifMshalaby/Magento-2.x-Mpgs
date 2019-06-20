<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Http\ThreeDSecure;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Appmerce\Mpgs\Gateway\Http\Client\Rest;
use Appmerce\Mpgs\Gateway\Http\TransferFactory;

class TransferFactoryProcess extends TransferFactory
{
    /**
     * @var string
     */
    protected $httpMethod = Rest::POST;

    /**
     * @param PaymentDataObjectInterface $payment
     * @return string
     */
    protected function getUri(PaymentDataObjectInterface $payment)
    {
        $threeDSId = $payment->getPayment()->getAdditionalInformation('3DSecureId');
        if (!$threeDSId) {
            throw new \InvalidArgumentException("3D-Secure ID not provided");
        }
        return $this->getGatewayUri() . '3DSecureId/' . $threeDSId;
    }
}
