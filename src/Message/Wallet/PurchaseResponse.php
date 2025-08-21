<?php

namespace Omnipay\Powerboard\Message\Wallet;

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
    public function getResource()
    {
        return $this->getData()['resource']['data'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getWallet()
    {
        // TODO: Ideally this should match the format in the create request, but it won't just now.
        return $this->getResource();
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
}
