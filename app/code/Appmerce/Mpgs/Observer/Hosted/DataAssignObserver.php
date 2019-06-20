<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Observer\Hosted;

use Appmerce\Mpgs\Observer\DataAssignAbstract;

class DataAssignObserver extends DataAssignAbstract
{
    const RESULT_INDICATOR = 'resultIndicator';
    const SESSION_VERSION = 'sessionVersion';

    /**
     * @var array
     */
    protected $additionalInformationList = [
        self::RESULT_INDICATOR,
        self::SESSION_VERSION,
    ];
}
