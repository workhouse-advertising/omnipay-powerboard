<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Powerboard\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return ($this->getIntent()['status'] ?? null) == 'completed';
    }

    /**
     * @return mixed
     */
    public function getIntent()
    {
        return $this->getData()['resource']['data'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getIntentId()
    {
        return $this->getIntent()['_id'] ?? null;
    }
}
