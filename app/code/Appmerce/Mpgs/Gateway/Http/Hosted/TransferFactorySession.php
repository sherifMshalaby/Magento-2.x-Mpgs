<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Http\Hosted;

use Appmerce\Mpgs\Gateway\Http\Client\Rest;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Appmerce\Mpgs\Gateway\Http\TransferFactory;

class TransferFactorySession extends TransferFactory
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
        return $this->getGatewayUri() . 'session';
    }
}
