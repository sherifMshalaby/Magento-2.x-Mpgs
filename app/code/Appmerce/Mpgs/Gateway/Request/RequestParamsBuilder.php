<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;

class RequestParamsBuilder implements BuilderInterface
{
    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        return [
            'order_id' => $buildSubject['order_id'],
            'transaction_id' => $buildSubject['transaction_id']
        ];
    }
}
