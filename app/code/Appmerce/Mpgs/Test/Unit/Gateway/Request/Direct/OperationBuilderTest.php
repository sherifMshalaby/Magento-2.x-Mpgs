<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Test\Unit\Gateway\Request\Direct;

use Appmerce\Mpgs\Gateway\Request\OperationBuilder;

class OperationBuilderTest extends \PHPUnit_Framework_TestCase
{
    const OPERATION = 'OPERATION';

    /**
     * @var OperationBuilder
     */
    private $operationBuilder;

    /**
     * setUp
     */
    public function setUp()
    {
        $this->operationBuilder = new OperationBuilder(static::OPERATION);
    }

    /**
     * testBuildSuccess
     */
    public function testBuildSuccess()
    {
        $expected = [
            'apiOperation' => static::OPERATION
        ];

        $result = $this->operationBuilder->build([]);
        static::assertEquals($expected, $result);
    }
}
