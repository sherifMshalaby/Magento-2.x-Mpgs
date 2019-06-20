<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Config\Hosted;

class Config extends \Appmerce\Mpgs\Gateway\Config\Config
{
    const COMPONENT_URI = '%scheckout/version/%s/checkout.js';

    /**
     * @var string
     */
    protected $method = 'tns_hosted';

    /**
     * @return string
     */
    public function getComponentUrl()
    {
        return sprintf(
            static::COMPONENT_URI,
            $this->getApiAreaUrl(),
            $this->getValue('api_version')
        );
    }

    /**
     * @return bool
     */
    public function isVaultEnabled()
    {
        return false;
    }
}
