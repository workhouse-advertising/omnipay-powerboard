<?php

namespace Omnipay\Powerboard\Message\Wallet;

use Omnipay\Powerboard\Message\AbstractRequest;

abstract class AbstractWalletRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->getParameter('meta');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setMeta($value)
    {
        return $this->setParameter('meta', $value);
    }
}
