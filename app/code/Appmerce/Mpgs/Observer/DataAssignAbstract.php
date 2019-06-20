<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Observer;

use Magento\Framework\Event\Observer;
use Magento\Payment\Observer\AbstractDataAssignObserver;

class DataAssignAbstract extends AbstractDataAssignObserver
{
    /**
     * @var array
     */
    protected $additionalInformationList = [];

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $data = $this->readDataArgument($observer);
        $paymentInfo = $this->readPaymentModelArgument($observer);

        foreach ($this->additionalInformationList as $additionalInformationKey) {
            $path = sprintf('additional_data/%s', $additionalInformationKey);
            if ($data->getDataByPath($path) !== null) {
                $paymentInfo->setAdditionalInformation(
                    $additionalInformationKey,
                    $data->getDataByPath($path)
                );
            }
        }
    }
}
