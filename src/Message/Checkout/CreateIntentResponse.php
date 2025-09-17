<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Powerboard\Message\AbstractResponse;

class CreateIntentResponse extends AbstractResponse
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

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getIntentId();
    }
}
