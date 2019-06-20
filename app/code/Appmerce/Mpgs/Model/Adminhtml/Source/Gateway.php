<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Model\Adminhtml\Source;

use Magento\Framework\Option\ArrayInterface;
use Appmerce\Mpgs\Gateway\Config\Config;

class Gateway implements ArrayInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => Config::API_EUROPE,
                'label' => __('Europe')
            ],
            [
                'value' => Config::API_ASIA,
                'label' => __('Asia Pacific')
            ],
            [
                'value' => Config::API_AMERICA,
                'label' => __('North America')
            ],
            [
                'value' => Config::API_UAT,
                'label' => __('UAT')
            ],
            [
                'value' => Config::API_OTHER,
                'label' => __('Other')
            ],
        ];
    }
}
