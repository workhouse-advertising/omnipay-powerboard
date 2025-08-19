<?php

namespace Omnipay\Powerboard\Message\Card;

use Omnipay\Powerboard\Message\AbstractResponse;

class CreateSessionResponse extends AbstractResponse
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
    public function getPaymentSource()
    {
        return $this->getData()['resource']['data'] ?? null;
    }
}
