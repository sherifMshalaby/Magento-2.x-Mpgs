<?php
/**
 * Copyright © 2019 Appmerce - Applications for Ecommerce
 * http://www.appmerce.com
 */
namespace Appmerce\Mpgs\Block\Customer;

use Magento\Vault\Api\Data\PaymentTokenInterface;
use Magento\Vault\Block\AbstractCardRenderer;

/**
 * Class CardRenderer
 * @package Appmerce\Mpgs\Block\Customer
 * @method array getAvailableProviders()
 */
class CardRenderer extends AbstractCardRenderer
{
    /**
     * Can render specified token
     *
     * @param PaymentTokenInterface $token
     * @return boolean
     */
    public function canRender(PaymentTokenInterface $token)
    {
        return in_array($token->getPaymentMethodCode(), array_values($this->getAvailableProviders()));
    }

    /**
     * @return string
     */
    public function getNumberLast4Digits()
    {
        return substr($this->getTokenDetails()['cc_number'], -4);
    }

    /**
     * @return string
     */
    public function getExpDate()
    {
        return $this->getTokenDetails()['cc_expr_month'] . '/' . $this->getTokenDetails()['cc_expr_year'];
    }

    /**
     * @return string
     */
    public function getIconUrl()
    {
        return $this->getIconForType($this->getTokenDetails()['type'])['url'];
    }

    /**
     * @return int
     */
    public function getIconHeight()
    {
        return $this->getIconForType($this->getTokenDetails()['type'])['height'];
    }

    /**
     * @return int
     */
    public function getIconWidth()
    {
        return $this->getIconForType($this->getTokenDetails()['type'])['width'];
    }
}
