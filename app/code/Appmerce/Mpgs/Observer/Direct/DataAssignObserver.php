<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Observer\Direct;

use Appmerce\Mpgs\Gateway\Request\Direct\CardDataBuilder;
use Appmerce\Mpgs\Observer\DataAssignAbstract;

class DataAssignObserver extends DataAssignAbstract
{
    /**
     * @var array
     */
    protected $additionalInformationList = [
        CardDataBuilder::CC_TYPE,
        CardDataBuilder::CC_EXP_YEAR,
        CardDataBuilder::CC_EXP_MONTH,
        CardDataBuilder::CC_NUMBER,
        CardDataBuilder::CC_CID
    ];
}
