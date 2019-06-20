<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Observer\Hpf;

use Appmerce\Mpgs\Observer\DataAssignAbstract;

class DataAssignObserver extends DataAssignAbstract
{
    const SESSION = 'session';

    /**
     * @var array
     */
    protected $additionalInformationList = [
        self::SESSION,
    ];
}
