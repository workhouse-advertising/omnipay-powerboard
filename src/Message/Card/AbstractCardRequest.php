<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\AbstractRequest;

abstract class AbstractCardRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getVaultToken()
    {
        return $this->getParameter('vaultToken');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setVaultToken($value)
    {
        return $this->setParameter('vaultToken', $value);
    }
}
