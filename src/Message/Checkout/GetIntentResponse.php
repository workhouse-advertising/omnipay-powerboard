<?php

namespace Omnipay\Powerboard\Message\Checkout;

use Omnipay\Powerboard\Message\AbstractResponse;

class GetIntentResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return ($this->getData()['status'] ?? null) == 200;
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
