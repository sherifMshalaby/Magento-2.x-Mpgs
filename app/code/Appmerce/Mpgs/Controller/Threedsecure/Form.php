<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Controller\Threedsecure;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\LayoutFactory;
use Magento\Checkout\Model\Session;
use Appmerce\Mpgs\Gateway\Response\ThreeDSecure\CheckHandler;

class Form extends Action implements CsrfAwareActionInterface
{
    /**
     * @var RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Acs constructor.
     * @param Context $context
     * @param RawFactory $pageFactory
     * @param LayoutFactory $layoutFactory
     * @param Session $session
     */
    public function __construct(
        Context $context,
        RawFactory $pageFactory,
        LayoutFactory $layoutFactory,
        Session $session
    ) {
        parent::__construct($context);
        $this->resultRawFactory = $pageFactory;
        $this->layoutFactory = $layoutFactory;
        $this->session = $session;
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
        /* @var \Magento\Framework\View\Element\Template $block */
        $block = $this->layoutFactory
            ->create()
            ->createBlock('\Appmerce\Mpgs\Block\Threedsecure\Form');

        $payment = $this->session->getQuote()->getPayment();

        $block
            ->setTemplate('Appmerce_Mpgs::threedsecure/form.phtml')
            ->setData($payment->getAdditionalInformation(CheckHandler::THREEDSECURE_CHECK));

        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents(
            $block->toHtml()
        );
    }
}
