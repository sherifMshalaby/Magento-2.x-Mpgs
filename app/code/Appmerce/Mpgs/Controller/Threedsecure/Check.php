<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Controller\Threedsecure;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Checkout\Model\Session;
use Magento\Payment\Gateway\Data\PaymentDataObjectFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Appmerce\Mpgs\Gateway\Response\ThreeDSecure\CheckHandler;
use Magento\Payment\Gateway\Command\CommandPoolFactory;

/**
 * Class Check
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Check extends \Magento\Framework\App\Action\Action implements CsrfAwareActionInterface
{
    const CHECK_ENROLMENT = '3ds_enrollment';
    const CHECK_ENROLMENT_TYPE_DIRECT = 'TnsThreeDSecureEnrollmentCommand';
    const CHECK_ENROLMENT_TYPE_HPF = 'TnsHpfThreeDSecureEnrollmentCommand';

    /**
     * @var Session
     */
    private $checkoutSession;

    /**
     * @var PaymentDataObjectFactory
     */
    private $paymentDataObjectFactory;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var CommandPoolFactory
     */
    private $commandPoolFactory;

    /**
     * Check constructor.
     * @param CommandPoolFactory $commandPoolFactory
     * @param Session $checkoutSession
     * @param PaymentDataObjectFactory $paymentDataObjectFactory
     * @param JsonFactory $jsonFactory
     * @param Context $context
     */
    public function __construct(
        CommandPoolFactory $commandPoolFactory,
        Session $checkoutSession,
        PaymentDataObjectFactory $paymentDataObjectFactory,
        JsonFactory $jsonFactory,
        Context $context
    ) {
        parent::__construct($context);
        $this->commandPoolFactory = $commandPoolFactory;
        $this->checkoutSession = $checkoutSession;
        $this->paymentDataObjectFactory = $paymentDataObjectFactory;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @inheritDoc
     */
    public function createCsrfValidationException(
        RequestInterface $request
    ): ?InvalidRequestException {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
    
    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $quote = $this->checkoutSession->getQuote();
        $jsonResult = $this->jsonFactory->create();
        try {
            // @todo: Commands require specific config, so they need to be defined separately in the di.xml
            $commandPool = $this->commandPoolFactory->create([
                'commands' => [
                    'hpf' => static::CHECK_ENROLMENT_TYPE_HPF,
                    'direct' => static::CHECK_ENROLMENT_TYPE_DIRECT,
                ]
            ]);

            $paymentDataObject = $this->paymentDataObjectFactory->create($quote->getPayment());

            $commandPool
                ->get($this->getRequest()->getParam('method'))
                ->execute([
                    'payment' => $paymentDataObject,
                    'amount' => $quote->getGrandTotal(),
                ]);

            $checkData = $paymentDataObject
                ->getPayment()
                ->getAdditionalInformation(CheckHandler::THREEDSECURE_CHECK);

            $jsonResult->setData([
                'result' => $checkData['status']
            ]);
        } catch (\Exception $e) {
            $jsonResult
                ->setHttpResponseCode(400)
                ->setData([
                    'message' => $e->getMessage()
                ]);
        }

        return $jsonResult;
    }
}
