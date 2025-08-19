<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\AbstractResponse;

class InitiateAuthenticationResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return ($this->getData()['status'] ?? null) == 201;
    }

    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->getData()['resource']['data'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getChargeStatus()
    {
        return $this->getCharge()['status'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationToken()
    {
        return $this->getCharge()['_3ds']['token'] ?? null;
    }
}
