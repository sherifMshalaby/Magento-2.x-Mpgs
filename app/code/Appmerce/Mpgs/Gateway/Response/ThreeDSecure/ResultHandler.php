<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Gateway\Response\ThreeDSecure;

use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Gateway\Response\HandlerInterface;
use Magento\Sales\Model\Order\Payment;

class ResultHandler implements HandlerInterface
{
    const THREEDSECURE_RESULT = '3DSecureResult';

    /**
     * Handles response
     *
     * @param array $handlingSubject
     * @param array $response
     * @return void
     */
    public function handle(array $handlingSubject, array $response)
    {
        $paymentDO = SubjectReader::readPayment($handlingSubject);

        /** @var Payment $payment */
        $payment = $paymentDO->getPayment();

        // @todo: remove these params when done with them
        $payment->setAdditionalInformation(static::THREEDSECURE_RESULT, [
            'acsEci' => $response['3DSecure']['acsEci'],
            'authenticationToken' => $response['3DSecure']['authenticationToken'],
            'status' => $response['3DSecure']['summaryStatus'],
            'xid' => $response['3DSecure']['xid'],
        ]);

        $payment->unsAdditionalInformation('PaRes');
    }
}
