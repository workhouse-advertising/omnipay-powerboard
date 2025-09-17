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
        // TODO: Consider if we should check against the charge instead or if we can rely on
        //       the checkout status. It's a bit irritating that the checkout uses `completed`
        //       and charges use `complete`.
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

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getIntentId();
    }
}
