<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        // TODO: Check and confirm available charge statuses, etc...
        return $this->getChargeStatus() == 'complete';
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
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getCharge()['_id'] ?? null;
    }
}
