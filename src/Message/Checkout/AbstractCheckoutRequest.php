<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Powerboard\Message\AbstractRequest;

abstract class AbstractCheckoutRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getIntentId()
    {
        return $this->getParameter('intentId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setIntentId($value)
    {
        return $this->setParameter('intentId', $value);
    }
}
