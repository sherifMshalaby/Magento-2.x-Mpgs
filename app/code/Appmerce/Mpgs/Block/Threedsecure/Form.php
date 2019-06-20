<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Block\Threedsecure;

use Magento\Framework\View\Element\Template;
use Appmerce\Mpgs\Gateway\Request\ThreeDSecure\CheckDataBuilder;

class Form extends Template
{
    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->_urlBuilder->getUrl(CheckDataBuilder::RESPONSE_URL, ['_secure' => true]);
    }
}
