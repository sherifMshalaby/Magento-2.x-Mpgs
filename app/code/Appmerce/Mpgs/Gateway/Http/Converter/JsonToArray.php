<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Http\Converter;

use Magento\Payment\Gateway\Http\ConverterException;
use Magento\Payment\Gateway\Http\ConverterInterface;

/**
 * Class JsonToArray
 */
class JsonToArray implements ConverterInterface
{
    /**
     * Converts gateway response to ENV structure
     *
     * @param mixed $response
     * @return array
     * @throws ConverterException
     */
    public function convert($response)
    {
        if (!is_string($response) || empty($response)) {
            throw new ConverterException(__('Wrong response type'));
        }

        return \Zend_Json_Decoder::decode($response, \Zend_Json::TYPE_ARRAY);
    }
}
