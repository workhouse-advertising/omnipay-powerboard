<?php

namespace Omnipay\Powerboard\Message;

use Omnipay\Powerboard\Message\AbstractResponse;

class GetChargeResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        // return ($this->getData()['status'] ?? null) == 200;
        return $this->getChargeStatus() == 'complete';
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->getData()['resource']['data'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->getResource();
    }

    /**
     * @return mixed
     */
    public function getChargeStatus()
    {
        return $this->getCharge()['status'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getCharge()['_id'] ?? null;
    }
}
